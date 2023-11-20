-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 02:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiemtra`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`id`, `ten`) VALUES
(1, 'Giám đốc');

-- --------------------------------------------------------

--
-- Table structure for table `donvitinh`
--

CREATE TABLE `donvitinh` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `ki_hieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donvitinh`
--

INSERT INTO `donvitinh` (`id`, `ten`, `ki_hieu`) VALUES
(1, 'Cái', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `cmnd` varchar(12) NOT NULL,
  `ngaysinh` date NOT NULL,
  `dienthoai` varchar(12) NOT NULL,
  `diachi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id`, `ten`, `cmnd`, `ngaysinh`, `dienthoai`, `diachi`) VALUES
(1, 'Trần Ngọc Anh', '025123450', '1969-09-17', '0985456343', '184 Hòa Bình, P.Hiệp Tân, Q.Tân Phú, TPHCM'),
(2, 'Nguyễn Văn Toàn', '025211231', '1975-01-12', '0909878454', '958/3 Âu Cơ, P.14, Q.Tân Bình, TPHCM'),
(3, 'Lê Thanh Hải', '235778190', '1980-11-08', '0909787865', '306 Nguyễn Trọng Tuyển, Phường 2, Quận Tân Bình'),
(4, 'Võ Hồng Nhung', '232897675', '1978-11-29', '0985757666', '172 Lê Thúc Hoạch, Phường Tân Quý, Quận Tân Phú'),
(5, 'Vinmart', '001097015233', '1969-09-17', '0985456344', '958');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp(),
  `updated_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`id`, `ten`, `created_at`, `updated_at`) VALUES
(1, 'Quần áo', 2147483647, 2147483647),
(2, 'Đồ gia dụng', 2147483647, 2147483647),
(3, 'Thực phẩm', 2147483647, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `ngaysinh` date NOT NULL,
  `dienthoai` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cmnd` varchar(255) NOT NULL,
  `id_phongban` int(11) NOT NULL,
  `id_chucvu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`id`, `ten`) VALUES
(1, 'Kỹ thuật'),
(2, 'Kế toán'),
(3, 'Kinh doanh');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `id_loaisanpham` int(11) NOT NULL,
  `id_donvitinh` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten`, `id_loaisanpham`, `id_donvitinh`, `created_at`, `updated_at`) VALUES
(7, '', 0, 1, '2023-11-19 16:59:08', '2023-11-19 16:59:08'),
(8, '', 0, 1, '2023-11-19 16:59:39', '2023-11-19 16:59:39'),
(9, '', 0, 1, '2023-11-19 17:01:23', '2023-11-19 17:01:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donvitinh`
--
ALTER TABLE `donvitinh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nhanvien_cmnd_unique` (`cmnd`),
  ADD UNIQUE KEY `nhanvien_dienthoai_unique` (`dienthoai`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_chucvu` (`id_chucvu`),
  ADD KEY `id_phongban` (`id_phongban`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donvitinh`
--
ALTER TABLE `donvitinh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`id_chucvu`) REFERENCES `chucvu` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_2` FOREIGN KEY (`id_phongban`) REFERENCES `phongban` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
