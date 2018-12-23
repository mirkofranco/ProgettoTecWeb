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
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (23, 'Materassi', 1); /*!!!!!!!*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (6, 'Comodini', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (7, 'Armadi', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (8, 'Cassettiere', 1);

/* Sottocategorie zona giorno */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (9, 'Tavoli e sedie', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (10, 'Divani', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (11, 'Librerie', 2); 
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (12, 'Poltrone', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (13, 'Elementi Divisori', 2);

/* Sottocategorie cucine*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (14, 'Tavoli', 3); 
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (15, 'Sedie', 3);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (16, 'Elettrodomestici da incasso', 3);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (17, 'Mobili componibili', 3);

/* Sottocategorie uffici*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (18, 'Scrivanie', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (19, 'Sedute per ufficio', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (20, 'Armadi', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (21, 'Classificatori', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (22, 'Sistemi di sedute per collettività', 4);


/* Inserimento prodotti tramite sql FORMATO DATA: 'YYYY-MM-DD'*/
/*INSERIMENTO LETTI*/
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (3, 5, 'Wing', 'Bside', 1400, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L178xP233xH122 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (4, 5, 'Happy', 'Bside', 1000, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L183xP232xH88 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (5, 5, 'Special', 'Bside', 1800, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L250xP250xH112 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (6, 5, 'Pad', 'Colombini', 700, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L185xP208xH112 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: No;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (7, 5, 'Snug', 'Colombini', 850, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L190xP213xH101 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: No;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (8, 5, 'Gruppo Letto Avalon', 'Giellesse', 3500, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L307xP226xH84 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Rovere; Contenitore: Sì;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (9, 5, 'Music', 'Giellesse', 2600, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Ingombro esterno letto: L188xP230xH95 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Ecopelle a scelta a campionario; Contenitore: Sì;');
/*INSERIMENTO MATERASSI*/
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (10, 23, 'Rodi', 'Maretto Marflex', 400, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Dimensioni materasso: L160xP190xH20 oppure L160xP200xH20; Tipologia: Molle tradizionali');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (11, 23, 'Memo Dream', 'Maretto Marflex', 1000, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Dimensioni materasso: L160xP190xH20 oppure L160xP200xH20; Tipologia: Molle insacchettate');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (12, 23, 'Eden', 'Maretto Marflex', 1100, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Dimensioni materasso: L160xP190xH19 oppure L160xP200xH19; Tipologia: Lattice');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (13, 23, 'EcoCell', 'Maretto Marflex', 550, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Dimensioni materasso: L160xP190xH19 oppure L160xP200xH19; Tipologia: Schiumato tecnico');
/*INSERIMENTO COMODINI*/
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (14, 6, 'Chic', 'Colombini', 160, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Misure: L55xP45xH35; Cassetti: 2; Materiale: Melaminico;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (15, 6, 'Stick', 'Colombini', 160, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Misure: L54xP46xH42; Cassetti: 2; Materiale: Melaminico;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (16, 6, 'Flat', 'Giellesse', 550, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Misure: L57xP45xH35; Cassetti: 2; Materiale: Rovere;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (17, 6, 'Twist', 'Giellesse', 500, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Misure: L57xP47xH35; Cassetti: 2; Materiale: Rovere;');
/*INSERIMENTO ARMADI*/
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (18, 7, 'Golf Battente', 'Colombini', 380, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Per un modulo: Misure: L90xP57xH262; Ante: 2; Ripiani interni: 1; Tubo appendiabiti: 2; Tipologia anta: Battente; Materiale: Melaminico; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (IDProdotto, sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, Descrizione) VALUES (18, 7, 'Golf Scorrevole', 'Colombini', 800, '2018-12-22', 0, "zonanotte_link_cropped.jpg", 'Per due moduli: Misure: L189xP62xH262; Ante: 2; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Scorrevole; Materiale: Melaminico; In foto mostrati 3 moduli;');