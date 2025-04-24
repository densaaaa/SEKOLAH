-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8887
-- Generation Time: Apr 22, 2025 at 02:32 PM
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
-- Database: `smk1jakarta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `password`) VALUES
('admin01', '$2y$10$C7oLDJooSmzGYbQ3lxRWZOYlVCxkNcbdNwG6.BSvRWKcCDACzlQ6u');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` int(255) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `mapel` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mapel_jurusan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `mapel`, `password`, `mapel_jurusan`) VALUES
(1, 'Wang Ling', '', '$2y$10$8MXYdM755QE6P9u10xZ6qe8EwSIN5t/FcMr2LIvDGfqTnGLfJhH.2', 'RPL'),
(2, 'Shi Lan', 'B Indo', '$2y$10$3pLJ5nJi790iqWAQoM8CHeTF5ITslbU0TJodNZpFK9fpFuhvrbGoG', ''),
(3, 'Wang La', '', '$2y$10$ecmtrjbcEj7naErc5Cdgy.t8zkLzu72d4qFjpDJlsTV5PFt3/0C1O', 'TKJ'),
(999, 'toni', 'B Indo', '$2y$10$4e.p9XnxlYFotfHUAzdRf.zZFcaMlm2y4qxxMi.sTTaygcMGtu/c6', ''),
(2070, 'Jaya', '', '$2y$10$Jl7Fd3xEki1HDLF3rGD1z.JqAK02Vc81ELiEMrQgduZuV07uTYuEe', 'TITL'),
(2090, 'Dian', '', '$2y$10$OCeXg11u5FNRUIfCAZ7ey.nN/tZ.PZmWOTfkajEOvWkmty8UNctKO', 'DGM'),
(2171, 'Krisna', '', '$2y$10$2RWATIBezbZWPd34p8e9uOPUEfKGSjuhyeX2LQzBA.ZGATL592tvu', 'DPIB'),
(2272, 'Luna', '', '$2y$10$LBcVGOkpYS8gGxCRzT4I8eCNf.rr7IXr0iHodW60nE3Fsje6gSRbO', 'RPL'),
(2332, 'Sugeng', 'B Indo\r\n', '$2y$10$IvL3Dn.Fumak3QLaSaIgKu8Z84UEsuPbbJVJ7e0p.FZVVyeMi4K02', ''),
(2373, 'Mira', '', '$2y$10$kXchLV0nF3kq5kuGN9j.xeWT0ogvEXw9OVzh7LAmEa6GQ0vxuycGq', 'RPL'),
(2474, 'Nina', '', '$2y$10$/P35AMNuIgBjx0kI6vNcve8nmR6KlL/QFHQ7dGDGwoLLOs8NiwY16', 'SIJA'),
(2575, 'Oka', '', '$2y$10$nYsAdyqfdfzL1mgkqHD8ZORio.ry7NspBJmN32U3tfvzJE8vO2yde', 'DGM'),
(2666, 'Fida', '', '$2y$10$7by1nvqw5pGNvRPBIFFwVOJxyTUoQ5g9.Ypk1jPz46d.sMeJ/L3OW', 'DGM'),
(2767, 'Gina', '', '$2y$10$AdIwq7e1fmVV6uLiTQZ/lOi6DdK.zoT0c4cS9bh9AcjLUMxXhLN6e', 'DPIB'),
(2777, 'Sugeng', '', '$2y$10$lQSf7mVX/p6NaYEEISuRqubl0DYvsXKS6yT/fG.cR0lKgPHI1tvQ6', 'DPIB'),
(2868, 'Hendra', '', '$2y$10$FbXsAGH3vAOC8lec/nZm0em3AyWtbLjO5FzDjqlrBg1Dgyy0YEtsi', 'SIJA'),
(2969, 'Ira', '', '$2y$10$XGQ/jwdEzCwQp/aTH3U0kek/FSUmMpnDnlynb6ANzWc2gXy1FCe8.', 'DGM'),
(3080, 'Tari', '', '$2y$10$1zEXOqzZrI6sZv602FFUPe8yEYH8Nk4x0xhLogdO71FM0.klZOJn2', 'RPL'),
(4464, 'Dewi', '', '$2y$10$IiU7kSYyvfJh0xZP2iKIrub5U/1PEwSuFq8q8W5efI/B5BVux98iq', 'TITL'),
(4565, 'Eko', '', '$2y$10$vNaEOhJroXGRgm4eVH2PDOg2yDl7cxdPKepdnshz1rszq3GtF3oM6', 'RPL'),
(4979, 'Santi', '', '$2y$10$KCKAH8BTqDCjAP1BnZE1hudQrHBORRRfGk6Bfb0wycOzY4nBtprXW', 'SIJA'),
(4989, 'Cleo', '', '$2y$10$kAo4MRzYkZvBuoanL59r1.DLEnYYUFZ1aahfqdgbZuwUYDnbJ76l2', 'RPL'),
(5676, 'Puti', '', '$2y$10$BdSAu3NBdZ3BibijYvGroOXegsDEtQVggdOd4DXVM42bPfuiOvzFO', 'DPIB'),
(5878, 'Rina', '', '$2y$10$OKspcq8bsftqrmoq.pXnPOgHoDl5p/RJ2BdUgHOMsZRovcJPjwnhK', 'DGM'),
(6061, 'Ayu', '', '$2y$10$o.UumSp8Owh0gd/.3DOQyONDnxAneoRFRrvm0WeoD8D/PXfB2KQVq', 'DGM'),
(6161, 'Ayu', 'B Indo', '$2y$10$DfZdBmhZfmmHF31CSJkiweaZSr4Z.RUbbQAdTN07BW8DvfQOjOW.W', ''),
(6181, 'Uli', '', '$2y$10$hVl1VMKUjYDo3ikfIffwiuTQLICvqFK0fjn8LMPL/lDiH777pQe0.', 'TITL'),
(6262, 'Budi', 'Olga', '$2y$10$4EkUYUwPA8hX5wmaKHpTceBRWQz74Enx4RqRmSOra2Jcyeg5fvkpW', ''),
(6263, 'Citra', '', '$2y$10$rfXDTZZG98zEhx2MC1fl0uFJlX5DHjl9vy3wd7C.TAcXyiZBBUZKW', 'RPL'),
(6363, 'Citra', 'IPAS', '$2y$10$C7lQSXwsHgOXjFd63w0YB.3w1wZ/UkNQUAF/sq3HXpCd27OCL3T9m', ''),
(6464, 'Dewi', 'Matematika', '$2y$10$SP1CHhqnTMMfYpv61umXC.46/zCQlbpSRkC1NiKWs8KYA8xUcG9W6', ''),
(6565, 'Eko', 'B Inggris', '$2y$10$rXr2O4uSW264tg/A9WT7IuAUeWPj6aNDpQjnTnUl5EKNlhGgirE4u', ''),
(6666, 'Fida', 'Olga', '$2y$10$YgK/9b4TfV3lzG0qhZ.Syef1vAHRAvjl/tiPJeqsZL84kW83uZ7Fi', ''),
(6767, 'Gina', 'B Indo', '$2y$10$uBjzLu5hmcIW6Qvg0NOARe43L/XKK7olW2jbZMomX/JaXvQkSLrgC', ''),
(6777, 'Qina', '', '$2y$10$ifZ7p8DbE4jj8l17W4T8XuYxg4zFO71Cf5/8gKJk5I3TLtfqr9S.u', 'RPL'),
(6862, 'Budi', '', '$2y$10$FwvN7h0AGSGrNuYO0Ta9NuWdt1toyCFH4XLYVtpM4.FWc3gULgcGC', 'SIJA'),
(6868, 'Hendra', 'Matematika', '$2y$10$e6oMweZUoCQMmErD28GOFOyZIZpQGeN87VAs6wuVO4BcpIgL2GoMi', ''),
(6969, 'Ira', 'B Inggris', '$2y$10$1/Gka/d3V9eAVtrexTGPHum0jDE6N03u6w.8i.UOgsSLuEO7If7uO', ''),
(7070, 'Jaya', 'IPAS', '$2y$10$cslPCmYDNZASpFAHoEUfAe2Z2iBJJBmrjp7bsJT2UZ8LqM2Q8GC4G', ''),
(7171, 'Krisna', 'Olga', '$2y$10$Jl2XS/PjPukyvjPhezINceo4VGziyHl9F7WOmL956tzQ.YZnSQ7OC', ''),
(7272, 'Luna', 'Matematika', '$2y$10$U8KEQVpAMf4aqipNEylqK.6joHrJSSmAIbuuIKxfdcCsRzE7hRrRa', ''),
(7373, 'Mira', 'B Indo', '$2y$10$0GHyLb/3Ru00USbujjNCj.sJSmxbH8Ruqv1kaCq4mMgMEyYmtNaRe', ''),
(7474, 'Nina', 'IPAS', '$2y$10$61f1pgMN19C7uH5ywOtl2.bsGj4CUmgFlTJva5zli7Kgh953ev1Ra', ''),
(7575, 'Oka', 'Matematika', '$2y$10$ZexvOgkQZYNDP4Qwfu.QI.HzF9UL9mt0yZtaL2tB/OINUexNs9ecG', ''),
(7676, 'Puti', 'Olga', '$2y$10$Ej4Ulh8BY84D/tJVWeENG.ZzJQzTGG/vFcW04.JKVD/CSYkdBnZk.', ''),
(7777, 'Qina', 'B Indo', '$2y$10$3L8koprHPDbYgVo7tAqmOOZwkU6yQJfPAeRTCrb9AR1cxuMdyGqKa', ''),
(7878, 'Rina', 'IPAS', '928374', ''),
(7979, 'Santi', 'Matematika', '829374', ''),
(8080, 'Tari', 'Olga', '839204', ''),
(8082, 'Vina', '', '749203', 'DPIB'),
(8083, 'Wira', '', '928374', 'DGM'),
(8087, 'Alya', '', '284736', 'RPL'),
(8088, 'Bara', '', '839204', 'SIJA'),
(8181, 'Uli', 'B Inggris', '572930', ''),
(8282, 'Vina', 'Matematika', '749203', ''),
(8284, 'Xena', '', '482736', 'RPL'),
(8383, 'Wira', 'IPAS', '928374', ''),
(8385, 'Yulia', '', '920384', 'TITL'),
(8484, 'Xena', 'B Indo', '482736', ''),
(8585, 'Yulia', 'Olga', '920384', ''),
(8686, 'Zara', 'B Inggris', '284736', ''),
(8786, 'Zara', '', '284736', 'DPIB'),
(8787, 'Alya', 'IPAS', '284736', ''),
(8888, 'Bara', 'Matematika', '839204', ''),
(8989, 'Cleo', 'B Indo', '493847', ''),
(9090, 'Dian', 'Olga', '729384', ''),
(9191, 'Evi', 'B Inggris', '394758', ''),
(9991, 'Evi', '', '394758', 'TITL');

