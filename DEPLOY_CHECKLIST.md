# DEPLOY_CHECKLIST.md — JHIC Portal (SMK Telkom Sidoarjo)

> Langkah persiapan & eksekusi rilis produksi untuk Laravel 11 + Blade + Tailwind v4 (Vite).
> Pasangan dokumen: `PERFORMANCE_OPTIMIZATION.md` (analisis & alasan tiap langkah).
> Konvensi: centang `[x]` bila selesai. Jalankan pada server produksi dengan docroot `public/`.

---

## 0. Pra-terbang (di mesin lokal / CI) — WAJIB

> **PITFALL dev yang sudah terbukti:** jangan pernah menjalankan `php artisan test`
> saat `config:cache` aktif. `config:cache` membekukan `DB_CONNECTION` menjadi
> literal `mysql`, sehingga `<env DB_CONNECTION="sqlite">` di `phpunit.xml` tidak
> lagi menang dan `RefreshDatabase` akan **menghapus seluruh isi DB MySQL dev**
> (`migrate:fresh`). Selalu `php artisan optimize:clear` sebelum `php artisan test`,
> dan jangan tinggalkan config cache di lingkungan dev.

- [ ] Pastikan branch & commit benar: `git status` bersih, `git log --oneline -1`
- [ ] **Hapus `public/hot`** (artifact dev Vite). Cek: `ls public/hot` → harus "No such file".
  Tanpa ini, `@vite` akan menunjuk `http://[::1]:5173` → situs tanpa CSS/JS di produksi.
- [ ] **Build asset:** `npm run build` → verifikasi `public/build/manifest.json` + `public/build/assets/*` ter-*hash* ada.
- [ ] **Jangan sertakan**: `node_modules/` (149 MB), `public/images/_originals/` (15 MB), `.env.bak.*`, `storage/logs/*.log`, `.phpunit.result.cache`.
- [ ] Verifikasi tidak ada `public/hot` dan `_originals` di artefak rilis (mis. cek tarball: `tar -tzf release.tgz | grep -E 'public/hot|_originals'` → kosong).
- [ ] `git ls-files public/hot public/build` → **harus kosong** (keduanya di-`.gitignore`; kirim via artefak rilis, bukan git).

---

## 1. Kode & Route

- [ ] Sanity test: `php artisan test` → semua hijau. `./vendor/bin/pint --test` → bersih.
- [ ] **Ganti 4 route closure** di `routes/web.php` baris `79, 84, 86, 92` dari `fn () => redirect()->route(...)` menjadi `Route::redirect('/program/jurusan', '/jurusan/sija');` (dst), agar `route:cache` bisa jalan.
  Cek cepat masih ada closure: `grep -n 'fn ()' routes/web.php`.
- [ ] Set timezone `Asia/Jakarta` di `config/app.php` (metrik "minggu ini" di dashboard tidak meleset ±7 jam).

---

## 2. Konfigurasi `.env` Produksi

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL=https://<domain-produksi>` (harus `https`, tanpa trailing slash)
- [ ] `APP_KEY` sudah ter-*generate* (`php artisan key:generate` hanya jika baru)
- [ ] `LOG_CHANNEL=stack`, `LOG_STACK=daily`, `LOG_LEVEL=warning` (atau `error`) — **bukan** `debug`/`single`
- [ ] `QUEUE_CONNECTION=database` (+ jalankan worker; lihat §6)
- [ ] `CACHE_STORE=database` atau `redis` (default file saat ini; database lebih tahan multi-proses)
- [ ] `SESSION_DRIVER=redis` bila tersedia, jika tidak `database` (tabel `sessions` sudah ada & kosong)
- [ ] `SESSION_SECURE_COOKIE=true` (karena HTTPS), `SESSION_ENCRYPT=true` (opsional, lebih aman)
- [ ] Kredensial DB produksi benar: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- [ ] API key pihak ketiga terisi (nama variabel saja, jangan cetak nilainya): `GRIPHUBROUTER_API_KEY`, `GRIPHUBROUTER_MODEL`
- [ ] Pastikan `.env` **tidak** ikut ter-commit (`git log --all -- .env` → kosong) dan permission `chmod 600 .env`

