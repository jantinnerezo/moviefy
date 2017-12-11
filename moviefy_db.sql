-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2017 at 06:10 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviefy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `account_type` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `verified` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `lastname`, `firstname`, `account_type`, `email`, `password`, `phone`, `address`, `verified`, `timestamp`) VALUES
(1000000007, 'Querol', 'Michelle', 2, 'querol_michelle@yahoo.com', '6281e1b93f3795eefa5d13f3574fe3f1', '09353998836', 'Buena oro, Macasandig', 1, '2017-10-29 17:08:20'),
(1000000008, 'Villagracia', 'Dodong', 2, 'dodong@gmail.com', '6fbbc2afd81c916d1bd550cf80738ea6', '0935685698', 'Galaxy, Gusa', 1, '2017-10-20 16:37:34'),
(1000000009, 'Abacahin', 'Keene Jasper', 2, 'ken@gmail.com', '1e72d7bcd14512016242b145a3ebfc52', '09353998836', 'Gran Europa', 1, '2017-10-20 16:37:21'),
(1000000010, 'Baluran', 'Nazerdan', 2, 'naz@yahoo.com', 'dc793e4f567c2eeba7cb08a3f52c7c4b', '09353998835', 'Kauswagan', 1, '2017-10-20 16:37:13'),
(1000000011, 'Bagares', 'Oriel', 2, 'oriel@gmail.com', 'd71becd352cdd7e0e8211a9d59545e31', '09356897525', 'NHA, Kauswagan', 1, '2017-10-20 16:37:05'),
(1000000012, 'Querol', 'Louelven', 1, 'querol_weng@yahoo.com', 'c2200cbaeeb39d1bdf2eef1886618da4', '09353998836', 'Buena oro, Macasandig', 1, '2017-10-20 16:36:40'),
(1000000013, 'Semeros', 'Maricor', 2, 'Justmaricor@gmail.com', '644681e52104aa42cc446c62e0902235', '09353998835', 'Buena oro, Macasandig', 1, '2017-10-20 16:36:18'),
(1000000014, 'Baluran', 'Nexus', 2, 'nex@gmail.com', '4baa1367e3bb8f1d1e38903af2beba16', '098665865965', 'Gran Europa', 1, '2017-10-20 16:35:37'),
(1000000016, 'Labial', 'Angie', 2, 'angie@gmail.com', '43a2de04a0e6ed8a1d81f147619d0c5d', '09656865658', 'Butuan city', 1, '2017-10-15 05:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Horror'),
(2, 'Romance'),
(3, 'Adventure'),
(4, 'Action'),
(5, 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_poster` varchar(255) NOT NULL,
  `movie_title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `movie_description` varchar(1000) DEFAULT NULL,
  `movie_date` varchar(50) NOT NULL,
  `movie_trailer` varchar(255) DEFAULT NULL,
  `view_count` int(6) NOT NULL,
  `movie_ratings` int(1) NOT NULL,
  `movie_length` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_poster`, `movie_title`, `category_id`, `movie_description`, `movie_date`, `movie_trailer`, `view_count`, `movie_ratings`, `movie_length`, `timestamp`) VALUES
(10, '17359000_1352532154785758_4951274997849028609_o.jpg', 'The windmill massacre', 1, '', '2017-08-23', '', 0, 0, 1.5, '2017-10-29 16:13:35'),
(12, '17388826_1352531934785780_7763891972950312256_o.jpg', 'Live on Night', 3, '', '2017-08-18', '', 0, 0, 2, '2017-10-29 16:13:41'),
(13, '17389176_1352532108119096_7946233948446659215_o.jpg', 'Sing', 4, '', '2017-08-19', '', 0, 0, 1.7, '2017-10-29 16:13:44'),
(14, '17390414_1352532064785767_7049216877374322749_o.jpg', 'Patriots Day', 5, '', '2017-08-17', '', 0, 0, 1.9, '2017-10-29 16:13:49'),
(15, '18056068_1387925067913133_832176125284415222_o.jpg', 'Sleepless', 5, '', '2017-08-25', '', 0, 0, 2, '2017-10-29 16:13:58'),
(16, '18121075_1387924881246485_3818335152836361762_o.jpg', 'Figures', 1, '', '2017-08-23', '', 0, 0, 2.1, '2017-10-29 16:14:08'),
(17, '18121211_1387924407913199_2036558323975214207_o.jpg', 'Keeping up with the jones', 1, '', '2017-08-10', '', 0, 0, 2.1, '2017-10-29 16:14:11'),
(19, '18121524_1387924704579836_7391768876675035726_o.jpg', 'Monster Trucks', 3, '', '2017-08-18', '', 0, 0, 2.1, '2017-10-29 16:14:15'),
(20, '18156003_1387924451246528_3155081091524147072_o.jpg', 'Dogs Purpose', 5, '', '2017-08-17', '', 0, 0, 2.3, '2017-10-29 16:14:17'),
(21, '18156473_1387924444579862_8843419024281972834_o.jpg', 'The Bye Bye Man', 5, '', '2017-08-18', '', 0, 0, 1.5, '2017-10-29 16:14:20'),
(22, '18156671_1387924934579813_5216568913987998259_o.jpg', 'Passengers', 5, '', '2017-08-11', 'https://youtu.be/7BWWWQzTpNU', 0, 0, 2, '2017-10-29 16:14:24'),
(23, '18156739_1387924861246487_2743612576606171997_o.jpg', 'La La Land', 3, '', '2017-08-23', 'https://youtu.be/0pdqf4P9MB8', 0, 0, 2.5, '2017-10-29 16:14:30'),
(24, 'Action.jpg', 'Avengers', 2, 'When Tony Stark (Robert Downey Jr.) jump-starts a dormant peacekeeping program, things go terribly awry, forcing him, Thor (Chris Hemsworth), the Incredible Hulk (Mark Ruffalo) and the rest of the Avengers to reassemble. As the fate of Earth hangs in the balance, the team is put to the ultimate test as they battle Ultron, a technological terror hell-bent on human extinction. Along the way, they encounter two mysterious and powerful newcomers, Pietro and Wanda Maximoff.', '2012-04-25', '', 0, 4, 2.3, '2017-10-29 16:14:33'),
(25, 'Mystery.jpg', 'The Mechanic', 1, 'The original team consisted of Iron Man, Captain America, Hulk, Thor, Black Widow and Hawkeye in The Avengers and Avengers: Age of Ultron and shifted when Tony Stark, Thor, Clint Barton, and Bruce Banner/Hulk left the team after the events of Age of Ultron.', '2011-02-11', '', 0, 3, 2, '2017-10-29 16:15:28'),
(27, 'default.png', 'The Flash', 2, 'Marvel', '2017-02-22', '', 0, 5, 1.9, '2017-10-29 16:15:36'),
(29, 'default.png', 'sadasd', 1, 'asdasd', '2017-09-28', '', 0, 0, 2.2, '2017-10-29 16:15:47'),
(32, 'default.png', 'La La Lands', 1, 'asdasd', '2017-08-23', '', 0, 0, 2.1, '2017-10-29 16:15:51'),
(33, 'default.png', 'Asdasdasd', 1, 'dasdasd', '2017-09-29', '', 0, 0, 2.4, '2017-10-29 16:15:53'),
(36, 'download_(2)2.jpg', 'Titanic', 1, 'British passenger liner that sank in the North Atlantic Ocean in the early morning hours of 15 April 1912, after it collided with an iceberg during its maiden voyage from Southampton to New York City.', '2017-10-12', '', 0, 0, 2, '2017-10-29 16:15:57'),
(39, '18155838_1387925087913131_4508094444276086224_o.jpg', 'Split', 1, 'Kulba kayu bay.', '2017-10-13', '', 0, 0, 2, '2017-10-29 16:15:59'),
(40, 'shagit.jpg', 'Shagit', 1, 'Chuy', '2017-10-19', '', 0, 0, 2.5, '2017-10-29 17:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `time_in` varchar(8) DEFAULT NULL,
  `time_out` varchar(8) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `person_count` int(2) NOT NULL,
  `room_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `reservation_type` int(1) NOT NULL,
  `reservation_date` date DEFAULT NULL,
  `fee` varchar(255) NOT NULL,
  `reservation_status` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `time_in`, `time_out`, `account_id`, `person_count`, `room_id`, `movie_id`, `reservation_type`, `reservation_date`, `fee`, `reservation_status`, `timestamp`) VALUES
