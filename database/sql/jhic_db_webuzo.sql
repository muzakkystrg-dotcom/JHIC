-- =============================================================================
--  DATABASE SETUP - JHIC / SMK Telkom Sidoarjo
--  Portal Website + Career Center (Hirelink) + Jurufind + Industry Dashboard
-- =============================================================================
--  Dibuat otomatis dari aplikasi Laravel.
--  Berisi: struktur SELURUH tabel + data awal (seed) tabel konten
--          + status migrasi + data mitra industri.
--
--  CARA IMPORT DI WEBUZO:
--    1. Login Webuzo > MySQL Databases.
--    2. Buat database baru (mis. jhic_db) + user + password (ALL PRIVILEGES).
--       Catat nama final database & user dari panel.
--    3. Buka phpMyAdmin > pilih database tsb > tab "Import" > upload file ini.
--    4. Update file .env aplikasi:
--         DB_CONNECTION=mysql
--         DB_HOST=localhost
--         DB_PORT=3306
--         DB_DATABASE=<nama_db_dari_panel>
--         DB_USERNAME=<user_db_dari_panel>
--         DB_PASSWORD=<password_db_dari_panel>
--    5. Selesai. (Opsional) jalankan `php artisan migrate` -> akan bilang
--       "Nothing to migrate" karena status migrasi sudah ikut di-import.
--
--  PENTING:
--    - Baris CREATE DATABASE / USE di bawah OPSIONAL. Jika database sudah dibuat
--      lewat panel Webuzo, HAPUS/lewati 2 baris tersebut lalu import bagian
--      tabelnya saja (phpMyAdmin meng-import ke database yang aktif).
--    - Ganti `jhic-404foundus_jhic_db` bila nama database Anda berbeda.
--    - File ini memakai DROP TABLE IF EXISTS -> import ulang akan MENGHAPUS data
--      lama di tabel-tabel ini. JANGAN import ulang di server produksi.
--    - Tabel `job_applications`, `users`, `sessions`, `cache`, `jobs` sengaja
--      DIKOSONGKAN (struktur saja) agar tidak membawa data uji/PII.
--
--  INDUSTRY DASHBOARD (Portal Mitra Industri):
--    - Tabel: industries (13 mitra dari config/mitra.php), job_postings, applicants.
--    - Login portal: /industry/login, password SEMUA akun mitra demo = password123
--        IND-GARUDA-01, IND-AXELBIT, IND-DIGIPRENER, IND-JAGOAN-HOSTING,
--        IND-MARKAZ-DESIGN, IND-PT-GLOBAL-INFRA-TEKNOLOGI,
--        IND-PT-JAVACREATIOX-NETWORK-INTERMEDIA, IND-PT-RADNET-DIGITAL-INDONESIA,
--        IND-WOWRACK-INDONESIA, IND-PT-GARUDA-TELEKOMUNIKASI-INDONESIA-WARU,
--        IND-PT-GLOBAL-INFRA-TEKNOLOGI-PABEAN, IND-PT-RADNET-DIGITAL-INDONESIA-KEMENKOMDIGI,
--        IND-WEZA-GROUP-PT-WEZA-PUNYA-CERITA.
--      WAJIB ganti semua password ini sebelum produksi.
--    - Alur: submit form alumni (/career-center/register) otomatis membuat 1 baris
--      `applicants` di SETIAP mitra (applicants.source='hirelink').
-- =============================================================================

-- --- (OPSIONAL) Buat & pilih database ---------------------------------------
CREATE DATABASE IF NOT EXISTS `jhic-404foundus_jhic_db`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `jhic-404foundus_jhic_db`;

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET FOREIGN_KEY_CHECKS = 0;

-- =============================================================================
--  STRUKTUR & DATA TABEL
-- =============================================================================

