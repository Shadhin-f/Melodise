-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 04:37 PM
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
-- Database: `melodise_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Name`, `Email`, `Password`, `Role`) VALUES
(1, 'Admin One', 'admin1@example.com', 'adminpass1', 'Super Admin'),
(2, 'Admin Two', 'admin2@example.com', 'adminpass2', 'Moderator'),
(3, 'Admin Three', 'admin3@example.com', 'adminpass3', 'Moderator');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `AlbumID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `ArtistID` int(11) DEFAULT NULL,
  `AlbumCover` varchar(255) NOT NULL DEFAULT 'unknown.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`AlbumID`, `Title`, `ReleaseDate`, `ArtistID`, `AlbumCover`) VALUES
(1, '1989', '2014-10-27', 1, 'unknown.jpg'),
(2, 'Divide', '2017-03-03', 2, 'unknown.jpg'),
(3, 'Scorpion', '2018-06-29', 3, 'unknown.jpg'),
(4, 'Lemonade', '2016-04-23', 4, 'unknown.jpg'),
(5, '21', '2011-01-24', 5, 'unknown.jpg'),
(6, 'After Hours', '2020-03-20', 6, 'unknown.jpg'),
(7, 'ANTI', '2016-01-28', 7, 'unknown.jpg'),
(8, 'When We All Fall Asleep, Where Do We Go?', '2019-03-29', 8, 'unknown.jpg'),
(9, 'El Dorado', '2017-05-26', 9, 'unknown.jpg'),
(10, '24K Magic', '2016-11-18', 10, 'unknown.jpg'),
(11, 'Done', '2024-11-28', 1, '1732763863_2357446_316357-P9L42S-709.jpg'),
(12, 'Niceee', '2024-11-28', 1, '1732782754_wallpaperflare.com_wallpaper (6).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `ArtistID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL DEFAULT 'demo@gmail.com',
  `Password` varchar(255) NOT NULL DEFAULT '1234',
  `Gender` varchar(255) NOT NULL DEFAULT 'Male',
  `Dob` date NOT NULL DEFAULT '1999-01-12',
  `Bio` text DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'unknown.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`ArtistID`, `Name`, `Email`, `Password`, `Gender`, `Dob`, `Bio`, `Country`, `Image`) VALUES
