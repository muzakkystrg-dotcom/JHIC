# PERFORMANCE_OPTIMIZATION.md — JHIC Portal (SMK Telkom Sidoarjo)

> Analisis performa, efisiensi resource, dan bottleneck untuk repo Laravel 11 + Blade + Tailwind v4 (Vite).
> Semua temuan di bawah diverifikasi langsung dari filesystem, query database, dan HTTP response — bukan asumsi.
> Dasar audit: commit `73574a5` (branch `development`), tanggal audit 2026-10-04 22:16 WIB.

---

## 1. Executive Performance Summary

Aplikasi **secara arsitektur sudah di jalur yang benar**: font self-hosted (no Google Fonts/gstatic), ikon Lucide di-*tree-shake* (hanya ~50 ikon dipakai), Chart.js di-*code-split* (hanya halaman Prestasi yang mengunduh 203 KB), AOS dimatikan otomatis di HP & saat `prefers-reduced-motion`, dan upload PII disimpan di disk privat. **Tidak ada CDN eksternal yang memblokir render.**

Masalahnya bukan "kode lambat", tapi **artifact development & konfigurasi yang belum dipindah ke mode produksi**. Tiga hal terbesar:

| # | Bottleneck utama | Dampak nyata | Severity |
|---|---|---|---|
| 1 | `public/hot` ada di disk (isi `http://[::1]:5173`) | Layout `@vite` me-render URL **Vite dev server**, bukan asset hasil build. Kalau `npm run dev` mati → CSS & JS **404, situs blank/tanpa gaya**. Terbukti dari HTML homepage: `src="http://[::1]:5173/@vite/client"` | **CRITICAL** |
| 2 | Sisa artifact: `public/images/_originals` **15,0 MB / 62 file PNG**, PNG uncompressed yang masih disajikan **1,9 MB**, `public/assets/js/home.js` (9,5 KB, tak dipakai) | Bobot repo/deploy bengkak; beberapa halaman (Profil Guru, Ekstra) mengirim PNG 100–200 KB yang bisa jadi WebP ~30–60 KB | **HIGH** |
| 3 | Fan-out lamaran **sinkron** di `submitRegistration` (≈ 3 query × jumlah mitra = ~40 query/request, plus 2 upload file, semua di jalur HTTP) | Submit form alumni makin lambat linear terhadap jumlah mitra (13 mitra sekarang). Bikin timeout saat mitra bertambah | **HIGH** |

Tambahan: **tidak ada config/route/view/event cache**, `APP_ENV=local` + `APP_DEBUG=true` + `LOG_LEVEL=debug`, `QUEUE_CONNECTION=sync`, dan **tidak ada kompresi (gzip/brotli) maupun Cache-Control** untuk aset statis (dikonfirmasi: `mod_deflate`/`mod_expires` di Apache LAMPP di-*load* tapi **tanpa satu pun direktif** `ExpiresByType`/`AddOutputFilterByType`; `nginx.conf` masih `#gzip on;`).

Estimasi gabungan (konservatif, dijelaskan di §5): **payload halaman turun 65–80%** untuk aset teks (gzip/brotli) + **~1,9 MB PNG** bisa dipangkas 60–70%, **waktu submit jadi konstan** (bukan linear ke jumlah mitra), dan **bootstrap Laravel turun ~20–60 ms/request** setelah seluruh cache produksi aktif.

---

## 2. Root Causes Analysis — kenapa website terasa berat

### 2.1 Asset & Frontend

**A. `public/hot` masih ada (CRITICAL).**
- File: `public/hot` → isi literal `http://[::1]:5173` (17 byte). Vite dev server memang sedang listen di `[::1]:5173` (`ss -ltnp`).
- Konsekuensi: `resources/views/layouts/app.blade.php:11` (`@vite([...])`) memakai manifest dev, menghasilkan 3 request ke dev server:
  ```
  href="http://[::1]:5173/resources/css/app.css"
  src="http://[::1]:5173/resources/js/app.js"
  src="http://[::1]:5173/@vite/client"
  ```
  Di server produksi tanpa `npm run dev`, ketiga request ini gagal → **halaman tanpa Tailwind sama sekali**.
- Catatan: `public/hot` sudah masuk `.gitignore` (aman dari commit), tapi **tetap ikut kalau deploy dengan rsync/copy folder**, dan tetap mengubah perilaku render selama file itu ada di disk.
- Simetris: `public/build/manifest.json` **ada** (hasil build valid), jadi tinggal hapus `public/hot` → layout otomatis kembali ke asset ter-*hash*.

**B. Bundling tidak seragam: aset di `public/assets/*` melewati Vite.**
Empat skrip + 3 stylesheet dimuat lewat `asset()` mentah (tanpa hash, tanpa cache-busting, tanpa minify lewat pipeline):

| File | Ukuran | Dimuat di | Catatan |
|---|---|---|---|
| `public/assets/js/chatbot.js` | 3.742 B | `layouts/app.blade.php:346` — **semua halaman** | global, di luar bundle |
| `public/assets/css/chatbot.css` | 3.422 B | `layouts/app.blade.php:345` — **semua halaman** | global, di luar bundle |
| `public/assets/js/jurufind.js` | 17.031 B | `jurufind.blade.php:174`, `jurufind/test.blade.php:123` | skrip terbesar yang tak ter-bundle |
| `public/assets/js/ppdb.js` | 780 B | `ppdb.blade.php:316` | |
| `public/assets/css/ppdb.css` | 1.142 B | `ppdb.blade.php:312` | |
| `public/assets/css/jurufind.css` | 14.171 B | `jurufind.blade.php:170`, `jurufind/test.blade.php:6` | |
| `public/assets/js/home.js` | 9.491 B | **tidak direferensikan siapa pun** | **dead code** (grep di seluruh `resources/views` = 0 hit) |

