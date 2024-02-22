-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Oca 2024, 10:31:56
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `relaxservices`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `package` varchar(32) NOT NULL,
  `date` int(11) NOT NULL,
  `ua` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `errors`
--

CREATE TABLE `errors` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `requestedURL` varchar(256) NOT NULL,
  `statusCode` int(4) NOT NULL,
  `date` int(24) NOT NULL,
  `ip` varchar(24) NOT NULL,
  `userAgent` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `validateToken` varchar(64) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `date` int(24) NOT NULL,
  `userAgent` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `query` varchar(64) NOT NULL,
  `token` varchar(64) NOT NULL,
  `validateToken` varchar(64) NOT NULL,
  `ip` varchar(24) NOT NULL,
  `processAction` varchar(48) NOT NULL,
  `processDate` int(24) NOT NULL,
  `userAgent` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `useractions`
--

CREATE TABLE `useractions` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `validateToken` varchar(24) NOT NULL,
  `page` varchar(256) NOT NULL,
  `date` int(24) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `userAgent` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `verify` int(1) NOT NULL,
  `warn` int(11) NOT NULL,
  `admin` int(1) NOT NULL,
  `referrerKey` varchar(24) NOT NULL,
  `userReferrer` varchar(24) NOT NULL,
  `ban` int(11) NOT NULL,
  `banDef` varchar(64) NOT NULL,
  `bypass` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `premium` int(24) NOT NULL,
  `sessionExpire` int(11) NOT NULL,
  `query` int(24) NOT NULL,
  `queryLimit` int(11) NOT NULL,
  `totalLimit` int(11) NOT NULL,
  `activity` int(24) NOT NULL,
  `userDef` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `verify`, `warn`, `admin`, `referrerKey`, `userReferrer`, `ban`, `banDef`, `bypass`, `token`, `premium`, `sessionExpire`, `query`, `queryLimit`, `totalLimit`, `activity`, `userDef`) VALUES
(26, 'RelaX', '3ce20d9513a5de6b0af1e9b1957f4d9ee8904d82', 1, 0, 1, '90cf5d', 'rexsex', 0, '', 0, '97e2a2720f25feab1e483df7acdc2a7c35e430a2', 1953372985, 18000, 0, 30, 0, 1706434132, 'Yönetici');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vip`
--

CREATE TABLE `vip` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `level` int(11) NOT NULL,
  `userLimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `warnings`
--

CREATE TABLE `warnings` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `validateToken` varchar(24) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` int(24) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `userAgent` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `useractions`
--
ALTER TABLE `useractions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `vip`
--
ALTER TABLE `vip`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `warnings`
--
ALTER TABLE `warnings`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `errors`
--
ALTER TABLE `errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `useractions`
--
ALTER TABLE `useractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `vip`
--
ALTER TABLE `vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `warnings`
--
ALTER TABLE `warnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
