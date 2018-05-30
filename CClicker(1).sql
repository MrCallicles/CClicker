-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2018 at 01:34 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CClicker`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avatar`
--

INSERT INTO `avatar` (`id`, `image`) VALUES
(1, '^_^'),
(2, '(-_-)'),
(3, '¯\\_(ツ)_/¯'),
(4, '(ﾉ◕ヮ◕)ﾉ*:･ﾟ✧'),
(5, '(づ｡◕‿‿◕｡)づ'),
(6, '¢‿¢'),
(7, '(¬‿¬)'),
(8, '(• ε •)'),
(9, '( ͡° ͜ʖ ͡°)'),
(10, '( ͡° ͜ʖ ( ͡° ͜ʖ ( ͡° ͜ʖ ( ͡° ͜ʖ ͡°) ͜ʖ ͡°)ʖ ͡°)ʖ ͡°)');

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `pseudo`, `password`) VALUES
(1, 'Test', 'test'),
(2, 'toast', 'toast'),
(3, 'test2', 'test2'),
(4, 'test3', 'test3'),
(5, 'test4', 'test4'),
(6, 'Gilles', 'papa'),
(7, 'François', 'françois');

-- --------------------------------------------------------

--
-- Table structure for table `partie`
--

CREATE TABLE `partie` (
  `id` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `avatar_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` bigint(20) NOT NULL,
  `life` bigint(20) NOT NULL,
  `over` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partie`
--

INSERT INTO `partie` (`id`, `compte_id`, `avatar_id`, `nom`, `score`, `life`, `over`) VALUES
(1, 2, 5, 'Toast', 17, 0, 1),
(2, 2, 5, 'Test', 36, -4, 1),
(3, 2, 5, 'Machin', 21, 0, 1),
(4, 2, 10, 'WhoToPrononce', 65, 0, 1),
(6, 1, 3, 'boarf', 122, 101025, 0),
(7, 1, 4, 'test', 24, 0, 1),
(10, 2, 8, 'wtf', 0, 10, 0),
(11, 7, 4, 'fdkjflkdsjfkldsjf', 0, 0, 1),
(12, 7, 5, 'rfresf', 6, 13, 0),
(13, 1, 10, 'Truc', 0, 12, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_59B1F3DF2C56620` (`compte_id`),
  ADD KEY `IDX_59B1F3D86383B10` (`avatar_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `partie`
--
ALTER TABLE `partie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `partie`
--
ALTER TABLE `partie`
  ADD CONSTRAINT `FK_59B1F3D86383B10` FOREIGN KEY (`avatar_id`) REFERENCES `avatar` (`id`),
  ADD CONSTRAINT `FK_59B1F3DF2C56620` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
