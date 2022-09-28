-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Wrz 2022, 00:22
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `scandiweb_test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(30) DEFAULT NULL,
  `name` varchar(99) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `size` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `width` double DEFAULT NULL,
  `length` double DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `size`, `weight`, `height`, `width`, `length`, `product_type`) VALUES
(1, 'JVC200123', 'Acme DISC', 6, 700, NULL, NULL, NULL, NULL, 1),
(2, 'JVC200662', 'Red DISC', 8, 1024, NULL, NULL, NULL, NULL, 1),
(3, 'JVC200621', 'Blue DISC', 12, 2048, NULL, NULL, NULL, NULL, 1),
(4, 'GGWP0007', 'War and Peace', 20, NULL, 2, NULL, NULL, NULL, 2),
(5, 'GGWP0328', 'First War', 24, NULL, 3, NULL, NULL, NULL, 2),
(6, 'GGWP0628', 'Enlightenment', 28, NULL, 4.2, NULL, NULL, NULL, 2),
(7, 'TR120555', 'Chair', 40, NULL, NULL, 24, 45, 15, 3),
(8, 'TR120192', 'Table', 75, NULL, NULL, 25, 15, 60, 3),
(9, 'TR120919', 'Cupboard', 50, NULL, NULL, 30, 50, 30, 3),
(13, 'sdfgsfg', 'fgsgsfg', 23, NULL, NULL, 21, 23, 45, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
