DROP DATABASE IF EXISTS DatabaseTecnologieWeb;

CREATE DATABASE DatabaseTecnologieWeb;

USE DatabaseTecnologieWeb;

DROP TABLE IF EXISTS PRODOTTO;
/* DROP TABLE IF EXISTS PRODOTTOSTORICO; */
DROP TABLE IF EXISTS UTENTE;

CREATE TABLE CATEGORIA(
	IDC integer auto_increment primary key,
	Nome varchar(30) not null,
	IDCatPadre	integer,
	foreign key (IDCatPadre) references CATEGORIA(IDC)
)ENGINE = InnoDB;

CREATE TABLE PRODOTTO(
	IDProdotto varchar(10) primary key,
	sottoCategoria integer not null,
	Nome varchar(50) not null,
	Marca varchar(50) not null,
	Prezzo float(2) not null,
  DataInizio date not null,
	isOfferta boolean not null default 0,
	NomeImmagine varchar(255) not null,
	Descrizione varchar(400) not null,
	foreign key (sottoCategoria) references CATEGORIA(IDC) ON DELETE CASCADE
)ENGINE = InnoDB;

/*
CREATE TABLE PRODOTTOSTORICO(
    IDStoricizzazione integer auto_increment,
    IDProdotto varchar(10),
    Prezzo float(2) not null,
    DataInizio date not null,
    DataFine date not null,
	isOffertaS boolean not null,
    primary key(IDStoricizzazione, IDProdotto),
    foreign key (IDProdotto) references PRODOTTO(IDProdotto) ON DELETE CASCADE
)ENGINE = InnoDB; */

CREATE TABLE UTENTE(
	UID integer auto_increment primary key,
	NomeCognome varchar(20) not null,
	Username varchar(20) not null unique,
	Password varchar(20) not null,
	Mail varchar(20) not null,
	Permessi varchar(2) not null default '01'
	/* 0: pagine amministrazione, 1: utente normale */
)ENGINE = InnoDB;

CREATE TABLE COMMENTI(
	IDCommento integer auto_increment,
	UID integer not null,
	IDProdotto varchar(10) not null,
	Commento varchar(512) not null,
	primary key(IDCommento),
	unique(UID, IDProdotto),
	foreign key (UID) references UTENTE(UID) ON DELETE CASCADE,
	foreign key (IDProdotto) references PRODOTTO(IDProdotto) ON DELETE CASCADE
)ENGINE = InnoDB;



/*
DROP TRIGGER IF EXISTS aggiuntiProdottoStorico;

DELIMITER $$

CREATE TRIGGER aggiuntiProdottoStorico
BEFORE UPDATE ON PRODOTTO
FOR EACH ROW
BEGIN
	IF OLD.Prezzo <> NEW.Prezzo THEN
		INSERT INTO PRODOTTOSTORICO(IDProdotto, Prezzo, DataInizio, DataFine, isOffertaS) VALUES
		(NEW.IDProdotto, OLD.Prezzo, OLD.DataInizio, curdate(), OLD.isOfferta);
	END IF;
END; $$

DELIMITER ; */

INSERT INTO UTENTE (UID, NomeCognome, Username, Password, Mail, Permessi) VALUES (1, 'admin', 'admin', 'admin', 'admin@admin.it', '11');
INSERT INTO UTENTE (UID, NomeCognome, Username, Password, Mail, Permessi) VALUES (2, 'user', 'user', 'user', 'user@user.it', '01');

/* INSERIMENTO DELLE CATEGORIE PRINCIPALI */

INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (1, 'Zona Notte', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (2, 'Zona Giorno', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (3, 'Cucine', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (4, 'Uffici', NULL);

/* INSERIMENTO DELLE SOTTOCATEGORIE */

/* Sottocategorie camere da letto: */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (5, 'Letti', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (6, 'Abat-jour', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (7, 'Armadi', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (8, 'Tappeti', 1);

/* Sottocategorie zona giorno */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (9, 'Tavoli', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (10, 'Divani', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (11, 'Tappeti', 2); /* non so se ha senso mettere tappeti sia in zona giorno che zona notte,
non so se ci siano differenze, mal che vada si levano (esempio gonna-pantalone della Gaggi)*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (12, 'Poltrone', 2);

/* Sottocategorie cucine*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (13, 'Tavoli', 3); /* stesso discorso dei tappeti: tavoli da salotto vs tavoli da cucine? */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (14, 'Sedie', 3);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (15, 'Scaffali', 3);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (16, 'Frigorigeri', 3);

/* Sottocategorie uffici*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (17, 'Scrivanie', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (18, 'Poltrone', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (19, 'Scaffali', 4);


/* Prova inserimenti prodotti tramite sql FORMATO DATA: 'YYYY-MM-DD'*/
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (1, 5, 'Letto bellissimo', 'Ikea', 200, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Un letto bellissimoooooo soffice e puffoso');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (2, 10, 'Divano pazzesco', 'Ikea', 200, '2018-12-22', 0, "divano1.jpg", 'Un divano pazzeschissimo non di pelle però che schifo i divani di pelle');
