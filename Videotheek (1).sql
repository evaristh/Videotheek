-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 04 mei 2021 om 09:16
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Videotheek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dvd`
--

CREATE TABLE `dvd` (
  `nummerId` int(11) NOT NULL,
  `titelId` int(11) NOT NULL,
  `aanwezig` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `dvd`
--

INSERT INTO `dvd` (`nummerId`, `titelId`, `aanwezig`) VALUES
(1, 47, b'1'),
(2, 48, b'1'),
(3, 51, b'1'),
(7, 52, b'1'),
(11, 49, b'0'),
(12, 52, b'1'),
(19, 50, b'1'),
(23, 47, b'1'),
(34, 48, b'1'),
(43, 51, b'1'),
(55, 52, b'1'),
(76, 49, b'1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `titel`
--

CREATE TABLE `titel` (
  `titelId` int(11) NOT NULL,
  `titel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `titel`
--

INSERT INTO `titel` (`titelId`, `titel`) VALUES
(47, 'Fast & Furious'),
(52, 'Insidious'),
(50, 'Red Dragon'),
(48, 'Saw '),
(49, 'The Wolf Of Wallstreet');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `dvd`
--
ALTER TABLE `dvd`
  ADD UNIQUE KEY `nummerId` (`nummerId`);

--
-- Indexen voor tabel `titel`
--
ALTER TABLE `titel`
  ADD PRIMARY KEY (`titelId`),
  ADD UNIQUE KEY `titel` (`titel`);
ALTER TABLE `titel` ADD FULLTEXT KEY `titel_2` (`titel`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `titel`
--
ALTER TABLE `titel`
  MODIFY `titelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
