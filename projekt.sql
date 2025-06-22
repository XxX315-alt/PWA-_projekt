-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 22, 2025 at 11:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `je_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `lozinka`, `je_admin`) VALUES
(1, 'Luka', '$2y$10$IhhfD.EQEuEwGx7ARANr8.cQZjRiEFsw47FRtgjaBiXsyvuFWtoCm', 1),
(2, 'Stipe', '$2y$10$.96XElXGfhDFdVr7hFKsYu9G3XE.Q1yLNfS00ovmwX3MiBVDznCvS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(100) NOT NULL,
  `kategorija` varchar(50) NOT NULL,
  `arhiva` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '2025-06-22', 'TIGRES DE LA UANL', 'Tigres vs Monterrey, minuto a minutos semifinales Liga MX', 'Utakmica Tigresa protiv Montereya, šteta što je dani primjer stranice na španjolskom, a ne na hrvatskom da pišemo o NK Dugopolju i Croatiji Zmijavcima!', 'tigres.jpg', 'deporte', 1),
(4, '2025-06-22', 'Estados Unidos', 'Tornados dejan danos en casssas del sur de America', 'U SAD-u je viđen uragan. Točnije u Teksasu je bio viđen. Ljudi na terenu kažu da je bio baš velik.', 'tornado.jpg', 'mundo', 1),
(5, '2025-06-22', 'BOEING', 'Boeing reconoce defectos en software del sumlador ', 'Boeing se pokvario. Članak smo dobili na španjolskom i naši najbolji prevoditelji su zaključili da je riječ o nekom problemu sa softwareom. ', 'avion.jpeg', 'mundo', 1),
(6, '2025-06-22', 'OBESIDAD', 'Mujer logra incredible transformacion al bajar', 'Pretila osoba je imala 200 kilograma i sada je uspjela smršaviti. Ta osoba nam je otkrila tajnu mršavljenja. Uz filmove sada jede kelj umjesto čipsa.', 'pretili.jpeg', 'mundo', 1),
(7, '2025-06-22', 'TAEKWONDO', 'Maria del Rosario Espinoza comparte amrgo adios lo', 'Maria del Rosario Espinoza osvojila je natjecanje u taekwondou. Ovo je drugo zlato u toj kategoriji koje je Mexico osvojilo.', 'natjecateljica.jpeg', 'deporte', 1),
(8, '2025-06-22', 'ZINEDINE ZIDANE', 'Yo decido en mi equipo, si no me marcharia, dice Z', 'Zidane je održao press konferenciju za novinare. Rekao im je klasične nogometne floskule. S obzirom da je Hajduk potjerao Gatussa, priča se po ulici da bi ga Zidane mogao zamijeniti.', 'zidane.jpeg', 'deporte', 1),
(9, '2025-06-22', 'ASESINATO', 'Joven que le sacaron su bebe en Chicago miraba', 'Neko je atentiran. To se desilo u Chicagu. Chikagovci su potrešeni ovim događajem. R.I.P.', 'cvice.jpeg', 'mundo', 1),
(10, '2025-06-22', 'LYON', 'Lyon vence al Barcelona y gana su cuarta Champions', 'Ženski tim Lyon pobijedio je Barcelonu. Ovim putem čestitamo svim igračicama, a naročito ovima koje su pobijedile.', 'slavlje.jpeg', 'deporte', 1),
(11, '2025-06-22', 'IRAN V IZRAEL', 'Amerika gađala Iran', 'Jučer je SAD gađao Iranska nuklearna postrojenja', 'amerika.jpeg', 'mundo', 0),
(12, '2025-06-22', 'Knin kup', 'Igra se turnir u Kninu', 'Povodom dana grada Knina i sv. Ante održava se malonogometni turnir.', 'balun.jpeg', 'deporte', 0),
(13, '2025-06-22', 'AAAAAAAAAAA', 'sssss', 'assssss', 'slavlje.jpeg', 'deporte', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `korisnicko_ime_2` (`korisnicko_ime`),
  ADD UNIQUE KEY `korisnicko_ime_3` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
