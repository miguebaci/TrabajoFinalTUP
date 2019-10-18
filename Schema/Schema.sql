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

CREATE TABLE genre
(   idGenre INT NOT NULL PRIMARY KEY,
    description VARCHAR(100) NOT NULL
)Engine=InnoDB;

CREATE TABLE movieXgenre
(
	idMovie INT NOT NULL,
    idGenre INT NOT NULL,
    constraint pfk_idMovie FOREIGN KEY (idMovie) references movie(idMovie),
    constraint pfk_idGenre FOREIGN KEY (idGenre) references genre(idGenre)
)Engine=InnoDB;

CREATE TABLE moviefunction
(   idMovieFunction INT AUTO_INCREMENT NOT NULL,
    idMovie INT NOT NULL,
    idCinema INT NOT NULL,
    function_date DATE,
    function_time TIME,
    constraint pk_idMovieFunction PRIMARY KEY (idMovieFunction),
    constraint fk_idMovie FOREIGN KEY (idMovie) references movie(idMovie),
    constraint fk_idGenre FOREIGN KEY (idCinema) references cinema(idMovie)
)Engine=InnoDB;

CREATE TABLE user
(
    idUser INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    idUserProfile INT NOT NULL,
    idRole INT NOT NULL,
    constraint pk_idUser PRIMARY KEY (idUser),
    constraint fk_idUserProfile FOREIGN KEY (idUserProfile) references userProfile(idUserProfile),
    constraint fk_idRole FOREIGN KEY (idRole) references userRole(idRole)
)Engine=InnoDB;

CREATE TABLE userProfile
(
    idUserProfile INT AUTO_INCREMENT NOT NULL,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    dni INT NOT NULL,
)Engine=InnoDB;

CREATE TABLE userRole
(
    idRole INT NOT NULL PRIMARY KEY,
    role_description VARCHAR(100) NOT NULL
)Engine=InnoDB;