Karena `asset('assets/...')` tidak menyertakan cache-buster, file-file ini **tidak bisa** diberi header `immutable`/cache 1 tahun dengan aman (kalau isi berubah, browser menyajikan versi basi).

**C. Font: 2 dari 4 file woff2 kemungkinan mati.**
- Terpakai: `Plus Jakarta Sans` (latin 27.348 B + latin-ext 21.728 B) — dipreload di `app.blade.php:10`.
- **Tidak terpakai**: `@font-face 'Inter'` (`resources/css/app.css:24-30`, 48.256 B) dan `'Space Grotesk'` (`:31-37`, 22.288 B). Grep seluruh `resources/views` = **0 pemakaian** `font-inter`/`font-grotesk`. Total **≈ 68,9 KB** aset mati di `public/fonts/`.
- Body font di CSS = `'Plus Jakarta Sans'` (`app.css:112`), jadi dua font itu murni sisa eksperimen.

**D. CSS build besar & campur aduk.**
- `public/build/assets/app-BC0ZHJN4.css` = **73,5 KB** (Tailwind v4 + custom base). Belum di-gzip saat disajikan (lihat §2.4).
- `.max-w-7xl/6xl/5xl` di-*override* `!important` di 2 breakpoint (`app.css:130-150`) plus `html{font-size:110%!important}` — sah untuk desain, tapi menambah beban kalkulasi layout di layar besar; tidak kritis.

**E. Gambar.**
- `public/images` total **19 MB**: `_originals/` **15,0 MB / 62 file PNG master**, gambar yang benar-benar disajikan hanya **4,0 MB**.
- Masih ada **16 PNG uncompressed yang disajikan** (≈ **1,9 MB**): `public/images/ekstra/paskib/paskib*.png` (6 file, ~757 KB) dan `public/images/profileguru/*.png` (10 file, ~1,05 MB). Padahal folder yang sama sudah punya konvensi WebP (`ekstra/paskib.webp`, dll). Halaman `/tentang-kami/profil-guru` memang menampilkan 29 foto guru → di situlah PNG ini paling terasa.
- Logo mitra `public/images/mitra/*.webp` sudah kecil (0,6–13 KB) — bagus.
- Sebagian `<img>` logo mitra tanpa `width`/`height` (`home.blade.php` loop mitra) → potensi CLS; mayoritas gambar lain sudah punya `width/height` + `loading` + `decoding`.

**F. Third-party runtime.**
- Google Maps iframe di `layouts/app.blade.php:294` dimuat di **setiap halaman** (sudah `loading="lazy"`, tapi tetap menarik JS berat Google saat footer masuk viewport). Bisa diganti *click-to-load* placeholder.

**G. Tidak ada cache header / kompresi (lihat §2.4).**

### 2.2 Backend & Database

**A. Fan-out sinkron di jalur request (HIGH).**
`app/Http/Controllers/CareerCenterController.php:193` memanggil `pushToIndustryDashboard()` di dalam `submitRegistration`, dan `pushToIndustryDashboard` (`:218-257`) melakukan, **per mitra**:
```
foreach ($industries as $industry) {
    JobPosting::where('industry_id', $industry->id)->first();   // query N+1
    Applicant::updateOrCreate([...], [
        'major' => $this->resolveMajor($sso),   // +1 query Student
        'dtp'   => $this->resolveDtp($sso),     // +1 query Student (DUPLIKAT, sso sama!)
    ]);
}
```
- `resolveMajor` (`:262-273`) dan `resolveDtp` (`:278-289`) **query `students` dua kali untuk SSO yang sama**.
- Dengan **13 mitra** (hasil seed `industries` = 13 baris): ≈ 13 `JobPosting` + 13 pasang cek-student + 13 `updateOrCreate` × (1 select + 1 insert/update) ≈ **~40–55 query** di satu request submit, ditempuh **sebelum** redirect sukses. Ditambah 2 operasi `Storage::put` (resume + portfolio).
- Ini yang membuat form lamaran terasa "hang" dan akan makin parah seiring mitra bertambah — padahal pekerjaan ini tidak perlu ditunggu user.

