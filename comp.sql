-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 jun 2021 om 14:23
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locations`
--

CREATE TABLE `locations` (
  `locationsID` int(4) NOT NULL,
  `locationsName` varchar(250) NOT NULL,
  `LocationsAdres` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(4) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `reservation`
--

INSERT INTO `reservation` (`reservationID`, `location`, `date`, `status`, `userID`) VALUES
(5, 'spijk', '2021-05-19', 1, 3),
(6, 'spijkennisse hogeschool brommel onder de brug', '2021-05-19', 1, 4),
(7, 'rotterdam', '2021-05-26', 0, 4),
(8, 'hellevoetsluis', '2021-05-27', 1, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `created_at`, `admin`) VALUES
(1, 'nova', '$2y$10$B/YF0MsSiqvVrkWYSk7d8uVe39qHvkt8o5ZXOQopQYXURCWTUalf6', '2021-05-10 12:30:23', 1),
(2, 'test', '$2y$10$JGPEry5xNtftX1g2tpabJ.PVTlVfjzR8hMAXzXfypnDeG8J2rLz1q', '2021-05-11 12:12:29', 0),
(3, 'test1', '$2y$10$xB6.OuDFWUv0gw.4XxDNJOMcrWgX1TeWAAq0D5tmyxKiGc5Z2YU/2', '2021-05-17 19:47:37', 0),
(4, 'erik', '$2y$10$0TbbeU5QU0vhVT4m4UBbL.36OZRzcx.s5z0jDXc3lvqXXrGDPkFh.', '2021-05-18 12:06:24', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationsID`);

--
-- Indexen voor tabel `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `locationsID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
