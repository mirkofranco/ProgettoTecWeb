DROP DATABASE IF EXISTS DatabaseTecnologieWeb;

CREATE DATABASE DatabaseTecnologieWeb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE DatabaseTecnologieWeb;

DROP TABLE IF EXISTS PRODOTTO;
/* DROP TABLE IF EXISTS PRODOTTOSTORICO; */
DROP TABLE IF EXISTS UTENTE;

CREATE TABLE CATEGORIA(
	IDC integer auto_increment primary key,
	Nome varchar(50) not null,
	IDCatPadre	integer,
	foreign key (IDCatPadre) references CATEGORIA(IDC)
)ENGINE = InnoDB;

CREATE TABLE PRODOTTO(
	IDProdotto integer auto_increment primary key,
	sottoCategoria integer not null,
	Nome varchar(20) not null,
	Marca varchar(20) not null,
	Prezzo float(2) not null,
	DataInizio date not null,
	isOfferta boolean not null default 0,
	NomeImmagine varchar(255) not null,
	NomeThumbnail varchar(255) not null,
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
	Nome varchar(20) not null,
	Cognome varchar(20) not null,
	Username varchar(20) not null unique,
	Password varchar(20) not null,
	Mail varchar(30) not null,
	Permessi varchar(2) not null default '01'
	/* 0: pagine amministrazione, 1: utente normale */
)ENGINE = InnoDB;

