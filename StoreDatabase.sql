-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 27, 2024 at 03:01 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cathegory`
--

CREATE TABLE `cathegory` (
  `Id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cathegory`
--

INSERT INTO `cathegory` (`Id`, `Name`) VALUES
(1, 'Rysowanie'),
(2, 'Hobby'),
(3, 'DIY'),
(4, 'Kreślarstwo'),
(5, 'Wszystkie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faktura`
--

CREATE TABLE `faktura` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `CustomerName` varchar(30) NOT NULL,
  `CustomerSurname` varchar(50) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `City` varchar(60) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `HouseNumber` int(11) NOT NULL,
  `ApartmentNumber` int(11) NOT NULL,
  `ProductsPrice` int(11) NOT NULL,
  `DeliveryPrice` int(11) NOT NULL,
  `WholePrice` int(10) NOT NULL,
  `Payment` varchar(60) NOT NULL,
  `Shipment` varchar(60) NOT NULL,
  `DateOfSubmission` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faktura`
--

INSERT INTO `faktura` (`Id`, `OrderId`, `CustomerName`, `CustomerSurname`, `PhoneNumber`, `City`, `Street`, `HouseNumber`, `ApartmentNumber`, `ProductsPrice`, `DeliveryPrice`, `WholePrice`, `Payment`, `Shipment`, `DateOfSubmission`) VALUES
(12, 35, 'Jan', 'Kowalski', 111111111, 'Katowice', 'Armii Krajowej', 23, 5, 16968, 1200, 18168, 'Przelew', 'Dostawa DPD - na adres', '2024-05-25'),
(13, 36, 'Jan', 'Kowalski', 123456789, 'Nysa', 'Obrońców Torbruku', 45, 2, 19568, 1200, 20768, 'Karta za pobraniem', 'Dostawa DPD - na adres', '2024-05-27'),
(14, 37, 'Jan', 'Kowlaski', 123456789, 'Nysa', 'Uliczka', 23, 12, 15512, 1200, 16712, 'Przelew', 'Dostawa DPD - na adres', '2024-05-27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `featurelist`
--

CREATE TABLE `featurelist` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `FeatureId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featurelist`
--

INSERT INTO `featurelist` (`Id`, `ProductId`, `FeatureId`) VALUES
(65, 47, 13),
(66, 47, 20),
(67, 47, 15),
(68, 48, 16),
(69, 48, 24),
(70, 48, 23),
(95, 62, 24),
(96, 62, 25),
(97, 62, 22),
(215, 156, 6),
(216, 156, 7),
(217, 156, 8),
(218, 157, 22),
(219, 157, 23),
(220, 157, 24),
(221, 158, 13),
(222, 158, 14),
(223, 158, 15),
(224, 158, 20),
(225, 159, 22),
(226, 159, 24),
(227, 159, 25),
(228, 160, 22),
(229, 160, 26),
(230, 161, 13),
(231, 161, 24),
(232, 162, 16),
(233, 162, 24),
(234, 163, 3),
(235, 163, 18),
(236, 164, 13),
(237, 164, 20),
(238, 165, 13),
(239, 165, 20),
(240, 166, 13),
(241, 166, 20),
(242, 167, 13),
(243, 167, 20),
(244, 168, 13),
(245, 168, 20),
(246, 169, 3),
(247, 169, 24),
(248, 170, 3),
(249, 170, 24),
(250, 171, 3),
(251, 171, 24),
(252, 172, 3),
(253, 172, 24),
(254, 173, 3),
(255, 173, 24),
(256, 174, 3),
(257, 174, 24),
(258, 175, 16),
(259, 175, 24),
(260, 176, 16),
(261, 176, 24),
(262, 177, 16),
(263, 177, 24),
(264, 178, 16),
(265, 178, 24),
(266, 179, 16),
(267, 179, 24),
(268, 180, 16),
(269, 180, 24),
(296, 197, 22),
(297, 197, 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `features`
--

CREATE TABLE `features` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`Id`, `Name`, `Value`) VALUES
(3, 'Miękość', 'HB'),
(6, 'Rozmiar', 'A4'),
(7, 'Rozmiar', 'A5'),
(8, 'Rozmiar', 'A6'),
(13, 'Kolor', 'niebieski'),
(14, 'Kolor', 'czerwony'),
(15, 'Kolor', 'zielony'),
(16, 'Zestaw', '3szt.'),
(18, 'Miękość', 'B2'),
(19, 'Kolor', 'czarny'),
(20, 'Kolor', 'żółty'),
(22, 'Zestaw', '10szt.'),
(23, 'Zestaw', '15szt.'),
(24, 'Zestaw', '5szt.'),
(25, 'Zestaw', '20szt.'),
(26, 'Zestaw', '6szt.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `CustomerName` varchar(30) DEFAULT 'nodata',
  `CustomerSurname` varchar(50) NOT NULL DEFAULT 'nodata',
  `PhoneNumber` int(9) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `City` varchar(60) NOT NULL,
  `Street` varchar(50) NOT NULL DEFAULT 'nodata',
  `HouseNumber` int(11) NOT NULL DEFAULT 0,
  `ApartmentNumber` int(11) NOT NULL DEFAULT 0,
  `ProductsPrice` int(11) NOT NULL,
  `DeliveryPrice` int(11) NOT NULL,
  `WholePrice` int(10) NOT NULL,
  `Payment` int(11) NOT NULL DEFAULT 1,
  `Shipment` int(11) NOT NULL DEFAULT 1,
  `OrderStatus` int(11) NOT NULL DEFAULT 2,
  `DateOfSubmission` datetime NOT NULL DEFAULT current_timestamp(),
  `Commentary` text NOT NULL DEFAULT 'nodata'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `CustomerName`, `CustomerSurname`, `PhoneNumber`, `Email`, `City`, `Street`, `HouseNumber`, `ApartmentNumber`, `ProductsPrice`, `DeliveryPrice`, `WholePrice`, `Payment`, `Shipment`, `OrderStatus`, `DateOfSubmission`, `Commentary`) VALUES
(35, 'Jan', 'Kowalski', 111111111, 'meail@email.com', 'Katowice', 'Armii Krajowej', 23, 5, 16968, 1200, 18168, 3, 3, 4, '2024-05-25 13:11:47', ''),
(36, 'Jan', 'Kowalski', 123456789, 'jfhryjg@hkfr.com', 'Nysa', 'Obrońców Torbruku', 45, 2, 19568, 1200, 20768, 2, 3, 4, '2024-05-27 10:23:08', 'komentarz'),
(37, 'Jan', 'Kowlaski', 123456789, 'djifgvidya@gjodsgd.com', 'Nysa', 'Uliczka', 23, 12, 15512, 1200, 16712, 3, 3, 4, '2024-05-27 10:43:38', 'Komentarz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderstatus`
--

