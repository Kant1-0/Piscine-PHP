CREATE DATABASE `768_42rush` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci

CREATE TABLE `768_42rush`.`users`
(
    `UserID`            INT PRIMARY KEY AUTO_INCREMENT,
    `Username`          VARCHAR(150) NOT NULL,
    `Password`          VARCHAR(150) NOT NULL,
    `HistoryCartID`     VARCHAR(150),
    `SuperUser`         TINYINT DEFAULT '0'
) ENGINE=InnoDB;

CREATE TABLE `768_42rush`.`cart`
(
    `CartID`        INT PRIMARY KEY AUTO_INCREMENT,
    `UserID`        INT,
    `TotalPrice`    INT,
    `ListItemID`    VARCHAR(150)
) ENGINE=InnoDB;

CREATE TABLE `768_42rush`.`category`
(
    `CategoryID`         INT PRIMARY KEY AUTO_INCREMENT,
    `CategoryName`       VARCHAR(150) NOT NULL,
    `CategoryAbstract`   VARCHAR(500),
    `CategoryURL`        VARCHAR(150)
) ENGINE=InnoDB;

CREATE TABLE `768_42rush`.`items`
(
    `ItemID`           INT PRIMARY KEY AUTO_INCREMENT,
    `CategoryID`       INT NOT NULL,
    `ItemTitle`        VARCHAR(150) NOT NULL,
    `ItemAbstract`     VARCHAR(500),
    `ItemPhotos`       VARCHAR(150),
    `ItemPrice`        INT NOT NULL
) ENGINE=InnoDB;

\\`ListItemID` & `HistoryCartID` are serialized to hold each item ID;