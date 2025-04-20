-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 07:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_melody`
--

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `artist` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `title`, `artist`) VALUES
(1, 'Echoes of Dawn', 'Liora Sune'),
(2, 'Crimson Waltz', 'The Ardent Ensemble'),
(3, 'Moonlit Mirage', 'Kaleidaria'),
(4, 'Celestial Drift', 'Nocturne Vale'),
(5, 'Whispers in the Wind', 'Aeris Quintet'),
(6, 'Gilded Silence', 'Rin Andera'),
(7, 'Shatterlight', 'Emberling'),
(8, 'Fragments of Ether', 'Sonaria'),
(9, 'Dawn Reclaimed', 'Vireya'),
(10, 'Starlace Requiem', 'Elieth Aurex'),
(11, 'Veil of the Horizon', 'Arcturine'),
(12, 'Obsidian Rain', 'Velmira'),
(13, 'Nebula Bloom', 'Zirelle'),
(14, 'Lunar Tides', 'Hiraeth Ensemble'),
(15, 'Phantom Reverie', 'Threnody'),
(16, 'Twilight Mosaic', 'Indira Vale'),
(17, 'Driftglass Heart', 'Orialis'),
(18, 'Silent Maelstrom', 'Azura Lyne'),
(19, 'Dandelion Requiem', 'Myrrh'),
(20, 'Crystalline Fate', 'Altheon Chorus'),
(21, 'Murmur of the Depths', 'Nyra Amaris'),
(22, 'Chrono Waltz', 'Lunether'),
(23, 'Seraphim Pulse', 'Yaren Elyse'),
(24, 'Ashen Vow', 'Velvex'),
(25, 'Boreal Fracture', 'Eira Elune'),
(26, 'Spire of Echoes', 'Ravenia'),
(27, 'Dust and Bloom', 'Olivien Skye'),
(28, 'Glimmerveil', 'Mirae'),
(29, 'Vortex Lullaby', 'Solstice Fade'),
(30, 'Cascade Reign', 'Zalephra');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `user_id`) VALUES
(1, 'Serenade for the Stars', 1),
(2, 'Firelight Echoes', 2),
(3, 'Shadowstep Ballads', 3),
(4, 'Dreambound', 4),
(5, 'Aether Jams', 5),
(6, 'Lullabies of Ether', 6),
(7, 'Hollow Harmony', 7),
(8, 'Arcanum Flow', 8),
(9, 'Celestial Static', 9),
(10, 'Whispertrail', 10),
(11, 'serenadeX', 1);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_relations`
--

CREATE TABLE `playlist_relations` (
  `id` int NOT NULL,
  `playlist_id` int NOT NULL,
  `music_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `playlist_relations`
--

INSERT INTO `playlist_relations` (`id`, `playlist_id`, `music_id`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 2, 1),
(4, 2, 7),
(5, 2, 8),
(6, 3, 4),
(7, 3, 9),
(8, 4, 2),
(9, 4, 6),
(10, 5, 10),
(11, 5, 1),
(12, 5, 6),
(13, 6, 12),
(14, 6, 14),
(15, 7, 16),
(16, 7, 19),
(17, 7, 3),
(18, 8, 20),
(19, 8, 21),
(20, 8, 22),
(21, 9, 18),
(22, 9, 25),
(23, 9, 28),
(24, 10, 11),
(25, 10, 17),
(26, 10, 27),
(27, 10, 30),
(28, 6, 29),
(29, 7, 24),
(30, 8, 15),
(31, 9, 13),
(32, 10, 23),
(33, 11, 13),
(34, 11, 1),
(35, 11, 11),
(36, 11, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`) VALUES
(1, 'nyxveil'),
(2, 'aurorium'),
(3, 'noctavius'),
(4, 'selvynx'),
(5, 'lyrienne'),
(6, 'oracleseeker'),
(7, 'azurveil'),
(8, 'cinderedivy'),
(9, 'noirastria'),
(10, 'echoithar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `playlist_relations`
--
ALTER TABLE `playlist_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `playlist_relations`
--
ALTER TABLE `playlist_relations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `playlist_relations`
--
ALTER TABLE `playlist_relations`
  ADD CONSTRAINT `playlist_relations_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`),
  ADD CONSTRAINT `playlist_relations_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `music` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
