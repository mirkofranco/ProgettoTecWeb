DROP DATABASE IF EXISTS DatabaseTecnologieWeb;

CREATE DATABASE DatabaseTecnologieWeb;

USE DatabaseTecnologieWeb;

DROP TABLE IF EXISTS PRODOTTO;
DROP TABLE IF EXISTS PRODOTTOSTORICO;

CREATE TABLE PRODOTTO(
	IDProdotto varchar(10) primary key,
	Categoria varchar(50) not null,
	Nome varchar(50) not null,
	Marca varchar(50) not null,
	Prezzo float(2) not null,
    DataInizio date not null
)ENGINE = InnoDB;

CREATE TABLE PRODOTTOSTORICO(
    IDStoricizzazione varchar(10),
    IDProdotto varchar(10),
    Prezzo float(2) not null,
    DataInizio date not null,
    DataFine date not null,
    primary key(IDStoricizzazione, IDProdotto),
    foreign key (IDProdotto) references PRODOTTO(IDProdotto)
)ENGINE = InnoDB;

DROP TRIGGER IF EXISTS aggiuntiProdottoStorico;

DELIMITER $$

CREATE TRIGGER aggiuntiProdottoStorico
BEFORE UPDATE ON PRODOTTO
FOR EACH ROW
BEGIN
INSERT INTO PRODOTTOSTORICO(IDProdotto, Prezzo, DataInizio, DataFine) VALUES
(NEW.IDProdotto, OLD.Prezzo, OLD.DataInizio, curdate());
END; $$

DELIMITER ;