**B. Query & indexing.**
- **Index yang kurang di `applicants`**: hanya ada index dari FK (`industry_id`, `job_posting_id`, `job_application_id`) + PK. Padahal dashboard query rutin `where industry_id + where status` dan `orderByDesc('ai_match_score')`. **Tidak ada** index komposit `(industry_id, status)` maupun index `ai_match_score` → full scan per mitra saat data pelamar membesar.
- `job_applications` sudah punya index `sso` & `status` ✓. `students.sso` unique ✓. `beritas`/`job_vacancies`/`prestasi`/`trial_classes` sudah ter-index di kolom filter ✓.
- **Eager loading sudah dipakai** di `IndustryApplicantController::index` (`->with('jobPosting')`, `:23`), `show` (`->with(['jobPosting','jobApplication'])`, `:40`), `downloadFile` (`:78`) ✓. **Tidak ada N+1 view-level** di halaman itu.
- `IndustryDashboardController::index` (`:22-48`): **3 query count** terpisah dari basis yang sama + 2 query `JobPosting` (`withCount` sudah benar). Bisa dipadatkan jadi 1–2 query agregat.
- `Schema::hasTable('job_vacancies')` dipanggil **setiap** request `/career-center` (`CareerCenterController.php:28`) → 1 query metadata ekstra tiap kunjungan (defensif, tapi bisa di-cache).
- **Tidak ada pagination** di mana pun: `BeritaController::index` (`->get()`), `AlumniController`, `applicants` (`->get()`). Aman sekarang (≤10 baris/tabel), tapi jadi tebing saat konten bertumbuh (`beritas`=10, `industries`=13, `job_vacancies`=9).
- DB saat ini sangat kecil (**0,88 MB**, InnoDB) — jadi bottleneck DB **bukan volume**, melainkan **jumlah round-trip** (lihat A).

**C. Logging & session.**
- `.env`: `APP_ENV=local`, `APP_DEBUG=true`, `LOG_LEVEL=debug`, `LOG_STACK=single`, `MAIL_MAILER=log`, `QUEUE_CONNECTION=sync`, `CACHE_STORE=file`, `SESSION_DRIVER=file`. **Belum ada satu pun nilai produksi.**
- `storage/logs/laravel.log` = **229.654 B / 1.426 baris** (24 ERROR, 2 WARNING). Karena `LOG_STACK=single`, file ini **tumbuh tanpa rotasi** — kalau dibiarkan, lama-lama jadi file raksasa dan tulis-log jadi lambat.
- Session driver **file**: **151 file / 608 KB** di `storage/framework/sessions`. Tabel `sessions` **ada tapi kosong** (0 baris) — jadi ada jalur alternatif yang belum dipakai. File session tulis+baca+lock per request; skala kecil masih OK, tapi boros I/O vs Redis/database.
- `.env.bak.20261004012727` masih di disk (sudah di-`.gitignore` lewat `.env.bak.*`) — jangan sampai ikut ter-copy saat deploy manual.

### 2.3 Server & Deployment

- **Cache produksi belum pernah dibangun.** `bootstrap/cache/` hanya berisi `packages.php` (703 B) + `services.php` (21 KB). Tidak ada `config.php`, `routes-v7.php`, `events.php`. Setiap request men-*rebuild* config & me-*resolve* route dari nol.
- **`route:cache` saat ini GAGAL.** `routes/web.php` punya 4 route ber-*closure* (`:79`, `:84`, `:86`, `:92`) — 5 sebenarnya termasuk grup `:121`. Laravel menolak men-*serialize* route closure (`Unable to prepare route [..] for serialization. Uses Closure.`). Jadi sebelum bisa `route:cache`, closure itu harus diganti `Route::redirect(...)` atau invokable controller.
- **OPcache (CLI terbaca):** `opcache.enable=On`, `memory_consumption=128`, `revalidate_freq=180`, `validate_timestamps=On`. Di produksi seharusnya `validate_timestamps=0` + memori lebih besar (256 MB) supaya PHP tidak pernah stat()-check file tiap request.
- **Composer belum mode produksi:** dev dependency **masih ter-*install*** (`vendor/phpunit`, `vendor/laravel/pint`, `vendor/laravel/pail`, `phpsysh`, `nunomaduro/collision`) → `vendor` = **66 MB**. `config.composer.php` sudah `optimize-autoloader: true`, tapi belum `--no-dev` / `--classmap-authoritative`.
- **Kompresi & browser cache tidak aktif** (dikonfirmasi via HTTP header):
  - Reply homepage hanya `Cache-Control: no-cache, private` (milik Laravel), aset statis **tanpa** `Cache-Control`/`Expires`/`ETag`/`Content-Encoding`.
  - Apache LAMPP: `mod_deflate`, `mod_expires`, `mod_headers` ter-*load* (`/opt/lampp/etc/httpd.conf:107,116,117`) tapi **nol direktif** `AddOutputFilterByType` / `ExpiresByType` / `Header set Cache-Control`.
  - `nginx.conf:36` masih `#gzip on;`; tidak ditemukan vhost JHIC di `/etc/nginx`.
  - `public/.htaccess` murni rewrite Laravel — tanpa blok kompresi/caching.
- **`node_modules` 149 MB** masih ada di disk (sudah di-`.gitignore`) — jangan ikut ter-*deploy*.
- **Runtime dev**: server aktif adalah `php artisan serve` (PHP built-in single-thread) di `127.0.0.1:8000`. Ini **bukan** server produksi (single-process, tanpa mpm worker, tanpa kompresi).
- Baseline TTFB di `artisan serve` (angka dev, bukan angka produksi, untuk pembanding internal):
  | Path | HTTP | TTFB | Total | HTML |
  |---|---|---|---|---|
  | `/` | 200 | 6,5 ms | 6,7 ms | 63,2 KB |
  | `/career-center` | 200 | 33,6 ms | 33,9 ms | 55,7 KB |
  | `/tentang-kami/profil-guru` | 200 | 8,3 ms | 8,6 ms | 99,0 KB |
  | `/informasi/berita` | 200 | 9,4 ms | 9,8 ms | 61,4 KB |
  | `/jurufind`, `/ppdb` | 200 | 6,5 ms | 6,8 ms | 34,8 / 45,1 KB |

  `/career-center` 5× lebih lambat dari `/` karena query DB — konsisten dengan temuan §2.2.

