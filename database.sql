create database if not exists `test`;
use `test`;
CREATE TABLE `users` (`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,`name` VARCHAR(50) NOT NULL,`username` VARCHAR(50) NOT NULL,`password` VARCHAR(50) NOT NULL,`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

Insert into users(name, username, password) values ('Admin','admin','admin');

CREATE TABLE `categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(50) NOT NULL,
    `image` VARCHAR(50) NOT NULL
    );

    Insert into categories(title, image) values ('Category 1','Category 1');

CREATE TABLE `foods` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `body` VARCHAR(50) NOT NULL,
    `price` VARCHAR(50) NOT NULL,
    `image` VARCHAR(50) NOT NULL,
    `category_id` INT UNSIGNED NOT NULL REFERENCES `categories`(`id`)
);
CREATE TABLE `orders` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `food_id` INT UNSIGNED NOT NULL REFERENCES `foods`(`id`),
    `qty` INT UNSIGNED NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `address` VARCHAR(50) NOT NULL,
    `status` VARCHAR(50) NOT NULL
);

