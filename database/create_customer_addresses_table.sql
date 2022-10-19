CREATE TABLE `customer_addresses` (
`id` char(36) NOT NULL UNIQUE,
`country_id` char(36) NOT NULL,
`customer_id` char(36) NOT NULL,
`region` varchar(50) NULL,
`city` varchar(50) NOT NULL,
`postal_code` varchar(20) NULL,
`street_suffix` varchar(20) NOT NULL,
`street` varchar(20) NOT NULL,
`street_number` integer NOT NULL,
`telephone` varchar(20) NULL,
PRIMARY KEY (`id`));