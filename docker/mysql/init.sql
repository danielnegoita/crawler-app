CREATE TABLE `issues` (
    `id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `issue` text NOT NULL,
    `status` enum('unhandled','resolved') NOT NULL,
    `level` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `links` (
    `id` int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `link` text NOT NULL,
    `page` varchar(255) NOT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
    KEY `page`(`page`)
);