### 2.4 Ringkasan bobot aset (terukur)

```
public/build/assets   324,1 KB  (7 file)   app.css 73,5 KB · chart 203,2 KB (lazy) · aos.css 25,9 KB · aos.js 14,4 KB · lucide 10,5 KB · app.js 3,7 KB · runtime 0,7 KB
public/fonts          116,8 KB  (4 file)   dari sini ±68,9 KB (Inter + Space Grotesk) tidak terpakai
public/images       19.044 KB  (151 file)  _originals 15,0 MB (62 file) · disajikan 4,0 MB · PNG disajikan 1,9 MB
public/assets          52,9 KB  (13 file)  di luar pipeline Vite; chatbot.js+css dimuat di semua halaman
vendor                 66,0 MB             masih termasuk dev-dependency
node_modules          149,0 MB             jangan ikut deploy
storage/logs          229,7 KB             laravel.log, tanpa rotasi
storage/.../sessions  608,0 KB            151 file (SESSION_DRIVER=file)
DB                      0,88 MB            InnoDB
```

---

## 3. Actionable Optimization Checklist

Prioritas: **[P0]** = sebelum rilis (wajib), **[P1]** = rilis ini/cepat, **[P2]** = berikutnya.

### Frontend / Asset
- [ ] **[P0]** Hapus `public/hot` (dan jangan pernah deploy file ini). Verifikasi `@vite` kembali memakai `public/build/manifest.json`. Tambahkan `public/hot` ke daftar cek deploy.
- [ ] **[P0]** Hapus `public/images/_originals/` dari artefak deploy (tetap di mesin dev). Hemat **15,0 MB**.
- [ ] **[P0]** Jalankan `npm run build`, commit/deploy `public/build/` (asset ter-*hash*, cache-busting otomatis).
- [ ] **[P1]** Konversi 16 PNG yang masih disajikan ke WebP (atau `loading="lazy"` + `width/height` lengkap): `public/images/ekstra/paskib/*.png` (6) dan `public/images/profileguru/*.png` (10). Perkiraan hemat **60–70%** dari 1,9 MB.
- [ ] **[P1]** Pindahkan `chatbot.js`/`chatbot.css` (dimuat **global**) + `jurufind.js`/`jurufind.css` + `ppdb.js`/`ppdb.css` ke entry Vite (mis. `resources/js/chatbot.js`, lalu `import` dari `resources/js/app.js` atau entry per-halaman). Hapus pemuatan mentah di `layouts/app.blade.php:345-346`, `jurufind.blade.php:170/174`, `ppdb.blade.php:312/316`.
- [ ] **[P1]** Hapus dead file `public/assets/js/home.js` (9,5 KB, 0 referensi).
- [ ] **[P2]** Hapus `@font-face 'Inter'` & `'Space Grotesk'` di `resources/css/app.css:24-37` + file `public/fonts/inter-latin.woff2`, `space-grotesk-latin.woff2` (≈68,9 KB) bila tak dipakai.
- [ ] **[P2]** Tambahkan `width`/`height` pada `<img>` logo mitra di loop `home.blade.php` untuk menekan CLS.
- [ ] **[P2]** Ubah Google Maps iframe (`layouts/app.blade.php:294`) jadi *click-to-load* thumbnail.

### Backend / Database
- [ ] **[P0]** Pindahkan fan-out ke Queue Job. Buat `App\Jobs\FanOutApplicationToIndustries implements ShouldQueue`, dan di `CareerCenterController::submitRegistration` ganti `pushToIndustryDashboard(...)` → `FanOutApplicationToIndustries::dispatch($application)`. Set `QUEUE_CONNECTION=database` (tabel `jobs` sudah ada) + jalankan worker (`php artisan queue:work --sleep=3 --tries=3`), plus Supervisor/systemd agar worker hidup.
- [ ] **[P1]** Di dalam Job, hilangkan N+1 & query student ganda:
  - Ambil `Student` **sekali** (`$student = Student::where('sso', $sso)->first()`), pakai untuk `major` **dan** `dtp` (buang `resolveMajor`/`resolveDtp` yang query 2×).
  - Ganti `JobPosting::...->first()` per mitra dengan satu peta `JobPosting` ber-*key* `industry_id` (1 query total), lalu lookup in-memory.
  - Bungkus dalam `DB::transaction()` dan pakai `Applicant::upsert([...])` untuk batch insert.
- [ ] **[P1]** Tambah index komposit pada `applicants`: `(industry_id, status)` dan `ai_match_score`. Migrasi baru: `$table->index(['industry_id','status']); $table->index('ai_match_score');`.
- [ ] **[P1]** Padatkan metrik dashboard `IndustryDashboardController::index` (`:22-48`) jadi 1 query agregat (`selectRaw` dengan `SUM(CASE WHEN ...)`) alih-alih 3 `count()` terpisah.
- [ ] **[P2]** Tambahkan pagination (`->paginate(12)`) di `BeritaController`, `AlumniController`, `IndustryApplicantController::index`.
- [ ] **[P2]** Cache hasil `Schema::hasTable('job_vacancies')` (mis. `Cache::rememberForever` atau hapus begitu migrasi dipastikan jalan) untuk membuang 1 query/request di `/career-center`.