CREATE TABLE COMMENTI(
	IDCommento integer auto_increment,
	UID integer not null,
	IDProdotto integer not null,
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

/*INSERT INTO UTENTE (UID, Nome, Cognome,  Username, Password, Mail, Permessi) VALUES (1, 'admin', "Piombin", 'admin', 'admin', 'admin@admin.it', '11');
INSERT INTO UTENTE (UID, Nome, Cognome, Username, Password, Mail, Permessi) VALUES (2, 'user', "Piombin", 'user', 'user', 'user@user.it', '01');*/

/* INSERIMENTO DELLE CATEGORIE PRINCIPALI */

INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (1, 'Zona Notte', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (2, 'Zona Giorno', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (3, 'Cucine', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (4, 'Uffici', NULL);

/* INSERIMENTO DELLE SOTTOCATEGORIE */

/* Sottocategorie camere da letto: */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (5, 'Letti', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (23, 'Materassi', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (6, 'Comodini', 1);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (7, 'Armadi', 1);

/* Sottocategorie zona giorno */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (8, 'Sedie', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (9, 'Tavoli', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (10, 'Divani', 2);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (11, 'Librerie', 2);

/* Sottocategorie uffici*/
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (12, 'Scrivanie', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (13, 'Sedute per ufficio', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (14, 'Armadi', 4);


/* Inserimento prodotti tramite sql FORMATO DATA: 'YYYY-MM-DD'*/
/*INSERIMENTO ZONA NOTTE*/
/*INSERIMENTO LETTI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Wing', 'Bside', 1400, '2018-12-22', 0, "letto_wing_bside.jpg", "thumbnails/letto_wing_bside.jpg", 'Ingombro esterno letto: L178xP233xH122 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Happy', 'Bside', 1000, '2018-12-22', 0, "letto_happy_bside.jpg", "thumbnails/letto_happy_bside.jpg", 'Ingombro esterno letto: L183xP232xH88 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Special', 'Bside', 1800, '2018-12-22', 0, "letto_special_bside.jpg", "thumbnails/letto_spacial_bside.jpg", 'Ingombro esterno letto: L250xP250xH112 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Pad', 'Colombini', 700, '2018-12-22', 0, "letto_pad_colombini.jpg", "thumbnails/letto_pad_colombini.jpg", 'Ingombro esterno letto: L185xP208xH112 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: No;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Snug', 'Colombini', 850, '2018-12-22', 0, "letto_snug_colombini.jpg", "thumbnails/letto_snug_colombini.jpg", 'Ingombro esterno letto: L190xP213xH101 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: No;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Gruppo Letto Avalon', 'Giellesse', 3500, '2018-12-22', 0, "letto_avalon_giellesse.jpg", "thumbnails/letto_avalon_giellesse.jpg", 'Ingombro esterno letto: L307xP226xH84 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Rovere; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Music', 'Giellesse', 2600, '2018-12-22', 0, "letto_music_giellesse.jpg", "thumbnails/letto_music_giellesse.jpg", 'Ingombro esterno letto: L188xP230xH95 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Ecopelle a scelta a campionario; Contenitore: Sì;');
/*INSERIMENTO MATERASSI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'Rodi', 'Maretto Marflex', 400, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "thumbnails/materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH20 oppure L160xP200xH20; Tipologia: Molle tradizionali');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'Memo Dream', 'Maretto Marflex', 1000, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "thumbnails/materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH20 oppure L160xP200xH20; Tipologia: Molle insacchettate');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'Eden', 'Maretto Marflex', 1100, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "thumbnails/materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH19 oppure L160xP200xH19; Tipologia: Lattice');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'EcoCell', 'Maretto Marflex', 550, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "thumbnails/materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH19 oppure L160xP200xH19; Tipologia: Schiumato tecnico');
/*INSERIMENTO COMODINI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Chic', 'Colombini', 160, '2018-12-22', 0, "comodino_chic_colombini.jpg", "thumbnails/comodino_chic_colombini.jpg", 'Misure: L55xP45xH35; Cassetti: 2; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Stick', 'Colombini', 160, '2018-12-22', 0, "comodino_stick_colombini.jpg", "thumbnails/comodino_stick_colombini.jpg", 'Misure: L54xP46xH42; Cassetti: 2; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Flat', 'Giellesse', 550, '2018-12-22', 0, "comodino_flat_giellesse.jpg", "thumbnails/comodino_flat_giellesse.jpg", 'Misure: L57xP45xH35; Cassetti: 2; Materiale: Rovere;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Twist', 'Giellesse', 500, '2018-12-22', 0, "comodino_twist_giellesse.jpg", "thumbnails/comodino_twist_giellesse.jpg", 'Misure: L57xP47xH35; Cassetti: 2; Materiale: Rovere;');
/*INSERIMENTO ARMADI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Golf Battente', 'Colombini', 380, '2018-12-22', 0, "armadio_golf_colombini.jpg", "thumbnails/armadio_golf_colombini.jpg", 'Per un modulo: Misure: L90xP57xH262; Ante: 2; Ripiani interni: 1; Tubo appendiabiti: 2; Tipologia anta: Battente; Materiale: Melaminico; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Golf Scorrevole', 'Colombini', 800, '2018-12-22', 0, "armadio_golf_scorrevole_colombini.jpg", "thumbnails/armadio_golf_scorrevole_colombini.jpg", 'Per due moduli: Misure: L189xP62xH262; Ante: 2; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Scorrevole; Materiale: Melaminico; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Arizona', 'Giellesse', 3000, '2018-12-24', 0, "armadio_arizona_giellesse.jpg", "thumbnails/armadio_arizona_giellesse.jpg", 'Per tre moduli: Misure: L291xP62xH262; Ante: 6; Ripiani interni: 3; Tubo appendiabiti: 6; Tipologia anta: Battente; Materiale: Rovere; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Wall', 'Giellesse', 3000, '2018-12-24', 0, "armadio_wall_giellesse.jpg", "thumbnails/armadio_wall_giellesse.jpg", 'Per due moduli: Misure: L259xP67xH262; Ante: 2; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Scorrevole; Materiale: Laccato opaco; In foto mostrati 2 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Glide', 'Giellesse', 1400, '2018-12-24', 0, "armadio_glide_giellesse.jpg", "thumbnails/armadio_glide_giellesse.jpg", 'Per due moduli: Misure: L195xP62xH262; Ante: 4; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Battente; Materiale: Melaminico; In foto mostrati 2 moduli;');

/*INSERIMENTO ZONA GIORNO*/
/*INSERIMENTO DIVANI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Upper Twist', 'Samoa', 1800, '2018-12-24', 0, "divano_twist_samoa.jpg", "thumbnails/divano_twist_samoa.jpg", 'Misure: L210xP98xH98; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Posh Line', 'Samoa', 1700, '2018-12-24', 0, "divano_posh_samoa.jpg", "thumbnails/divano_posh_samoa.jpg", 'Misure: L212xP98-130xH93; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Skill', 'Samoa', 1200, '2018-12-24', 0, "divano_skill_samoa.jpg", "thumbnails/divano_skill_samoa.jpg", 'Misure: L200xP93xH100; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Glide', 'Errebi', 1700, '2018-12-24', 0, "divano_glide_errebi.jpg", "thumbnails/divano_glide_errebi.jpg", 'Misure: L215xP108xH82; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Vintage', 'Errebi', 1000, '2018-12-24', 0, "divano_vintage_errebi.jpg", "thumbnails/divano_vintage_errebi.jpg", 'Misure: L185xP80xH90; Numero posti: 2; Materiale: Tessuto a scelta a campionario;');
/*INSERIMENTO TAVOLI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Tabià', 'Sedit', 1600, '2018-12-24', 0, "tavolo_tabia_sedit.jpg", "thumbnails/tavolo_tabia_sedit.jpg", 'Misure: L180xP100xH75; Materiale: Cristallo, legno;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Mix', 'Sedit', 1500, '2018-12-24', 0, "tavolo_mix_sedit.jpg", "thumbnails/tavolo_mix_sedit.jpg", 'Misure: L200xP100xH75; Materiale: Rovere, metallo; Allungabile a L300;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Bio', 'Sedit', 1550, '2018-12-24', 0, "tavolo_bio_sedit.jpg", "thumbnails/tavolo_bio_sedit.jpg", 'Misure: L180xP100xH75; Materiale: Rovere naturale;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Mikol', 'Abitare Giovane', 1000, '2018-12-24', 0, "tavolo_mikol_abitaregiovane.jpg", "thumbnails/tavolo_mikol_abitaregiovane.jpg", 'Misure: L150xP90xH75; Materiale: Vetro, metallo, legno; Allungabile a L205 e L260;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Eclipse', 'Abitare Giovane', 890, '2018-12-24', 0, "tavolo_eclipse_abitaregiovane.jpg", "thumbnails/tavolo_eclipse_abitaregiovane.jpg", 'Misure: L160xP90xH76; Materiale: Metallo, melaminico; Allungabile a L220;');
/*INSERIMENTO SEDIE*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Edra', 'Abitare Giovane', 89, '2018-12-24', 0, "sedia_edra_abitaregiovane.jpg", "thumbnails/sedia_edra_abitaregiovane.jpg", 'Misure: L54xP47xH82; Materiale: Tessuto, legno, metallo;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Lara', 'Abitare Giovane', 85, '2018-12-24', 0, "sedia_lara_abitaregiovane.jpg", "thumbnails/sedia_lara_abitaregiovane.jpg", 'Misure: L46xP46xH100; Materiale: Legno, tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Bianca', 'Sedit', 230, '2018-12-24', 0, "sedia_bianca_sedit.jpg", "thumbnails/sedia_bianca_sedit.jpg", 'Misure: L49xP53xH86; Materiale: Metallo, tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Lula', 'Sedit', 400, '2018-12-24', 0, "sedia_lula_sedit.jpg", "thumbnails/sedia_lula_sedit.jpg", 'Misure: L47xP56xH80; Materiale: Legno, tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Victoria Ghost', 'Kartell', 216, '2018-12-24', 0, "sedia_victoriaghost_kartell.jpg", "thumbnails/sedia_victoriaghost_kartell.jpg", 'Misure: L39xP50xH91; Materiale: Policarbonato;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Masters', 'Kartell', 180, '2018-12-24', 0, "sedia_masters_kartell.jpg", "thumbnails/sedia_masters_kartell.jpg", 'Misure: L54xP55xH83; Materiale: Polipropilene;');
/*INSERIMENTO LIBRERIE*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 1', 'Colombini', 2000, '2018-12-24', 0, "libreria1.jpg", "thumbnails/libreria1.jpg", 'Misure: L482xP33-46xH262; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 2', 'Colombini', 3100, '2018-12-24', 0, "libreria2.jpg", "thumbnails/libreria2.jpg", 'Misure: L438xP33-45xH227; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Infinity', 'Colombini', 3700, '2018-12-24', 0, "libreria3.jpg", "thumbnails/libreria3.jpg", 'Misure: L600xP33-49xH227; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 3', 'Colombini', 2300, '2018-12-24', 0, "libreria4.jpg", "thumbnails/libreria4.jpg", 'Misure: L365xP33xH195; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 4', 'Colombini', 2100, '2018-12-24', 0, "libreria5.jpg", "thumbnails/libreria5.jpg", 'Misure libreria: L365xP33xH195; Misure libreria bassa: L215xP46xH80; Materiale: Melaminico;');

/*INSERIMENTO CUCINE*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (3, 'Quadra', 'Colombini Artec', 6000, '2018-12-24', 0, "cucina_quadra_colombini.jpg", "thumbnails/cucina_quadra_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (3, 'Paragon', 'Colombini Artec', 6000, '2018-12-24', 0, "cucina_paragon_colombini.jpg", "thumbnails/cucina_paragon_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (3, 'Isla', 'Colombini Artec', 6000, '2018-12-24', 0, "cucina_isla_colombini.jpg", "thumbnails/cucina_isla_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (3, 'Mida', 'Colombini Artec', 6000, '2018-12-24', 0, "cucina_mida_colombini.jpg", "thumbnails/cucina_mida_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (3, 'Lungomare', 'Colombini Artec', 6000, '2018-12-24', 0, "cucina_lungomare_colombini.jpg", "thumbnails/cucina_lungomare_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');

/*INSERIMENTO UFFICI*/
/*INSERIMENTO SEDUTE UFFICIO*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Dafne', 'Mael', 300, '2018-12-24', 0, "sediauff_dafne_mael.jpg", "thumbnails/sediauff_dafne_mael.jpg", 'Ambito d''utilizzo: Operativo; Meccanismo: Syncro; Materiale: Rete;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Evolution H', 'Mael', 450, '2018-12-24', 0, "sediauff_evolution_mael.jpg", "thumbnails/sediauff_evolution_mael.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Oscillante monoblocco; Materiale: Rete;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Berlin', 'Mael', 200, '2018-12-24', 0, "sediauff_berlin_mael.jpg", "thumbnails/sediauff_berlin_mael.jpg", 'Ambito d''utilizzo: Operativo; Meccanismo: Syncro; Materiale: Rete e tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Light', 'Luxy', 650, '2018-12-24', 0, "sediauff_light_luxy.jpg", "thumbnails/sediauff_light_luxy.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Multiblock; Materiale: Rete;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Youster', 'Luxy', 900, '2018-12-24', 0, "sediauff_youster_luxy.jpg", "thumbnails/sediauff_youster_luxy.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Oscillante multiblock; Materiale: Pelle;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Urania', 'Olivo&Groppo', 900, '2018-12-24', 0, "sediauff_urania_olegropp.jpg", "thumbnails/sediauff_urania_olegropp.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Multiblock; Materiale: Pelle;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Y', 'Olivo&Groppo', 300, '2018-12-24', 0, "sediauff_y_olegropp.jpg", "thumbnails/sediauff_y_olegropp.jpg", 'Ambito d''utilizzo: Operativo; Meccanismo: Syncro; Materiale: Rete e tessuto a scelta a campionario;');
/*INSERIMENTO SCRIVANIE UFFICIO*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (12, 'Teko', 'Offic''è', 250, '2018-12-24', 0, "scrivania_teko_office.jpg", "thumbnails/scrivania_teko_office.jpg", 'Ambito d''utilizzo: Operativo; Misure: L160xP80xH75; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (12, 'Loft', 'Offic''è', 390, '2018-12-24', 0, "scrivania_loft_office.jpg", "thumbnails/scrivania_loft_office.jpg", 'Ambito d''utilizzo: Semidirezionale; Misure: L160xP80xH75; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (12, 'Over', 'Offic''è', 1200, '2018-12-24', 0, "scrivania_over_office.jpg", "thumbnails/scrivania_over_office.jpg", 'Ambito d''utilizzo: Direzionale; Misure: L200xP100xH75; Materiale: Metallo, vetro;');
/*INSERIMENTO ARMADI UFFICIO*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 1', 'Offic''è', 1370, '2018-12-24', 0, "armadiouff1.jpg", "thumbnails/armadiouff1.jpg", 'Misure: L240xP35xH195; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 2', 'Offic''è', 3000, '2018-12-24', 0, "armadiouff2.jpg", "thumbnails/armadiouff2.jpg", 'Misure: L358xP46xH196; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 3', 'Offic''è', 1800, '2018-12-24', 0, "armadiouff3.jpg", "thumbnails/armadiouff3.jpg", 'Misure: L360xP45xH155; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 4', 'Offic''è', 2000, '2018-12-24', 0, "armadiouff4.jpg", "thumbnails/armadiouff4.jpg", 'Misure: L270xP45xH230; Materiale: Melaminico;');