---

## 3. Dependency & Autoloader

- [ ] `composer install --no-dev --optimize-autoloader --classmap-authoritative`
  → buang `phpunit`, `pint`, `pail`, `psysh`, `collision` dari server (vendor 66 MB → lebih kecil).
- [ ] `composer audit --locked --no-dev` → tidak ada advisory High/Critical yang belum ditangani
  (catatan: `composer.json` punya `policy.advisories.block=false` — periksa manual).
- [ ] `php artisan package:discover --ansi` (biasanya otomatis via post-autoload-dump)

---

## 4. Database

- [ ] Backup DB sebelum migrasi: `mysqldump ... > backup-YYYYMMDD.sql` (simpan di luar docroot)
- [ ] `php artisan migrate --force`
- [ ] Pastikan index baru ada di `applicants`: `(industry_id, status)` dan `ai_match_score`
  Verifikasi: `SHOW INDEX FROM applicants;` → kedua index muncul.
- [ ] Jangan jalankan `db:seed` di produksi (kecuali memang butuh data referensi: `industries`, `job_vacancies`).
- [ ] Migrasi seeder produksi yang diperlukan (opsional): `php artisan db:seed --class=IndustrySeeder --force`

---

## 5. Cache Produksi (setelah `.env` & kode final)

- [ ] `php artisan optimize:clear` (bersihkan cache lama dulu)
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`  *(hanya jalan bila §1 sudah ganti closure)*
- [ ] `php artisan view:cache`
- [ ] `php artisan event:cache`
- [ ] Verifikasi: `ls bootstrap/cache` → ada `config.php`, `routes-v7.php`, `events.php` (di samping `packages.php`, `services.php`).
- [ ] Hapus `storage/logs/laravel.log` lama & `storage/framework/sessions/*` basi sebelum go-live.
- [ ] Pastikan `storage/` & `bootstrap/cache/` writable oleh user web server.

---

## 6. Queue Worker (fan-out lamaran)

- [ ] Pastikan tabel `jobs`, `failed_jobs`, `job_batches` ada (migrasi default) — sudah ada ✓
- [ ] Jalankan worker permanen (systemd atau Supervisor):
  ```
  php artisan queue:work --sleep=3 --tries=3 --max-time=3600
  ```
  Dengan modul `queue:work` di-restart otomatis (systemd `Restart=always` / Supervisor `autorestart=true`).
- [ ] Tambahkan langkah deploy: `php artisan queue:restart` setiap kali rilis (worker memuat kode baru).
- [ ] Monitor `failed_jobs`; sediakan perintah `php artisan queue:failed` / `queue:retry all`.
- [ ] Verifikasi: submit form lamaran 1× → redirect instan, dan baris `applicants` muncul di dashboard mitra setelah worker memproses.

---

## 7. PHP Runtime (OPcache)

- [ ] `opcache.enable=1`
- [ ] `opcache.validate_timestamps=0` (produksi — **wajib reload php-fpm tiap deploy**)
- [ ] `opcache.memory_consumption=256`
- [ ] `opcache.max_accelerated_files=20000`
- [ ] `opcache.interned_strings_buffer=16`
- [ ] Pakai **php-fpm** (bukan `php artisan serve`). Reload setelah deploy: `systemctl reload php8.2-fpm` (sesuaikan versi).
- [ ] Verifikasi: `php -i | grep -E 'opcache.(enable|validate_timestamps|memory_consumption)'`

---

## 8. Web Server, Kompresi & Browser Cache

- [ ] Docroot menunjuk ke `public/` (bukan root repo). Bila terpaksa root, `mod_rewrite` + `AllowOverride All` harus aktif agar `.htaccess` root bekerja.
- [ ] **Apache** — tambahkan ke `public/.htaccess` atau vhost:
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
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
  </IfModule>
  ```
  (Aman karena asset Vite sudah ber-*hash* di nama file.)
- [ ] **Nginx** — `gzip on; gzip_comp_level 6; gzip_types text/css application/javascript application/json image/svg+xml;` dan `location ~* \.(css|js|woff2|webp|svg)$ { expires 1y; add_header Cache-Control "public, immutable"; }`. Aktifkan `brotli` bila modul tersedia.
- [ ] Verifikasi header setelah go-live:
  ```
  curl -sI -H 'Accept-Encoding: gzip, br' https://<domain>/build/assets/app-*.css | grep -iE 'content-encoding|cache-control|expires'
  ```
  → harus ada `content-encoding: gzip|br` **dan** `cache-control: public, max-age=31536000, immutable`.
- [ ] HTTPS aktif dengan redirect HTTP → HTTPS.

---

## 9. Aset & Gambar

- [ ] Konversi sisa PNG yang masih disajikan ke WebP bila ada (saat ini 0 PNG tersisa di `public/images/`).
- [ ] Hapus `public/assets/js/home.js` — **sudah dihapus**; `public/assets/` kini tidak ada (chatbot/jurufind/ppdb sudah masuk bundle Vite).
- [ ] **Font Inter & Space Grotesk JANGAN dihapus** — dipakai halaman Jurufind via `jurufind.css` (`--jf-font-display`/`--jf-font-body`). Sudah dipindah ke `@font-face` scoped di `jurufind.css` supaya hanya diunduh di halaman Jurufind.
- [ ] Pastikan `public/build/assets/*` hasil build terbaru, bukan build lama.
- [ ] **Wajib ulang `npm run build`** setiap kali mengubah `vite.config.js`, `resources/js/*`, atau `resources/css/*` (termasuk `@source` di `app.css` untuk view pagination vendor) — kalau tidak, chunk/utility baru tidak ikut ter-*deploy*.

---

## 10. Verifikasi Pasca-Deploy (smoke test)

- [ ] `curl -s -o /dev/null -w "%{http_code}" https://<domain>/` → `200`
- [ ] Halaman berat cek manual: `/`, `/tentang-kami/profil-guru`, `/career-center`, `/informasi/berita`, `/jurufind`, `/ppdb` → semua `200` dan **memakai CSS Tailwind** (bukan tampilan polos = tanda `public/hot` masih ada / build hilang).
- [ ] DevTools → Network: sumber CSS/JS berasal dari `/build/assets/...` (ber-*hash*), bukan `:5173`.
- [ ] Network: ukuran transfer CSS/JS mengecil (gzip/brotli aktif).
- [ ] Uji form: SSO check → register → submit → halaman sukses; cek baris `applicants` muncul di dashboard mitra setelah worker memproses.
- [ ] Uji login portal mitra industri (`/industry/login`) → dashboard tampil.
- [ ] Cek `storage/logs/laravel.log` **tidak** banjir error setelah smoke test.
- [ ] Cek tidak ada `ERROR`/`CRITICAL` baru di log; `APP_DEBUG=false` tidak menampilkan stack trace ke user.

---

## 11. Rollback Plan (bila gagal)

- [ ] Simpan salinan `public/build/` versi sebelumnya + `bootstrap/cache/` sebelum rilis.
- [ ] Bila gagal: `php artisan optimize:clear`, kembalikan `public/build/` & `.env` versi sebelumnya, restart php-fpm & queue worker.
- [ ] Migrasi punya `down()` — gunakan `php artisan migrate:rollback --step=<n>` hanya bila benar-benar perlu (perhatikan index terlewat).

---

## 12. Setelah Go-Live (cepat)

- [ ] Ukur ulang TTFB halaman utama & halaman berat dari server produksi (bukan `artisan serve`).
- [ ] Bandingkan dengan target di `PERFORMANCE_OPTIMIZATION.md` §4 (payload & query count).
- [ ] Pasang monitoring uptime + alert error log; tinjau `failed_jobs` berkala.
