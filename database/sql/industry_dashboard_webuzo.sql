-- =============================================================================
--  INDUSTRY DASHBOARD (Portal Mitra Industri) - SETUP TABLE
--  Untuk JHIC / SMK Telkom Sidoarjo
-- =============================================================================
--  Isi file ini:
--    1. Struktur 3 tabel : industries, job_postings, applicants (dengan kolom
--       penghubung Hirelink: applicants.job_application_id + applicants.source)
--    2. Data awal (seed) : 13 akun mitra industri (dari config/mitra.php),
--       lowongan contoh, dan 2 pelamar contoh yang sinkron dengan tabel `students`
--    3. Penanda migrasi  : supaya `php artisan migrate` melihatnya "sudah jalan"
--
--  SIFAT: IDEMPOTENT. Aman dijalankan berkali-kali (CREATE TABLE IF NOT EXISTS +
--  INSERT IGNORE), tidak menimpa/menggandakan data. Tabel existing JHIC
--  (job_vacancies, job_applications, students, dll) TIDAK disentuh.
--
--  -----------------------------------------------------------------------------
--  CARA IMPORT DI WEBUZO:
--    1. Login Webuzo > MySQL Databases (kalau db & user JHIC sudah ada, lanjut no.2).
--    2. Buka phpMyAdmin > pilih DATABASE JHIC > tab "Import" > upload file ini.
--       (CLI:  mysql -u USER -p NAMA_DB < industry_dashboard_webuzo.sql)
--    3. Samakan .env server: DB_DATABASE/DB_USERNAME/DB_PASSWORD sesuai panel.
--    4. Cek: php artisan migrate:status -> 5 migrasi industry harus "Ran".
--       Jangan jalankan `php artisan migrate:fresh` di server (menghapus data).
--
--  AKUN DEMO PORTAL (/industry/login): password SEMUA mitra = password123
--    - IND-GARUDA-01               -> PT Garuda Telekomunikasi Indonesia
--    - IND-AXELBIT                 -> Axelbit
--    - IND-DIGIPRENER              -> DigiPrener
--    - IND-JAGOAN-HOSTING          -> Jagoan Hosting
--    - IND-MARKAZ-DESIGN           -> Markaz Design
--    - IND-PT-GLOBAL-INFRA-TEKNOLOGI, IND-PT-JAVACREATIOX-NETWORK-INTERMEDIA,
--      IND-PT-RADNET-DIGITAL-INDONESIA, IND-WOWRACK-INDONESIA, dll.
--    Ganti semua password ini sebelum produksi.
--
--  ALUR: submit form pendaftaran alumni (/career-center/register) otomatis
--  membuat 1 baris `applicants` di SETIAP mitra -> tiap mitra melihat kandidat
--  yang sama dan bersaing merekrut.
-- =============================================================================

SET NAMES utf8mb4;
SET time_zone = '+00:00';