### Logging / Session
- [ ] **[P0]** Set `.env` produksi: `APP_ENV=production`, `APP_DEBUG=false`, `LOG_LEVEL=error`/`warning`, `LOG_STACK=daily` (rotasi harian, retensi default 14 hari) — bukan `single`.
- [ ] **[P0]** Hapus/rotasi `storage/logs/laravel.log` (229 KB) sebelum rilis.
- [ ] **[P1]** Pertimbangkan `SESSION_DRIVER=redis` (jika ada Redis) atau `database` (tabel `sessions` sudah ada & kosong) untuk memangkas I/O file & lock. Minimal: pastikan `session:gc`/bersihkan `storage/framework/sessions` periodik.

### Server / Deployment
- [ ] **[P0]** Jalankan cache produksi:
  ```
  php artisan config:cache
  php artisan view:cache
  php artisan event:cache
  ```
  Untuk `route:cache`: **ganti dulu 4 route closure** di `routes/web.php:79,84,86,92` menjadi `Route::redirect('/program/jurusan','/jurusan/sija');` (atau invokable controller), baru jalankan `php artisan route:cache`.
- [ ] **[P0]** OPcache produksi: `opcache.validate_timestamps=0`, `opcache.memory_consumption=256`, `opcache.max_accelerated_files=20000`, `opcache.interned_strings_buffer=16`. Wajib `php-fpm`/OPcache reload tiap deploy (karena `validate_timestamps=0`).
- [ ] **[P0]** Build dependency produksi: `composer install --no-dev --optimize-autoloader --classmap-authoritative` (vendor 66 MB → turun, tanpa phpunit/pint/pail).
- [ ] **[P0]** Aktifkan kompresi + cache header di web server:
  - Apache (`public/.htaccess` atau vhost):
    ```
    <IfModule mod_deflate.c>
      AddOutputFilterByType DEFLATE text/html text/plain text/css application/javascript application/json image/svg+xml
    </IfModule>
    <IfModule mod_expires.c>
      ExpiresActive On
      ExpiresByType text/css "access plus 1 year"
      ExpiresByType application/javascript "access plus 1 year"
      ExpiresByType font/woff2 "access plus 1 year"
      ExpiresByType image/webp "access plus 6 months"
      ExpiresByType image/svg+xml "access plus 6 months"
    </IfModule>
    <IfModule mod_headers.c>
      <FilesMatch "\.(css|js|woff2|webp|svg)$">
        Header set Cache-Control "public, max-age=31536000, immutable"
      </FilesMatch>
      Header set X-Content-Type-Options "nosniff"
    </IfModule>
    ```
    (Aman karena asset build sudah ber-*hash* dari Vite.)
  - Nginx (setara): `gzip on; gzip_types ...; gzip_comp_level 6; brotli on;` (bila modul brotli ada) + `location ~* \.(css|js|woff2|webp|svg)$ { expires 1y; add_header Cache-Control "public, immutable"; }`.
- [ ] **[P0]** Jangan pakai `php artisan serve` di produksi → pakai `php-fpm` + Apache/Nginx dengan docroot `public/`.
- [ ] **[P1]** Pastikan docroot = `public/` (atau root `.htaccess` redirect-only tetap butuh `mod_rewrite` + `AllowOverride All`).
- [ ] **[P2]** Set `config/app.php` `timezone` ke `Asia/Jakarta` — saat ini `UTC`, sementara metrik dashboard memakai `now()->startOfWeek()` ("Diterima minggu ini"), jadi batas minggu meleset ±7 jam.

---

## 4. Before vs After — Benchmark Expectations

> Angka "after" adalah **estimasi berbasis ukuran terukur** (bukan hasil load-test produksi). Yang paling akurat untuk dikutip adalah angka payload & query count; angka ms bergantung server produksi.

### 4.1 Payload & aset

| Metrik | Before (terukur) | After (estimasi) | Perbaikan |
|---|---|---|---|
| Bobot `public/images` deploy | 19,0 MB | ~4,0 MB (tanpa `_originals`) | **−79%** |
| PNG yang disajikan | 1,9 MB (16 file) | ~0,6–0,75 MB (WebP q80) | **−60–70%** |
| Jumlah file font | 4 (116,8 KB) | 2 (49,1 KB) | **−58%** |
| Aset teks (CSS+JS) ter-download | tanpa gzip | ter-gzip | **−70–80%** payload teks |
| `app.css` diserve | 73,5 KB | ~12–15 KB gzip | **−80%** |
| Deploy `vendor` | 66 MB (dev deps) | lebih kecil (`--no-dev`) | **−±30–40%** |
| Cache aset ulang (visit ke-2) | tanpa Cache-Control | `immutable, max-age=1y` → 0 byte re-download | **~100% hemat** |

### 4.2 Backend / query

