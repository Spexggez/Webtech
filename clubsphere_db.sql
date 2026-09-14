CREATE DATABASE IF NOT EXISTS `clubsphere_db`;
USE `clubsphere_db`;

DROP TABLE IF EXISTS `match_scores`;
DROP TABLE IF EXISTS `tournament_registrations`;
DROP TABLE IF EXISTS `tournaments`;
DROP TABLE IF EXISTS `rosters`;
DROP TABLE IF EXISTS `captains`;

CREATE TABLE `captains` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `real_name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `ign` VARCHAR(50) NOT NULL,
  `game` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `rosters` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `captain_id` INT NOT NULL,
  `real_name` VARCHAR(100) NOT NULL,
  `ign` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  CONSTRAINT `fk_roster_captain` FOREIGN KEY (`captain_id`) REFERENCES `captains` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tournaments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `game` VARCHAR(50) NOT NULL,
  `event_date` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tournament_registrations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `captain_id` INT NOT NULL,
  `tournament_id` INT NOT NULL,
  `status` VARCHAR(50) DEFAULT 'Pending',
  CONSTRAINT `fk_reg_captain` FOREIGN KEY (`captain_id`) REFERENCES `captains` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reg_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `match_scores` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `captain_id` INT NOT NULL,
  `tournament_id` INT NOT NULL,
  `score` VARCHAR(50) NOT NULL,
  `proof_image` VARCHAR(255) NOT NULL,
  `status` VARCHAR(50) DEFAULT 'Pending Review',
  CONSTRAINT `fk_score_captain` FOREIGN KEY (`captain_id`) REFERENCES `captains` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_score_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tournaments` (`id`, `title`, `game`, `event_date`) VALUES
(1, 'Challenger League Open Qualifiers', 'VALORANT', '2026-10-15'),
(2, 'FC26 Winter Cup', 'FC26', '2026-11-01'),
(3, 'MLBB Community Showdown', 'MLBB', '2026-11-20');