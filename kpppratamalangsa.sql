-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Okt 2021 pada 10.06
-- Versi server: 8.0.25
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpppratamalangsa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'e0af022a-7a4c-4f72-bb0a-0bee6ca3a48f', 'database', 'default', '{\"uuid\":\"e0af022a-7a4c-4f72-bb0a-0bee6ca3a48f\",\"displayName\":\"Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\",\"command\":\"O:32:\\\"Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\\":21:{s:7:\\\"timeout\\\";N;s:5:\\\"tries\\\";N;s:13:\\\"maxExceptions\\\";N;s:40:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000import\\\";O:25:\\\"App\\\\Imports\\\\LettersImport\\\":3:{s:9:\\\"\\u0000*\\u0000output\\\";N;s:9:\\\"\\u0000*\\u0000errors\\\";a:0:{}s:11:\\\"\\u0000*\\u0000failures\\\";a:0:{}}s:40:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000reader\\\";O:36:\\\"PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Xlsx\\\":8:{s:53:\\\"\\u0000PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Xlsx\\u0000referenceHelper\\\";O:40:\\\"PhpOffice\\\\PhpSpreadsheet\\\\ReferenceHelper\\\":0:{}s:15:\\\"\\u0000*\\u0000readDataOnly\\\";b:1;s:17:\\\"\\u0000*\\u0000readEmptyCells\\\";b:1;s:16:\\\"\\u0000*\\u0000includeCharts\\\";b:0;s:17:\\\"\\u0000*\\u0000loadSheetsOnly\\\";N;s:13:\\\"\\u0000*\\u0000readFilter\\\";O:49:\\\"PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\DefaultReadFilter\\\":0:{}s:13:\\\"\\u0000*\\u0000fileHandle\\\";N;s:18:\\\"\\u0000*\\u0000securityScanner\\\";O:51:\\\"PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Security\\\\XmlScanner\\\":2:{s:60:\\\"\\u0000PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Security\\\\XmlScanner\\u0000pattern\\\";s:9:\\\"<!DOCTYPE\\\";s:61:\\\"\\u0000PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Security\\\\XmlScanner\\u0000callback\\\";N;}}s:47:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000temporaryFile\\\";O:42:\\\"Maatwebsite\\\\Excel\\\\Files\\\\LocalTemporaryFile\\\":1:{s:52:\\\"\\u0000Maatwebsite\\\\Excel\\\\Files\\\\LocalTemporaryFile\\u0000filePath\\\";s:108:\\\"D:\\\\Project_Belajar\\\\sp2dk\\\\storage\\\\framework\\\\laravel-excel\\\\laravel-excel-u9rMXgOqfMtvoWZfhLY2fRNmMTDsO0Op.xlsx\\\";}s:43:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000sheetName\\\";s:14:\\\"Tabel Aplikasi\\\";s:45:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000sheetImport\\\";r:5;s:42:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000startRow\\\";i:2;s:43:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\ReadChunk\\u0000chunkSize\\\";i:1000;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:1:{i:0;s:1733:\\\"O:37:\\\"Maatwebsite\\\\Excel\\\\Jobs\\\\AfterImportJob\\\":12:{s:45:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\AfterImportJob\\u0000import\\\";O:25:\\\"App\\\\Imports\\\\LettersImport\\\":3:{s:9:\\\"\\u0000*\\u0000output\\\";N;s:9:\\\"\\u0000*\\u0000errors\\\";a:0:{}s:11:\\\"\\u0000*\\u0000failures\\\";a:0:{}}s:45:\\\"\\u0000Maatwebsite\\\\Excel\\\\Jobs\\\\AfterImportJob\\u0000reader\\\";O:24:\\\"Maatwebsite\\\\Excel\\\\Reader\\\":5:{s:14:\\\"\\u0000*\\u0000spreadsheet\\\";N;s:15:\\\"\\u0000*\\u0000sheetImports\\\";a:0:{}s:14:\\\"\\u0000*\\u0000currentFile\\\";O:42:\\\"Maatwebsite\\\\Excel\\\\Files\\\\LocalTemporaryFile\\\":1:{s:52:\\\"\\u0000Maatwebsite\\\\Excel\\\\Files\\\\LocalTemporaryFile\\u0000filePath\\\";s:108:\\\"D:\\\\Project_Belajar\\\\sp2dk\\\\storage\\\\framework\\\\laravel-excel\\\\laravel-excel-u9rMXgOqfMtvoWZfhLY2fRNmMTDsO0Op.xlsx\\\";}s:23:\\\"\\u0000*\\u0000temporaryFileFactory\\\";O:44:\\\"Maatwebsite\\\\Excel\\\\Files\\\\TemporaryFileFactory\\\":2:{s:59:\\\"\\u0000Maatwebsite\\\\Excel\\\\Files\\\\TemporaryFileFactory\\u0000temporaryPath\\\";s:56:\\\"D:\\\\Project_Belajar\\\\sp2dk\\\\storage\\\\framework\\/laravel-excel\\\";s:59:\\\"\\u0000Maatwebsite\\\\Excel\\\\Files\\\\TemporaryFileFactory\\u0000temporaryDisk\\\";N;}s:9:\\\"\\u0000*\\u0000reader\\\";O:36:\\\"PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Xlsx\\\":8:{s:53:\\\"\\u0000PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Xlsx\\u0000referenceHelper\\\";O:40:\\\"PhpOffice\\\\PhpSpreadsheet\\\\ReferenceHelper\\\":0:{}s:15:\\\"\\u0000*\\u0000readDataOnly\\\";b:1;s:17:\\\"\\u0000*\\u0000readEmptyCells\\\";b:1;s:16:\\\"\\u0000*\\u0000includeCharts\\\";b:0;s:17:\\\"\\u0000*\\u0000loadSheetsOnly\\\";N;s:13:\\\"\\u0000*\\u0000readFilter\\\";O:49:\\\"PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\DefaultReadFilter\\\":0:{}s:13:\\\"\\u0000*\\u0000fileHandle\\\";N;s:18:\\\"\\u0000*\\u0000securityScanner\\\";O:51:\\\"PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Security\\\\XmlScanner\\\":2:{s:60:\\\"\\u0000PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Security\\\\XmlScanner\\u0000pattern\\\";s:9:\\\"<!DOCTYPE\\\";s:61:\\\"\\u0000PhpOffice\\\\PhpSpreadsheet\\\\Reader\\\\Security\\\\XmlScanner\\u0000callback\\\";N;}}}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:9:\\\"\\u0000*\\u0000events\\\";a:0:{}}\\\";}s:9:\\\"\\u0000*\\u0000events\\\";a:0:{}s:3:\\\"job\\\";N;}\"}}', 'Carbon\\Exceptions\\InvalidFormatException: Trailing data in D:\\Project_Belajar\\sp2dk\\vendor\\nesbot\\carbon\\src\\Carbon\\Traits\\Creator.php:675\nStack trace:\n#0 D:\\Project_Belajar\\sp2dk\\vendor\\nesbot\\carbon\\src\\Carbon\\Traits\\Creator.php(698): Carbon\\Carbon::rawCreateFromFormat(\'Y-m-d\', \'21-06-2021\', NULL)\n#1 D:\\Project_Belajar\\sp2dk\\app\\Imports\\LettersImport.php(31): Carbon\\Carbon::createFromFormat(\'Y-m-d\', \'21-06-2021\')\n#2 D:\\Project_Belajar\\sp2dk\\app\\Imports\\LettersImport.php(66): App\\Imports\\LettersImport->transformDate(\'21-06-2021\')\n#3 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Imports\\ModelManager.php(92): App\\Imports\\LettersImport->model(Array)\n#4 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Imports\\ModelManager.php(108): Maatwebsite\\Excel\\Imports\\ModelManager->toModels(Object(App\\Imports\\LettersImport), Array, 2)\n#5 [internal function]: Maatwebsite\\Excel\\Imports\\ModelManager->Maatwebsite\\Excel\\Imports\\{closure}(Array, 2)\n#6 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\Collection.php(640): array_map(Object(Closure), Array, Array)\n#7 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Collections\\Traits\\EnumeratesValues.php(343): Illuminate\\Support\\Collection->map(Object(Closure))\n#8 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Imports\\ModelManager.php(109): Illuminate\\Support\\Collection->flatMap(Object(Closure))\n#9 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Imports\\ModelManager.php(71): Maatwebsite\\Excel\\Imports\\ModelManager->massFlush(Object(App\\Imports\\LettersImport))\n#10 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Imports\\ModelImporter.php(92): Maatwebsite\\Excel\\Imports\\ModelManager->flush(Object(App\\Imports\\LettersImport), true)\n#11 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Sheet.php(264): Maatwebsite\\Excel\\Imports\\ModelImporter->import(Object(PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet), Object(App\\Imports\\LettersImport), 2)\n#12 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Jobs\\ReadChunk.php(169): Maatwebsite\\Excel\\Sheet->import(Object(App\\Imports\\LettersImport), 2)\n#13 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Concerns\\ManagesTransactions.php(29): Maatwebsite\\Excel\\Jobs\\ReadChunk->Maatwebsite\\Excel\\Jobs\\{closure}(Object(Illuminate\\Database\\MySqlConnection))\n#14 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Transactions\\DbTransactionHandler.php(30): Illuminate\\Database\\Connection->transaction(Object(Closure))\n#15 D:\\Project_Belajar\\sp2dk\\vendor\\maatwebsite\\excel\\src\\Jobs\\ReadChunk.php(175): Maatwebsite\\Excel\\Transactions\\DbTransactionHandler->__invoke(Object(Closure))\n#16 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Maatwebsite\\Excel\\Jobs\\ReadChunk->handle(Object(Maatwebsite\\Excel\\Transactions\\DbTransactionHandler))\n#17 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#19 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#20 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#21 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#22 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Maatwebsite\\Excel\\Jobs\\ReadChunk))\n#23 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Maatwebsite\\Excel\\Jobs\\ReadChunk))\n#24 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Maatwebsite\\Excel\\Jobs\\ReadChunk), false)\n#26 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Maatwebsite\\Excel\\Jobs\\ReadChunk))\n#27 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Maatwebsite\\Excel\\Jobs\\ReadChunk))\n#28 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#29 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Maatwebsite\\Excel\\Jobs\\ReadChunk))\n#30 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#31 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#33 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#35 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#36 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#39 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#40 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#41 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#42 D:\\Project_Belajar\\sp2dk\\vendor\\symfony\\console\\Command\\Command.php(299): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#44 D:\\Project_Belajar\\sp2dk\\vendor\\symfony\\console\\Application.php(978): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 D:\\Project_Belajar\\sp2dk\\vendor\\symfony\\console\\Application.php(295): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 D:\\Project_Belajar\\sp2dk\\vendor\\symfony\\console\\Application.php(167): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 D:\\Project_Belajar\\sp2dk\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 D:\\Project_Belajar\\sp2dk\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#50 {main}', '2021-10-12 04:10:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `letters`
--