| Alur | Before | After | Perbaikan |
|---|---|---|---|
| `POST /career-center/register` (fan-out 13 mitra) | ~40–55 query + 2 upload, **sinkron** sebelum redirect | **~1–3 query** di request (dispatch Job), sisanya async | request **jauh lebih cepat & konstan** |
| Skalabilitas fan-out | linear O(jumlah mitra) | O(1) di jalur request; O(n) di worker | bebas timeout |
| Dashboard mitra | 3 count + 2 jobPosting query | 1–2 query agregat | ~50–60% round-trip lebih sedikit |
| `/career-center` TTFB (dev) | 33,6 ms | < 15 ms (estimasi) | ~2× lebih cepat |
| Index `applicants` saat data besar | full scan (`industry_id`+`status`, `ai_match_score`) | index-covered | query tidak tumbuh linear |

### 4.3 Bootstrap & konfigurasi

| Metrik | Before | After |
|---|---|---|
| Config/route/view/event di-rebuild tiap request | Ya | Tidak (cache) |
| OPcache stat-file check | tiap request (`validate_timestamps=On`) | tidak pernah (`=0`) |
| Estimasi penghematan bootstrap/request | — | **~20–60 ms** (khas Laravel; verifikasi di server produksi) |

### 4.4 Kesimpulan dampak
- **First Contentful Paint / LCP** membaik paling besar dari kombinasi: (1) hilangnya dependency ke Vite dev server, (2) gzip/brotli, (3) WebP. Untuk halaman berat gambar (Profil Guru, Ekstrakurikuler), estimasi **1,9 MB → ~0,6 MB** transfer.
- **Form lamaran** berubah dari "menunggu semua mitra diproses" menjadi "submit instan → redirect", dengan pekerjaan berat pindah ke queue worker.
- **Repeat visits** hampir nol transfer aset setelah header immutable dipasang.

---

## 5. Ringkasan Prioritas Eksekusi (urutan kerja)

1. [P0] Hapus `public/hot`; `npm run build`; deploy `public/build/`; jangan deploy `_originals`, `node_modules`.
2. [P0] Set `.env` produksi (`APP_ENV`, `APP_DEBUG`, `LOG_LEVEL`, `LOG_STACK=daily`, `QUEUE_CONNECTION=database`).
3. [P0] Ganti 4 route closure → `Route::redirect`; jalankan `config:cache` + `route:cache` + `view:cache` + `event:cache`.
4. [P0] `composer install --no-dev -o --classmap-authoritative`; set OPcache produksi; pakai `php-fpm` (bukan `artisan serve`).
5. [P0] Pasang gzip/brotli + `Cache-Control: immutable` untuk asset ber-*hash*.
6. [P0] Buat `FanOutApplicationToIndustries` Job + worker; ganti pemanggilan sinkron.
7. [P1] Optimasi Job (1 query Student, 1 query JobPosting map, `upsert`, transaksi).
8. [P1] Migrasi index `applicants (industry_id,status)` + `ai_match_score`; padatkan metrik dashboard.
9. [P1] Pindahkan `chatbot/js/css`, `jurufind`, `ppdb` ke Vite; hapus `home.js`; konversi PNG→WebP.
10. [P2] Pagination, hapus font mati, `timezone=Asia/Jakarta`, hitung ulang dengan load-test di server produksi.

Untuk langkah taktis rilis produksi yang bisa dieksekusi urut, lihat **`DEPLOY_CHECKLIST.md`**.

---

## 6. Status Eksekusi

### Batch 1 — P0 (critical & infra dasar): SELESAI

| # | Item | Status | Bukti / catatan |
|---|---|---|---|
| A1 | Hapus `public/hot` | ✅ DONE | Aset homepage kini `/build/assets/app-BC0ZHJN4.css` (hashed), bukan `:5173` |
| A2 | 4 route closure → `Route::redirect()` | ✅ DONE | `routes/web.php`; `grep 'fn ()'` = 0 hit |
| A3 | `route:cache` + `config:cache` + `view:cache` + `event:cache` | ✅ DONE | Semua sukses; `bootstrap/cache/` berisi `config.php`, `routes-v7.php`, `events.php` |
| A4 | Test suite hijau | ✅ DONE | 28 test pass; +4 test baru `ApplicantFanOutTest` |
| B | `.htaccess`: gzip (`mod_deflate`) + browser cache (`mod_expires`) + `Cache-Control: immutable` | ✅ DONE | **Catatan penting:** instruksi awal menyebut ada typo `HTTP_AUTHORIZATION` di baris 10 — setelah diverifikasi byte-level (`od -c` + base64) **tidak ada typo**; baris tersebut utuh & identik dengan commit skeleton. Tidak ada yang diperbaiki di situ. |
| C1 | `App\Jobs\ProcessApplicantFanOut` dibuat | ✅ DONE | `app/Jobs/ProcessApplicantFanOut.php` |
| C2 | `submitRegistration` jadi O(1) (dispatch job, bukan proses sinkron) | ✅ DONE | POST E2E → 302 instan; 13 baris difan-out oleh job |
| C3 | Optimasi N+1 di dalam job (1 query Student, 1 query JobPosting map, batch `upsert`) | ✅ DONE | Query per-mitra yang lama dihapus |
| C4 | Migration index `applicants` (unique `industry_id+job_application_id`, `industry+status`, `ai_match_score`) | ✅ DONE | Migrasi `2026_10_04_220000_...`; index terverifikasi di DB |
| C5 | Test regresi fan-out (idempoten + status mitra tidak ter-reset) | ✅ DONE | `tests/Feature/ApplicantFanOutTest.php` (4 test) |
| D1 | Hapus `public/images/_originals` | ✅ DONE | −15,0 MB (git-ignored, local-only) |
| D2 | 16 PNG orde di `ekstra/paskib/` & `profileguru/` | ✅ DONE | **16 file** (10 + 6), semuanya **nol referensi** (tidak pernah diserve) → dihapus. `public/images` 19 MB → **2,3 MB** |
| Terverifikasi | Tidak ada 404 aset | ✅ DONE | 80 aset unik di 15 halaman balas **200** |

