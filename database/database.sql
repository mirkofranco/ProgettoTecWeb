DROP DATABASE IF EXISTS DatabaseTecnologieWeb;

CREATE DATABASE DatabaseTecnologieWeb;

USE DatabaseTecnologieWeb;

DROP TABLE IF EXISTS PRODOTTO;
DROP TABLE IF EXISTS PRODOTTOSTORICO;
DROP TABLE IF EXISTS UTENTE;

CREATE TABLE PRODOTTO(
	IDProdotto varchar(10) primary key,
	Categoria varchar(50) not null,
	Nome varchar(50) not null,
	Marca varchar(50) not null,
	Prezzo float(2) not null,
    DataInizio date not null,
	isOfferta boolean not null default 0,
	NomeImmagine varchar(255) not null,
	Descrizione varchar(400) not null
)ENGINE = InnoDB;

CREATE TABLE PRODOTTOSTORICO(
    IDStoricizzazione integer auto_increment,
    IDProdotto varchar(10),
    Prezzo float(2) not null,
    DataInizio date not null,
    DataFine date not null,
	isOffertaS boolean not null,
    primary key(IDStoricizzazione, IDProdotto),
    foreign key (IDProdotto) references PRODOTTO(IDProdotto) ON DELETE CASCADE
)ENGINE = InnoDB;

CREATE TABLE UTENTE(
	UID integer auto_increment primary key,
	NomeCognome varchar(20) not null,
	Username varchar(20) not null unique,
	Password varchar(20) not null,
	Mail varchar(20) not null,
	Permessi varchar(2) not null default '01'
	/* 0: pagine amministrazione, 1: utente normale */
)ENGINE = InnoDB;

CREATE TABLE Commenti(
	IDCommento integer auto_increment,
	UID integer not null,
	IDProdotto varchar(10) not null,
	Commento varchar(512) not null,
	primary key(IDCommento),
	unique(UID, IDProdotto),
	foreign key (UID) references UTENTE(UID) ON DELETE CASCADE,
	foreign key (IDProdotto) references PRODOTTO(IDProdotto) ON DELETE CASCADE
)ENGINE = InnoDB;

CREATE TABLE Categoria(
	
)ENGINE = InnoDB;


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

DELIMITER ;

INSERT INTO UTENTE (UID, NomeCognome, Username, Password, Mail, Permessi ) VALUES (1, 'admin', 'admin', 'admin', 'admin@admin.it', '11');