-- --------------------------------------------------------

--
-- Table structure for table `nilaisiswa`
--

CREATE TABLE `nilaisiswa` (
  `nama` varchar(200) NOT NULL,
  `kelas` varchar(11) NOT NULL,
  `produktif` varchar(11) NOT NULL,
  `ipas` int(11) NOT NULL,
  `olga` int(11) NOT NULL,
  `b_indo` int(11) NOT NULL,
  `b_inggris` int(11) NOT NULL,
  `matematika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilaisiswa`
--

INSERT INTO `nilaisiswa` (`nama`, `kelas`, `produktif`, `ipas`, `olga`, `b_indo`, `b_inggris`, `matematika`) VALUES
('Adianto Sulaiman', 'X-2 SIJA', '78', 83, 49, 70, 76, 68),
('Andreas Tian', 'X-2 TKP', '48', 74, 52, 74, 64, 57),
('Angga Yongki', 'XII-3 TITL', '62', 59, 51, 65, 66, 64),
('Ardi Halim', 'XII-2 TKR', '90', 80, 57, 75, 70, 60),
('Bambang Lu', 'XI-1 TPM', '49', 61, 62, 70, 69, 81),
('Bani', 'XII SIJA 3', '94', 90, 85, 91, 92, 96),
('Bao Wicaksono', 'X-1 DGM', '72', 88, 45, 76, 64, 59),
('Beno', 'XI TKR 2', '93', 91, 90, 92, 90, 94),
('Cheng Nugroho', 'XII-3 TKR', '60', 55, 48, 67, 59, 71),
('Cipto Liang', 'X-3 DGM', '71', 61, 54, 69, 87, 66),
('Cleo', 'XII RPL 1', '91', 85, 91, 88, 93, 92),
('Dani', 'XII DKV 1', '93', 88, 89, 90, 86, 91),
('Dewanto Chi', 'XI-3 SIJA', '70', 69, 55, 77, 75, 86),
('Didi Wijanarko', 'XI-1 DKV', '57', 46, 62, 66, 55, 73),
('Dodo', 'X RPL 3', '92', 89, 93, 90, 86, 93),
('Eka', 'XI DGM 2', '91', 85, 92, 89, 90, 93),
('Erna', 'XI SIJA 2', '90', 87, 86, 91, 93, 92),
('Fena', 'XII DKV 3', '91', 92, 90, 89, 92, 94),
('Fenarto Priyo', 'XI-1 DPIB', '91', 65, 40, 87, 77, 50),
('Gina', 'XI RPL 1', '94', 89, 91, 88, 92, 90),
('Gunadi Sun', 'X-1 SIJA', '42', 67, 57, 81, 72, 70),
('Gunawan Lingga', 'XI-2 DPIB', '63', 59, 67, 68, 66, 77),
('Hadi', 'XII TKJ 1', '90', 85, 87, 92, 94, 93),
('Hanif Gunarto', 'X-2 DGM', '69', 78, 69, 82, 79, 86),
('Harianto Tjin', 'X-1 TITL', '46', 87, 47, 79, 58, 83),
('Hendra Wijaya', 'XII-1 TKR', '90', 51, 39, 58, 67, 64),
('Heng Sujito', 'XI-3 DGM', '87', 64, 48, 68, 65, 74),
('Hengki Subagyo', 'X-2 DKV', '81', 70, 44, 89, 85, 68),
('Ica', 'X TKR 1', '91', 88, 92, 90, 91, 92),
('Iman Kwee', 'XII-3 DPIB', '66', 58, 61, 63, 62, 82),
('Jaya', 'XI RPL 3', '99', 93, 86, 89, 91, 95),
('Johan Kurniawan', 'XI-2 TKP', '61', 52, 66, 88, 60, 76),
('Julius', 'XI RPL 2', '94', 91, 89, 85, 92, 90),
('Junarto Widodo', 'XI-2 TKJ', '53', 62, 58, 84, 73, 77),
('Kamal', 'XII DPIB 2', '', 92, 90, 87, 94, 89),
('Kevin Purnomo', 'XII-1 TKP', '84', 50, 47, 66, 85, 62),
('Kevin Tan', 'X-2 RPL', '88', 60, 55, 67, 82, 58),
('Kian Santosa', 'X-3 TITL', '64', 73, 56, 66, 89, 82),
('Kris', 'XII DGM 2', '92', 93, 87, 91, 90, 92),
('Kurniawan Yong', 'X-1 DPIB', '70', 58, 60, 80, 83, 65),
('Kusuma Lin', 'X-3 TPM', '66', 75, 53, 62, 71, 78),
('Lala', 'X RPL 3', '91', 92, 90, 88, 94, 93),
('Leo Tjahjadi', 'X-2 TKJ', '55', 43, 59, 75, 78, 62),
('Lia', 'XI DKV 1', '92', 90, 88, 85, 92, 91),
('Liem Suwito', 'X-1 TKP', '45', 66, 60, 79, 81, 73),
('Mario Subandi', 'XII-2 DKV', '49', 60, 69, 79, 63, 71),
('Martin Kusuma', 'XI-3 TKJ', '59', 63, 46, 73, 57, 85),
('Mina', 'XII RPL 2', '92', 89, 91, 90, 93, 94),
('Mira', 'XII RPL 3', '90', 88, 91, 92, 90, 94),
('Nanda Huang', 'X-1 TKR', '72', 75, 66, 68, 58, 67),
('Nico Pranoto', 'XII-2 TPM', '50', 62, 63, 78, 73, 69),
('Nina', 'XI SIJA 1', '89', 86, 85, 92, 88, 91),
('Nora', 'XI SIJA 3', '90', 92, 88, 87, 91, 93),
('Oki', 'XII DGM 1', '93', 91, 90, 88, 93, 95),
('Omar', 'XII TKR 3', '91', 94, 85, 90, 92, 91),
('Pasha', 'XI DKV 2', '93', 89, 91, 88, 90, 94),
('Puti', 'X TKJ 2', '87', 89, 93, 90, 94, 92),
('Qais', 'XI TKR 2', '94', 90, 86, 91, 92, 94),
('Qina', 'X RPL 2', '92', 87, 88, 94, 90, 93),
('Randy Chandra', 'X-2 DPIB', '55', 61, 60, 70, 72, 78),
('Rayan', 'XII TKJ 3', '94', 92, 85, 91, 92, 93),
('Rima', 'XII SIJA 2', '92', 89, 91, 86, 94, 93),
('Rudi Zhang', 'XII-2 DPIB', '74', 60, 50, 77, 56, 83),
('Rudianto Sun', 'XI-3 RPL', '60', 65, 58, 83, 71, 71),
('Salim Prabowo', 'XII-1 TKJ', '36', 70, 68, 61, 69, 84),
('Santi', 'XI RPL 1', '91', 92, 90, 94, 87, 93),
('Sigit Lim', 'XI-3 TKP', '69', 66, 53, 64, 88, 59),
('Sisi', 'XI DPIB 1', '95', 88, 89, 92, 94, 91),
('Slamet Hao', 'XII-3 SIJA', '75', 50, 60, 72, 85, 90),
('Sonny Gunadi', 'XII-3 TKP', '41', 72, 64, 91, 87, 63),
('Steven Gun', 'XI-1 DGM', '83', 57, 44, 62, 59, 90),
('Sugiarto Kang', 'XII-2 TITL', '43', 56, 67, 59, 88, 72),
('Surya Lee', 'XII-1 RPL', '61', 47, 56, 82, 60, 55),
('Suryo Liang', 'XI-1 TITL', '38', 46, 65, 85, 63, 91),
('Sutrisno Yu', 'X-1 TPM', '43', 68, 63, 58, 67, 79),
('Tari', 'XII DKV 2', '90', 88, 86, 93, 92, 94),
('Teddy Warjono', 'X-3 TKR', '67', 85, 51, 64, 90, 66),
('Teng Kuswoyo', 'XII-2 SIJA', '59', 57, 72, 69, 66, 61),
('Tomo', 'XII RPL 1', '91', 94, 90, 85, 93, 92),
('Uda', 'X RPL 2', '94', 93, 92, 87, 90, 89),
('Uli', 'XI DGM 3', '88', 85, 91, 87, 93, 94),
('Vina', 'XII RPL 3', '', 90, 88, 91, 94, 92),
('Vino Hendrawan', 'X-3 TKJ', '58', 52, 65, 73, 74, 86),
('Vivi', 'XII SIJA 1', '92', 89, 90, 90, 92, 95),
('Wahyudi Kim', 'XI-2 SIJA', '65', 74, 49, 76, 54, 68),
('Wawan Chan', 'XI-2 TITL', '54', 77, 50, 71, 79, 76),
('Wei Nurcahyo', 'XII-3 TKJ', '56', 59, 47, 60, 55, 67),
('Wendi', 'XI RPL 3', '91', 92, 88, 91, 94, 93),
('Wira', 'XI DPIB 1', '94', 87, 91, 92, 88, 90),
('Wu Handoko', 'XII-1 TPM', '36', 49, 68, 73, 70, 60),
('Xander', 'XII TKR 1', '92', 89, 91, 90, 85, 93),
('Xena', 'XII TKR 1', '92', 89, 90, 91, 86, 93),
('Yani', 'XI TKJ 2', '94', 90, 87, 91, 93, 94),
('Yanto Kwee', 'XI-3 DKV', '44', 54, 61, 74, 70, 80),
('Yanto Wong', 'X-3 DKV', '78', 71, 42, 60, 68, 74),
('Yopi Su', 'XI-2 TPM', '56', 53, 48, 74, 80, 69),
('Yusuf', 'XII DGM 2', '91', 93, 87, 90, 92, 94),
('Yusuf Sunarto', 'XII-1 DGM', '37', 79, 59, 86, 75, 61),
('Zara', 'XI SIJA 1', '88', 94, 89, 85, 92, 91),
('Zev', 'XII DKV 3', '90', 88, 90, 91, 92, 94);

-- --------------------------------------------------------

--
-- Table structure for table `nisn_to_nama`
--

CREATE TABLE `nisn_to_nama` (
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nisn_to_nama`
--

INSERT INTO `nisn_to_nama` (`nisn`, `nama`) VALUES
('1', 'toni'),
('1234567894', 'Eka'),
('1234567896', 'Gigi'),
('1234567899', 'Jaya'),
('1234567900', 'Kamal'),
('1234567901', 'Lia'),
('1234567902', 'Mira'),
('1234567903', 'Nina'),
('1234567904', 'Oki'),
('1234567905', 'Puti'),
('1234567906', 'Qais'),
('1234567907', 'Rima'),
('1234567908', 'Santi'),
('1234567909', 'Tari'),
('1234567910', 'Uda'),
('1234567911', 'Vina'),
('1234567912', 'Wira'),
('1234567913', 'Xena'),
('1234567914', 'Yusuf'),
('1234567915', 'Zara'),
('1234567916', 'Ari'),
('1234567917', 'Beno'),
('1234567918', 'Cleo'),
('1234567919', 'Dodo'),
('1234567920', 'Erna'),
('1234567921', 'Fena'),
('1234567922', 'Gina'),
('1234567923', 'Hadi'),
('1234567924', 'Ica'),
('1234567925', 'Julius'),
('1234567926', 'Kris'),
('1234567927', 'Lala'),
('1234567928', 'Mina'),
('1234567929', 'Nora'),
('1234567930', 'Omar'),
('1234567931', 'Pasha'),
('1234567932', 'Qina'),
('1234567933', 'Rayan'),
('1234567934', 'Sisi'),
('1234567935', 'Tomo'),
('1234567936', 'Uli'),
('1234567937', 'Vivi'),
('1234567938', 'Wendi'),
('1234567939', 'Xander'),
('1234567940', 'Yani'),
('1234567941', 'Zev'),
('2003948576', 'Budianto Lim'),
('2009182734', 'Kevin Tan'),
('2009183746', 'Andi Suharto'),
('2029374650', 'Gunadi Sun'),
('2029384712', 'Teng Kuswoyo'),
('2029837462', 'Wahyudi Kim'),
('2049172839', 'Sugiarto Kang'),
('2049182735', 'Harianto Tjin'),
('2049182736', 'Suryo Liang'),
('2049876235', 'Kian Santosa'),
('2061728394', 'Hanif Gunarto'),
('2061827364', 'Yusuf Sunarto'),
('2061847263', 'Heng Sujito'),
('2061937432', 'Bao Wicaksono'),
('2073462918', 'Johan Kurniawan'),
('2073489150', 'Liem Suwito'),
('2073958172', 'Sonny Gunadi'),
('2083746590', 'Liadi Purnomo'),
('2093847261', 'Aditya Huang'),
('2093847512', 'Cheng Nugroho'),
('2098374629', 'Teddy Warjono'),
('2098473621', 'Hendra Wijaya'),
('2103748291', 'Nico Pranoto'),
('2103847291', 'Bambang Lu'),
('2103847562', 'Kusuma Lin'),
('2103984756', 'Wu Handoko'),
('2112837465', 'Fenarto Priyo'),
('2112839471', 'Rudi Zhang'),
('2112839473', 'Gunawan Lingga'),
('2112948372', 'Kurniawan Yong'),
('2129847601', 'Hengki Subagyo'),
('2138472938', 'Leo Tjahjadi'),
('2139482716', 'Martin Kusuma'),
('2139842753', 'Wei Nurcahyo'),
('2147384629', 'Yanto Wong'),
('2147639285', 'Yanto Kwee'),
('2147923856', 'Junarto Widodo');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kelas` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `kelas`, `password`) VALUES
('1', 'toni', 'XI DPIB 3', '$2y$10$GOnHjB6Tfjl6gfoJpkWX5ODWO4tjDaWzpsL6t8zSx311lwpLbyXHm'),
('1234567899', 'Jaya', 'XI RPL 3', '210493'),
('1234567900', 'Kamal', 'XII DPIB 2', '549106'),
('1234567901', 'Lia', 'XI DKV 1', '396284'),
('1234567902', 'Mira', 'XII RPL 3', '764520'),
('1234567903', 'Nina', 'XI SIJA 1', '957341'),
('1234567904', 'Oki', 'XII DGM 1', '532176'),
('1234567905', 'Puti', 'X TKJ 2', '820943'),
('1234567906', 'Qais', 'XI TKR 2', '639104'),
('1234567907', 'Rima', 'XII SIJA 2', '374918'),
('1234567908', 'Santi', 'XI RPL 1', '512680'),
('1234567909', 'Tari', 'XII DKV 2', '689254'),
('1234567910', 'Uda', 'X RPL 2', '204965'),
('1234567911', 'Vina', 'XII RPL 3', '875340'),
('1234567912', 'Wira', 'XI DPIB 1', '560173'),
('1234567913', 'Xena', 'XII TKR 1', '781562'),
('1234567914', 'Yusuf', 'XII DGM 2', '426150'),
('1234567915', 'Zara', 'XI SIJA 1', '631047'),
('1234567916', 'Ari', 'XII TKJ 3', '190672'),
('1234567917', 'Beno', 'XI TKR 2', '482315'),
('1234567918', 'Cleo', 'XII RPL 1', '935741'),
('1234567919', 'Dodo', 'X RPL 3', '649280'),
('1234567920', 'Erna', 'XI SIJA 2', '731890'),
('1234567921', 'Fena', 'XII DKV 3', '250947'),
('1234567922', 'Gina', 'XI RPL 1', '608514'),
('1234567923', 'Hadi', 'XII TKJ 1', '420193'),
('1234567924', 'Ica', 'X TKR 1', '869421'),
('1234567925', 'Julius', 'XI RPL 2', '175362'),
('1234567926', 'Kris', 'XII DGM 2', '836591'),
('1234567927', 'Lala', 'X RPL 3', '491758'),
('1234567928', 'Mina', 'XII RPL 2', '265937'),
('1234567929', 'Nora', 'XI SIJA 3', '987560'),
('1234567930', 'Omar', 'XII TKR 3', '623849'),
('1234567931', 'Pasha', 'XI DKV 2', '158270'),
('1234567932', 'Qina', 'X RPL 2', '720361'),
('1234567933', 'Rayan', 'XII TKJ 3', '493857'),
('1234567934', 'Sisi', 'XI DPIB 1', '862305'),
('1234567935', 'Tomo', 'XII RPL 1', '547613'),
('1234567936', 'Uli', 'XI DGM 3', '314679'),
('1234567937', 'Vivi', 'XII SIJA 1', '763182'),
('1234567938', 'Wendi', 'XI RPL 3', '405823'),
('1234567939', 'Xander', 'XII TKR 1', '612947'),
('1234567940', 'Yani', 'XI TKJ 2', '791536'),
('1234567941', 'Zev', 'XII DKV 3', '238106'),
('2003948576', 'Budianto Lim', 'XI RPL 2', '187653'),
('2009182734', 'Kevin Tan', 'X-2 RPL', '193764'),
('2009183746', 'Andi Suharto', 'XII-3 RPL', '123984'),
('2029384712', 'Teng Kuswoyo', 'XII-2 SIJA', '197842'),
('2029837462', 'Wahyudi Kim', 'XI-2 SIJA', '175629'),
('2049172839', 'Sugiarto Kang', 'XII-2 TITL', '198347'),
('2049182735', 'Harianto Tjin', 'X-1 TITL', '183624'),
('2049182736', 'Suryo Liang', 'XI-1 TITL', '154362'),
('2049876235', 'Kian Santosa', 'X-3 TITL', '135689'),
('2061728394', 'Hanif Gunarto', 'X-2 DGM', '162834'),
('2061827364', 'Yusuf Sunarto', 'XII-1 DGM', '152849'),
('2061847263', 'Heng Sujito', 'XI-3 DGM', '132765'),
('2061937432', 'Bao Wicaksono', 'X-1 DGM', '183956'),
('2073462918', 'Johan Kurniawan', 'XI-2 TKP', '196734'),
('2073489150', 'Liem Suwito', 'X-1 TKP', '178945'),
('2073958172', 'Sonny Gunadi', 'XII-3 TKP', '185347'),
('2083746590', 'Liadi Purnomo', 'XI-3 RPL', '158392'),
('2093847512', 'Cheng Nugroho', 'XII-3 TKR', '132789'),
('2098374629', 'Teddy Warjono', 'X-3 TKR', '145789'),
('2098473621', 'Hendra Wijaya', 'XII-1 TKR', '137894'),
('2103748291', 'Nico Pranoto', 'XII-2 TPM', '195843'),
('2103847291', 'Bambang Lu', 'XI-1 TPM', '178243'),
('2103847562', 'Kusuma Lin', 'X-3 TPM', '121345'),
('2103984756', 'Wu Handoko', 'XII-1 TPM', '167823'),
('2112837465', 'Fenarto Priyo', 'XI-1 DPIB', '165327'),
('2112839471', 'Rudi Zhang', 'XII-2 DPIB', '169238'),
('2112948372', 'Kurniawan Yong', 'X-1 DPIB', '143286'),
('2129847601', 'Hengki Subagyo', 'X-2 DKV', '124578'),
('2138472938', 'Leo Tjahjadi', 'X-2 TKJ', '192375'),
('2139482716', 'Martin Kusuma', 'XI-3 TKJ', '163275'),
('2139842753', 'Wei Nurcahyo', 'XII-3 TKJ', '173921'),
('2147384629', 'Yanto Wong', 'X-3 DKV', '136754'),
('2147639285', 'Yanto Kwee', 'XI-3 DKV', '195623'),
('2147923856', 'Junarto Widodo', 'XI-2 TKJ', '192840');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `nilaisiswa`
--
ALTER TABLE `nilaisiswa`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `nisn_to_nama`
--
ALTER TABLE `nisn_to_nama`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