CREATE TABLE `letters` (
  `id` bigint UNSIGNED NOT NULL,
  `taxpayer_id` bigint UNSIGNED NOT NULL,
  `no_sp2dk` bigint NOT NULL,
  `tanggal_sp2dk` date NOT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `potensi_awal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_kirim_suki` date DEFAULT NULL,
  `tanggal_kirim_pos` date DEFAULT NULL,
  `tanggal_kempos` date DEFAULT NULL,
  `tanggal_telpon_wp` date DEFAULT NULL,
  `hasil_telpon_wp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_konseling` date DEFAULT NULL,
  `hasil_konseling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_ba_tidak_hadir` date DEFAULT NULL,
  `no_ba_tidak_hadir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_visit` date DEFAULT NULL,
  `hasil_visit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_lhp2dk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lhp2dk` date DEFAULT NULL,
  `keputusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesimpulan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potensi_akhir` bigint DEFAULT NULL,
  `realisasi` bigint DEFAULT NULL,
  `tanggal_setor` date DEFAULT NULL,
  `tanggal_usul_pemeriksaan` date DEFAULT NULL,
  `no_dspp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_dspp` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `letters`
--

INSERT INTO `letters` (`id`, `taxpayer_id`, `no_sp2dk`, `tanggal_sp2dk`, `tahun`, `potensi_awal`, `tanggal_kirim_suki`, `tanggal_kirim_pos`, `tanggal_kempos`, `tanggal_telpon_wp`, `hasil_telpon_wp`, `tanggal_konseling`, `hasil_konseling`, `tanggal_ba_tidak_hadir`, `no_ba_tidak_hadir`, `tanggal_visit`, `hasil_visit`, `no_lhp2dk`, `tanggal_lhp2dk`, `keputusan`, `kesimpulan`, `potensi_akhir`, `realisasi`, `tanggal_setor`, `tanggal_usul_pemeriksaan`, `no_dspp`, `tanggal_dspp`, `created_at`, `updated_at`) VALUES
(29, 5, 'SP2DK-5/WPJ.25/KP.05/2021', '2021-01-21', '2020', '300000', '2021-05-10', '2021-07-10', '2021-10-13', NULL, NULL, NULL, NULL, '2021-05-10', 'BA-001004', NULL, NULL, 'LHP2DK-12/WPJ.25/KP.0506/2022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SE-02/PJ/2021', NULL, '2021-10-14 07:34:11', '2021-10-14 07:34:11'),
(30, 6, 'SP2DK-6/WPJ.25/KP.05/2021', '2021-01-19', '2020', '709000', '2021-05-11', '2021-07-11', '2021-10-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LHP2DK-13/WPJ.25/KP.0506/2022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SE-03/PJ/2021', NULL, '2021-10-14 07:34:11', '2021-10-14 07:34:11'),
(32, 8, 'SP2DK-8/WPJ.25/KP.05/2021', '2021-03-12', '2019', '863000', '2021-05-13', '2021-07-13', '2021-10-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LHP2DK-14/WPJ.25/KP.0506/2021', '2021-01-20', 'Seluruh data diakui Wajib Pajak', 'Dalam Pengawasan', '560000', NULL, NULL, NULL, 'SE-02/PJ/2022', NULL, '2021-10-14 07:34:11', '2021-10-14 07:34:11'),
(33, 9, 'SP2DK-9/WPJ.25/KP.05/2021', '2021-03-19', '2016', '352500', '2021-05-14', '2021-07-14', '2021-10-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LHP2DK-15/WPJ.25/KP.0506/2021', '2021-01-21', 'Seluruh data diakui Wajib Pajak', 'Dalam Pengawasan', '90000', NULL, NULL, NULL, 'SE-03/PJ/2022', NULL, '2021-10-14 07:34:11', '2021-10-14 07:34:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_07_150405_create_positions_table', 1),
(6, '2021_09_07_150528_create_sections_table', 1),
(7, '2021_09_07_150601_create_taxpayers_table', 1),
(8, '2021_09_07_150719_create_letters_table', 1),
(9, '2021_09_07_153359_add_position_and_section_to_users_tabel', 1),
(10, '2021_09_09_140954_add_kasi_id_to_taxpayers_table', 1),
(11, '2021_09_22_043746_add_pelaksana_id_to_taxpayers_table', 2),
(12, '2021_10_01_042253_add_field_nip_to_users_table', 3),
(13, '2021_10_12_062700_create_jobs_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('adamyordan0102@gmail.com', '$2y$10$mYuwo1u/g89PVf6wy/ez0Oxk4EIxsIB4qUn55J8RlcqdT6u3Qqslu', '2021-10-11 02:55:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_jabatan` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Kantor', '2021-09-18 22:45:11', '2021-09-18 22:45:11'),
(2, 'Kepala Suki', '2021-09-18 22:45:11', '2021-09-18 22:45:11'),
(3, 'Pelaksana Suki', '2021-09-18 22:45:11', '2021-09-18 22:45:11'),
(4, 'Kepala Seksi', '2021-09-18 22:45:11', '2021-09-18 22:45:11'),
(5, 'Account Representative', '2021-09-18 22:45:11', '2021-09-18 22:45:11'),
(6, 'Pelaksana Seksi', '2021-09-18 22:45:11', '2021-09-18 22:45:11'),
(7, 'Operator Console', '2021-09-18 22:45:11', '2021-09-18 22:45:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sections`
--

CREATE TABLE `sections` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_seksi` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sections`
--

INSERT INTO `sections` (`id`, `nama_seksi`, `created_at`, `updated_at`) VALUES
(1, 'KPP Pratama Langsa', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(2, 'Sub Bagian Umum dan Kepatuhan Internal', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(3, 'Seksi Pengawasan I', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(4, 'Seksi Pengawasan II', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(5, 'Seksi Pengawasan III', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(6, 'Seksi Pengawasan IV', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(7, 'Seksi Pengawasan V', '2021-09-18 22:45:31', '2021-09-18 22:45:31'),
(8, 'Seksi Penjamin Kualitas Data', '2021-09-18 22:45:31', '2021-10-13 08:52:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `taxpayers`
--

CREATE TABLE `taxpayers` (
  `id` bigint UNSIGNED NOT NULL,
  `npwp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kasi_id` bigint UNSIGNED NOT NULL,
  `pelaksana_id` bigint UNSIGNED NOT NULL DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `taxpayers`
--

INSERT INTO `taxpayers` (`id`, `npwp`, `nama`, `user_id`, `kasi_id`, `pelaksana_id`, `created_at`, `updated_at`) VALUES
(5, '202110010000005', 'SUGOENTO', 9, 7, 16, '2021-10-13 08:18:24', '2021-10-13 08:18:24'),
(6, '202110010000006', 'DERE MEULODE', 9, 7, 16, '2021-10-13 08:18:24', '2021-10-13 08:18:24'),
(8, '202110010000008', 'SYEROFUDDON', 9, 7, 16, '2021-10-13 08:18:24', '2021-10-13 08:18:24'),
(9, '202110010000009', 'MELE EGUSTOENE', 9, 7, 16, '2021-10-13 08:18:24', '2021-10-13 08:18:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_id` bigint UNSIGNED NOT NULL,
  `section_id` bigint UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nip`, `position_id`, `section_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ragil Andika Johan', 'ragil@gmail.com', '1234567890', 1, 1, NULL, '$2y$10$heHfoIqzq32H166BVFwKue81zTz8uraKvs3fUyAYYsd6/Y4/pKavi', NULL, '2021-09-18 22:45:41', '2021-09-19 18:55:46'),
(2, 'Muhammad Hisar', 'hisar@gmail.com', NULL, 2, 2, NULL, '$2y$10$TVg6s77AqMXuBrNzMxEgXOxIWPpaXxTJmkT1Mr3Szcmm0ykFdIv1K', NULL, '2021-09-18 22:45:41', '2021-09-18 22:45:41'),
(3, 'Rispani Himilda', 'pani@gmail.com', NULL, 3, 2, NULL, '$2y$10$93mPfPRfojcyuvWxWi/Zvu9y8ZUqyqv0hQISI8KXNmWNptUwWx.T6', NULL, '2021-09-18 22:45:41', '2021-09-18 22:45:41'),
(4, 'Adam Yordan', 'adam@gmail.com', '2345678901', 4, 3, NULL, '$2y$10$Zr9Cv5fiNqvAfH6opEe9re8/2ziP9tivtvGL7ZuCG7PsSS5M0ua0u', 'jOIH7jz4Sd99rnbkBB3uVTJdx8GEeQHBghLsk7svSWQGL4p6gl2bn3iwqDpF', '2021-09-18 22:45:41', '2021-09-30 22:12:22'),
(5, 'Tri Novriza Putri', 'riza@gmail.com', NULL, 5, 3, NULL, '$2y$10$oYV229R1dZzt4BzPy9b6Z.iZzFszfjLCuzUxqEbigCsAa6.smeC86', NULL, '2021-09-18 22:45:41', '2021-09-18 22:45:41'),
(6, 'Dara', 'dara@gmail.com', NULL, 5, 3, NULL, '$2y$10$58kRSeX5sIHc59kgLPdCLOcl9Gu1bkRneRmJlfoMvyApHPBeafOoe', NULL, '2021-09-18 22:45:41', '2021-09-18 22:45:41'),
(7, 'Irham Ali', 'atet@gmail.com', NULL, 4, 4, NULL, '$2y$10$KHTAWQHep0LGO9H9BXvG6eRNUapspIUPwl4CA9KrmUVDuZl9UzQDC', NULL, '2021-09-18 22:45:42', '2021-09-18 22:45:42'),
(8, 'Nadya Auliza', 'nadya@gmail.com', NULL, 5, 4, NULL, '$2y$10$SW40L9u9KAecfQKZXbj3MuTN/UU7/uUMuw6cQDj5.SdaQoBdnOHeG', NULL, '2021-09-18 22:45:42', '2021-09-18 22:45:42'),
(9, 'Siti Abiola', 'abi@gmail.com', NULL, 5, 4, NULL, '$2y$10$3vfxuvC3XF4E6mylen3mCOh/f1aZaAOAF0ZJkDVqFDqe3CbIezYre', NULL, '2021-09-18 22:45:42', '2021-09-18 22:45:42'),
(10, 'Johan Saputra', 'johan@gmail.com', NULL, 7, 8, NULL, '$2y$10$e8hN4.ZQ7n.XA05cZsyfOeXEhpiK63e0EOGtjLzxbPbx1jxNiPH7K', NULL, '2021-09-18 22:45:42', '2021-09-19 23:22:09'),
(12, 'Nurul Husna', 'nuna@gmail.com', NULL, 5, 3, NULL, '$2y$10$dD6xR7sxO3OAzbK2Yq.JkufQPSLh4zpYBLQL/IJh04r4u5u45FzHq', NULL, '2021-09-24 01:06:29', '2021-10-06 17:38:35'),
(13, 'Cik Dara Asri', 'icik@gmail.com', NULL, 6, 3, NULL, '$2y$10$lVFZcAw2Mx/hLPHo8k7nyO5uXTljtOVfNduEttrWswYMeJ4exBSa2', NULL, '2021-09-30 10:00:18', '2021-09-30 10:00:18'),
(16, 'Rica Gebi', 'rica@gmail.com', NULL, 6, 4, NULL, '$2y$10$jQolygJ.b69fQut9jens7egTkup3j8TJdkwnJ7Oz678d88WjOqZ4q', NULL, '2021-09-30 10:01:14', '2021-09-30 10:01:14'),
(18, 'Muhammad Rizki', 'rizki@gmail.com', '0000000002', 3, 2, NULL, '$2y$10$LQ4BGJKaNz.lZNOuHUhSJuwIk8tJyggr.H.ZN6ujAjtECO4xz2uxK', NULL, '2021-10-13 07:32:12', '2021-10-13 07:39:21'),
(19, 'Rahmad Alfian', 'rahmad@gmail.com', '0000000003', 3, 2, NULL, '$2y$10$i6sVcUDOFuhbMWMJ8A7c7.58bD7B6yzKoje0luNL5ztw1zCHN2cYa', NULL, '2021-10-13 08:40:59', '2021-10-13 08:40:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `letters_no_sp2dk_unique` (`no_sp2dk`),
  ADD KEY `letters_taxpayer_id_foreign` (`taxpayer_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `taxpayers`
--
ALTER TABLE `taxpayers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxpayers_user_id_foreign` (`user_id`),
  ADD KEY `taxpayers_kasi_id_foreign` (`kasi_id`),
  ADD KEY `taxpayers_pelaksana_id_foreign` (`pelaksana_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD KEY `users_section_id_foreign` (`section_id`),
  ADD KEY `users_position_id_foreign` (`position_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `letters`
--
ALTER TABLE `letters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `taxpayers`
--
ALTER TABLE `taxpayers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD CONSTRAINT `letters_taxpayer_id_foreign` FOREIGN KEY (`taxpayer_id`) REFERENCES `taxpayers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `taxpayers`
--
ALTER TABLE `taxpayers`
  ADD CONSTRAINT `taxpayers_kasi_id_foreign` FOREIGN KEY (`kasi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taxpayers_pelaksana_id_foreign` FOREIGN KEY (`pelaksana_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taxpayers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