**Dampak terukur sesudah P0:** `public/images` **19 MB → 2,3 MB (−88%)**; submit lamaran berubah dari ~40–55 query sinkron menjadi **1 insert + 1 dispatch** (fan-out 13 mitra diproses job); `route:cache` akhirnya bisa jalan.

### Koreksi penting terhadap asumsi awal analisis

1. **DB dev ter-wipe saat `php artisan test` dijalankan dalam keadaan `config:cache`.** `config:cache` membekukan `DB_CONNECTION` menjadi literal `mysql`, sehingga `<env DB_CONNECTION="sqlite">` di `phpunit.xml` **tidak lagi menang**, dan `RefreshDatabase` (yang `migrate:fresh`) menghapus seluruh isi DB MySQL dev. Sudah direproduksi & dikonfirmasi. **Aturan operasional:** selalu `php artisan optimize:clear` **sebelum** `php artisan test`, dan jangan pernah meninggalkan config cache di dev. Data dev telah di-restore lewat `php artisan db:seed`.
2. **16 PNG itu orde, bukan "terkirim tapi berat".** Ke-16 file (6 di `ekstra/paskib/`, 10 di `profileguru/`) tidak direferensikan config maupun view mana pun, jadi tidak pernah masuk HTML. Strategi yang benar: **hapus**, bukan konversi.
3. **`public/.htaccess` tidak punya typo** (lihat tabel di atas).

### Sisa item (belum dieksekusi)
Pindah `chatbot/js/css`/`jurufind`/`ppdb` ke entry Vite + hapus `public/assets/js/home.js`, hapus font mati (Inter/Space Grotesk), pagination, padatkan metrik dashboard, `timezone=Asia/Jakarta`, serta penyetelan produksi (`APP_ENV=production`, `QUEUE_CONNECTION=database` + worker, OPcache, `composer --no-dev`) — seluruhnya ada di `DEPLOY_CHECKLIST.md`.

---

### Batch 2 — P1 Frontend Asset Migration + Cleanup + Timezone: SELESAI

| Area | Item | Status | Bukti / catatan |
|---|---|---|---|
| Vite | `chatbot.js` → entry Vite (dipanggil dari `@vite()` layout, global) | ✅ DONE | chunk `chatbot-*.js` + `chatbot-*.css`; HTML homepage memuatnya (mode build) |
| Vite | `jurufind.js` → entry Vite (per-halaman) | ✅ DONE | chunk `jurufind-*`; hanya dimuat di `/jurufind` & `/jurufind/test` |
| Vite | `ppdb.js` → entry Vite (per-halaman) | ✅ DONE | chunk `ppdb-*`; `window.toggleFaq` tersedia (`typeof === 'function'`) |
| Vite | CSS ikut bundle: `chatbot.css`/`jurufind.css`/`ppdb.css` | ✅ DONE | di-import (`import '../css/x.css'`) dari masing-masing entry |
| Cleanup | Hapus `public/assets/js/home.js` | ✅ DONE | dead code, 0 referensi |
| Cleanup | Hapus `public/assets/js/jurufind.html` + 6 SVG orde | ✅ DONE | semuanya 0 referensi; folder `public/assets/` sekarang tidak ada |
| Timezone | `config/app.php` → `env('APP_TIMEZONE', 'Asia/Jakarta')` | ✅ DONE | `config('app.timezone')='Asia/Jakarta'`, `now()` = `WIB` |
| Verifikasi | Build + tidak ada 404 aset | ✅ DONE | `npm run build` sukses; 80 aset di 15 halaman = 200 |
| Verifikasi | Uji browser (mode build, proses PHP baru) | ✅ DONE | FAQ toggle ✓, widget chatbot buka & kirim ✓, kuis Jurufind render + progress ✓ |

**Bug yang ketemu & diperbaiki saat batch ini:** `resources/js/chatbot.js` sempat dihapus dari layout tapi lupa ditambahkan ke `@vite()` layout → chunk ter-build tapi tidak dimuat (widget chatbot tanpa JS). Sudah diperbaiki: `@vite(['resources/css/app.css','resources/js/app.js','resources/js/chatbot.js'])`.

### Koreksi penting: font Inter & Space Grotesk BUKAN dead code

Analisis awal (§2.1-C) menyimpulkan Inter + Space Grotesk tidak terpakai hanya karena tidak ada `font-inter`/`font-grotesk` di view. **Itu keliru.** `resources/css/jurufind.css:15-16` memakai keduanya lewat CSS variable:
```css
--jf-font-display: 'Space Grotesk', sans-serif;   /* dipakai 9× */
--jf-font-body:    'Inter', sans-serif;           /* dipakai 1× */
```
Menghapus fontnya akan merusak tipografi halaman Jurufind. **Penanganan yang benar (sudah diterapkan):** `@font-face` untuk kedua font **dipindah dari `app.css` (global) ke `jurufind.css`** — bukan dihapus. Hasilnya berkas font 48 KB + 22 KB kini hanya diunduh di halaman Jurufind, bukan di setiap halaman. Bukti: `app.css` build **0** referensi `inter/space-grotesk`; `jurufind.css` build memuat keduanya. Win performa tetap didapat (per-halaman), tanpa regresi visual.

