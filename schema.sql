CREATE DATABASE phoneshop;


USE phoneshop;

CREATE TABLE `customers` (
  `id` int(30) NOT NULL,
  `buydate` date NOT NULL,
  `phonemodel` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `customers`
  ADD KEY `id` (`id`);


ALTER TABLE `customers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
USE `phpmyadmin`;