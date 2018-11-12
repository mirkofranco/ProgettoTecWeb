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
    IDStoricizzazione integer auto_increment,
    IDProdotto varchar(10),
    Prezzo float(2) not null,
    DataInizio date not null,
    DataFine date not null,
    primary key(IDStoricizzazione, IDProdotto),
    foreign key (IDProdotto) references PRODOTTO(IDProdotto) ON DELETE CASCADE
)ENGINE = InnoDB;

DROP TRIGGER IF EXISTS aggiuntiProdottoStorico;

DELIMITER $$

CREATE TRIGGER aggiuntiProdottoStorico
BEFORE UPDATE ON PRODOTTO
FOR EACH ROW
BEGIN
	IF OLD.Prezzo <> NEW.Prezzo THEN
		INSERT INTO PRODOTTOSTORICO(IDProdotto, Prezzo, DataInizio, DataFine) VALUES
		(NEW.IDProdotto, OLD.Prezzo, OLD.DataInizio, curdate());
	END IF;
END; $$

DELIMITER ;

INSERT INTO PRODOTTO(IDProdotto, Categoria, Nome, Marca, Prezzo, DataInizio) VALUES ('0000','Mobile', 'Tavolo', 'Apple', 35, 2018-07-12);
INSERT INTO PRODOTTO(IDProdotto, Categoria, Nome, Marca, Prezzo, DataInizio) VALUES ('0001','Armadio', 'Armadio Rosa', 'Google', 100, 2018-08-10);
UPDATE PRODOTTO
SET Nome = 'Armadio Nuovo'
WHERE IDProdotto = '0001';
UPDATE PRODOTTO
SET Prezzo = 110
WHERE IDProdotto = '0001';
UPDATE PRODOTTO
SET Prezzo = 120
WHERE  IDProdotto = '0001';
DELETE FROM PRODOTTO WHERE IDProdotto = '0001';
