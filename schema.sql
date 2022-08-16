CREATE DATABASE `task-force`
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE `task-force`;

CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(128) UNIQUE NOT NULL,
  `type` VARCHAR(128) UNIQUE NOT NULL
);

CREATE TABLE `cities` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` CHAR(64) UNIQUE DEFAULT NULL
);

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(320) UNIQUE NOT NULL,
  `password` CHAR(64) NOT NULL,
  `name` VARCHAR(320) NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `birthday` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `description` TEXT DEFAULT NULL,
  `avatar` TEXT DEFAULT NULL,
  `type` ENUM ('customer', 'executor'),
  `rating` INT NOT NULL,
  `city_id` INT,
  `phone` INT,
  `telegram` CHAR(64),
  FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
);

CREATE TABLE `users_categories` (
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
);

CREATE TABLE `tasks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_id` INT NOT NULL,
  `executor_id` INT DEFAULT NULL,
  `title` VARCHAR(128) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `file` VARCHAR(320) DEFAULT NULL,
  `city_id` INT NOT NULL,
  `price` INT NOT NULL,
  `status` ENUM ('new', 'canceled', 'in_work', 'completed', 'failed') NOT NULL,
  `category_id` INT NOT NULL,
  `deadline` TIMESTAMP,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  FOREIGN KEY (`executor_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL,
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `grade` INT,
  `content` TEXT NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`)
);

CREATE TABLE `responses` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `task_id` INT NOT NULL,
  `executor_id` INT NOT NULL,
  `content` TEXT NOT NULL,
  FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  FOREIGN KEY (`executor_id`) REFERENCES `users` (`id`)
);
