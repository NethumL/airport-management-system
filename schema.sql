CREATE TABLE `user`
(
    `email`    varchar(50)                              NOT NULL,
    `name`     varchar(50)                              NOT NULL,
    `password` varchar(256)                             NOT NULL,
    `userType` ENUM ('CUSTOMER', 'EMPLOYEE', 'MANAGER') NOT NULL DEFAULT 'CUSTOMER',
    PRIMARY KEY (`email`)
);

CREATE TABLE `unverified_user`
(
    `email`      varchar(50)                              NOT NULL,
    `name`       varchar(50)                              NOT NULL,
    `password`   varchar(256)                             NOT NULL,
    `userType`   ENUM ('CUSTOMER', 'EMPLOYEE', 'MANAGER') NOT NULL DEFAULT 'CUSTOMER',
    `token`      varchar(40)                              NOT NULL UNIQUE,
    `expiryTime` timestamp                                NOT NULL,
    PRIMARY KEY (`email`)
);

CREATE TABLE `password_reset`
(
    `email`      varchar(50) NOT NULL,
    `token`      varchar(40) NOT NULL UNIQUE,
    `expiryTime` timestamp   NOT NULL
);

CREATE TABLE `airport`
(
    `id`   int AUTO_INCREMENT NOT NULL,
    `name` varchar(50)        NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `flight`
(
    `id`                 int AUTO_INCREMENT NOT NULL,
    `airline`            varchar(20)        NOT NULL,
    `begin`              int                NULL,
    `end`                int                NULL,
    `departureDateTime`  timestamp          NOT NULL,
    `arrivalDateTime`    timestamp          NOT NULL,
    `economyClassPrice`  decimal(15, 2)     NOT NULL,
    `businessClassPrice` decimal(15, 2)     NOT NULL,
    `status`             ENUM (
        'SCHEDULED',
        'IN_PROGRESS',
        'CANCELLED',
        'ARRIVED'
        )                                   NOT NULL DEFAULT 'SCHEDULED',
    PRIMARY KEY (`id`)
);

CREATE TABLE `seat`
(
    `id`           int AUTO_INCREMENT           NOT NULL,
    `xPosition`    varchar(3)                   NOT NULL,
    `yPosition`    int                          NOT NULL,
    `isBooked`     tinyint                      NOT NULL DEFAULT 0,
    `flightNumber` int                          NOT NULL,
    `class`        ENUM ('ECONOMY', 'BUSINESS') NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `booking`
(
    `id`           int AUTO_INCREMENT NOT NULL,
    `flightNumber` int                NOT NULL,
    `isPaid`       tinyint            NOT NULL DEFAULT 0,
    `email`        varchar(50)        NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `booking_seat`
(
    `bookingId` int NOT NULL,
    `seatId`    int NOT NULL,
    PRIMARY KEY (`bookingId`, `seatId`)
);

CREATE TABLE `payment`
(
    `id`               int AUTO_INCREMENT NOT NULL,
    `creditCardNumber` varchar(15)        NOT NULL,
    `paidAmount`       decimal(15, 2)     NOT NULL,
    `paidDateTime`     timestamp          NOT NULL DEFAULT current_timestamp(),
    `email`            varchar(50)        NOT NULL,
    `bookingId`        int                NOT NULL,
    PRIMARY KEY (`id`)
);


ALTER TABLE `flight`
    ADD FOREIGN KEY (`begin`) REFERENCES `airport` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `flight`
    ADD FOREIGN KEY (`end`) REFERENCES `airport` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `seat`
    ADD FOREIGN KEY (`flightNumber`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `booking`
    ADD FOREIGN KEY (`flightNumber`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `booking`
    ADD FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `booking_seat`
    ADD FOREIGN KEY (`bookingId`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `booking_seat`
    ADD FOREIGN KEY (`seatId`) REFERENCES `seat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `payment`
    ADD FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `payment`
    ADD FOREIGN KEY (`bookingId`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
