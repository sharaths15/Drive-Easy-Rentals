-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 02:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `carImage` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `model`, `type`, `price_per_day`, `availability`, `carImage`) VALUES
(1, 'Tesla Model S', 'Luxury Sedan', 150.00, 1, 'tesla_model_s.jpg'),
(2, 'BMW X5', 'SUV', 200.00, 1, 'bmw_x5.jpg'),
(3, 'Audi A4', 'Luxury Sedan', 120.00, 1, 'audi_a4.jpg'),
(4, 'Ford Mustang', 'Convertible', 180.00, 1, 'ford_mustang.jpg'),
(5, 'Honda Civic', 'Economy', 80.00, 1, 'honda_civic.jpg'),
(6, 'Toyota Corolla', 'Economy', 75.00, 1, 'toyota_corolla.jpg'),
(8, 'Jeep Wrangler', 'SUV', 190.00, 1, 'jeep_wrangler.jpg'),
(9, 'Nissan Altima', 'Sedan', 95.00, 1, 'nissan_altima.jpg'),
(10, 'Chevrolet Camaro', 'Convertible', 170.00, 1, 'chevrolet_camaro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `dropoff_date` date DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `rentalStatus` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `car_id`, `pickup_date`, `dropoff_date`, `total_price`, `rentalStatus`) VALUES
(1, 1, 1, '2024-01-10', '2024-01-15', 750.00, 'Confirmed'),
(2, 2, 1, '2024-02-05', '2024-02-10', 1000.00, 'Pending'),
(3, 3, 3, '2024-03-15', '2024-03-20', 600.00, 'Confirmed'),
(4, 4, 3, '2024-04-01', '2024-04-07', 1080.00, 'Pending'),
(7, 1, 1, '2024-12-20', '2024-12-25', 100.00, 'Pending'),
(8, 6, 2, '2024-12-12', '2024-12-15', 200.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'admin123', 'Admin'),
(2, 'Jane Smith', 'jane.smith@example.com', '*4994A78AFED55B0F529C11C436F85', 'Member'),
(3, 'Mike Johnson', 'mike.johnson@example.com', '*34FD07B148CCA9FCB2BE6C2EA2068', 'Member'),
(4, 'Emily Davis', 'emily.davis@example.com', '*FABE5482D5AADF36D028AC443D117', 'Normal'),
(5, 'Chris Brown', 'chris.brown@example.com', '*614D8D38E8E6324DB10B38780AD01', 'Normal'),
(6, 'maxdan', 'maxmillan@gmail.com', 'max123', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
