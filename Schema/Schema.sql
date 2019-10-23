CREATE DATABASE MovieDB;

USE MovieDB;

CREATE TABLE cinema
(
	idCinema INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cinemaName VARCHAR(100) NOT NULL,
    adress VARCHAR(100) NOT NULL,
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

CREATE TABLE room
(   idRoom INT AUTO_INCREMENT NOT NULL,
    idCinema INT NOT NULL,
    roomName VARCHAR(100) NOT NULL,
    constraint pk_idRoom PRIMARY KEY (idRoom),
    constraint fk_idCinema FOREIGN KEY (idCinema) references cinema(idCinema)
)Engine=InnoDB;

CREATE TABLE moviefunction
(   idMovieFunction INT AUTO_INCREMENT NOT NULL,
    idMovie INT NOT NULL,
    idRoom INT NOT NULL,
    function_date DATE,
    function_time TIME,
    constraint pk_idMovieFunction PRIMARY KEY (idMovieFunction),
    constraint fk_idMovie FOREIGN KEY (idMovie) references movie(idMovie),
    constraint fk_idRoom FOREIGN KEY (idRoom) references room(idRoom)
)Engine=InnoDB;

CREATE TABLE userRole
(
    idRole INT NOT NULL PRIMARY KEY,
    role_description VARCHAR(100) NOT NULL
)Engine=InnoDB;

CREATE TABLE user
(
    idUser INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    idRole INT NOT NULL,
    constraint pk_idUser PRIMARY KEY (idUser),
    constraint fk_idRole FOREIGN KEY (idRole) references userRole(idRole)
)Engine=InnoDB;

CREATE TABLE userProfile
(
    idUser INT,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    dni INT,
    constraint pfk_idUser FOREIGN KEY (idUser) references user(idUser)
)Engine=InnoDB;

CREATE TABLE ticket
(   idTicket INT AUTO_INCREMENT NOT NULL,
    idMovieFunction INT NOT NULL,
    constraint pk_idTicket PRIMARY KEY (idTicket),
    constraint fk_idMovieFunction FOREIGN KEY (idMovieFunction) references moviefunction(idMovieFunction)
)Engine=InnoDB;

CREATE TABLE purchase
(
    idPurchase INT AUTO_INCREMENT NOT NULL,
    idUser INT NOT NULL,
    idTicket INT NOT NULL,
    constraint pk_idPurchase PRIMARY KEY (idPurchase),
    constraint fk_idUser FOREIGN KEY (idUser) references user(idUser),
    constraint fk_idTicket FOREIGN KEY (idTicket) references ticket(idTicket)
)Engine=InnoDB;