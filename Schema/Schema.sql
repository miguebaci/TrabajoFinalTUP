CREATE DATABASE MovieDB;

USE MovieDB;

CREATE TABLE cinema
(
	idCinema INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cinemaName VARCHAR(100) NOT NULL,
    address VARCHAR(100) NOT NULL,
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
    constraint pfk_idMovie FOREIGN KEY (idMovie) references movie(idMovie) ON DELETE CASCADE,
    constraint pfk_idGenre FOREIGN KEY (idGenre) references genre(idGenre) ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE room
(   idRoom INT AUTO_INCREMENT NOT NULL,
    idCinema INT NOT NULL,
    roomName VARCHAR(100) NOT NULL,
    totalCap INT NOT NULL,
    constraint pk_idRoom PRIMARY KEY (idRoom),
    constraint fk_idCinema FOREIGN KEY (idCinema) references cinema(idCinema) ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE moviefunction
(   
    idMovieFunction INT AUTO_INCREMENT NOT NULL,
    idMovie INT NOT NULL,
    idRoom INT NOT NULL,
    function_date DATE,
    function_time TIME,
    constraint pk_idMovieFunction PRIMARY KEY (idMovieFunction),
    constraint fk_idMovie FOREIGN KEY (idMovie) references movie(idMovie) ON DELETE CASCADE,
    constraint fk_idRoom FOREIGN KEY (idRoom) references room(idRoom) ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE userRole
(
    idRole INT NOT NULL PRIMARY KEY,
    role_description VARCHAR(100) NOT NULL
)Engine=InnoDB;

INSERT INTO userrole(idRole,role_description) VALUES (1,"User"),(2,"Admin");

CREATE TABLE user
(
    idUser INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    idRole INT NOT NULL,
    constraint pk_idUser PRIMARY KEY (idUser),
    constraint fk_idRole FOREIGN KEY (idRole) references userRole(idRole) ON DELETE CASCADE
)Engine=InnoDB;

INSERT INTO user(email,password,idRole) VALUES ("admin@localhost.com", "admin", 2);

CREATE TABLE userProfile
(
    idUser INT,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    dni INT,
    constraint pfk_idUser FOREIGN KEY (idUser) references user(idUser) ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE ticket
(   idTicket INT AUTO_INCREMENT NOT NULL,
    idMovieFunction INT NOT NULL,
    QR VARCHAR(150),
    constraint pk_idTicket PRIMARY KEY (idTicket),
    constraint fk_idMovieFunction FOREIGN KEY (idMovieFunction) references moviefunction(idMovieFunction) ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE purchase
(
    idPurchase INT AUTO_INCREMENT NOT NULL,
    idUser INT NOT NULL,
    idTicket INT NOT NULL,
    ticketQuantity INT NOT NULL,
    total INT NOT NULL,
    discount INT,
    purchaseDate VARCHAR(100),
    constraint pk_idPurchase PRIMARY KEY (idPurchase),
    constraint fk_idUser FOREIGN KEY (idUser) references user(idUser) ON DELETE CASCADE,
    constraint fk_idTicket FOREIGN KEY (idTicket) references ticket(idTicket) ON DELETE CASCADE
)Engine=InnoDB;