CREATE TABLE `orderstatus` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`Id`, `Name`) VALUES
(1, 'Podanie Danych'),
(2, 'Podtwierdzono'),
(3, 'Opłacanie'),
(4, 'Przygotowanie zamówienia'),
(5, 'Wysłano'),
(6, 'Odebrano'),
(7, 'Anulowano');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `paymenttype`
--

CREATE TABLE `paymenttype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`Id`, `Name`) VALUES
(1, 'NoSelected'),
(2, 'Karta za pobraniem'),
(3, 'Przelew'),
(4, 'Blik'),
(5, 'Gotówka za pobraniem');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `privilege`
--

CREATE TABLE `privilege` (
  `Id` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`Id`, `Name`) VALUES
(1, 'Administrator'),
(2, 'Pracownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `productlist`
--

CREATE TABLE `productlist` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(60) NOT NULL,
  `ProductPrice` int(11) NOT NULL,
  `NumberOfProducts` int(11) NOT NULL,
  `FakturaId` int(11) NOT NULL,
  `ProductType` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productlist`
--

INSERT INTO `productlist` (`Id`, `ProductId`, `ProductName`, `ProductPrice`, `NumberOfProducts`, `FakturaId`, `ProductType`) VALUES
(18, 156, 'Blok techniczny', 1200, 4, 12, 'Rozmiar: A5'),
(19, 47, 'Pisaki akwarelowe', 4056, 2, 12, 'Kolor: niebieski'),
(20, 47, 'Pisaki akwarelowe', 4056, 1, 12, 'Kolor: żółty'),
(21, 156, 'Blok techniczny', 1200, 3, 13, 'Rozmiar: A5'),
(22, 47, 'Pisaki akwarelowe', 4056, 2, 13, 'Kolor: żółty'),
(23, 197, 'Pisaki akrylowe', 7856, 1, 13, 'Zestaw: 10szt.'),
(24, 156, 'Blok techniczny', 1200, 3, 14, 'Rozmiar: A5'),
(25, 47, 'Pisaki akwarelowe', 4056, 1, 14, 'Kolor: żółty'),
(26, 197, 'Pisaki akrylowe', 7856, 1, 14, 'Zestaw: 10szt.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(5) NOT NULL,
  `Cathegory` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Tax` int(11) NOT NULL,
  `SalePercent` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Description`, `Price`, `Cathegory`, `Type`, `Tax`, `SalePercent`) VALUES