(101, '01:00 PM', '03:00 PM', 1000000007, 6, 14, 36, 2, '2017-10-04', '753', 1, '2017-10-13 07:14:02'),
(102, '01:00 PM', '03:18 PM', 1000000007, 5, 13, 24, 2, '2017-10-14', '652', 1, '2017-10-13 07:58:44'),
(103, '06:17 PM', '08:35 PM', 1000000007, 5, 17, 24, 1, '2017-10-20', '702', 0, '2017-10-21 03:46:21'),
(104, '01:00 PM', '03:00 PM', 1000000008, 7, 17, 36, 2, '2017-10-25', '854', 2, '2017-10-21 03:47:02'),
(105, '01:00 PM', '03:18 PM', 1000000010, 4, 17, 24, 2, '2017-10-02', '551', 2, '2017-10-21 06:21:42'),
(106, '02:00 PM', '04:00 PM', 1000000010, 5, 17, 39, 2, '2017-10-02', '652', 2, '2017-10-21 06:23:04'),
(107, '01:00 AM', '03:00 AM', 1000000007, 4, 18, 36, 2, '2017-10-26', '526', 2, '2017-10-29 17:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(30) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type` int(1) NOT NULL,
  `room_img` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_no`, `room_name`, `room_type`, `room_img`, `status`, `timestamp`) VALUES
(17, '101', 'Moviefy 3D', 2, '10911457_826507497388229_3417260143711963520_o.jpg', 0, '2017-10-21 03:46:21'),
(18, '102', 'Moviefy 1', 1, '10911525_824266650945647_4577521967521508580_o.jpg', 0, '2017-10-20 16:16:26'),
(19, '103', 'Moviefy 2', 1, '10931687_824266647612314_3913832231998265670_o.jpg', 0, '2017-10-20 16:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `slide_id` int(11) NOT NULL,
  `slide_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slideshows`
--

INSERT INTO `slideshows` (`slide_id`, `slide_img`) VALUES
(6, '10714108_824266674278978_3932264565823862093_o.jpg'),
(7, '10911457_826507497388229_3417260143711963520_o.jpg'),
(10, '10931687_824266647612314_3913832231998265670_o.jpg'),
(12, '10911525_824266650945647_4577521967521508580_o.jpg'),
(13, '12191608_965476856824625_8739157280286014048_n.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`slide_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000017;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
