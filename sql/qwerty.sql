-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Oct 07, 2019 at 11:59 AM
=======
<<<<<<< HEAD
-- Generation Time: Oct 07, 2019 at 11:59 AM
=======
<<<<<<< HEAD
-- Generation Time: Oct 07, 2019 at 11:59 AM
=======
<<<<<<< HEAD
-- Generation Time: Oct 07, 2019 at 11:59 AM
=======
-- Generation Time: Oct 07, 2019 at 10:58 AM
>>>>>>> abb3e2ecc4e5f10bcfd8efccf61878111dafeb1e
>>>>>>> 5c0886d6e94a4419ab73643e4e9617c46a786965
>>>>>>> 3b80066a1e99cbd1f6686f1a50842b2f9fe11257
>>>>>>> 193f5c2e1c51e87412b885c09d8fdbb1d142bd6d
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qwerty`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `img` text NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `img`, `short_description`, `description`) VALUES
(1, 'CS GO', 13.45, 'csgo.jpg', 'Wallhack,Aimbot,Trigger', 'Our CS:GO cheat is industry leading with the perfect combination of legit and rage features. Our developers have profound experience which allowed us to become the most popular CS:GO cheat on the market today.'),
(2, 'Fortnite', 91.99, 'fortnite.jpg', 'Wallhack,Aimbot,Trigger', 'There are a lot of Fortnite hacks online that promises cheat features such as infinite teleportation, V-Bucks and more.');
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 5c0886d6e94a4419ab73643e4e9617c46a786965
>>>>>>> 3b80066a1e99cbd1f6686f1a50842b2f9fe11257
>>>>>>> 193f5c2e1c51e87412b885c09d8fdbb1d142bd6d

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar_img` varchar(50) DEFAULT 'user.png',
  `ssd` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> abb3e2ecc4e5f10bcfd8efccf61878111dafeb1e
>>>>>>> 5c0886d6e94a4419ab73643e4e9617c46a786965
>>>>>>> 3b80066a1e99cbd1f6686f1a50842b2f9fe11257
>>>>>>> 193f5c2e1c51e87412b885c09d8fdbb1d142bd6d

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
