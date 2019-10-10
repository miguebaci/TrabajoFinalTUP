CREATE DATABASE MovieDB;

USE MovieDB;

CREATE TABLE cinema
(
	idCinema INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cinemaName VARCHAR(100) NOT NULL,
    adress VARCHAR(100) NOT NULL,
    totalCap INT NOT NULL,
    ticketPrice INT NOT NULL
)Engine=InnoDB;

CREATE TABLE movie
(
	idMovie INT NOT NULL PRIMARY KEY,
    movieName VARCHAR(100) NOT NULL,
    movielanguage VARCHAR(100) NOT NULL,
    duration INT NOT NULL,
    poster_image VARCHAR(100) NOT NULL
)Engine=InnoDB;