### Catatan operasional (penting untuk dev)

- **`public/hot` akan muncul lagi selama `npm run dev` hidup.** Dev server Vite menulis ulang file itu tiap kali config berubah/reload. Karena itu langkah "hapus `public/hot`" adalah **langkah deploy** (jalankan `npm run build`, matikan `npm run dev`, lalu hapus `public/hot` di server), bukan langkah sekali-jalan di mesin dev.
- **Opcache stale di `php artisan serve`.** Setelah mengubah `@vite(...)`, HTML dari server lama bisa menampilkan tag lama sampai proses PHP di-restart (`opcache.revalidate_freq=180`). Untuk verifikasi andal: jalankan proses PHP **baru** (`php artisan serve --port=8001`) lalu cek dari sana.

### Sisa item (belum dieksekusi)
Pagination pada `BeritaController`/`AlumniController`/`IndustryApplicantController`, padatkan metrik `IndustryDashboardController::index`, dan penyetelan produksi (`APP_ENV=production`, `QUEUE_CONNECTION=database` + worker, OPcache, `composer --no-dev`, gzip/brotli vhost) — semuanya ada di `DEPLOY_CHECKLIST.md`.

---

### Batch 3 — P2 Dashboard Query + Pagination: SELESAI

| Area | Item | Status | Bukti |
|---|---|---|---|
| Dashboard | Metrik `IndustryDashboardController::index`: 3× `count()` → **1 query agregat** (`COUNT(*)` + 2× `SUM(CASE WHEN …)`) | ✅ DONE | Diverifikasi setara: metrics `{kandidat_baru:3, diterima_minggu_ini:3, total_kandidat:7}` identik, **3 query → 1** |
| Dashboard | Daftar lowongan: 2 query (aktif/ditutup) → **1 query**, dipisah di memori | ✅ DONE | active=1/inactive=1 identik, **2 query → 1** |
| Dashboard | Cast eksplisit `(int)` pada hasil agregat (driver MySQL mengembalikan string) | ✅ DONE | — |
| Pagination | `AlumniController::index` → `paginate(15)` + `withQueryString()` | ✅ DONE | `perPage=15`, nomor urut lanjut (`firstItem()+$index`) |
| Pagination | `BeritaController::index` → `paginate(9)` + `withQueryString()` | ✅ DONE | hal.1 = 9 kartu, hal.2 = 1 kartu; link pagination muncul |
| Pagination | `IndustryApplicantController::index` → `paginate(20)` + `withQueryString()` | ✅ DONE | total=25 → 2 halaman, tetap scoped per mitra |
| View | `{{ $x->links() }}` ditambahkan (alumni/berita/applicants), dibungkus `hasPages()` | ✅ DONE | terverifikasi di browser (server proses baru) |
| CSS | `@source` untuk view pagination vendor (Tailwind v4 tidak men-scan `vendor/`) | ✅ DONE | sebelum: `leading-5`/`dark:*`/`active:*` **tidak ada** di CSS build → tombol polos. Sesudah: ter-generate; `line-height:22px` = `leading-5`, `border-radius:6.6px` = `rounded-md` |
| Perf kecil | Thumbnail berita `loading="eager"`+`fetchpriority=high` → `loading="lazy"` | ✅ DONE | 9 thumbnail off-screen tidak lagi dimuat agresif |
| Test | `tests/Feature/PaginationTest.php` (4 test: paginator alumni, berita 9/hal, pelamar scoped+paginated, metrik dashboard & split lowongan) | ✅ DONE | suite total **20 passed (92 assertions)** |

**Dampak terukur Batch 3:** dashboard mitra turun dari **5 query → 2 query** per muat; daftar alumni/berita/pelamar tidak lagi mengambil seluruh tabel (`->get()`) → memori & payload stabil seiring pertumbuhan data.

### Ringkasan akhir seluruh workstream (P0 → P2): TUNTAS

| Batch | Cakupan | Status |
|---|---|---|
| P0 | `public/hot`, route closure→`route:cache`, `.htaccess` gzip+expires, fan-out→Queue Job (`ProcessApplicantFanOut`), index DB, hapus artefak gambar | ✅ SELESAI |
| P1 | Migrasi `chatbot`/`jurufind`/`ppdb` ke Vite, cleanup dead code, scoping font, `timezone=Asia/Jakarta` | ✅ SELESAI |
| P2 | Padatkan query dashboard, pagination 3 controller, `@source` CSS pagination, lazy thumbnail | ✅ SELESAI |

Suite test keseluruhan: **20 test pass** (4 `ApplicantFanOutTest` + 4 `PaginationTest` baru). Sisa penyetelan murni **konfigurasi produksi** (APP_ENV, queue worker, OPcache, `composer --no-dev`, vhost gzip/brotli) — checklist-nya ada di `DEPLOY_CHECKLIST.md` dan wajib dijalankan di server produksi, bukan di dev.
