-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2025 at 03:23 AM
-- Server version: 8.0.42
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web1220906_clothingStore`
--

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `productId` int NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,3) NOT NULL,
  `Rating` decimal(3,1) NOT NULL,
  `Quantity` int NOT NULL,
  `productImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`productId`, `Name`, `Category`, `Description`, `Price`, `Rating`, `Quantity`, `productImage`) VALUES
(8, 'Jeans ', 'Pants', 'Crafted from premium-grade denim with a classic indigo finish, these slim-fit jeansoffer the perfect balance of style and comfort.  Made with durable, breathable cotton fabric for all-day wear.  Features a clean stitched back pocket with a leather brand patch.  Mid-rise waist with a modern tapered leg for a sleek silhouette.  Designed for both casual and semi-formal looks.  Reinforced seams and high-quality zipper closure ensure long-lasting wear.  Ideal for pairing with T-shirts, button-ups, or jackets.', 140.000, 7.0, 10, '8.jpeg'),
(9, 'Premium Cotton T-Shirt', 'T-Shirts', '100% pure cotton, breathable and lightweightClassic crew neck designSoft, smooth finish with premium stitchingIdeal for everyday wear or layeringEasy to pair with jeans or shorts', 70.000, 6.0, 12, '9.jpeg'),
(10, 'Men\'s Cotton Cargo Pants', 'Pants', 'Durable 100% cotton fabric for everyday wear\r\n\r\nMultiple cargo pockets for convenient storage\r\n\r\nStraight-leg fit with reinforced stitching\r\n\r\nIdeal for casual or outdoor use\r\n\r\nComfortable waistband with button closure', 120.000, 5.0, 13, '10.jpeg'),
(11, 'Men\'s Casual Button-Up Shirt', 'Shirts', 'Premium cotton blend for a soft, breathable feel\r\n\r\nModern stand collar design with front button closure\r\n\r\nStylish layered look with white inner lining\r\n\r\nSuitable for casual and semi-formal occasions\r\n\r\nEasy to match with jeans or chinos', 130.000, 7.0, 7, '11.jpeg'),
(12, 'Kids\' Checkered Flannel Shirt', 'Shirts', 'Soft and warm flannel fabric perfect for colder days\r\n\r\nBlue and black classic checkered design\r\n\r\nFront button closure with single chest pocket\r\n\r\nIdeal for casual and school outfits\r\n\r\nDurable stitching made for active kids', 200.000, 6.0, 5, '12.jpeg'),
(13, 'Men\'s Casual Sports Shorts (4-Pack)', 'Shorts', 'Set includes 4 pairs: black, navy, green, and grey\r\n\r\nComfortable cotton-blend fabric with breathable design\r\n\r\nAdjustable drawstring waistband for a secure fit\r\n\r\nSide pockets for convenience\r\n\r\nIdeal for gym, home, or summer outings', 100.000, 7.0, 20, '13.jpeg'),
(16, 'Light Pink Women\'s Chiffon Scarf', 'Accessories', 'Elegant lightweight chiffon material\r\n\r\nSoft texture with a subtle checkered pattern\r\n\r\nVersatile style suitable for casual or formal wear\r\n\r\nCan be worn as a headscarf, neck scarf, or wrap\r\n\r\nA perfect finishing touch for any outfit', 25.000, 4.0, 10, '16.jpeg'),
(17, 'Men\'s Black Leather Ankle Boots', 'Shoes', 'Premium black leather construction with detailed stitching\r\n\r\nDurable rubber sole for maximum traction\r\n\r\nLace-up front with reinforced metal eyelets\r\n\r\nCushioned insole for enhanced comfort\r\n\r\nIdeal for casual and semi-formal wear in all seasons', 240.000, 10.0, 17, '17.jpeg'),
(19, 'shirt', 'Shirts', 'GOOD', 200.000, 3.0, 99, '19.jpeg'),
(20, 'Slim Fit Jeans', 'Pants', 'Crafted from premium-grade denim with a classic inky blue wash. Comfortable, stylish, and versatile for every occasion.', 140.000, 7.0, 10, '20.jpeg'),
(21, 'Cotton T-Shirt', 'T-Shirts', '100% pure cotton, breathable and lightweight. Classic fit with a timeless design, perfect for casual wear.', 70.000, 6.0, 12, '21.jpeg'),
(22, 'Cargo Pants', 'Pants', 'Durable 100% cotton fabric designed for rugged outdoor wear. Multiple pockets for added functionality.', 120.000, 5.0, 13, '22.jpeg'),
(23, 'Button-Up Shirt', 'Shirts', 'Premium cotton blend for a soft, breathable feel. Perfect for both casual and semi-formal occasions.', 130.000, 7.0, 7, '23.jpeg'),
(24, 'Flannel Shirt', 'Shirts', 'Soft and warm flannel fabric perfect for colder days. Stylish checkered design with a comfortable fit.', 200.000, 6.0, 5, '24.jpeg'),
(25, 'Sports Shorts', 'Shorts', 'Set includes 4 pairs in black, navy, green, and grey. Ideal for workouts and casual outings.', 100.000, 7.0, 20, '25.jpeg'),
(26, 'Chiffon Scarf', 'Accessories', 'Elegant lightweight chiffon material with a soft texture. Perfect for adding a touch of style to any outfit.', 25.000, 4.0, 10, '26.jpeg'),
(27, 'Leather Ankle Boots', 'Shoes', 'Premium black leather construction with detailed stitching. Designed for both comfort and style.', 240.000, 10.0, 17, '27.jpeg'),
(28, 'Classic Shirt', 'Shirts', 'A timeless shirt made from high-quality cotton. A must-have for your wardrobe with an effortless look.', 200.000, 3.0, 99, '28.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `productId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