(47, 'Pisaki akwarelowe', 'qwerttyuiop', 4056, 1, 1, 5, 10),
(48, 'Długopisy kulkowe', 'Lorem', 1000, 2, 1, 6, 0),
(62, 'Farby plakatowe', 'Farby plakatowe dla dziecka na różne okazje', 2050, 1, 1, 6, 0),
(156, 'Blok techniczny', 'Blok techniczny kolorowy', 1200, 1, 3, 6, 0),
(157, 'Zestaw pędzli', 'Pędzli do rysowania w różnych technikach', 4890, 1, 1, 6, 0),
(158, 'Taśma papierowa', 'Dekoracyjne taśmy do różnej twórczości artystycznej', 1000, 3, 4, 6, 0),
(159, 'Zestaw ołówków', 'Ołówki do pracy kreślarskiej', 8000, 4, 2, 6, 0),
(160, 'Farby akrylowe', 'Farby akrylowe do rysowania na płótnie', 4000, 1, 5, 6, 0),
(161, 'towar', 'ttt', 5000, 1, 2, 6, 0),
(162, 'towar', 'qwertyuiop', 5000, 2, 4, 6, 0),
(163, 'towar', 'qawsderftyhjiklop;', 5000, 2, 2, 6, 0),
(164, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 2, 3, 6, 0),
(165, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 2, 3, 6, 0),
(166, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 2, 3, 6, 0),
(167, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 2, 3, 6, 0),
(168, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 2, 3, 6, 0),
(169, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 3, 3, 6, 0),
(170, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 3, 3, 6, 0),
(171, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 3, 3, 6, 0),
(172, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 3, 3, 6, 0),
(173, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 3, 3, 6, 0),
(174, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 3, 3, 6, 0),
(175, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 4, 3, 6, 0),
(176, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 4, 3, 6, 0),
(177, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 4, 3, 6, 0),
(178, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 4, 3, 6, 0),
(179, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 4, 3, 6, 0),
(180, 'towar', 'qawsedrftgvfgnghmjhkghkyyhjkhjg', 5000, 4, 3, 6, 0),
(197, 'Pisaki akrylowe', 'qwertghbfvcdsewrtghbvfdsertyhjnm', 7856, 1, 2, 6, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipmenttype`
--

CREATE TABLE `shipmenttype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipmenttype`
--

INSERT INTO `shipmenttype` (`Id`, `Name`) VALUES
(1, 'NoSelected'),
(2, 'Dostawa DHL - na adres'),
(3, 'Dostawa DPD - na adres'),
(4, 'Inpost Paczkomat'),
(5, 'Odbiór osobisty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tax`
--

CREATE TABLE `tax` (
  `Id` int(11) NOT NULL,
  `Value` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`Id`, `Value`) VALUES
(1, '0%'),
(2, '3%'),
(3, '5%'),
(4, '6%'),
(5, '8%'),
(6, '23%');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `type`
--

CREATE TABLE `type` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`Id`, `Name`) VALUES
(1, 'Penzel'),
(2, 'Ołówek'),
(3, 'Blok'),
(4, 'Taśma'),
(5, 'Farba'),
(6, 'Długopis'),
(7, 'Płótno');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Privilege` int(11) NOT NULL DEFAULT 2,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Login`, `Password`, `Privilege`, `Status`) VALUES
(6, 'test', '9f86d081884c7d659a2f', 1, 1),
(7, 'pracownik', 'ce3c15c7575ddca735eb', 2, 1),
(10, 'michal', '311fc486c10a0ca2d9d6', 2, 1),
(11, 'admin', '8c6976e5b5410415bde9', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userstatus`
--

CREATE TABLE `userstatus` (
  `Id` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userstatus`
--

INSERT INTO `userstatus` (`Id`, `Name`) VALUES
(1, 'Aktywny'),
(2, 'Zablokowany');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `workers`
--

CREATE TABLE `workers` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `PhoneNumber` int(9) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`Id`, `UserId`, `Name`, `Surname`, `PhoneNumber`, `Email`) VALUES
(6, 6, 'test', 'test', 111111111, 'behoco2260@cgbird.com'),
(7, 7, 'pracownik', 'pracownik', 222222222, 'pracownik@email.com'),
(10, 10, 'michal', 'kowalski', 567895462, 'kowalski@gmai.com'),
(11, 11, 'Panie', 'Areczku', 111258964, 'tokontoniedlauzytku@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cathegory`
--
ALTER TABLE `cathegory`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `faktura`
--
ALTER TABLE `faktura`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indeksy dla tabeli `featurelist`
--
ALTER TABLE `featurelist`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FeatureId` (`FeatureId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indeksy dla tabeli `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `orders_ibfk_1` (`OrderStatus`),
  ADD KEY `orders_ibfk_2` (`Payment`),
  ADD KEY `Shipment` (`Shipment`);

--
-- Indeksy dla tabeli `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `paymenttype`
--
ALTER TABLE `paymenttype`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `productlist`
--
ALTER TABLE `productlist`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `productlist_ibfk_1` (`FakturaId`),
  ADD KEY `productlist_ibfk_2` (`ProductId`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Cathegory` (`Cathegory`),
  ADD KEY `Type` (`Type`);

--
-- Indeksy dla tabeli `shipmenttype`
--
ALTER TABLE `shipmenttype`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Privilege` (`Privilege`),
  ADD KEY `Status` (`Status`);

--
-- Indeksy dla tabeli `userstatus`
--
ALTER TABLE `userstatus`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cathegory`
--
ALTER TABLE `cathegory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faktura`
--
ALTER TABLE `faktura`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `featurelist`
--
ALTER TABLE `featurelist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productlist`
--
ALTER TABLE `productlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `shipmenttype`
--
ALTER TABLE `shipmenttype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userstatus`
--
ALTER TABLE `userstatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faktura`
--
ALTER TABLE `faktura`
  ADD CONSTRAINT `faktura_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`Id`);

--
-- Constraints for table `featurelist`
--
ALTER TABLE `featurelist`
  ADD CONSTRAINT `featurelist_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `featurelist_ibfk_2` FOREIGN KEY (`FeatureId`) REFERENCES `features` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`OrderStatus`) REFERENCES `orderstatus` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Payment`) REFERENCES `paymenttype` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`Shipment`) REFERENCES `shipmenttype` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `productlist`
--
ALTER TABLE `productlist`
  ADD CONSTRAINT `productlist_ibfk_1` FOREIGN KEY (`FakturaId`) REFERENCES `faktura` (`Id`),
  ADD CONSTRAINT `productlist_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`Id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Cathegory`) REFERENCES `cathegory` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`Type`) REFERENCES `type` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Privilege`) REFERENCES `privilege` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `userstatus` (`Id`) ON UPDATE CASCADE;

--
-- Constraints for table `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
