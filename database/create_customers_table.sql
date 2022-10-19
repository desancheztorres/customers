CREATE TABLE `customers` (
 `id` char(36) NOT NULL UNIQUE,
 `first_name` varchar(20) NOT NULL,
 `last_name` varchar(50) NOT NULL,
 `email` varchar(100) NOT NULL UNIQUE,
 `password` varchar(100) NULL,
 `birthday` date DEFAULT NULL,
 PRIMARY KEY (`id`));