-- -----------------------------------------------------------------------------
-- 0. Tabel migrations
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 1a. Tabel `job_applications` (lamaran alumni dari Hirelink)
--     Dibuat hanya bila belum ada. Di server yang sudah ada, tabel ini LEWAT.
--     Wajib ada karena `applicants.job_application_id` menunjuk ke sini.
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `job_applications` (
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

-- -----------------------------------------------------------------------------
-- 1-3. Struktur + data: industries, job_postings, applicants
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `industries` (
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
INSERT  IGNORE INTO `industries` VALUES (2,'IND-AXELBIT','axelbit','Axelbit','$2y$12$pvWnLyVASUjtJ79aIOz4PuESNjdXgPPh/MfT7CyIqPWnI.SxQ/3jK','images/mitra/axelbit.webp','axelbit@industri.skomda.sch.id','Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(3,'IND-DIGIPRENER','digiprener','DigiPrener','$2y$12$vupGHh1bofXyMZdCiNSMluxRHsngN8N35UDXMEcvZ2blJRcp6YwG2','images/mitra/digi.webp','digiprener@industri.skomda.sch.id','Taman Bungkul Street No. 25, Surabaya, Jawa Timur 60241, Jl. Sukomanunggal Tanjung Sari Baru IV, Tanjungsari, Kec. Sukomanunggal, Surabaya, Jawa Timur 60226',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(4,'IND-JAGOAN-HOSTING','jagoan-hosting','Jagoan Hosting','$2y$12$qb0nYN.8IgpKS1fLMTMKWuENEsiF0owSPqxzUWtHsGKTJBLyyvaui','images/mitra/jagoanhosting.webp','jagoan-hosting@industri.skomda.sch.id','Kec. Lowokwaru, Kota Malang, Jawa Timur 65145',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(5,'IND-MARKAZ-DESIGN','markaz-design','Markaz Design','$2y$12$Q1ntlz1e21goan1lFzsSsuc9K4etLdmjRxY6s1q0pESazQwUJOMkm','images/mitra/markaz.webp','markaz-design@industri.skomda.sch.id','Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61226',NULL,'2026-10-04 07:06:49','2026-10-04 07:06:49'),(6,'IND-GARUDA-01','pt-garuda-telekomunikasi-indonesia','PT Garuda Telekomunikasi Indonesia','$2y$12$0bMKTX9vSvCdtd1EszMrROaMUwKpM1rWo6HzewmL.k/pK58Bv3/q2','images/mitra/gt.webp','pt-garuda-telekomunikasi-indonesia@industri.skomda.sch.id','Jl. Muria Jl. Pepelegi Indah No.47, Pepe, Pepelegi, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(7,'IND-PT-GLOBAL-INFRA-TEKNOLOGI','pt-global-infra-teknologi','PT Global Infra Teknologi','$2y$12$0BxuzKWNaVnJnAVJ6tZgJ.Faspiuod9qKrhXfsAuSiNf/mvme4pda','images/mitra/gi.webp','pt-global-infra-teknologi@industri.skomda.sch.id','kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(8,'IND-PT-JAVACREATIOX-NETWORK-INTERMEDIA','pt-javacreatiox-network-intermedia','PT Javacreatiox Network Intermedia','$2y$12$bWlYMkGLVhNU39.vsRCIOujQMKECeRlDK8gL8FL4h9L71kPichnJi','images/mitra/javacreat.webp','pt-javacreatiox-network-intermedia@industri.skomda.sch.id','Kec. Wonocolo, Surabaya, Jawa Timur 60237',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(9,'IND-PT-RADNET-DIGITAL-INDONESIA','pt-radnet-digital-indonesia','PT Radnet Digital Indonesia','$2y$12$Jwi6bNxqDseSiQSh5Q25Mu3FMh2H/1tXWt4fGfW15VzO/.Zfub48y','images/mitra/radnext.webp','pt-radnet-digital-indonesia@industri.skomda.sch.id','Kec. Genteng, Surabaya, Jawa Timur 60271',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(10,'IND-WOWRACK-INDONESIA','wowrack-indonesia','Wowrack Indonesia','$2y$12$ge9GR6jOwNTa3o9bBi41CuFT/0..DW.zF/wtFkJ5Ad4muJ2eFwRUS','images/mitra/wowrack.webp','wowrack-indonesia@industri.skomda.sch.id','Kec. Genteng, Surabaya, Jawa Timur 60275',NULL,'2026-10-04 07:06:50','2026-10-04 07:06:50'),(11,'IND-PT-GARUDA-TELEKOMUNIKASI-INDONESIA-WARU','pt-garuda-telekomunikasi-indonesia-waru','PT Garuda Telekomunikasi Indonesia','$2y$12$.3OBXjdzFamQw3O9W/yF9.GBjIWaGnZdPi0s9vtmIcEnb3qzietVO','images/mitra/gt.webp','pt-garuda-telekomunikasi-indonesia-waru@industri.skomda.sch.id','Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(12,'IND-PT-GLOBAL-INFRA-TEKNOLOGI-PABEAN','pt-global-infra-teknologi-pabean','PT Global Infra Teknologi','$2y$12$7xmGB7W/r1SVeYNBUEnDd.ozQROSZDRUKzxWtpH3uXLc/46s.0q6.','images/mitra/gi.webp','pt-global-infra-teknologi-pabean@industri.skomda.sch.id','Kec. Pabean Cantikan, Surabaya, Jawa Timur 60164',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(13,'IND-PT-RADNET-DIGITAL-INDONESIA-KEMENKOMDIGI','pt-radnet-digital-indonesia-kemenkomdigi','PT RADNET DIGITAL INDONESIA','$2y$12$tPifFwOzR7fa9Xj6M6m5a.toPLQbTJgpEfWaN51SzpkY1Uw/gSXuG','images/mitra/radnext.webp','pt-radnet-digital-indonesia-kemenkomdigi@industri.skomda.sch.id','Kec. Genteng, Surabaya, Jawa Timur 60271',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(14,'IND-WEZA-GROUP-PT-WEZA-PUNYA-CERITA','weza-group-pt-weza-punya-cerita','Weza Group – PT Weza Punya Cerita','$2y$12$WUd4hLE9GsAzadAYL1m.a..KMURbqHXUZmxcaMxxVpIUI5L2qvw/O','images/mitra/weza.webp','weza-group-pt-weza-punya-cerita@industri.skomda.sch.id','Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61217',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51');
CREATE TABLE IF NOT EXISTS `job_postings` (
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
INSERT  IGNORE INTO `job_postings` VALUES (2,6,'Junior DevOps','Full Time','Surabaya, Indonesia',NULL,1,'2026-10-04 07:06:51','2026-10-04 07:06:51');
CREATE TABLE IF NOT EXISTS `applicants` (
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
INSERT  IGNORE INTO `applicants` VALUES (3,6,2,NULL,'seed','541211001','Ahmad Fauzi','Sistem Informasi Jaringan & Aplikasi (SIJA)','2023/2024','ahmad.fauzi@student.telkomsda.sch.id','081234567890','https://linkedin.com/in/ahmadfauzi','[\"Web Development\",\"Docker\",\"Linux\",\"Laravel\"]',96,'On-Site','pending',NULL,'2026-10-04 07:06:51','2026-10-04 07:06:51'),(4,6,2,NULL,'seed','541211002','Siti Aminah','Teknik Jaringan Akses Telekomunikasi (TJAT)','2023/2024','siti.aminah@student.telkomsda.sch.id','085678901234','https://linkedin.com/in/sitiaminah','[\"Fiber Optic\",\"Cisco\",\"MikroTik\"]',89,'Hybrid','interview','Senin, 10:00 WIB via Google Meet','2026-10-04 07:06:51','2026-10-04 07:06:51');

-- -----------------------------------------------------------------------------
-- 4. Tandai migrasi industry sebagai SUDAH JALAN
--    (menghindari error "Table already exists" saat `php artisan migrate`)
-- -----------------------------------------------------------------------------
DELETE FROM `migrations` WHERE `migration` IN (
  '2026_10_04_081603_create_industries_table',
  '2026_10_04_081604_create_job_postings_table',
  '2026_10_04_081605_create_applicants_table',
  '2026_10_04_210000_add_slug_to_industries_table',
  '2026_10_04_210001_add_hirelink_link_to_applicants_table'
);

INSERT INTO `migrations` (`migration`, `batch`)
SELECT m.migration, (SELECT COALESCE(MAX(batch), 0) + 1 FROM `migrations`)
FROM (
  SELECT '2026_10_04_081603_create_industries_table' AS migration
  UNION ALL SELECT '2026_10_04_081604_create_job_postings_table'
  UNION ALL SELECT '2026_10_04_081605_create_applicants_table'
  UNION ALL SELECT '2026_10_04_210000_add_slug_to_industries_table'
  UNION ALL SELECT '2026_10_04_210001_add_hirelink_link_to_applicants_table'
) AS m;

-- -----------------------------------------------------------------------------
-- 5. Verifikasi cepat (opsional)
-- -----------------------------------------------------------------------------
-- SELECT COUNT(*) AS industries FROM `industries`;
-- SELECT COUNT(*) AS applicants FROM `applicants`;
-- =============================================================================
--  SELESAI.
-- =============================================================================
