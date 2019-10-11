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
    duration INT,
    poster_image VARCHAR(100) NOT NULL
)Engine=InnoDB;

CREATE TABLE gerne
(   idGenre INT NOT NULL PRIMARY KEY,
    genre_description VARCHAR(100) NOT NULL
)Engine=InnoDB;

CREATE TABLE movieXgenre
(
	idMovie INT NOT NULL,
    idGenre INT NOT NULL,
    constraint pfk_idMovie FOREIGN KEY(idMovie) references movie(idMovie),
    constraint pfk_idGenre FOREIGN KEY(idGenre) references gerne(idGenre)
)Engine=InnoDB;