-- -----------------------------------------------------------------------------
-- Tabel `migrations`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_03_162107_create_job_applications_table',1),(5,'2026_10_03_170000_create_students_table',1),(6,'2026_10_04_093231_create_beritas_table',2),(7,'2026_10_04_093231_create_job_vacancies_table',2),(8,'2026_10_04_110001_create_alumnis_table',3),(9,'2026_10_04_110002_create_prestasis_table',3),(10,'2026_10_04_110003_create_penerapan_k3s_table',3),(11,'2026_10_04_110004_create_trial_classes_table',3),(12,'2026_10_04_081603_create_industries_table',4),(13,'2026_10_04_081604_create_job_postings_table',4),(14,'2026_10_04_081605_create_applicants_table',4),(15,'2026_10_04_210000_add_slug_to_industries_table',5),(16,'2026_10_04_210001_add_hirelink_link_to_applicants_table',5);

-- -----------------------------------------------------------------------------
-- Tabel `users`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `password_reset_tokens`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `cache`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `cache_locks`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `sessions`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `jobs`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `job_batches`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `failed_jobs`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `students`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sso` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `dtp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_sso_unique` (`sso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `students` VALUES (1,'541211001','Ahmad Fauzi','Sistem Informasi Jaringan & Aplikasi (SIJA)','2023/2024','2026-10-04 08:42:07','2026-10-04 08:42:07'),(2,'541211002','Siti Aminah','Teknik Jaringan Akses Telekomunikasi (TJAT)','2023/2024','2026-10-04 08:42:07','2026-10-04 08:42:07'),(3,'541211003','Budi Santoso','Sistem Informasi Jaringan & Aplikasi (SIJA)','2022/2023','2026-10-04 08:42:07','2026-10-04 08:42:07'),(4,'541211004','Dewi Lestari','Teknik Jaringan Akses Telekomunikasi (TJAT)','2022/2023','2026-10-04 08:42:07','2026-10-04 08:42:07'),(5,'541211005','Reza Pratama','Sistem Informasi Jaringan & Aplikasi (SIJA)','2024/2025','2026-10-04 08:42:07','2026-10-04 08:42:07');

