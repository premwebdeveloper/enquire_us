-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 04:28 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enquire_us`
--

-- --------------------------------------------------------

--
-- Table structure for table `website_pages`
--

CREATE TABLE `website_pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_pages`
--

INSERT INTO `website_pages` (`id`, `page_title`, `page_description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'About Us', 'Justdial\'s MissionTo provides fast, free, reliable and comprehensive information to our users and connects buyers to sellers.Corporate Information\r\nThe company started offering local search services in 1996 under the Justdial brand and is now the leading local search engine in India.\r\nThe official website www.justdial.com was launched in 2007.\r\nJustdial\'s search service is available to users across multiple platforms, such as the internet, mobile Internet, over the telephone (voice) and text (SMS).\r\nJustdial\'s search service bridges the gap between the users and businesses by helping users find relevant providers of products and services quickly while helping businesses listed in Justdial\'s database to market their offerings.Justdial has also initiated its ‘Search Plus’ Services for the users. These services are aimed at making several day-to-day tasks conveniently actionable and accessible to the users. With this step, Justdial is transitioning from being purely a provider of local search and related information to being an enabler of such transactions. Justdial intends to provide an online platform to thousands of SME’s to get them discovered and transacted.', '2018-02-16 06:29:18', '2018-02-16 15:18:18', 1),
(2, 'FAQ', 'hii', '0000-00-00 00:00:00', '2018-02-16 15:31:14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `website_pages`
--
ALTER TABLE `website_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `website_pages`
--
ALTER TABLE `website_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
