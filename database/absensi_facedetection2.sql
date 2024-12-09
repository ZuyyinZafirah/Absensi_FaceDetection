-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 05:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_facedetection2`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_dosen` varchar(50) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nip`, `nama_dosen`, `id_prodi`, `photo`) VALUES
(1, '198709101234', 'Dr. Andi Wijaya', 1, 'andi_wijaya.jpg'),
(2, '197809201122', 'Prof. Rina Sari', 2, 'rina_sari.jpg'),
(3, '198504112233', 'Ir. Budi Santoso', 1, 'budi_santoso.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `face_data`
--

CREATE TABLE `face_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `face_encoding` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `face_data`
--

INSERT INTO `face_data` (`id`, `user_id`, `face_encoding`, `created_at`, `updated_at`) VALUES
(1, 1, 'c29tZV9yYW5kb21fZW5jb2Rpbmc=', '2024-12-09 10:25:55', '2024-12-09 10:25:55'),
(2, 2, 'c29tZV9yYW5kb21fZW5jb2Rpbmcx', '2024-12-09 10:25:55', '2024-12-09 10:25:55'),
(3, 3, 'c29tZV9yYW5kb21fZW5jb2RpbmMy', '2024-12-09 10:25:55', '2024-12-09 10:25:55'),
(4, 4, 'c29tZV9yYW5kb21fZW5jb2RpbmMz', '2024-12-09 10:25:55', '2024-12-09 10:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mk`
--

CREATE TABLE `jadwal_mk` (
  `id_jadwal` int(11) NOT NULL,
  `nama_jadwal` varchar(100) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `id_prodi` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_mk` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_mk`
--

INSERT INTO `jadwal_mk` (`id_jadwal`, `nama_jadwal`, `waktu_mulai`, `waktu_selesai`, `hari`, `id_ruangan`, `id_prodi`, `id_dosen`, `id_mk`, `created_at`, `updated_at`) VALUES
(1, 'Pemrograman Web - Pagi', '08:00:00', '10:00:00', 'Senin', 1, 1, 1, 1, '2024-12-09 10:27:00', '2024-12-09 10:27:00'),
(2, 'Matematika Diskrit - Siang', '10:00:00', '12:00:00', 'Selasa', 2, 1, 2, 2, '2024-12-09 10:27:00', '2024-12-09 10:27:00'),
(3, 'Pengantar Basis Data - Pagi', '08:00:00', '10:00:00', 'Rabu', 3, 2, 3, 3, '2024-12-09 10:27:00', '2024-12-09 10:27:00'),
(4, 'Sistem Operasi - Sore', '15:00:00', '17:00:00', 'Kamis', 1, 1, 1, 4, '2024-12-09 10:27:00', '2024-12-09 10:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` int(11) NOT NULL,
  `jurusan_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `jurusan_name`) VALUES
(2, 'Sistem Informasi'),
(1, 'Teknik Informatika'),
(3, 'Teknik Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_jadwal` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('hadir','alpha','izin','sakit','telat') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id`, `id_mahasiswa`, `id_dosen`, `id_jadwal`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-12-01 08:05:00', 'hadir', '2024-12-09 10:27:19', '2024-12-09 10:27:19'),
(2, 2, 1, 1, '2024-12-01 08:10:00', 'telat', '2024-12-09 10:27:19', '2024-12-09 10:27:19'),
(3, 3, 3, 3, '2024-12-02 08:00:00', 'hadir', '2024-12-09 10:27:19', '2024-12-09 10:27:19'),
(4, 4, 3, 3, '2024-12-02 08:15:00', 'telat', '2024-12-09 10:27:19', '2024-12-09 10:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `semester` int(5) NOT NULL DEFAULT 1,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `semester`, `id_prodi`) VALUES
(1, 'IF-A', 1, 1),
(2, 'IF-B', 1, 1),
(3, 'SI-A', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `semester` int(5) NOT NULL DEFAULT 1,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `id_prodi`, `id_kelas`, `semester`, `photo`, `created_at`, `updated_at`) VALUES
(1, '22011001', 'Ayu Lestari', 1, 1, 1, 'ayu_lestari.jpg', '2024-12-09 10:25:23', '2024-12-09 13:52:20'),
(2, '22011002', 'Budi Hartono', 1, 1, 1, 'budi_hartono.jpg', '2024-12-09 10:25:23', '2024-12-09 13:52:23'),
(3, '22012001', 'Citra Dewi', 1, 2, 1, 'citra_dewi.jpg', '2024-12-09 10:25:23', '2024-12-09 13:52:28'),
(4, '22012002', 'Dedi Supriyadi', 1, 2, 1, 'dedi_supriyadi.jpg', '2024-12-09 10:25:23', '2024-12-09 13:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` int(11) NOT NULL,
  `nama_mk` varchar(50) NOT NULL,
  `sks` int(5) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `nama_mk`, `sks`, `id_dosen`, `id_kelas`, `semester`) VALUES
(1, 'Pemrograman Web', 3, 1, 1, 1),
(2, 'Matematika Diskrit', 3, 2, 1, 1),
(3, 'Pengantar Basis Data', 3, 3, 2, 1),
(4, 'Sistem Operasi', 3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `prodi_name` varchar(100) NOT NULL,
  `jurusan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `prodi_name`, `jurusan_id`) VALUES
(1, 'Informatika', 1),
(2, 'Sistem Informasi Bisnis', 2),
(3, 'Teknologi Informasi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `id_prodi`, `nama_ruangan`) VALUES
(1, 1, 'Lab Komputer 1'),
(2, 1, 'Lab Komputer 2'),
(3, 2, 'Lab Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dosen') NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_photo`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'admin1@example.com', 'password123', 'admin', 'admin1.jpg', '2024-12-09 10:25:10', '2024-12-09 10:25:10'),
(2, 'Andi Wijaya', 'andi.wijaya@example.com', 'password123', 'dosen', 'andi_wijaya.jpg', '2024-12-09 10:25:10', '2024-12-09 10:25:10'),
(3, 'Rina Sari', 'rina.sari@example.com', 'password123', 'dosen', 'rina_sari.jpg', '2024-12-09 10:25:10', '2024-12-09 10:25:10'),
(4, 'Budi Santoso', 'budi.santoso@example.com', 'password123', 'dosen', 'budi_santoso.jpg', '2024-12-09 10:25:10', '2024-12-09 10:25:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `face_data`
--
ALTER TABLE `face_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jadwal_mk`
--
ALTER TABLE `jadwal_mk`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusan_id`),
  ADD UNIQUE KEY `jurusan_name` (`jurusan_name`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `nama_kelas` (`nama_kelas`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD UNIQUE KEY `prodi_name` (`prodi_name`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`),
  ADD UNIQUE KEY `nama_ruangan` (`nama_ruangan`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `face_data`
--
ALTER TABLE `face_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_mk`
--
ALTER TABLE `jadwal_mk`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `face_data`
--
ALTER TABLE `face_data`
  ADD CONSTRAINT `face_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_mk`
--
ALTER TABLE `jadwal_mk`
  ADD CONSTRAINT `jadwal_mk_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_mk_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_mk_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_mk_ibfk_4` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `kehadiran_ibfk_3` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_mk` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prodi` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mata_kuliah_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `prodi_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`jurusan_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `ruangan_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