(1, 'Taylor Swiftyyy', 'demo@gmail.com', '1234', 'Male', '1999-01-12', 'American singer-songwriter known for narrative songwriting.', 'USA', '1'),
(2, 'Ed Sheeran', 'demo1@gmail.com', '1234', 'Male', '1999-01-12', 'British singer-songwriter with multiple hit singles.', 'UK', '2.jpg'),
(3, 'Drake', 'demo2@gmail.com', '1234', 'Male', '1999-01-12', 'Canadian rapper and singer known for his impact on the hip hop genre.', 'Canada', '3.jpg'),
(4, 'Beyoncé', 'demo3@gmail.com', '1234', 'Male', '1999-01-12', 'American singer, songwriter, actress, and producer.', 'USA', '4.jpg'),
(5, 'Adele', 'demo4@gmail.com', '1234', 'Male', '1999-01-12', 'British singer-songwriter known for powerful ballads.', 'UK', '5.jpg'),
(6, 'The Weeknd', 'demo5@gmail.com', '1234', 'Male', '1999-01-12', 'Canadian singer, songwriter, and record producer.', 'Canada', '6.jpg'),
(7, 'Rihanna', 'demo6@gmail.com', '1234', 'Male', '1999-01-12', 'Barbadian singer, actress, and businesswoman.', 'Barbados', '7.jpg'),
(8, 'Billie Eilish', 'demo7@gmail.com', '1234', 'Male', '1999-01-12', 'American singer-songwriter known for her distinctive style.', 'USA', '8.jpg'),
(9, 'Shakira', 'demo8@gmail.com', '1234', 'Male', '1999-01-12', 'Colombian singer and songwriter.', 'Colombia', '9.jpg'),
(10, 'Bruno Mars', 'demo9@gmail.com', '1234', 'Male', '1999-01-12', 'American singer, songwriter, record producer.', 'USA', '10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artist_followers`
--

CREATE TABLE `artist_followers` (
  `UserID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `FollowedTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist_followers`
--

INSERT INTO `artist_followers` (`UserID`, `ArtistID`, `FollowedTime`) VALUES
(6, 2, '2024-11-10 16:36:40'),
(3, 2, '2024-11-10 18:07:18'),
(6, 1, '2024-11-10 19:25:00'),
(6, 3, '2024-11-10 19:25:06'),
(6, 4, '2024-11-10 19:25:11'),
(8, 5, '2024-11-14 04:01:26'),
(23, 2, '2024-11-17 13:38:59'),
(23, 4, '2024-11-17 13:39:04'),
(23, 1, '2024-11-17 13:39:06'),
(23, 3, '2024-11-17 14:52:39'),
(8, 4, '2024-11-18 06:39:08'),
(8, 9, '2024-11-18 06:39:18'),
(8, 10, '2024-11-18 06:39:27'),
(8, 2, '2024-11-20 15:53:48'),
(8, 3, '2024-11-23 07:50:08'),
(25, 2, '2024-11-23 07:54:40'),
(25, 3, '2024-11-23 08:42:34'),
(9, 4, '2024-11-27 16:29:59'),
(9, 1, '2024-11-27 16:42:40'),
(8, 1, '2024-11-27 18:15:59'),
(8, 8, '2024-11-28 03:47:42'),
(24, 3, '2024-11-28 06:47:04'),
(26, 3, '2024-11-28 08:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `event_followers`
--

CREATE TABLE `event_followers` (
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FollowTime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_followers`
--

INSERT INTO `event_followers` (`EventID`, `UserID`, `FollowTime`) VALUES
(2, 8, '2024-11-26'),
(4, 9, '2024-11-27'),
(5, 8, '2024-11-28'),
(3, 24, '2024-11-28'),
(5, 24, '2024-11-28'),
(4, 8, '2024-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `GenreID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`GenreID`, `Title`) VALUES
(1, 'Pop'),
(2, 'Hip Hop'),
(3, 'R&B'),
(4, 'Soul'),
(5, 'Electronic');

-- --------------------------------------------------------

--
-- Table structure for table `music_play_record`
--

CREATE TABLE `music_play_record` (
  `UserID` int(11) DEFAULT NULL,
  `SongID` int(11) NOT NULL,
  `TimeStamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `music_play_record`
--

INSERT INTO `music_play_record` (`UserID`, `SongID`, `TimeStamp`) VALUES
(3, 10, '2024-11-15'),
(2, 8, '2024-11-15'),
(1, 8, '2024-11-15'),
(25, 8, '2024-11-23'),
(23, 8, '2024-11-26'),
(NULL, 8, '2024-11-26'),
(23, 1, '2024-11-26'),
(23, 2, '2024-11-26'),
(NULL, 8, '2024-11-26'),
(NULL, 1, '2024-11-26'),
(NULL, 3, '2024-11-26'),
(23, 6, '2024-11-26'),
(23, 5, '2024-11-26'),
(23, 6, '2024-11-26'),
(23, 3, '2024-11-26'),
(23, 27, '2024-11-26'),
(23, 2, '2024-11-26'),
(23, 1, '2024-11-26'),
(23, 2, '2024-11-26'),
(23, 1, '2024-11-26'),
(23, 1, '2024-11-26'),
(23, 2, '2024-11-26'),
(23, 62, '2024-11-26'),
(23, 63, '2024-11-26'),
(23, 9, '2024-11-26'),
(23, 48, '2024-11-26'),
(23, 1, '2024-11-26'),
(23, 1, '2024-11-26'),
(23, 62, '2024-11-26'),
(8, 1, '2024-11-26'),
(8, 2, '2024-11-26'),
(8, 3, '2024-11-26'),
(8, 4, '2024-11-26'),
(8, 5, '2024-11-26'),
(8, 6, '2024-11-26'),
(8, 1, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 8, '2024-11-27'),
(8, 1, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 1, '2024-11-27'),
(8, 2, '2024-11-27'),
(8, 3, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 5, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 3, '2024-11-27'),
(8, 2, '2024-11-27'),
(8, 1, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 1, '2024-11-27'),
(8, 62, '2024-11-27'),
(8, 1, '2024-11-27'),
(8, 2, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 5, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 2, '2024-11-27'),
(8, 3, '2024-11-27'),
(8, 4, '2024-11-27'),
(8, 1, '2024-11-27'),
(8, 2, '2024-11-27'),
(8, 3, '2024-11-27'),
(23, 1, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 2, '2024-11-27'),
(23, 1, '2024-11-27'),
(23, 6, '2024-11-27'),
(23, 62, '2024-11-27'),
(23, 8, '2024-11-27'),
(9, 62, '2024-11-27'),
(9, 2, '2024-11-27'),
(9, 1, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(9, 4, '2024-11-27'),
(8, 4, '2024-11-28'),
(8, 62, '2024-11-28'),
(8, 2, '2024-11-28'),
(NULL, 4, '2024-11-28'),
(8, 47, '2024-11-28'),
(8, 64, '2024-11-28'),
(26, 4, '2024-11-28'),
(8, 48, '2024-12-14'),
(8, 4, '2024-12-14'),
(8, 1, '2024-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `PlaylistID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CreatedDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`PlaylistID`, `Name`, `UserID`, `CreatedDate`) VALUES
(1, 'Chill Vibes', 1, '2024-01-10'),
(2, 'Workout Hits', 2, '2024-02-15'),
(3, 'Road Trip', 3, '2024-03-20'),
(4, 'Focus Playlist', 4, '2024-04-10'),
(5, 'Party Playlist', 5, '2024-05-12'),
(6, 'Nice', 8, '2024-11-03'),
(7, 'Not Nice', 8, '2024-11-07'),
(38, 'wajiiii', 8, '2024-11-09'),
(47, 'ddd', 8, '2024-11-14'),
(53, 'dd', 23, '2024-11-17'),
(55, 'Favourite', 23, '2024-11-17'),
(57, 'Favourite', 8, '2024-11-17'),
(58, 'Favourite', 25, '2024-11-23'),
(59, 'lala', 8, '2024-11-26'),
(60, 'Favourite', 9, '2024-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `playlist_songs`
--

CREATE TABLE `playlist_songs` (
  `PlaylistID` int(11) NOT NULL,
  `SongID` int(11) NOT NULL,
  `AddDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_songs`
--

INSERT INTO `playlist_songs` (`PlaylistID`, `SongID`, `AddDate`) VALUES
(6, 47, '2024-11-07'),
(7, 1, '2024-11-09'),
(6, 6, '2024-11-09'),
(38, 3, '2024-11-09'),
(38, 2, '2024-11-10'),
(38, 2, '2024-11-12'),
(6, 43, '2024-11-14'),
(6, 39, '2024-11-14'),
(6, 1, '2024-11-14'),
(6, 11, '2024-11-14'),
(6, 20, '2024-11-14'),
(6, 4, '2024-11-14'),
(38, 22, '2024-11-14'),
(38, 3, '2024-11-15'),
(6, 32, '2024-11-15'),
(6, 27, '2024-11-17'),
(7, 1, '2024-11-17'),
(53, 1, '2024-11-17'),
(55, 1, '2024-11-17'),
(55, 4, '2024-11-17'),
(55, 5, '2024-11-17'),
(55, 6, '2024-11-17'),
(55, 7, '2024-11-17'),
(57, 9, '2024-11-18'),
(57, 3, '2024-11-18'),
(6, 2, '2024-11-20'),
(57, 2, '2024-11-20'),
(6, 3, '2024-11-23'),
(58, 2, '2024-11-23'),
(7, 62, '2024-11-25'),
(47, 4, '2024-11-27'),
(60, 62, '2024-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `SongID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `AlbumID` int(11) DEFAULT NULL,
  `GenreID` int(11) DEFAULT NULL,
  `ArtistID` int(11) DEFAULT NULL,
  `ColorCode` varchar(255) NOT NULL DEFAULT '#FFF',
  `Audio` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`SongID`, `Title`, `Duration`, `ReleaseDate`, `AlbumID`, `GenreID`, `ArtistID`, `ColorCode`, `Audio`) VALUES
(1, 'Shake It Off', 242, '2014-08-18', 1, 1, 1, '#FFF', '1'),
(2, 'Shape of You', 233, '2017-01-06', 2, 1, 2, '#FFF', '2'),
(3, 'God\'s Plan', 198, '2018-01-19', 3, 2, 3, '#FFF', '0'),
(4, 'Formation', 215, '2016-02-06', 4, 3, 4, '#FFF', '0'),
(5, 'Rolling in the Deep', 228, '2010-11-29', 5, 4, 5, '#FFF', '0'),
(6, 'Blinding Lights', 200, '2019-11-29', 6, 3, 6, '#FFF', '0'),
(7, 'Work', 219, '2016-01-27', 7, 1, 7, '#FFF', '0'),
(8, 'Bad Guy', 194, '2019-03-29', 8, 1, 8, '#FFF', '0'),
(9, 'Chantaje', 213, '2016-11-18', 9, 1, 9, '#FFF', '0'),
(10, '24K Magic', 227, '2016-10-07', 10, 1, 10, '#FFF', '0'),
(11, 'Happier', 207, '2017-12-01', 2, 1, 2, '#F0E68C', '0'),
(12, 'Can\'t Feel My Face', 215, '2015-06-08', 6, 3, 6, '#FFDAB9', '0'),
(13, 'Love On The Brain', 221, '2016-01-28', 7, 1, 7, '#FFE4B5', '0'),
(14, 'Ocean Eyes', 200, '2016-11-18', 8, 1, 8, '#E0FFFF', '0'),
(15, 'Waka Waka', 219, '2010-06-07', 9, 1, 9, '#FFFACD', '0'),
(16, 'Locked Out of Heaven', 233, '2012-10-01', 10, 1, 10, '#F5FFFA', '0'),
(17, 'Perfect', 263, '2017-09-26', 2, 1, 2, '#F8F8FF', '0'),
(18, 'Starboy', 230, '2016-09-22', 6, 3, 6, '#FAFAD2', '0'),
(19, 'Unstoppable', 210, '2016-01-21', 5, 4, 5, '#FFF5EE', '0'),
(20, 'Savage Love', 172, '2020-06-11', NULL, 2, 2, '#FFF8DC', '0'),
(21, 'Take Care', 275, '2011-11-15', 3, 2, 3, '#FFFAF0', '0'),
(22, 'Halo', 261, '2008-01-20', 4, 3, 4, '#FFFFE0', '0'),
(23, 'Taki Taki', 212, '2018-09-28', NULL, 2, 7, '#FDF5E6', '0'),
(24, 'In My Feelings', 210, '2018-06-29', 3, 2, 3, '#F5F5DC', '0'),
(25, 'Don\'t Stop the Music', 238, '2007-09-07', NULL, 1, 7, '#F0FFF0', '0'),
(26, 'Happy', 234, '2013-11-21', NULL, 1, 6, '#FFFFF0', '0'),
(27, 'Dusk Till Dawn', 248, '2017-09-07', NULL, 1, 2, '#FFF0F5', '0'),
(28, 'Elastic Heart', 257, '2013-09-19', NULL, 1, 8, '#FAF0E6', '0'),
(29, 'Sugar', 235, '2015-01-13', NULL, 1, 10, '#F5DEB3', '0'),
(30, 'Despacito', 229, '2017-01-12', NULL, 1, 9, '#E6E6FA', '0'),
(31, 'Don\'t Let Me Down', 208, '2016-02-05', NULL, 1, 2, '#F0F8FF', '0'),
(32, 'We Don\'t Talk Anymore', 223, '2016-05-24', NULL, 1, 2, '#FAEBD7', '0'),
(33, 'Lose Yourself', 326, '2002-10-28', NULL, 2, 3, '#FFFACD', '0'),
(34, 'See You Again', 230, '2015-03-10', NULL, 1, 2, '#F5FFFA', '0'),
(35, 'Sunflower', 159, '2018-10-18', NULL, 1, 6, '#FFE4E1', '0'),
(36, 'Old Town Road', 157, '2018-12-03', NULL, 2, 9, '#FFF0F5', '0'),
(37, 'Levitating', 203, '2020-03-27', NULL, 1, 8, '#FDF5E6', '0'),
(38, 'Adore You', 207, '2019-12-06', NULL, 1, 8, '#FFFFE0', '0'),
(39, 'Rockstar', 238, '2017-04-21', NULL, 2, 3, '#FAFAD2', '0'),
(40, 'Dance Monkey', 210, '2019-05-10', NULL, 1, 8, '#FFEFD5', '0'),
(41, 'Blow Your Mind', 212, '2016-08-26', NULL, 1, 8, '#FFF8DC', '0'),
(42, 'Bad Romance', 295, '2009-10-23', NULL, 1, 7, '#FFEBCD', '0'),
(43, 'Shallow', 215, '2018-09-27', NULL, 4, 5, '#FFDEAD', '0'),
(44, 'Havana', 217, '2017-08-03', NULL, 1, 9, '#E0FFFF', '0'),
(45, 'Lover', 221, '2019-08-16', 1, 1, 1, '#FFFACD', '0'),
(46, 'No Tears Left to Cry', 222, '2018-04-20', NULL, 1, 8, '#FAF0E6', '0'),
(47, 'Believer', 204, '2017-02-01', NULL, 2, 6, '#F0FFF0', '0'),
(48, 'Attention', 212, '2017-04-21', NULL, 1, 2, '#FFFFF0', '0'),
(49, 'Memories', 189, '2019-09-20', NULL, 1, 10, '#FAEBD7', '0'),
(50, 'Closer', 244, '2016-07-29', NULL, 1, 6, '#E6E6FA', '0'),
(51, 'Let Her Go', 255, '2012-07-24', NULL, 1, 2, '#F5FFFA', '0'),
(52, 'Faded', 212, '2015-12-03', NULL, 1, 2, '#FFFFF0', '0'),
(53, 'Don\'t Start Now', 183, '2019-11-01', NULL, 1, 8, '#FAFAD2', '0'),
(54, 'Someone Like You', 285, '2011-01-24', 5, 4, 5, '#FFEFD5', '0'),
(55, 'Shape of You', 233, '2017-01-06', 2, 1, 2, '#FFDAB9', '0'),
(56, 'Cheap Thrills', 224, '2016-02-11', NULL, 1, 7, '#E0FFFF', '0'),
(57, 'Wolves', 215, '2017-10-25', NULL, 1, 7, '#FDF5E6', '0'),
(58, 'Girls Like You', 235, '2018-05-30', NULL, 1, 10, '#FAF0E6', '0'),
(59, 'One Dance', 173, '2016-04-05', 3, 2, 3, '#FFF5EE', '0'),
(60, 'Stay', 217, '2021-07-09', NULL, 1, 7, '#FAF8DC', '0'),
(61, 'Hh', 122, '2024-11-07', 1, 1, 5, '#FFF', '0'),
(62, 'Jani Na', 222, '2024-11-25', 1, 4, 1, '#7bd5c5', '62'),
(63, 'jani na 2', 333, '2024-11-25', 1, 1, 1, '#d4d987', '63'),
(64, 'Cruel', 222, '2024-11-28', 1, 1, 1, '#88c3b8', '64'),
(65, 'Hola', 222, '2024-11-28', 11, 2, 1, '#99d6cb', '65'),
(66, 'JIji', 222, '2024-11-28', 12, 3, 1, '#98e6d8', '66');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_records`
--

CREATE TABLE `subscription_records` (
  `SubscriptionID` int(11) NOT NULL,
  `SubscriptionType` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT current_timestamp(),
  `EndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_records`
--

INSERT INTO `subscription_records` (`SubscriptionID`, `SubscriptionType`, `UserID`, `StartDate`, `EndDate`) VALUES
(112210, 2, 8, '2024-11-02', '2025-11-01'),
(112211, 4, 9, '2024-11-05', '2025-11-11'),
(112217, 3, 23, '2024-11-17', '2024-12-17'),
(112218, 4, 25, '2024-11-23', '2025-11-23'),
(112219, 1, 1, '2023-12-01', '2024-12-01'),
(112220, 3, 2, '2022-08-15', '2023-08-15'),
(112221, 4, 3, '2025-01-10', '2026-01-10'),
(112222, 2, 4, '2023-11-05', '2024-11-05'),
(112223, 1, 5, '2022-06-20', '2023-06-20'),
(112226, 4, 9, '2022-09-01', '2023-09-01'),
(112227, 1, 12, '2025-05-17', '2026-05-17'),
(112228, 3, 15, '2023-10-05', '2024-10-05'),
(112230, 3, 24, '2025-01-03', '2026-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE `subscription_types` (
  `PackageCode` int(11) NOT NULL,
  `PackageName` varchar(255) NOT NULL,
  `Duration` int(11) NOT NULL DEFAULT 1,
  `Price` decimal(10,0) DEFAULT NULL,
  `UserLimit` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`PackageCode`, `PackageName`, `Duration`, `Price`, `UserLimit`) VALUES
(1, 'Free', 1, 0, 1),
(2, 'Premium', 1, 60, 1),
(3, 'Family', 1, 100, 4),
(4, 'Premium Year', 12, 600, 1);

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_events`
--

CREATE TABLE `upcoming_events` (
  `EventID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `EventTitle` varchar(255) NOT NULL,
  `EventDescription` text DEFAULT NULL,
  `EventDate` date NOT NULL,
  `EventTime` time DEFAULT NULL,
  `EventLocation` varchar(255) DEFAULT NULL,
  `EventImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upcoming_events`
--

INSERT INTO `upcoming_events` (`EventID`, `ArtistID`, `EventTitle`, `EventDescription`, `EventDate`, `EventTime`, `EventLocation`, `EventImage`) VALUES
(2, 7, 'hoho', 'awdjhdvqw', '2024-11-15', '01:59:00', 'Dhaka', 'wallpaperflare.com_wallpaper (5).jpg'),
(3, 3, 'Drunk Con', 'Lets goooo. Join the event!!! Yesssss!!!', '2024-12-04', '09:58:22', 'Kolkata, IN', 'unknown.jpg'),
(4, 1, 'Tata With Ty', 'Join the epic concert!!', '2024-12-27', '19:13:00', 'London, UK', '31912901_halloween_background_with_blood_splatters_and_drips_1409.jpg'),
(5, 1, 'Bye Bye 2', 'jhab yugd ugiuygouwg uygfugf uowfgfygwfg kwehfbgwuy', '2024-12-12', '18:35:00', 'Bankok', 'EVENT SCHEDULE.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(255) NOT NULL DEFAULT 'Others',
  `Country` varchar(255) DEFAULT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'unknown.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Email`, `Password`, `DateOfBirth`, `Gender`, `Country`, `Image`) VALUES
(1, 'John Doel', 'john@example.com', 'password123', '1990-01-15', 'Male', 'USA', 'unknown.jpg'),
(2, 'Jane Smith', 'jane@example.com', 'password456', '1985-06-22', 'Others', 'UK', 'unknown.jpg'),
(3, 'Alice Johnson', 'alice@example.com', 'password789', '1992-04-10', 'Others', 'Canada', 'unknown.jpg'),
(4, 'Bob Williams', 'bob@example.com', 'password111', '1988-03-30', 'Others', 'Australia', 'unknown.jpg'),
(5, 'Charlie Brown', 'charlie@example.com', 'password222', '1995-12-01', 'Others', 'USA', 'unknown.jpg'),
(6, 'Sakin 1', 'sakin@gmail.com', '1234', '2002-01-12', 'Others', 'Bangladesh', 'unknown.jpg'),
(8, 'Shadhin 1', 'shadhin@gmail.com', '1234', '2002-03-27', 'Male', 'Bangladesh', '8.jpg'),
(9, 'Uma Banik', 'uma@gmail.com', '1234', '2004-07-02', 'Female', 'India', '9.JPG'),
(12, 'uma banik', 'umabanik48@gmail.com', 'uma1234', '2004-07-04', 'Others', 'Bangladesh', 'unknown.jpg'),
(15, 'Mojo', 'mojo@gmail.com', '1234', NULL, 'Male', 'Bangladesh', 'unknown.jpg'),
(23, 'jojo', 'jojo@gmail.com', '1234', '2024-10-13', 'Male', 'USA', '23.jpg'),
(24, 'Tanveer', 'tanveer@gmail.com', '1234', '2024-10-23', 'Male', 'Canada', 'unknown.jpg'),
(25, 'galib', 'galib@gmail.com', '1234', '2024-11-20', 'Male', 'Bangladesh', 'unknown.jpg'),
(26, 'test', 'test@gmail.com', '12345', '2024-11-28', 'Male', 'Bangladesh', 'unknown.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`ArtistID`);

--
-- Indexes for table `artist_followers`
--
ALTER TABLE `artist_followers`
  ADD KEY `fk_artistID_Contrain` (`UserID`),
  ADD KEY `fk_userID_Constrain` (`ArtistID`);

--
-- Indexes for table `event_followers`
--
ALTER TABLE `event_followers`
  ADD KEY `fk_userID` (`UserID`),
  ADD KEY `fk_eventID` (`EventID`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GenreID`);

--
-- Indexes for table `music_play_record`
--
ALTER TABLE `music_play_record`
  ADD KEY `fk_userID_in_musicPlayRecord` (`UserID`),
  ADD KEY `fk_songID_in_MusicPlayRecord` (`SongID`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`PlaylistID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD KEY `fk_playlistID_constraint` (`PlaylistID`),
  ADD KEY `fk_songID_constraint` (`SongID`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`SongID`),
  ADD KEY `AlbumID` (`AlbumID`),
  ADD KEY `GenreID` (`GenreID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `subscription_records`
--
ALTER TABLE `subscription_records`
  ADD PRIMARY KEY (`SubscriptionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `subscription_type_fk` (`SubscriptionType`);

--
-- Indexes for table `subscription_types`
--
ALTER TABLE `subscription_types`
  ADD PRIMARY KEY (`PackageCode`,`PackageName`);

--
-- Indexes for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`,`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `ArtistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `PlaylistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `SongID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `subscription_records`
--
ALTER TABLE `subscription_records`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112231;

--
-- AUTO_INCREMENT for table `subscription_types`
--
ALTER TABLE `subscription_types`
  MODIFY `PackageCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`);

--
-- Constraints for table `artist_followers`
--
ALTER TABLE `artist_followers`
  ADD CONSTRAINT `fk_artistID_Contrain` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_Constrain` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_followers`
--
ALTER TABLE `event_followers`
  ADD CONSTRAINT `fk_eventID` FOREIGN KEY (`EventID`) REFERENCES `upcoming_events` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `music_play_record`
--
ALTER TABLE `music_play_record`
  ADD CONSTRAINT `fk_songID_in_MusicPlayRecord` FOREIGN KEY (`SongID`) REFERENCES `songs` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_in_musicPlayRecord` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD CONSTRAINT `fk_playlistID_constraint` FOREIGN KEY (`PlaylistID`) REFERENCES `playlists` (`PlaylistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_songID_constraint` FOREIGN KEY (`SongID`) REFERENCES `songs` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `albums` (`AlbumID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription_records`
--
ALTER TABLE `subscription_records`
  ADD CONSTRAINT `subscription_records_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_type_fk` FOREIGN KEY (`SubscriptionType`) REFERENCES `subscription_types` (`PackageCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD CONSTRAINT `upcoming_events_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