-- -----------------------------------------------------------------------------
-- Tabel `job_vacancies`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `job_vacancies`;
CREATE TABLE `job_vacancies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Full Time',
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `posted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_vacancies_slug_unique` (`slug`),
  KEY `job_vacancies_category_index` (`category`),
  KEY `job_vacancies_posted_at_index` (`posted_at`),
  KEY `job_vacancies_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `job_vacancies` VALUES (1,'Junior DevOps','junior-devops-pt-garuda-telekomunikasi-indonesia','Pt. Garuda Telekomunikasi Indonesia','Full Time','Surabaya, Indonesia','Mendukung otomatisasi deployment, monitoring, dan pengelolaan infrastruktur aplikasi.','images/mitra/gt.webp','2026-09-07 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(2,'Network Technician','network-technician-axelbit-solutions','Axelbit Solutions','Full Time','Surabaya, Indonesia','Instalasi, konfigurasi, dan pemeliharaan perangkat jaringan pada sisi pelanggan.','images/mitra/axelbit.webp','2026-09-06 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(3,'Junior Web Developer','junior-web-developer-digiprener-tech','DigiPrener Tech','Full Time','Surabaya, Indonesia','Mengembangkan dan memelihara aplikasi web menggunakan framework modern.','images/mitra/digi.webp','2026-09-07 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(4,'Cloud System Support','cloud-system-support-jagoan-hosting-indonesia','Jagoan Hosting Indonesia','Full Time','Malang, Indonesia','Memberikan dukungan teknis layanan cloud hosting kepada pelanggan.','images/mitra/jagoanhosting.webp','2026-09-05 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(5,'Creative Graphic Designer','creative-graphic-designer-markaz-design-studio','Markaz Design Studio','Full Time','Sidoarjo, Indonesia','Merancang aset visual branding dan materi desain untuk klien UMKM.','images/mitra/markaz.webp','2026-09-07 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(6,'Fullstack Developer Trainee','fullstack-developer-trainee-pt-javacreatiox-network','PT Javacreatiox Network','Internship','Surabaya, Indonesia','Program pelatihan pengembangan aplikasi web end-to-end untuk pemula.','images/mitra/javacreat.webp','2026-09-06 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(7,'Technical Support NOC','technical-support-noc-pt-radnet-digital-indonesia','PT Radnet Digital Indonesia','Full Time','Surabaya, Indonesia','Memantau dan menangani gangguan jaringan pada Network Operations Center.','images/mitra/radnext.webp','2026-09-07 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(8,'Data Center Technician','data-center-technician-wowrack-indonesia','Wowrack Indonesia','Full Time','Surabaya, Indonesia','Perawatan perangkat dan infrastruktur fisik data center.','images/mitra/wowrack.webp','2026-09-04 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(9,'B2B Solution Associate','b2b-solution-associate-weza-group','Weza Group','Full Time','Sidoarjo, Indonesia','Mendukung penyusunan solusi teknologi B2B untuk klien korporasi.','images/mitra/weza.webp','2026-09-06 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13');

-- -----------------------------------------------------------------------------
-- Tabel `job_applications`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `job_applications`;
CREATE TABLE `job_applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sso` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `portfolio_path` varchar(255) DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `job_interest` varchar(255) DEFAULT NULL,
  `work_preference` varchar(255) NOT NULL DEFAULT 'On-Site',
  `start_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_applications_sso_index` (`sso`),
  KEY `job_applications_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Tabel `alumnis`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `alumnis`;
CREATE TABLE `alumnis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sso` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) NOT NULL,
  `dtp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alumnis_slug_unique` (`slug`),
  UNIQUE KEY `alumnis_sso_unique` (`sso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `alumnis` VALUES (1,'Ahmad Fauzi','ahmad-fauzi','541211001','SIJA','Software Developer','2026-10-04 02:43:27','2026-10-04 02:43:27'),(2,'Siti Aminah','siti-aminah','541211002','TJAT','CyberSecurity','2026-10-04 02:43:27','2026-10-04 02:43:27'),(3,'Budi Santoso','budi-santoso','541211003','SIJA','AI Specialist','2026-10-04 02:43:27','2026-10-04 02:43:27'),(4,'Dewi Lestari','dewi-lestari','541211004','TJAT','Cloud Engineer','2026-10-04 02:43:27','2026-10-04 02:43:27'),(5,'Reza Pratama','reza-pratama','541211005','SIJA','IOT','2026-10-04 02:43:27','2026-10-04 02:43:27');

-- -----------------------------------------------------------------------------
-- Tabel `beritas`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `beritas`;
CREATE TABLE `beritas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`),
  KEY `beritas_category_index` (`category`),
  KEY `beritas_published_at_index` (`published_at`),
  KEY `beritas_is_published_index` (`is_published`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `beritas` VALUES (1,'Lomba Matematika SMP/MTs Terbesar Se-Sidoarjo Sukses Digelar di SKOMDA','lomba-matematika-smpmts-terbesar-se-sidoarjo-sukses-digelar-di-skomda','Kegiatan Sekolah','Ratusan siswa SMP/MTs se-Sidoarjo berkompetisi dalam lomba matematika yang digelar di SMK Telkom Sidoarjo.','Ratusan siswa SMP/MTs se-Sidoarjo berkompetisi dalam lomba matematika yang digelar di SMK Telkom Sidoarjo.','images/berita/juara.webp','2025-11-27 12:24:35',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(2,'Juara 1 Lomba Web Design Tingkat Provinsi Jawa Timur 2026','juara-1-lomba-web-design-tingkat-provinsi-jawa-timur-2026','Prestasi','Siswa SIJA berhasil meraih juara 1 lomba web design tingkat Provinsi Jawa Timur.','Siswa SIJA berhasil meraih juara 1 lomba web design tingkat Provinsi Jawa Timur.','images/berita/juara.webp','2026-06-05 03:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(3,'Penandatanganan Kerja Sama dengan Mitra Industri Telekomunikasi','penandatanganan-kerja-sama-dengan-mitra-industri-telekomunikasi','Kemitraan & Kerja Sama','SMK Telkom Sidoarjo memperluas jejaring kemitraan industri untuk magang dan rekrutmen alumni.','SMK Telkom Sidoarjo memperluas jejaring kemitraan industri untuk magang dan rekrutmen alumni.','images/berita/juara.webp','2026-06-01 02:30:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(4,'Karya Inovasi Siswa: Smart Home Automation Berbasis IoT','karya-inovasi-siswa-smart-home-automation-berbasis-iot','Karya & Inovasi Siswa','Tim siswa memamerkan proyek smart home berbasis IoT dalam pameran inovasi sekolah.','Tim siswa memamerkan proyek smart home berbasis IoT dalam pameran inovasi sekolah.','images/berita/juara.webp','2026-05-20 07:15:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(5,'Pengumuman: Jadwal Ujian Tengah Semester Genap','pengumuman-jadwal-ujian-tengah-semester-genap','Pengumuman','Berikut jadwal dan tata tertib ujian tengah semester genap tahun ajaran berjalan.','Berikut jadwal dan tata tertib ujian tengah semester genap tahun ajaran berjalan.','images/berita/juara.webp','2026-03-10 01:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(6,'Tips Belajar Efektif untuk Siswa SMK Bidang Teknologi','tips-belajar-efektif-untuk-siswa-smk-bidang-teknologi','Artikel & edukasi','Strategi belajar yang efektif bagi siswa SMK yang fokus pada kompetensi teknologi dan praktik industri.','Strategi belajar yang efektif bagi siswa SMK yang fokus pada kompetensi teknologi dan praktik industri.','images/berita/juara.webp','2026-02-18 04:45:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(7,'Kisah Alumni: Dari SMK Telkom Sidoarjo ke Industri Cloud','kisah-alumni-dari-smk-telkom-sidoarjo-ke-industri-cloud','Alumni','Alumni berbagi pengalaman meniti karier di bidang cloud computing setelah lulus dari SMK Telkom Sidoarjo.','Alumni berbagi pengalaman meniti karier di bidang cloud computing setelah lulus dari SMK Telkom Sidoarjo.','images/berita/juara.webp','2026-01-25 09:20:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(8,'Kegiatan Class Meeting Akhir Semester Penuh Semangat','kegiatan-class-meeting-akhir-semester-penuh-semangat','Kegiatan Sekolah','Berbagai pertandingan dan kegiatan class meeting berlangsung meriah di akhir semester.','Berbagai pertandingan dan kegiatan class meeting berlangsung meriah di akhir semester.','images/berita/juara.webp','2025-12-15 06:00:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(9,'Medali Emas Olimpiade Jaringan Komputer Tingkat Nasional','medali-emas-olimpiade-jaringan-komputer-tingkat-nasional','Prestasi','Siswa TJAT meraih medali emas pada olimpiade jaringan komputer tingkat nasional.','Siswa TJAT meraih medali emas pada olimpiade jaringan komputer tingkat nasional.','images/berita/juara.webp','2025-11-02 02:10:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13'),(10,'Sosialisasi K3 untuk Praktik Laboratorium Jaringan dan Fiber Optik','sosialisasi-k3-untuk-praktik-laboratorium-jaringan-dan-fiber-optik','Pengumuman','Sekolah menggelar sosialisasi penerapan Keselamatan dan Kesehatan Kerja (K3) di laboratorium.','Sekolah menggelar sosialisasi penerapan Keselamatan dan Kesehatan Kerja (K3) di laboratorium.','images/berita/juara.webp','2025-10-21 03:40:00',1,'2026-10-04 02:33:13','2026-10-04 02:33:13');

-- -----------------------------------------------------------------------------
-- Tabel `prestasis`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `prestasis`;
CREATE TABLE `prestasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prestasis_slug_unique` (`slug`),
  KEY `prestasis_level_index` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `prestasis` VALUES (1,'Para Juara - Generative AI Web Design','para-juara-generative-ai-web-design','🖥️🏆 Skill digital, naik level!','Nasional','Tiga siswa SKOMDA berhasil membawa pulang prestasi dari Intermedia Information Technology Competition (IITC) 2026 yang diselenggarakan Universitas Amikom Purwokerto. 🚀','images/prestasi/juara.webp','2026-10-04 02:43:38','2026-10-04 02:43:38'),(2,'Juara 1 LKS Web Technologies Tingkat Nasional','juara-1-lks-web-technologies-tingkat-nasional','💻🥇 Kompetensi keahlian unggul','Nasional','Siswa jurusan SIJA sukses mendominasi ajang LKS Nasional melalui inovasi web application development berstandar industri.','images/prestasi/juara.webp','2026-10-04 02:43:38','2026-10-04 02:43:38'),(3,'Medali Emas Olimpiade Jaringan Komputer','medali-emas-olimpiade-jaringan-komputer','🌐🏅 Networking champion','Provinsi','Prestasi membanggakan di bidang infrastruktur jaringan telekomunikasi dan konfigurasi router tingkat regional.','images/prestasi/juara.webp','2026-10-04 02:43:38','2026-10-04 02:43:38');

-- -----------------------------------------------------------------------------
-- Tabel `penerapan_k3s`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `penerapan_k3s`;
CREATE TABLE `penerapan_k3s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penerapan_k3s_slug_unique` (`slug`),
  KEY `penerapan_k3s_uploaded_at_index` (`uploaded_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `penerapan_k3s` VALUES (1,'SOP Keselamatan Praktikum Lab Komputer & Jaringan.pdf','sop-keselamatan-praktikum-lab-komputer-jaringan','2.4 MB',NULL,'2025-01-12','2026-10-04 02:43:38','2026-10-04 02:43:38'),(2,'Manual K3 Workshop Fiber Optik & Telekomunikasi.pdf','manual-k3-workshop-fiber-optik-telekomunikasi','3.1 MB',NULL,'2025-01-15','2026-10-04 02:43:38','2026-10-04 02:43:38'),(3,'Prosedur Darurat & Evakuasi Kebakaran Gedung Sekolah.pdf','prosedur-darurat-evakuasi-kebakaran-gedung-sekolah','1.8 MB',NULL,'2025-01-20','2026-10-04 02:43:38','2026-10-04 02:43:38'),(4,'Pedoman Penggunaan Alat Pelindung Diri (APD) Siswa.pdf','pedoman-penggunaan-alat-pelindung-diri-apd-siswa','4.0 MB',NULL,'2025-01-25','2026-10-04 02:43:38','2026-10-04 02:43:38');

-- -----------------------------------------------------------------------------
-- Tabel `trial_classes`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `trial_classes`;
CREATE TABLE `trial_classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(255) NOT NULL,
  `instruktur` varchar(255) NOT NULL,
  `kuota` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trial_classes_slug_unique` (`slug`),
  KEY `trial_classes_jurusan_index` (`jurusan`),
  KEY `trial_classes_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `trial_classes` VALUES (1,'Eksplorasi Jaringan Fiber Optik & 5G','eksplorasi-jaringan-fiber-optik-5g','TJAT','2026-02-10','09:00 - 11:30 WIB','Tim Lab Telekomunikasi',25,1,'2026-10-04 02:43:38','2026-10-04 02:43:38'),(2,'Pemrograman Web & UI/UX Design Dasar','pemrograman-web-uiux-design-dasar','SIJA','2026-02-12','13:00 - 15:30 WIB','Tim Produktif SIJA',25,1,'2026-10-04 02:43:38','2026-10-04 02:43:38'),(3,'Smart Home Automation berbasis IoT','smart-home-automation-berbasis-iot','SIJA / TJAT','2026-02-15','09:00 - 11:30 WIB','Tim IoT Lab RPS Hall',20,1,'2026-10-04 02:43:38','2026-10-04 02:43:38');

-- -----------------------------------------------------------------------------
-- Tabel `industries`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `industries`;
CREATE TABLE `industries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `industry_id` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `industries_industry_id_unique` (`industry_id`),
  UNIQUE KEY `industries_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `industries` VALUES (2,'IND-AXELBIT','axelbit','Axelbit','$2y$12$pvWnLyVASUjtJ79aIOz4PuESNjdXgPPh/MfT7CyIqPWnI.SxQ/3jK','images/mitra/axelbit.webp','axelbit@industri.skomda.sch.id','Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(3,'IND-DIGIPRENER','digiprener','DigiPrener','$2y$12$vupGHh1bofXyMZdCiNSMluxRHsngN8N35UDXMEcvZ2blJRcp6YwG2','images/mitra/digi.webp','digiprener@industri.skomda.sch.id','Taman Bungkul Street No. 25, Surabaya, Jawa Timur 60241, Jl. Sukomanunggal Tanjung Sari Baru IV, Tanjungsari, Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(4,'IND-JAGOAN-HOSTING','jagoan-hosting','Jagoan Hosting','$2y$12$qb0nYN.8IgpKS1fLMTMKWuENEsiF0owSPqxzUWtHsGKTJBLyyvaui','images/mitra/jagoanhosting.webp','jagoan-hosting@industri.skomda.sch.id','Kec. Lowokwaru, Kota Malang, Jawa Timur 65145',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(5,'IND-MARKAZ-DESIGN','markaz-design','Markaz Design','$2y$12$Q1ntlz1e21goan1lFzsSsuc9K4etLdmjRxY6s1q0pESazQwUJOMkm','images/mitra/markaz.webp','markaz-design@industri.skomda.sch.id','Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61226',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(6,'IND-GARUDA-01','pt-garuda-telekomunikasi-indonesia','PT Garuda Telekomunikasi Indonesia','$2y$12$0bMKTX9vSvCdtd1EszMrROaMUwKpM1rWo6HzewmL.k/pK58Bv3/q2','images/mitra/gt.webp','pt-garuda-telekomunikasi-indonesia@industri.skomda.sch.id','Jl. Muria Jl. Pepelegi Indah No.47, Pepe, Pepelegi, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(7,'IND-PT-GLOBAL-INFRA-TEKNOLOGI','pt-global-infra-teknologi','PT Global Infra Teknologi','$2y$12$0BxuzKWNaVnJnAVJ6tZgJ.Faspiuod9qKrhXfsAuSiNf/mvme4pda','images/mitra/gi.webp','pt-global-infra-teknologi@industri.skomda.sch.id','kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(8,'IND-PT-JAVACREATIOX-NETWORK-INTERMEDIA','pt-javacreatiox-network-intermedia','PT Javacreatiox Network Intermedia','$2y$12$bWlYMkGLVhNU39.vsRCIOujQMKECeRlDK8gL8FL4h9L71kPichnJi','images/mitra/javacreat.webp','pt-javacreatiox-network-intermedia@industri.skomda.sch.id','Kec. Wonocolo, Surabaya, Jawa Timur 60237',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(9,'IND-PT-RADNET-DIGITAL-INDONESIA','pt-radnet-digital-indonesia','PT Radnet Digital Indonesia','$2y$12$Jwi6bNxqDseSiQSh5Q25Mu3FMh2H/1tXWt4fGfW15VzO/.Zfub48y','images/mitra/radnext.webp','pt-radnet-digital-indonesia@industri.skomda.sch.id','Kec. Genteng, Surabaya, Jawa Timur 60271',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(10,'IND-WOWRACK-INDONESIA','wowrack-indonesia','Wowrack Indonesia','$2y$12$ge9GR6jOwNTa3o9bBi41CuFT/0..DW.zF/wtFkJ5Ad4muJ2eFwRUS','images/mitra/wowrack.webp','wowrack-indonesia@industri.skomda.sch.id','Kec. Genteng, Surabaya, Jawa Timur 60275',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(11,'IND-PT-GARUDA-TELEKOMUNIKASI-INDONESIA-WARU','pt-garuda-telekomunikasi-indonesia-waru','PT Garuda Telekomunikasi Indonesia','$2y$12$.3OBXjdzFamQw3O9W/yF9.GBjIWaGnZdPi0s9vtmIcEnb3qzietVO','images/mitra/gt.webp','pt-garuda-telekomunikasi-indonesia-waru@industri.skomda.sch.id','Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(12,'IND-PT-GLOBAL-INFRA-TEKNOLOGI-PABEAN','pt-global-infra-teknologi-pabean','PT Global Infra Teknologi','$2y$12$7xmGB7W/r1SVeYNBUEnDd.ozQROSZDRUKzxWtpH3uXLc/46s.0q6.','images/mitra/gi.webp','pt-global-infra-teknologi-pabean@industri.skomda.sch.id','Kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(13,'IND-PT-RADNET-DIGITAL-INDONESIA-KEMENKOMDIGI','pt-radnet-digital-indonesia-kemenkomdigi','PT RADNET DIGITAL INDONESIA','$2y$12$tPifFwOzR7fa9Xj6M6m5a.toPLQbTJgpEfWaN51SzpkY1Uw/gSXuG','images/mitra/radnext.webp','pt-radnet-digital-indonesia-kemenkomdigi@industri.skomda.sch.id','Kec. Genteng, Surabaya, Jawa Timur 60271',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(14,'IND-WEZA-GROUP-PT-WEZA-PUNYA-CERITA','weza-group-pt-weza-punya-cerita','Weza Group – PT Weza Punya Cerita','$2y$12$WUd4hLE9GsAzadAYL1m.a..KMURbqHXUZmxcaMxxVpIUI5L2qvw/O','images/mitra/weza.webp','weza-group-pt-weza-punya-cerita@industri.skomda.sch.id','Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61217',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51');

-- -----------------------------------------------------------------------------
-- Tabel `job_postings`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `job_postings`;
CREATE TABLE `job_postings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `industry_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Full Time',
  `location` varchar(255) NOT NULL DEFAULT 'Surabaya, Indonesia',
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_postings_industry_id_foreign` (`industry_id`),
  CONSTRAINT `job_postings_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `job_postings` VALUES (2,6,'Junior DevOps','Full Time','Surabaya, Indonesia',NULL,1,'2026-10-04 07:06:51','2026-10-04 07:06:51');

-- -----------------------------------------------------------------------------
-- Tabel `applicants`
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `applicants`;
CREATE TABLE `applicants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `industry_id` bigint(20) unsigned NOT NULL,
  `job_posting_id` bigint(20) unsigned DEFAULT NULL,
  `job_application_id` bigint(20) unsigned DEFAULT NULL,
  `source` varchar(255) NOT NULL DEFAULT 'hirelink',
  `sso_number` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL DEFAULT 'SIJA',
  `dtp` varchar(255) NOT NULL DEFAULT '2023/2024',
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `ai_match_score` int(11) NOT NULL DEFAULT 85,
  `work_preference` varchar(255) NOT NULL DEFAULT 'On-Site',
  `status` enum('pending','interview','accepted','rejected') NOT NULL DEFAULT 'pending',
  `interview_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applicants_industry_id_foreign` (`industry_id`),
  KEY `applicants_job_posting_id_foreign` (`job_posting_id`),
  KEY `applicants_job_application_id_foreign` (`job_application_id`),
  CONSTRAINT `applicants_industry_id_foreign` FOREIGN KEY (`industry_id`) REFERENCES `industries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applicants_job_application_id_foreign` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications` (`id`) ON DELETE SET NULL,
  CONSTRAINT `applicants_job_posting_id_foreign` FOREIGN KEY (`job_posting_id`) REFERENCES `job_postings` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `applicants` VALUES (3,6,2,NULL,'seed','541211001','Ahmad Fauzi','Sistem Informasi Jaringan & Aplikasi (SIJA)','2023/2024','ahmad.fauzi@student.telkomsda.sch.id','081234567890','https://linkedin.com/in/ahmadfauzi','[\"Web Development\",\"Docker\",\"Linux\",\"Laravel\"]',96,'On-Site','pending',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(4,6,2,NULL,'seed','541211002','Siti Aminah','Teknik Jaringan Akses Telekomunikasi (TJAT)','2023/2024','siti.aminah@student.telkomsda.sch.id','085678901234','https://linkedin.com/in/sitiaminah','[\"Fiber Optic\",\"Cisco\",\"MikroTik\"]',89,'Hybrid','interview','Senin, 10:00 WIB via Google Meet','2026-10-04 07:06:51','2026-10-04 07:06:51');


SET FOREIGN_KEY_CHECKS = 1;

-- =============================================================================
--  SELESAI. Cek cepat:
--    SELECT COUNT(*) FROM industries;   -- 13
--    SELECT COUNT(*) FROM job_vacancies;-- 9
--    SELECT COUNT(*) FROM students;     -- 5
-- =============================================================================
