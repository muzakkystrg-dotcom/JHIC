-- =============================================================================
--  DATABASE SETUP - JHIC / SMK Telkom Sidoarjo (Career Center + SSO Form)
-- =============================================================================
--  File ini adalah versi SQL mentah dari database yang dipakai aplikasi.
--  Cocok untuk di-import di hosting (Webuzo / cPanel / phpMyAdmin) maupun lokal.
--
--  CARA PAKAI DI WEBUZO:
--    1. Login Webuzo > MySQL Databases (atau "Database").
--    2. Buat database baru, misal: jhic_db   (catat nama final dari panel).
--    3. Buat user database + password, lalu assign ke database tsb (ALL PRIVILEGES).
--       -> Webuzo biasanya menambahkan prefix, mis: user_jhic_db / user_jhic_user.
--    4. Buka phpMyAdmin > pilih database tsb > tab "Import" > upload file ini.
--       (JANGAN pakai baris CREATE DATABASE di bawah kalau DB sudah dibuat panel;
--        cukup import bagian tabel-tabelnya saja. Kalau import via CLI, boleh
--        jalankan seluruh file.)
--    5. Update file .env aplikasi agar cocok dengan kredensial hosting:
--         DB_CONNECTION=mysql
--         DB_HOST=localhost
--         DB_PORT=3306
--         DB_DATABASE=<nama_db_dari_panel>
--         DB_USERNAME=<user_db_dari_panel>
--         DB_PASSWORD=<password_db_dari_panel>
--    6. Jalankan:  php artisan migrate   (opsional, hanya bila ingin sinkron status).
--
--  CATATAN: File ini memakai DROP TABLE IF EXISTS. Import ulang = DATA LAMA
--  DI TABEL-TABEL INI AKAN TERHAPUS. Jangan import ulang di server produksi
--  yang sudah berisi data asli.
-- =============================================================================

-- CATATAN: file ini TIDAK berisi CREATE DATABASE/USE.
-- Import lewat phpMyAdmin: pilih dulu database tujuan, lalu Import file ini.

-- --- 2) (OPSIONAL) Buat user database + hak akses -----------------------------
--  Di Webuzo biasanya langkah ini dilakukan lewat panel, jadi baris di bawah
--  TIDAK dijalankan otomatis (dikomentari). Buka komentar hanya jika punya
--  hak admin dan ingin membuat user via SQL.
--
-- CREATE USER 'jhic-404foundus_jhic_user'@'localhost' IDENTIFIED BY 'GANTI_PASSWORD_DISINI';
-- GRANT ALL PRIVILEGES ON `jhic-404foundus_jhic_db`.* TO 'jhic-404foundus_jhic_user'@'localhost';
-- FLUSH PRIVILEGES;


SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET FOREIGN_KEY_CHECKS = 0;


-- =============================================================================
--  TABEL: students  (data master siswa untuk verifikasi SSO Form)
-- =============================================================================
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `students` (`id`, `sso`, `name`, `major`, `dtp`, `created_at`, `updated_at`) VALUES
  (1, '541211001', 'Ahmad Fauzi',   'Sistem Informasi Jaringan & Aplikasi (SIJA)',   '2023/2024', NOW(), NOW()),
  (2, '541211002', 'Siti Aminah',   'Teknik Jaringan Akses Telekomunikasi (TJAT)',   '2023/2024', NOW(), NOW()),
  (3, '541211003', 'Budi Santoso',  'Sistem Informasi Jaringan & Aplikasi (SIJA)',   '2022/2023', NOW(), NOW()),
  (4, '541211004', 'Dewi Lestari',  'Teknik Jaringan Akses Telekomunikasi (TJAT)',   '2022/2023', NOW(), NOW()),
  (5, '541211005', 'Reza Pratama',  'Sistem Informasi Jaringan & Aplikasi (SIJA)',   '2024/2025', NOW(), NOW());


-- =============================================================================
--  TABEL: job_applications  (data lamaran dari Registration Form)
--  Terhubung ke students lewat kolom `sso`.
-- =============================================================================
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =============================================================================
--  TABEL BAWAAN LARAVEL
-- =============================================================================
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
  (1, '0001_01_01_000000_create_users_table', 1),
  (2, '0001_01_01_000001_create_cache_table', 1),
  (3, '0001_01_01_000002_create_jobs_table', 1),
  (4, '2026_10_03_162107_create_job_applications_table', 1),
  (5, '2026_10_03_170000_create_students_table', 1);


SET FOREIGN_KEY_CHECKS = 1;

-- =============================================================================
--  SELESAI. Database siap dipakai.
-- =============================================================================
