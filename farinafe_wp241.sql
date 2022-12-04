-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2022 at 06:14 PM
-- Server version: 10.3.37-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farinafe_wp241`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `name`, `password`, `last_login`) VALUES
('admin', 'Admin Farina', '$2y$10$97SXi32JNoSjUVI3G2s0iOMKCOtmLw.Y5NUY8OrBVNw80.EaWRkza', '2022-11-29 03:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `short_desc` text NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `article_type` enum('normal','exclusive','','') NOT NULL DEFAULT 'normal',
  `viewed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `short_desc`, `content`, `created`, `is_published`, `is_deleted`, `category_id`, `article_type`, `viewed`) VALUES
(1, 'Coba', 'Coba shd', '<p>content test<span style=\"font-family: &quot;Source Sans Pro&quot;;\">﻿</span></p>', '2021-03-08 05:26:39', 1, 1, 4, 'normal', 0),
(5, '10 Simple tips maintaning glowing face', 'Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.', '<p>Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla porttitor accumsan tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Nulla quis lorem ut libero malesuada feugiat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p><p>Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Donec sollicitudin molestie malesuada.</p><p>Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat.</p>', '2021-03-08 06:19:46', 1, 0, 3, 'exclusive', 0),
(6, 'Coba lagi', 'Donec rutrum congue leo eget malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; ', '<div>Curabitur aliquet quam id dui posuere blandit. Nulla porttitor accumsan tincidunt. Nulla quis lorem ut libero malesuada feugiat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Curabitur aliquet quam id dui posuere blandit. Cras ultricies ligula sed magna dictum porta.</div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus suscipit tortor eget felis porttitor volutpat. Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</div><div><br></div><div>Proin eget tortor risus. Donec rutrum congue leo eget malesuada. Cras ultricies ligula sed magna dictum porta. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat. Curabitur aliquet quam id dui posuere blandit. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</div>', '2021-03-08 08:34:10', 1, 0, 2, 'normal', 0),
(7, '5 Pilihan Highlighter untuk Kulit Gelap', 'Mengaplikasikan highlighter bisa memberi ilusi wajah lebih berdimensi, makeup tampak lebih cerah, dan tentu saja memberi kilau yang mencuri perhatian serta membuat kulit tampak lebih sehat. ', '<p><font color=\"#333333\" face=\"proxima_nova_rgregular, serif\"><span style=\"font-family: &quot;Source Sans Pro&quot;;\">Mengaplikasikan highlighter bisa memberi ilusi wajah lebih berdimensi, makeup tampak lebih cerah, dan tentu saja memberi kilau yang mencuri perhatian serta membuat kulit tampak lebih sehat. Sama seperti memilih warna makeup yang lainnya, memilih shade highlighter juga perlu berhati-hati, supaya pigmentasinya tetap muncul di kulit wajahmu tanpa berkesan terlalu berlebihan.</span></font><span style=\"font-family: &quot;Source Sans Pro&quot;;\">﻿</span><br></p>', '2021-03-08 14:12:42', 1, 0, 2, 'exclusive', 0),
(8, 'S&K', 'Syarat dan Ketentuan', '<b>Syarat dan Ketentuan</b>', '2021-03-30 13:13:33', 1, 0, 6, 'normal', 0),
(9, 'How to register', 'How to register', '<b>How to register</b>', '2021-03-30 13:14:08', 1, 0, 6, 'normal', 0),
(10, 'How to make transaction', 'How to make transaction', '<b>How to make transaction</b>', '2021-03-30 13:14:24', 1, 0, 6, 'normal', 0),
(11, 'VIP Benefit', 'VIP Benefit', 'VIP Benefit', '2021-03-30 13:14:42', 1, 0, 6, 'normal', 0),
(12, 'FAQ', 'FAQ', '<b>FAQ</b>', '2021-03-30 13:14:54', 1, 1, 6, 'normal', 0),
(13, 'Lip Tint Korea HItz', 'Lip cream beraroma buah beri dengan hasil akhir silky-satin untuk bibir yang tampak penuh dan lembap.', '<div>Bare Essentials: Australian Macadamia Organic Oil, Vitamin E, and Hyaluronic Acid in the matte lipcream for plump and moist lips.</div><div>- No Harm: The matte lipcream is Cruelty Free, Paraben Free, Alcohol Free, Mineral Oil Free, Phthalates Free, Talc Free, BHA/BHT Free, Gluten Free.</div><div>- Bliss Moments: I love three things in this world: berry, creamy, and you. Berry for scent, cr</div>', '2022-11-29 04:53:40', 1, 0, 2, 'normal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `name`, `is_deleted`) VALUES
(1, 'Latest News', 0),
(2, 'Product Review', 0),
(3, 'Beauty Tips', 0),
(4, 'Beauty Knowledge', 0),
(5, 'Dummy for delete', 1),
(6, 'Max Femme', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_media`
--

CREATE TABLE `article_media` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `media_type` enum('photo','youtube','','') NOT NULL,
  `filename` text NOT NULL,
  `youtube_link` text NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_media`
--

INSERT INTO `article_media` (`id`, `article_id`, `media_type`, `filename`, `youtube_link`, `display_order`) VALUES
(1, 5, 'photo', 'c13c9ea04ebded77f26567088fe96249.jpg', '', 1),
(2, 5, 'photo', '99bbba46da62ac6aed3b70c0a3499cd2.jpg', '', 2),
(3, 5, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/If2oZ87p6e4?start=1\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 3),
(4, 5, 'photo', '29538f35bdcb92a65de06403d868d88a.jpg', '', 4),
(5, 5, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/uB28yHYUvYo?start=1\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 5),
(6, 7, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/5xGFKCh_SJQ\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(7, 1, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/BaLJ0TKMJds\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(8, 13, 'photo', '5446ac624addbb5293074d6c8b973136.jpg', '', 1),
(9, 13, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/I9RsxdKoB2Q\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `is_deleted`) VALUES
(1, 'Hanasui', 0),
(2, 'Garnier', 0),
(3, 'Cosrx', 0),
(4, 'coba', 1),
(5, 'Emina', 0),
(6, 'Implora', 0),
(7, 'Madame Gie', 0),
(8, 'Mustika Ratu', 0),
(9, 'Safi', 0),
(10, 'Wardah', 0),
(11, 'Maybelline', 0),
(12, 'Makeover', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `short_desc` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `icon` varchar(50) NOT NULL,
  `event_date` datetime NOT NULL,
  `need_registration` tinyint(1) NOT NULL DEFAULT 0,
  `host` varchar(150) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `short_desc`, `content`, `icon`, `event_date`, `need_registration`, `host`, `is_deleted`) VALUES
(1, 'Makeover Competition #1', 'Makeover Competition #1', 'Makeover Competition #1', 'star', '2021-05-01 10:00:00', 1, 'Max Femme', 0),
(2, 'eg', 'wgew', 'weg', 'star', '2021-04-01 08:57:00', 0, 'gewgw', 1),
(3, 'Talkshow: Beauty Class', 'Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Proin eget tortor', '<div>Sed porttitor lectus nibh. Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh. Curabitur aliquet quam id dui posuere blandit.</div><div><br></div><div>Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla porttitor accumsan tincidunt. Donec rutrum congue leo eget malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Nulla quis lorem ut libero malesuada feugiat.</div>', 'bullhorn', '2021-04-15 09:30:00', 0, 'Max Femme', 0),
(4, 'Back date', 'gwr', 'wrhreheh', 'star', '2021-01-06 13:31:00', 0, 'rbrh', 0),
(5, 'Kelas Makeup', 'Kelas Makeup by Ristya Stefani', 'Kelas Makeup by Ristya Stefani', 'fa-solid fa-cupcake', '2022-11-30 14:05:00', 0, 'Ristya Stefani', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_media`
--

CREATE TABLE `event_media` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `media_type` enum('photo','youtube','','') NOT NULL,
  `filename` text NOT NULL,
  `youtube_link` text NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_media`
--

INSERT INTO `event_media` (`id`, `event_id`, `media_type`, `filename`, `youtube_link`, `display_order`) VALUES
(1, 2, 'photo', 'f5548b1a27cbbf9ed599b3e29ec04ed4.jpg', '', 1),
(2, 1, 'photo', 'f5479f68726fb914fe9d31d99db467b2.jpg', '', 1),
(3, 1, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/If2oZ87p6e4?start=1\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2),
(4, 3, 'youtube', '', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/BaLJ0TKMJds\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1),
(5, 5, 'photo', '94845aaa21e7ba1a26c264f6b7f7d13f.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `feed_date` datetime NOT NULL,
  `member_id` varchar(300) NOT NULL,
  `is_headline` tinyint(1) NOT NULL DEFAULT 0,
  `is_from_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feed_comment`
--

CREATE TABLE `feed_comment` (
  `id` bigint(20) NOT NULL,
  `feed_id` bigint(20) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `comment_date` datetime NOT NULL,
  `member_id` varchar(300) NOT NULL,
  `is_from_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feed_likes`
--

CREATE TABLE `feed_likes` (
  `id` bigint(20) NOT NULL,
  `feed_id` bigint(20) NOT NULL,
  `member_id` varchar(300) NOT NULL,
  `is_from_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feed_media`
--

CREATE TABLE `feed_media` (
  `id` bigint(20) NOT NULL,
  `feed_id` bigint(20) NOT NULL,
  `media_type` enum('photo','youtube','','') NOT NULL,
  `filename` text NOT NULL,
  `youtube_link` text NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` varchar(300) NOT NULL,
  `parent_member_id` varchar(300) DEFAULT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(300) NOT NULL,
  `ref_code` varchar(300) NOT NULL,
  `member_type` enum('regular','VIP','','') NOT NULL DEFAULT 'regular',
  `status` enum('active','pending','banned','') NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `parent_member_id`, `first_name`, `last_name`, `email`, `password`, `ref_code`, `member_type`, `status`, `is_deleted`, `last_login`) VALUES
('$2y$10$5LWDgcyxxo72guhaEIkqTu32DGyZRdbNOgOsnyLZ4jUeQwn2t9bWu', '$2y$10$FC4sPrfJRKddd39p26fcCuOhD5TktKaJOkgRq1vyL8SZopgu.GNVy', 'ojeog', 'gkr', 'eg@a.com', '$2y$10$Qnrv8lmdoOQ7p6G87LpTGurcXku3ZHQepLUtsO4W0RdjvXw99ffIy', 'dpJxm1614306312', 'regular', 'pending', 0, NULL),
('$2y$10$FC4sPrfJRKddd39p26fcCuOhD5TktKaJOkgRq1vyL8SZopgu.GNVy', NULL, 'Andre', 'Erdna', 'andrenoto@yahoo.co.id', '$2y$10$GZ8NlqLSi4MKAb35NA6D9uxfJLCmyrOzuCyke6/Id6XCpEY46piOK', 'jdpq51614266525', 'regular', 'active', 0, '2022-11-29 03:41:39'),
('$2y$10$I9uKlSUewU1Tt4IUUgT6vuPA1CSXrIqA7a5MGGbeE50uc4pClLKR2', NULL, 'Second', 'Andre', 'andre@staff.ubaya.ac.id', '$2y$10$TGEYP/RvQA6IszZn4WIYCe/X2Gj6ZUwC/WLHoZzIKjO/n684lAug2', 'eStPo1614305762', 'regular', 'pending', 0, NULL),
('$2y$10$xpPov8tCb2g.U32aGfihC.5S2k6Vy1GFarGl3KGt0mk4dJRI3tqye', NULL, 'Jok', 'Jok', 'antonhendrik@staff.ubaya.ac.id', '$2y$10$znI7JHA00DUsFosVMvKZluZBOzVmal8B.iv/5UYAc8cRcyk2cEA.y', 'AoS2T1614305715', 'regular', 'pending', 0, NULL),
('$2y$10$YZBdr8LmgzFcxWx/ayRbQOg20PQguChPQB6NYtaj7cgOZGUDp.OwW', NULL, 'Second', 'Andre', 'a@abc.com', '$2y$10$FTPtuHmfWoghy0kCu7ACAe2ySQeShRN5fCJTmZkHGHOYIG5K0qM/.', 'Oe3HL1614305824', 'regular', 'pending', 0, NULL),
('$2y$10$ZB31IkaYRmPzvfUrKbIhJuGBhpudK1Er03qJRUOZvkFWITIWfrOgm', NULL, 'jeoo', 'wgoweoj', 'jk@a.com', '$2y$10$/cbjcb9Jj0XbKhag15NojOj2EQTxt.YPlkXp4IAsUfPoSAuwlkrgS', 'D5Sfe1614306082', 'regular', 'pending', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `short_desc` varchar(300) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `weight` int(11) NOT NULL COMMENT 'in grams',
  `product_unit_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `brand_id`, `short_desc`, `description`, `weight`, `product_unit_id`, `price`, `in_stock`, `is_deleted`) VALUES
(1, 'Colorfit Ultralight Matte Lipstick', 10, 'lipstick batang dengan teknologi color powder pigment yang  ringan, halus dan tetap menjaga kelembaban bibir', '<p><span style=\"color: rgba(49, 53, 59, 0.96); font-family: &quot;Source Sans Pro&quot;; font-size: 16px;\"><b>Wardah Ultralight Matte Lipstick </b>merupakan lipstick batang yang diformulasikan menggunakan teknologi color powder pigment sehingga menghasilkan hasil powdery matte yang ringan, halus dan tetap menjaga kelembaban bibir. Wardah Ultralight Matte Lipstick cocok digunakan untuk aktivitas sehari-hari</span></p><p></p><ul><li><span style=\"font-family: &quot;Source Sans Pro&quot;; font-size: 16px;\">Sertifikat: Halal</span></li><li><span style=\"font-family: &quot;Source Sans Pro&quot;; font-size: 16px;\">Kondisi: Baru</span></li><li><span style=\"font-family: &quot;Source Sans Pro&quot;; font-size: 16px;\">Berat: 10 Gram</span></li><li><span style=\"font-family: &quot;Source Sans Pro&quot;; font-size: 16px;\">Kategori: Lipstik</span></li><li><span style=\"font-family: &quot;Source Sans Pro&quot;; font-size: 16px;\">Etalase: WIB</span></li></ul><p></p>', 10, 1, 45000, 0, 0),
(3, 'Makeover Intense Matte Lip Cream', 12, 'asf 2', '<p><span style=\"font-family: &quot;Source Sans Pro&quot;;\">﻿</span><span style=\"font-size: 14px;\">﻿Make Over Intense Matte Lip Cream adalah lip cream dengan bentuk liquid persembahan dari Make Over yang menghadirkan warna-warna intens dan menawan. Kini, Make Over Intense Matte Lip Cream memiliki koleksi 20 varian warna yang menarik dan lengkap, mulai dari warna-warna nudes hingga warna-warna bold yang sangat menawan. Diformulasi dengan tekstur creamy sehingga lip cream ini sangat mudah diaplikasikan. Kandungan pigmentasi warnanya yang sangat intens dapat mengcover bibir hanya dengan sekali olas. Hasil akhirnya pun matte dan terasa sangat ringan yang bahkan dapat bertahan hingga lebih dari 8 jam.&nbsp;</span></p><p><span style=\"font-size: 14px;\"><b>Tahan Lama Hingga 8 Jam<br></b></span><span style=\"font-size: 14px;\">Dengan tekstur yang creamy dan matte dan cukup hanya sekali oles, lip cream ini mampu bertahan hingga 8 jam. Dengannya, Anda tidak perlu repot-repot untuk selalu touch up. Tentunya, Anda dapat tampil cantik sepanjang hari.</span></p><p><span style=\"font-size: 14px;\"><b>Tekstur Ringan<br></b></span><span style=\"font-size: 14px;\">Yang terbaik dari lip cream ini adalah teksturnya yang super ringan dan tidak membuat bibir kering. Kandungan Vitamin E &amp; Vitamin C di dalamnya juga sebagai antioxidant. Selain tahan lama, lip cream ini juga mudah diaplikasikan pada bibir Anda. Cukup usapkan sekali pada bibir Anda, lipstick ini mampu memberikan pigmentasi yang intens.</span></p><p><span style=\"font-size: 14px;\"><b>Manfaat</b></span></p><ul><li><span style=\"font-size: 14px;\">Tekstur creamy yang ringan</span></li><li><span style=\"font-size: 14px;\">Mudah diaplikasikan</span></li><li><span style=\"font-size: 14px;\">Menutup bibir dalam satu kali ulas</span></li><li><span style=\"font-size: 14px;\">Sapuan warna yang intens</span></li><li><span style=\"font-size: 14px;\">Hasil akhir matte yang tahan lama</span></li></ul>', 105, 4, 90000, 1, 0),
(4, 'Instant Age Rewind Treatment Concealer', 11, '﻿Produk concealer inovatif dari Maybelline New York yang ringan pada wajah dengan berbagai pilihan shade warna untuk menyamarkan noda hitam, bekas jerawat dan lingkaran hitam pada mata. Jadi kamu bisa mengucapkan selamat tinggal pada mata panda dan noda pada wajah.', '<p><span style=\"font-size: 14px;\">﻿Produk concealer inovatif dari Maybelline New York yang ringan pada wajah dengan berbagai pilihan shade warna untuk menyamarkan noda hitam, bekas jerawat dan lingkaran hitam pada mata. Jadi kamu bisa mengucapkan selamat tinggal pada mata panda dan noda pada wajah.<br></span></p><p><span style=\"font-size: 14px;\">Instant age rewind ,Concealer serbaguna yang dapat digunakan untuk menutupi lingkaran hitam di bawah mata, merapikan bentuk alis, serta meniruskan dan mempertegas wajah. Tersedia dalam 7 shades.</span><br></p><p><b style=\"font-size: 14px;\">Manfaat:<br></b><span style=\"font-size: 14px;\">Instant Age Rewind memiliki formula yang ringan sehingga mudah untuk dibaurkan. Cukup satu kali swipe untuk mendapatkan high-coverage namun tidak mudah creasing. Dilengkapi dengan cushion tip yang lembut untuk area mata yang sensitif dan menjadikannya mudah dan praktis untuk digunakan.</span></p><p><b style=\"font-size: 14px;\">Cara pemakaian:<br></b><span style=\"font-size: 14px;\">Twist &amp; tap! Putar bagian merah dan formula Instant Age Rewind akan keluar melalui cushion tip. Aplikasikan ke bagian wajah yang ingin kamu sempurnakan.</span></p>', 100, 2, 60000, 1, 0),
(5, 'gewg', 6, 'hrehe', 'erhreh', 144, 4, 245235, 1, 1),
(6, 'Light Complete White Speed Foam (100 ml)', 2, 'Sabun cuci muka yang diperkaya dengan Sari Lemon mampu membersihkan wajah dengan lembut dan mencerahkan kulit wajah. ', 'Sabun cuci muka yang diperkaya dengan Sari Lemon mampu membersihkan wajah dengan lembut dan mencerahkan kulit wajah. Aroma lemon yang terdapat di dalamnya membuat kulit terasa segar setelah menggunakannya&nbsp;', 100, 2, 25000, 1, 0),
(7, 'Sakura White Whitening Serum Day Cream 20 UV (40 ml)', 2, 'Paduan alami Ekstrak Sakura dari Jepang dan Vitamin Pencerah (B3 & CG), cream lembut ini mampu mencerahkan wajah kusam, sekaligus membuat pori-pori di permukaan tampak halus', 'Cocok untuk kulit normal - berminyak dengan paduan alami Ekstrak Sakura dari Jepang dan Vitamin Pencerah (B3 &amp; CG), cream lembut ini mampu mencerahkan wajah kusam, sekaligus membuat pori-pori di permukaan tampak halus. Teknologi Talc Touch, melembabkan tanpa membuat wajah mengkilap akibat minyak berlebih sedangkan UVA/UVB Filter berfungsi untuk melindungi kulit dari efek sinar UVA dan UVB.', 40, 2, 23000, 1, 0),
(8, 'Micellar Water Rose (100 ml)', 2, 'Diperkaya dengan air mawar, membersihkan dan mengangkat make-up secara efisien dan menjadikan kulitmu tampak glowing', 'BARU! All-In-One Micellar Cleansing Water Pertama* diperkaya dengan air mawar, membersihkan dan mengangkat make-up secara efisien dan menjadikan kulitmu tampak glowing. Cocok untuk kulit kusam, termasuk kulit sensitif. Manfaat: Garnier Micellar Cleasning Water pertama* diperkaya dengan Air Mawar, wangi parfum mawar yang memikat dan dikenal dapat mencerahkan wajah dan menjadikan kulit tampak glowing seketika. Teknologi Micellesnya, mengangkat make up, kotoran dan debu bagai magnet tanpa perlu diusap dengan keras. Dalam 1 langkah, bersihkan make up dan jadikan kulitmu tampak bercahaya. Cocok untuk kulit sensitif.', 100, 2, 44000, 1, 0),
(9, 'Light Complete Vitamin C 30X Booster Serum (30 ml)', 2, 'Tekstur serum yang ringan dan fresh mempu mencerahkan noda hitam dan menyamarkan bekas jerawat. Dengan pemakain rutin, kulit tampak lebih cerah bersinar dan noda hitam tersamarkan.', 'Tekstur serum yang ringan dan fresh mempu mencerahkan noda hitam dan menyamarkan bekas jerawat. Dengan pemakain rutin, kulit tampak lebih cerah bersinar dan noda hitam tersamarkan.', 30, 2, 93500, 1, 0),
(10, 'Sakura White Pinkish Glow Whip Foam (100 ml)', 2, 'Whip foam dengan kandungan ekstrak sakura dan hyaluron serum', 'Whip foam dengan kandungan ekstrak sakura dan hyaluron serum. Busa lembut dan padat mampu membersihkan pori-pori secara merata. Kamu akan mendapatkan kulit kenyal, halus dan lebih cerah. Ready ukuran 100 ml&nbsp;', 100, 2, 24500, 1, 0),
(11, 'Light Complete & Sakura Day Cream Sachet (7 ml)', 2, 'Formula baru dengan tekstur ringannya membantu mengurangi kekusaman wajah dan minyak berlebih', 'Inovasi baru dari Garnier Light Complete Multi-Action Whitening Cream. Formula baru dengan tekstur ringannya membantu mengurangi kekusaman wajah dan minyak berlebih. Selain itu, juga menyamarkan bintik hitam dan noda bekas jerawat agar wajah tampak lebih cerah dan bening. Diperkaya dengan Whitening Vitamin (B3), Vitamin E 50% lebih banyak, Sari Lemon, dan Salicylic Acid Derivative. Formula barunya memberikan manfaat yang lebih komplit: Hingga 3 tingkat/tona lebih cerah, menyamarkan bintik hitam dan bekas jerawat, 8 jam bebas kilap, meratakan warna kulit, efek kurangi minyak berlebih yang tahan lama. Sakura Day Cream Sachet Garnier Krim wajah untuk wajah putih cerah merona, diperkaya dengan Ekstrak Sakura - bunga lembut dari Jepang. Dengan paduan ekstrak Sakura dan Whitening Vitamin (B3 &amp; CG), krim ini menutrisi kulit wajah, membantu mencerahkan warna kulit, dan menyamarkan noda hitam. Kulit terasa halus dan pori-pori tampak kecil&nbsp;', 7, 2, 5000, 1, 0),
(12, 'Hair color 1 natural black', 2, 'Pewarna rambut permanen terbuat dari formula natural oil avocado, olive, dan almond', 'Pewarna rambut permanen terbuat dari formula natural oil avocado, olive, dan almond. Dengan menggunakkan pewarna ini warna rambut lebih indah dan tetap terawat. Kamu akan mendapatkan warna rambut 5x lebih berkilau, terawat dan warna lebih indah.&nbsp;', 30, 2, 11200, 1, 0),
(13, 'Clean Micellar Water Blue (125 ml)', 2, 'Garnier Micellar Water bertektstur ringan seperti air cocok untuk kulit kombinasi dan cenderung berminyak/berjerawat.', 'Garnier Micellar Water bertektstur ringan seperti air cocok untuk kulit kombinasi dan cenderung berminyak/berjerawat. Pengaplikasiannya cukup mudah tanpa perlu dibilas. Pembersih ini mampu membersihkan kotoran, makeup serta menghilangkan minyak berlebih dari wajah, mata dan bibir tanpa menimbulkan iritasi.', 125, 2, 27800, 1, 0),
(14, 'Sakura White Whitening Serum Day Cream 20 UV (20 ml)', 2, 'Ekstrak Sakura dari Jepang dan Vitamin Pencerah (B3 & CG), cream lembut ini mampu mencerahkan wajah kusam, sekaligus membuat pori-pori di permukaan tampak halus.', 'Cocok untuk kulit normal - berminyak dengan paduan alami Ekstrak Sakura dari Jepang dan Vitamin Pencerah (B3 &amp; CG), cream lembut ini mampu mencerahkan wajah kusam, sekaligus membuat pori-pori di permukaan tampak halus. Teknologi Talc Touch, melembabkan tanpa membuat wajah mengkilap akibat minyak berlebih sedangkan UVA/UVB Filter berfungsi untuk melindungi kulit dari efek sinar UVA dan UVB.', 20, 2, 23000, 1, 0),
(15, 'Pure Active Anti-Acne White Foam (100 ml)', 2, 'Sabun cuci muka diperkaya dengan anti bakteri dan ekstrak blueberry. ', 'Sabun cuci muka diperkaya dengan anti bakteri dan ekstrak blueberry. Pembersih ini membantu mengatasi jerawat, minyak berlebih, warna kulit tidak rata, kulit kusam,&nbsp; efek paparan sinar UV, bintik hitam,&nbsp; pori besar, pori tersumbat, dan komedo.', 100, 2, 26500, 1, 0),
(16, 'Naturgo Peel Off Mask Black Tube', 1, 'Perawatan kulit wajah dengan masker ini cocok untuk semua jenis kulit.', 'Perawatan kulit wajah dengan masker ini cocok untuk semua jenis kulit. Dengan formulasi Vitamin B3 masker ini bermanfaat untuk mengangkat komedo, menghilangkan noda hitam, mengatasi jerawat, mencerahkan, serta membuat kulit wajah lebih halus, dan lembut', 60, 4, 19500, 1, 0),
(17, 'Peel Off Mask Gold Anti Aging', 1, 'Masker wajah ini mengandung peach extract dan Vitamin B3. ', '<div>Masker wajah ini mengandung peach extract dan Vitamin B3. Membuat kulit tampak lebih awet muda, lebih halus, lembut, dan bercahaya. Selain itu juga menghilangkan bintik hitam dan radikal bebas pada kulit.</div><div><br></div>', 10, 4, 1750, 1, 0),
(18, 'Naturgo Peel Off Mask Black', 1, 'Perawatan kulit wajah dengan masker ini cocok untuk semua jenis kulit.', 'Perawatan kulit wajah dengan masker ini cocok untuk semua jenis kulit. Dengan formulasi Vitamin B3 masker ini bermanfaat untuk mengangkat komedo, menghilangkan noda hitam, mengatasi jerawat, mencerahkan, serta membuat kulit wajah lebih halus, dan lembut.&nbsp;', 10, 4, 1750, 1, 0),
(19, 'Body Care Series 3 in 1', 1, 'Paket perawatan kulit tubuh dengan kombinasi 3 produk unggulan untuk kulit tampak cerah dan terlindung dari debu dan kotoran', 'Paket perawatan kulit tubuh dengan kombinasi 3 produk unggulan untuk kulit tampak cerah dan terlindung dari debu dan kotoran. Transparent Soap, and and Body Lotion with Sunscreen, Hand and Body Lotion with Bengkoang. Dengan rutin menggunakan ketuga produk ini kulit akan tampak lebih cerah, terlindungi dari sinar matahari dan tidak ada kotoran &amp; debu yang menempel.', 10, 4, 30500, 1, 0),
(20, 'Hand Gel Aloe Vera', 1, 'Terbuat dari formula Alkohol 70% dan Ekstrak Aloe Vera yang mampu membersihkan sekaligus melembapkan tangan sehingga terasa segar dan lembut', 'Terbuat dari formula Alkohol 70% dan Ekstrak Aloe Vera yang mampu membersihkan sekaligus melembapkan tangan sehingga terasa segar dan lembut. Serta efektif 100% membunuh kuman, bakteri dan virus.', 100, 2, 25000, 1, 0),
(21, 'Peel Of Mask Egg White', 1, 'Formula yang mengandung putih telur dan Vitamin B3 mampu melembutkan, mencerahkan, mengecilkan pori-pori, mengangkat komedo, bitnik hitam, sel kulit mati dan jerawat.', 'Formula yang mengandung putih telur dan Vitamin B3 mampu melembutkan, mencerahkan, mengecilkan pori-pori, mengangkat komedo, bitnik hitam, sel kulit mati dan jerawat.', 85, 4, 14300, 1, 0),
(22, 'Mattedorable Lipcream', 1, 'Lip cream yang diperkaya dengan Olive Oil dan Vitamin E ini cocok untuk warna kulit wanita Indonesia.', 'Lip cream yang diperkaya dengan Olive Oil dan Vitamin E ini cocok untuk warna kulit wanita Indonesia. Dengan hasil akhir velvet matte yang tahan lama, lip cream ini membantu melembapkan bibir dan tidak mudah pecah. Dapat juga kamu aplikasikan sebagai blush on', 4, 4, 25000, 1, 0),
(23, 'Body Exfoliaitng Gel With Collagen', 1, 'Gel pembersih yang cocok untuk semua jenis ini mengandung collagen. ', 'Gel pembersih yang cocok untuk semua jenis ini mengandung collagen. Berfungsi untuk mengangkat sel-sel kulit mati dengan melembapkan serta meningkatkan kekenyalan kulit agar lebih halus', 300, 2, 20500, 1, 0),
(24, 'Body Serum', 1, 'Terdiri dari 4 pilihan yakni body serum, aloevera, sakura dan vitamin C', '<div>a. Body Serum Hanasui</div><div>Serum lotion dalam bentuk gel ini tidak lengket dan kaya akan Vitamin B3 dan antioksidan. Kulit akan mendapatkan nutrisi dan terlindungi dari polusi atau debu. Sehingga tampak lebih bersinar, segar dan lembap.</div><div><br></div><div>b. Aloevera</div><div>-Aroma menenangkan</div><div>-Pelembab alami untuk meningkatkan hidrasi dan membantu regenerasi kulit</div><div><br></div><div>c. Sakura</div><div>-Aroma melembutkan</div><div>-Melindungi kulit dari paparan radikal bebas dan mencerahkan kulit</div><div><br></div><div>d. Vitamin C</div><div>-Aroma menyegarkan</div><div>-Mengencangkan kulit dan kaya antioksidan untuk melindungi kulit dari polusi&nbsp;</div>', 200, 2, 23500, 1, 0),
(25, 'Serum Wajah', 1, 'Terdiri dari 4 pilihan yakni Serum Vitamin C, Serum Vitamin C dan Collagen, Serum Anti Acne, dan Serum Whitening Gold', '<div>a. Serum Vitamin C</div><div>Produk Perawatan Kulit diperkaya oleh Vitamin C untuk merawat kulit. Kulit akan terhindar dari noda hitam dan kusam. Lalu warna kulit akan merata, lembab dan lebih D2cerah.</div><div><br></div><div>b. Serum Vitamin C dan Collagen</div><div>Diperkaya denga Vitamin C dan Collagen serum ini mampu membuat kulit wajah cerah, mengembalikan kemilau sehat alami kulit dan mengurangi noda hitam di wajah</div><div><br></div><div>c. Serum Anti Acne</div><div>Diformulasikan khusus untuk wajah berminyak yang mengandung BHA (Salycilic Acid) dan Vitamin B3. Serum ini mampu mengangkat kotoran menyumbat pori-pori, mengurangi bakteri penyebab jerawat dan mencerahkan kulit</div><div><br></div><div>d. Serum Whitening Gold</div><div>Perawatan kecantikan kulit wajah yang mengandung Vitamin B3, Glyserin dan Vitamin C mampu membantu untuk mencerahkan dan melembutkan kulit.</div>', 20, 2, 16500, 1, 0),
(26, 'Urban Lip Cream Matte (Lip Cream/Lipstick)', 6, 'Cream Matte yang kaya akan kandungan vitamin E berfungsi sebagai antioxidant dalam menjaga kelembaban bibir. ', '<div>Cream Matte yang kaya akan kandungan vitamin E berfungsi sebagai antioxidant dalam menjaga kelembaban bibir. Dengan sekali sapuan saja warna akan terlihat menarik.</div>', 275, 4, 25000, 1, 0),
(27, 'Eyeliner Pen', 6, 'Dengan ujung yang lembut dan runcing membuat tampilan mata akan terlihat lebih tegas dan dramatis. ', 'Dengan ujung yang lembut dan runcing membuat tampilan mata akan terlihat lebih tegas dan dramatis. Eye liner ini mampu bertahan hingga 24jam.', 170, 4, 21000, 1, 0),
(28, 'Cheek & Liptint', 6, 'Mengandung Vitamin C dan Omega 3,6,9 liptint ini mudah untuk diaplikasikan dan mampu bertahan lama', 'Mengandung Vitamin C dan Omega 3,6,9 liptint ini mudah untuk diaplikasikan dan mampu bertahan lama', 550, 4, 39700, 1, 0),
(29, 'Deep Black Mascara', 6, 'Mascara hitam membuat bulu mata menjadi elegan, berkilau ganda dan alami.', '<div>Mascara hitam membuat bulu mata menjadi elegan, berkilau ganda dan alami. Kuas lembut yang memiliki tekstur pekat untuk menghasilkan bulu mata yang sensasional.&nbsp;</div><div><br></div>', 10, 4, 19500, 1, 0),
(30, 'Bedak Sueluttu Powder Cake 3in1', 6, 'Bedak yang terdiri dari 2 two way cake dan 1 foundation serta kemasan baru yang lebih stylish membuat tampilan yang menawan dan bercahaya di wajah cantikmu', 'Bedak yang terdiri dari 2 two way cake dan 1 foundation serta kemasan baru yang lebih stylish membuat tampilan yang menawan dan bercahaya di wajah cantikmu. Lembut, tahan lama dan tanpa cela untuk pemakaian sehari-hari.&nbsp;', 45, 4, 22500, 1, 0),
(31, 'Handsanaitizer Karakter', 6, 'Handsanaitizer ini memiliki kemasan yang mungil dan lucu yang mudah untuk kamu bawa pergi kemana-mana', 'Handsanaitizer ini memiliki kemasan yang mungil dan lucu yang mudah untuk kamu bawa pergi kemana-mana', 30, 2, 25000, 1, 0),
(32, 'Pensil Alis', 6, 'Riasan mata untuk memberikan kesempurnaan pada penampilan mata.', 'Riasan mata untuk memberikan kesempurnaan pada penampilan mata. Dilengkapi dengan kuas yang lembut untuk merapikan rambut alis. Selain itu juga dilengkapi rautan untuk meruncingkan pensil alis', 250, 4, 10182, 1, 0),
(33, 'Intense Matte Lipstick Long Lasting', 6, 'Dengan formula yang mengandung antioksidan serta mouisturizer yang berguna untuk kelembutan bibir.', 'Dengan formula yang mengandung antioksidan serta mouisturizer yang berguna untuk kelembutan bibir. Ulasan warna lipstick yang matte dan mampu tahan lama.', 350, 4, 23500, 1, 0),
(34, 'Eyeshadow Pallette', 6, 'Eyeshadow palette terbuat dengan tekstur lembut yang mampu bertahan sepanjang hari setelah diaplikasikan', 'Eyeshadow palette terbuat dengan tekstur lembut yang mampu bertahan sepanjang hari setelah diaplikasikan', 35, 4, 22000, 1, 0),
(35, 'Cheek Blossom Blush On', 6, 'Perona untuk mencerahkan tampilan pipi ini berwarna natural dengan hasil akhir yang matte', 'Perona untuk mencerahkan tampilan pipi ini berwarna natural dengan hasil akhir yang matte', 350, 4, 22000, 1, 0),
(36, 'Eyeshadow Palette Desert Dawn Twilight Ocean', 6, 'Eyeshadow palette series terbaru dari Implora ini tersedia dengan berbagai macam warna yang menarik', 'Eyeshadow palette series terbaru dari Implora ini tersedia dengan berbagai macam warna yang menarik', 108, 2, 50000, 1, 0),
(37, 'Fleur Rouge Lipstick', 6, 'Tonjolkan keindahan warna bibirmu yang sebenarnya dengan liptsick bertekstur lembut dan kaya akan moisturizer', 'Tonjolkan keindahan warna bibirmu yang sebenarnya dengan liptsick bertekstur lembut dan kaya akan moisturizer. Temukan rahasia dari warna natural yang indah dan mewah.', 350, 4, 10000, 1, 0),
(38, 'Lip Crayon Matte Make Over', 12, 'Crayon Satin Matte', '<span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; font-size: 14px; white-space: pre-wrap;\"><b>Make Over Color Stick Matte Crayon</b> merupakan lipstik berbentuk seperti pensil atau crayon yang memiliki warna pigmented dan tahan lama. Membuat bibir terasa lembut dan ringan dengan teksture yang matte.\r\n\r\nTersedia 5 Variant :\r\n- 101 Brooklyn \r\n- 102 Iris \r\n- 103 Harper \r\n- 104 Blake \r\n- 105 Skye</span>', 55, 1, 82500, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_photo`
--

CREATE TABLE `product_photo` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_photo`
--

INSERT INTO `product_photo` (`id`, `product_id`, `filename`, `display_order`) VALUES
(1, 30, 'd6c29ee905e9d66b7186bca0a9b2e1c9.jpg', 1),
(2, 19, '37224dc5c25358138bc20eea6c27a7de.jpg', 1),
(3, 23, 'f74a964358dbeb17dc6806daa0e75e51.jpg', 1),
(4, 27, '69f706b3271cc7fb2973075841ad8d1b.jpg', 1),
(5, 29, 'fc6a8753e4fa2f59882adc022eac1b32.jpg', 1),
(6, 13, '77a3f1047a0357fc39d162b7955a8297.jpg', 1),
(7, 35, '2aebb395a9bd9f085ed692dabe6f1b09.jpg', 1),
(8, 28, 'f9466e72cb9ffc7110c4f12ad87b4727.jpg', 1),
(9, 24, '706deaf055da6ca626ff043c42dc53e0.jpg', 1),
(10, 38, '0b7bce81ad5cec242bbe9fa533c5bd80.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `unit_name`) VALUES
(1, 'buah'),
(2, 'ml'),
(3, 'sachet'),
(4, 'gram');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `website_name` varchar(150) NOT NULL,
  `website_short_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `no_reply_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `website_name`, `website_short_name`, `address`, `phone`, `email`, `no_reply_email`) VALUES
(1, 'Farina Femme', 'Farina Femme', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_desc` varchar(150) NOT NULL,
  `url` text DEFAULT NULL,
  `filename` text NOT NULL,
  `url_caption` varchar(30) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `short_desc`, `url`, `filename`, `url_caption`, `is_deleted`, `display_order`) VALUES
(1, 'Indulge You', 'Proin eget tortor risus. Donec sollicitudin molestie malesuada', 'https://google.com', '061faebe9357c4cd603234e20bb2e8de.jpg', 'Find Out More', 0, 1),
(2, 'tes', 'asf 2', 'https://google.com', '55d3aacfca73ac40b03964f5b97e194b.jpg', 'Find Out Mores', 1, 4),
(3, 'Max Femme Shopping Spree', 'Nulla quis lorem ut libero malesuada feugiat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. ', 'https://google.com', '42cc9e6321f98256e6bd915a47c63585.jpg', 'Find Out More', 0, 3),
(4, 'Beauty Trick', 'Beauty trick on hand', 'https://google.com', '3673d76fef643ad637d53df030259195.jpg', 'Find Out More', 1, 3),
(5, 'Welcome to Max-Femme', 'Welcome to Max-Femme', 'https://google.com', '6270aaacd5cad44c529b2675e5274947.jpg', 'Find Out More', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `filename` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id`, `product_id`, `name`, `filename`, `is_active`, `is_deleted`) VALUES
(1, 23, 'Lemon', 'bf677ca02b0319d9af5b8a608e064e6a.jpg', 1, 0),
(2, 38, 'Skye', '', 1, 0),
(3, 38, 'Harper', '', 1, 0),
(4, 38, 'Irish', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_code` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `voucher_type` enum('global','vip','private','') NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `min_order` double DEFAULT NULL,
  `discount_percentage` double DEFAULT NULL,
  `discount_value` double NOT NULL,
  `exp_date` date DEFAULT NULL,
  `filename` varchar(300) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_code`, `created`, `voucher_type`, `title`, `description`, `min_order`, `discount_percentage`, `discount_value`, `exp_date`, `filename`, `is_deleted`) VALUES
('COBA BELI 2021', '0000-00-00 00:00:00', 'global', 'Coba Beli 2021', 'Tes', 150000, 0, 15000, '2021-09-10', NULL, 0),
('COBABELI', '0000-00-00 00:00:00', 'global', 'javascript', 'vgeg', 0, 0, 0, '2021-04-02', NULL, 0),
('WELCOMEGIFT', '0000-00-00 00:00:00', 'global', 'Welcome Gift 2021', 'egwwg', 100000, 30, 0, '2021-09-17', '43bed31fbc6606b78eb0d0e3265db378.jpg', 0),
('WELCOMEGIFT2021', '0000-00-00 00:00:00', 'private', 'Product promo', '<p>tes</p>', 0, 30, 0, '2021-06-24', '9dc7dc7df2ab3a46e400f8197a8d3215.jpg', 0),
('WELCOMEGIFT20212', '0000-00-00 00:00:00', 'vip', 'geeg', '<p>asg</p>', 0, 0, 0, '2021-07-01', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_used`
--

CREATE TABLE `voucher_used` (
  `id` int(11) NOT NULL,
  `voucher_code` varchar(20) NOT NULL,
  `member_id` varchar(300) NOT NULL,
  `applied_date` datetime DEFAULT NULL,
  `transaction_id` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher_used`
--

INSERT INTO `voucher_used` (`id`, `voucher_code`, `member_id`, `applied_date`, `transaction_id`) VALUES
(1, 'WELCOMEGIFT', '$2y$10$FC4sPrfJRKddd39p26fcCuOhD5TktKaJOkgRq1vyL8SZopgu.GNVy', '2021-04-03 16:13:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_media`
--
ALTER TABLE `article_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_media`
--
ALTER TABLE `event_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_comment`
--
ALTER TABLE `feed_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_likes`
--
ALTER TABLE `feed_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_media`
--
ALTER TABLE `feed_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photo`
--
ALTER TABLE `product_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`,`product_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_code`);

--
-- Indexes for table `voucher_used`
--
ALTER TABLE `voucher_used`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article_media`
--
ALTER TABLE `article_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_media`
--
ALTER TABLE `event_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed_comment`
--
ALTER TABLE `feed_comment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed_likes`
--
ALTER TABLE `feed_likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed_media`
--
ALTER TABLE `feed_media`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_photo`
--
ALTER TABLE `product_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voucher_used`
--
ALTER TABLE `voucher_used`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
