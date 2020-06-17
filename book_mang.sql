-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2020 at 07:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_mang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `short_desc` varchar(100) NOT NULL,
  `long_desc` varchar(5000) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `small_pic` varchar(500) NOT NULL,
  `large_pic` varchar(1000) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `publish_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `cat_id`, `book_name`, `short_desc`, `long_desc`, `author_name`, `created_date`, `small_pic`, `large_pic`, `status`, `modified_date`, `publish_date`) VALUES
(4, 6, 'I Will Teach You ', 'I Will Teach You Excel: Master Excel, Surpass Your Co-Workers, And Impress Your Boss! [Print Replica', 'Ever get passed up for a promotion or pay increase and wonder, â€œwhy didnâ€™t I get itâ€? Ever wonder if your skills are good enough to compete in todayâ€™s crowded job market? You work hard, go above and beyond and still canâ€™t seem to get noticed. Many of todayâ€™s jobs require that you be familiar with Microsoft Excel. How can you become proficient at Excel when companies arenâ€™t willing to teach you this valuable skill?', 'Joel Villar ', '2020-03-25 14:54:22', 'logo_radix.png', 'img22.jpg', '1', '2020-04-09 03:37:58', '2020-03-25'),
(5, 6, 'World War 1', 'It\'s been 100 years since World War I ended, but there is still very little consensus about what cau', 'It\'s been 100 years since World War I ended, but there is still very little consensus about what caused it, or what its consequences were. Historian Jonathan Boff talks us through the latest books and best modern interpretations of World War I.It\'s been 100 years since World War I ended, but there is still very little consensus about what caused it, or what its consequences were. Historian Jonathan Boff talks us through the latest books and best modern interpretations of World War I.', 'Jonathan Boff', '2020-03-25 15:06:38', '51vJiBbhGFL.jpg', 'History_Weeds_WWI_Firsts_SF_still_624x352.jpg', '1', '2020-03-25 18:04:29', '2020-03-25'),
(6, 12, 'Incredible Hulk', 'CONTINUING THE FIRST APPEARANCES OF WOLVERINE! Completing one of the most famous Hulk sagas of all! ', 'CONTINUING THE FIRST APPEARANCES OF WOLVERINE! Completing one of the most famous Hulk sagas of all! The INCREDIBLE HULK #180-181 FACSIMILE EDITIONS reintroduced you to Wolverine, who joined the Hulk in a three-way tussle against the monstrous Wendigo! Now find out what happens next as Wolvieâ€™s bosses take matters into their own hands! But the puny humans only succeed in making the Hulk even angrier - and set him on a collision course with the super-powered escaped convicts known as Hammer and Anvil! Prepare for a surprisingly touching chapter in the Hulkâ€™s endless wandering, as the jade giant makes a friend-and learns the meaning of loss. Itâ€™s one of the all-time great Marvel comic books, boldly re-presented in its original form, ads and all! Reprinting INCREDIBLE HULK (1968) #182.', 'Len Wein', '2020-03-25 15:21:42', 'clean.jpg', 'Blur.Wallpapers.01.jpg', '1', '2020-04-02 20:03:06', '2020-03-25'),
(7, 25, 'New Thinking  ', 'New Thinking  New Thinking  New Thinking  ', 'New Thinking  New Thinking  New Thinking  New Thinking  New Thinking  New Thinking  New Thinking  New Thinking  New Thinking  New Thinking  New ', 'Joel Villar ', '2020-04-01 22:32:34', 'img.jpeg', 'WhatsApp Image 2020-02-27 at 2.58.44 AM.jpeg', '1', '2020-04-02 09:23:30', '2020-04-02'),
(8, 6, 'book mang1234', 'testingtestingtestingtestingtesting\r\ntestingtestingtestingtesting', 'testing testing testing testing testing\r\ntesting testing testing testing', 'mayanksingh', '2020-04-01 22:43:12', '1.jpg', '7.png', '0', '2020-04-02 20:04:01', '2019-10-10'),
(9, 9, 'new book', 'new booknew booknew book\r\nnew booknew book\r\nnew book\r\nnew book', 'new booknew booknew booknew book\r\nnew booknew booknew booknew book new booknew booknew book new booknew booknew booknew book\r\nnew booknew booknew booknew book', 'mayanksingh', '2020-04-08 15:44:39', 'logo_radix.png', 'bg1.jpg', '1', '2020-04-08 10:44:48', '2020-12-31'),
(10, 6, 'new book 2', 'new book 2new book 2 new book 2 book summary', 'New book details new book 2new book 2\r\nnew book 2', 'Stan Lee', '2020-04-08 15:47:45', '30710332_2048983702057183_3105916620988481536_o.jpg', 'bg2.jpg', '1', '2020-04-08 10:36:34', '2020-03-10'),
(12, 24, 'Demo book', 'Book summmary Book summmary Book summmary Book summmary Book summmary Book summmary Book summmary Bo', 'Book details Book summmary Book details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmaryBook details Book summmary', 'Joel Villar ', '2020-04-08 18:04:07', 'bg-2.jpg', 'bg1.jpg', '1', '2020-04-09 04:10:04', '0010-10-10'),
(13, 25, 'Demo book', 'Book Summary:', 'Book Summary:', 'Stan Lee', '2020-04-08 18:15:41', 'logo_radix.png', 'bg1.jpg', '1', '2020-04-08 13:55:54', '2020-02-10'),
(14, 9, 'Update book', 'Book Name:\r\nNew Demo book\r\nEnter name\r\nSelect Category:Select category\r\nAuthor Name:\r\nJoel Villar \r\n', 'Book Name:\r\nNew Demo book\r\nEnter name\r\nSelect Category:Select category\r\nAuthor Name:\r\nJoel Villar \r\nEnter author_name\r\nPublish Date:\r\n31-Dec-2020\r\nEnter publish_date', 'Joel Villar ', '2020-04-08 18:19:19', 'footer-logo.png', 'icon2.png', '1', '2020-04-08 13:57:02', '2020-12-31'),
(15, 9, 'Demo book', 'Book Name:\r\nNew Thinking  \r\nSelect Category:\r\nAuthor Name:\r\nmayanksingh\r\nPublish Date:\r\n10-Oct-2020\r', 'Book Name:\r\nNew Thinking  \r\nSelect Category:\r\nAuthor Name:\r\nmayanksingh\r\nPublish Date:\r\n10-Oct-2020\r\nBook Summary:\r\nBook details:', 'Stan Lee', '2020-04-08 18:48:51', 'logo_radix.png', 'bg1.jpg', '1', '2020-04-08 13:55:57', '2020-12-31'),
(16, 24, 'Demo book update', 'Book Managment System update', 'Book Managment System', 'Stan Lee', '2020-04-08 18:54:19', 'logo_radix.png', 'Back-to-back-side-visiting-card_1.jpg', '1', '2020-04-10 09:55:36', '2020-10-10'),
(17, 6, 'final testing', 'final testing summary', 'book details', 'Stan Lee', '2020-04-08 19:31:02', 'bg-3.jpg', 'bg.jpg', '1', '2020-04-08 14:03:16', '2020-12-31'),
(18, 6, 'New Book ', 'Book summary ', 'Book details', 'Stan Lee', '2020-04-09 10:25:21', 'img22.jpg', 'i33.jpg', '1', '0000-00-00 00:00:00', '2020-12-31'),
(19, 31, 'Demo book123', 'Book Summary:', 'Book details:', 'Stan Lee', '2020-04-10 15:41:39', 'Back-to-back-side-visiting-card_1.jpg', 'Back-to-back-side-visiting-card_2.jpg', '1', '2020-04-10 10:15:25', '2020-02-01'),
(20, 31, 'Marvel Encyclopedia', 'Book SummaryBook Summary', 'Book SummaryBook SummaryBook Summary', 'Stan Lee', '2020-05-04 15:42:41', 'IMG_20190908_184527.jpg', 'IMG_20190908_185155.jpg', '1', '0000-00-00 00:00:00', '2020-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`cat_id`, `cat_name`, `status`, `sort_order`, `created_date`, `modified_date`) VALUES
(6, 'History123', '1', 1, '2020-03-24 14:12:53', '2020-04-10 10:09:16'),
(9, 'Picture book', '0', 12, '2020-03-24 14:12:42', '2020-04-10 10:06:57'),
(10, 'Suspense', '1', 1, '2020-03-24 14:28:51', '2020-04-02 19:46:02'),
(11, 'Education', '1', 1, '2020-03-25 14:53:00', '2020-03-25 18:04:47'),
(12, 'Comic book', '1', 5, '2020-03-26 16:00:00', '2020-04-01 17:32:22'),
(13, 'Diary', '1', 3, '2020-03-26 16:01:48', '2020-04-01 17:51:18'),
(14, 'Health', '1', 3, '2020-03-26 16:01:53', '2020-04-01 17:51:16'),
(15, 'Guide', '1', 5, '2020-03-26 16:01:58', '2020-04-01 17:51:13'),
(16, 'Encyclopedia', '1', 2, '2020-03-26 16:02:04', '2020-04-01 17:51:10'),
(18, 'Short story', '1', 6, '2020-03-26 16:02:16', '2020-04-01 17:51:03'),
(19, 'Thriller', '1', 5, '2020-03-26 16:02:21', '2020-04-01 17:50:58'),
(20, 'Mystery', '1', 1, '2020-03-26 16:02:27', '2020-04-01 17:50:41'),
(21, 'Graphic novel', '1', 1, '2020-03-26 16:02:34', '2020-04-01 17:50:44'),
(22, 'Fairytale', '1', 1, '2020-03-26 16:02:40', '2020-04-01 17:50:46'),
(23, 'Drama', '1', 2, '2020-03-26 16:02:44', '2020-04-01 17:50:50'),
(24, 'Action and adventure', '1', 3, '2020-04-01 17:13:14', '2020-04-01 17:50:53'),
(25, 'english', '1', 4, '2020-04-01 18:16:55', '2020-04-01 17:50:56'),
(31, 'Comic book', '1', 2, '2020-04-01 23:09:37', '0000-00-00 00:00:00'),
(32, 'new cat', '1', 11, '2020-04-08 17:32:22', '2020-04-08 12:15:08'),
(33, 'new ', '1', 1, '2020-04-10 15:36:36', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
