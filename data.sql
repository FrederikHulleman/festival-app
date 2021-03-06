-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2020 at 02:49 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `festival_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `bands`
--

CREATE TABLE `bands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bands`
--

INSERT INTO `bands` (`id`, `name`, `slug`, `description`, `created`, `modified`) VALUES
(1, 'KCO', 'kco', 'Best orchestra of the world & Amsterdam!', '2020-01-15 17:13:16', '2020-01-27 10:29:05'),
(2, 'RPO', 'RPO', 'Best orchestra of Rotterdam', '2020-01-15 17:13:16', '2020-01-15 17:13:16'),
(3, 'Radio Philharmonisch Orkest', 'Radio-Philharmonisch-Orkest', 'Beautiful orchestra often performs on TV and radio live recordings.', '2020-01-15 17:13:16', '2020-01-15 17:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `starttime` time NOT NULL DEFAULT '00:00:00',
  `endtime` time NOT NULL DEFAULT '00:00:00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `festival_id`, `date`, `starttime`, `endtime`, `created`, `modified`) VALUES
(1, 1, '2020-07-11', '14:00:00', '23:00:00', '2020-01-16 08:36:00', '2020-01-30 13:41:42'),
(2, 1, '2020-07-12', '14:00:00', '23:00:00', '2020-01-16 08:36:00', '2020-01-30 13:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `festivals`
--

CREATE TABLE `festivals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `festivals`
--

INSERT INTO `festivals` (`id`, `title`, `slug`, `description`, `created`, `modified`) VALUES
(1, 'Leidsche Rijn Mahler Festival', 'leidsche-rijn-mahler-festival', 'Come and enjoy the best & only Mahler festival in the World, in the best place to live: Leidsche Rijn!', '2020-01-23 21:07:39', '2020-01-30 13:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `festival_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `festival_id`, `name`, `slug`, `created`, `modified`) VALUES
(1, 1, 'Main stage', 'main-stage', '2020-01-16 12:27:32', '2020-01-16 12:27:32'),
(9, 1, 'Mahler stage', 'mahler-stage', '2020-01-30 13:42:01', '2020-01-30 13:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `festival_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`festival_id`, `date_id`, `visitor_id`, `confirmed`, `created`, `modified`) VALUES
(1, 1, 1, 1, '2020-01-30 08:31:01', '2020-01-30 08:31:04'),
(1, 2, 1, 1, '2020-01-30 08:31:01', '2020-01-30 08:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `band_id` int(11) NOT NULL,
  `festival_id` int(11) NOT NULL,
  `date_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`band_id`, `festival_id`, `date_id`, `stage_id`, `starttime`, `endtime`, `created`, `modified`) VALUES
(3, 1, 1, 1, '14:00:00', '14:45:00', '2020-01-30 13:48:30', '2020-01-30 13:48:30'),
(3, 1, 1, 9, '22:00:00', '22:45:00', '2020-01-30 13:46:59', '2020-01-30 13:46:59'),
(1, 1, 2, 9, '14:00:00', '14:45:00', '2020-01-30 13:43:38', '2020-01-30 13:43:38'),
(2, 1, 2, 1, '14:00:00', '14:45:00', '2020-01-30 13:48:21', '2020-01-30 13:48:21'),
(1, 1, 2, 9, '22:00:00', '22:45:00', '2020-01-30 13:47:15', '2020-01-30 13:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `modified`) VALUES
(1, 'admin@lrmf.nl', '$2y$10$vJ157T65NRiHq/eOSfxFjOVe0p.nFFYTz4Jf63j.yUP9IyTa5JdF6', '2020-01-15 17:13:16', '2020-01-29 14:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `email`, `created`, `modified`) VALUES
(1, 'fhulleman@gmail.com', '2020-01-30 08:31:01', '2020-01-30 08:31:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bands`
--
ALTER TABLE `bands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `festival_key` (`festival_id`);

--
-- Indexes for table `festivals`
--
ALTER TABLE `festivals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `festival_key` (`festival_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`visitor_id`,`festival_id`,`date_id`),
  ADD KEY `festival_key` (`festival_id`),
  ADD KEY `date_key` (`date_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`festival_id`,`date_id`,`starttime`,`band_id`),
  ADD KEY `festival_key` (`festival_id`),
  ADD KEY `date_key` (`date_id`),
  ADD KEY `stage_key` (`stage_id`),
  ADD KEY `band_key` (`band_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bands`
--
ALTER TABLE `bands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `festivals`
--
ALTER TABLE `festivals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`);

--
-- Constraints for table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_ibfk_1` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`);

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`band_id`) REFERENCES `bands` (`id`),
  ADD CONSTRAINT `timetables_ibfk_2` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`),
  ADD CONSTRAINT `timetables_ibfk_3` FOREIGN KEY (`date_id`) REFERENCES `dates` (`id`),
  ADD CONSTRAINT `timetables_ibfk_4` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`);
