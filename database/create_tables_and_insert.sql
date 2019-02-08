USE mifranco;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS CATEGORIA;
DROP TABLE IF EXISTS COMMENTI;
DROP TABLE IF EXISTS PRODOTTO;
-- DROP TABLE IF EXISTS PRODOTTOSTORICO;
DROP TABLE IF EXISTS UTENTE;

SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE CATEGORIA(
	IDC integer auto_increment primary key,
	Nome varchar(50),
	IDCatPadre integer,
	foreign key (IDCatPadre) references CATEGORIA(IDC)
)ENGINE = InnoDB;

CREATE TABLE PRODOTTO(
	IDProdotto integer auto_increment primary key,
	sottoCategoria integer not null,
	Nome varchar(50) not null,
	Marca varchar(20) not null,
	Prezzo integer,
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
	Password varchar(100) not null,
	Mail varchar(30) not null unique,
	/* 0: pagine amministrazione, 1: utente normale */
	Permessi varchar(2) not null default '01'
)ENGINE = InnoDB;

CREATE TABLE COMMENTI(
	IDCommento integer auto_increment primary key,
	UID integer not null,
	IDProdotto integer not null,
	Commento varchar(512) not null,

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

DROP TRIGGER IF EXISTS aggiustaPercorsoInsert;
DELIMITER $$
CREATE TRIGGER aggiustaPercorsoInsert
BEFORE INSERT ON PRODOTTO
FOR EACH ROW
BEGIN
	SET NEW.NomeThumbnail = CONCAT("thumbnails/" , NEW.NomeThumbnail);
END; $$
DELIMITER ;

/* password admin -> md5("admin") */
INSERT INTO UTENTE (UID, Nome, Cognome, Username, Password, Mail, Permessi) VALUES (1, "nome_admin", 'cognome_admin', 'admin', '21232F297A57A5A743894A0E4A801FC3', 'admin@admin.it', '11');
/* password user -> md5("user") */
INSERT INTO UTENTE (UID, Nome, Cognome, Username, Password, Mail, Permessi) VALUES (2, "nome_user", 'cognome_user', 'user', 'EE11CBB19052E40B07AAC0CA060C23EE', 'user@user.it', '01');

/* INSERIMENTO DELLE CATEGORIE PRINCIPALI */

INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (1, 'Zona Notte', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (2, 'Zona Giorno', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (3, 'Cucina', NULL);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (4, 'Ufficio', NULL);

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

/* Sottocategorie uffici */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (12, 'Scrivanie', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (13, 'Sedute per ufficio', 4);
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (14, 'Armadi', 4);

/* Sottocategoria vuota per le cucine */
INSERT INTO CATEGORIA (IDC, Nome, IDCatPadre) VALUES (24, NULL, 3);

/* Inserimento prodotti tramite sql FORMATO DATA: 'YYYY-MM-DD'*/
/*INSERIMENTO ZONA NOTTE*/
/*INSERIMENTO LETTI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Wing', 'Bside', 1400, '2018-12-22', 0, "letto_wing_bside.jpg", "letto_wing_bside.jpg", 'Ingombro esterno letto: L178xP233xH122 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Happy', 'Bside', 1000, '2018-12-22', 0, "letto_happy_bside.jpg", "letto_happy_bside.jpg", 'Ingombro esterno letto: L183xP232xH88 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Special', 'Bside', 1800, '2018-12-22', 0, "letto_special_bside.jpg", "letto_special_bside.jpg", 'Ingombro esterno letto: L250xP250xH112 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Pad', 'Colombini', 700, '2018-12-22', 0, "letto_pad_colombini.jpg", "letto_pad_colombini.jpg", 'Ingombro esterno letto: L185xP208xH112 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: No;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Snug', 'Colombini', 850, '2018-12-22', 0, "letto_snug_colombini.jpg", "letto_snug_colombini.jpg", 'Ingombro esterno letto: L190xP213xH101 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x200 (non compreso nel prezzo); Materiale: Tessuto a scelta a campionario; Contenitore: No;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Gruppo Letto Avalon', 'Giellesse', 3500, '2018-12-22', 0, "letto_avalon_giellesse.jpg", "letto_avalon_giellesse.jpg", 'Ingombro esterno letto: L307xP226xH84 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Rovere; Contenitore: Sì;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (5, 'Music', 'Giellesse', 2600, '2018-12-22', 0, "letto_music_giellesse.jpg", "letto_music_giellesse.jpg", 'Ingombro esterno letto: L188xP230xH95 (l''altezza si riferisce alla testiera); Dimensioni materasso: 160x190 (non compreso nel prezzo); Materiale: Ecopelle a scelta a campionario; Contenitore: Sì;');
/*INSERIMENTO MATERASSI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'Rodi', 'Maretto Marflex', 400, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH20 oppure L160xP200xH20; Tipologia: Molle tradizionali');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'Memo Dream', 'Maretto Marflex', 1000, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH20 oppure L160xP200xH20; Tipologia: Molle insacchettate');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'Eden', 'Maretto Marflex', 1100, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH19 oppure L160xP200xH19; Tipologia: Lattice');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (23, 'EcoCell', 'Maretto Marflex', 550, '2018-12-22', 0, "materasso_maretto_marflex.jpg", "materasso_maretto_marflex.jpg", 'Dimensioni materasso: L160xP190xH19 oppure L160xP200xH19; Tipologia: Schiumato tecnico');
/*INSERIMENTO COMODINI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Chic', 'Colombini', 160, '2018-12-22', 0, "comodino_chic_colombini.jpg", "comodino_chic_colombini.jpg", 'Misure: L55xP45xH35; Cassetti: 2; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Stick', 'Colombini', 160, '2018-12-22', 0, "comodino_stick_colombini.jpg", "comodino_stick_colombini.jpg", 'Misure: L54xP46xH42; Cassetti: 2; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Flat', 'Giellesse', 550, '2018-12-22', 0, "comodino_flat_giellesse.jpg", "comodino_flat_giellesse.jpg", 'Misure: L57xP45xH35; Cassetti: 2; Materiale: Rovere;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (6, 'Twist', 'Giellesse', 500, '2018-12-22', 0, "comodino_twist_giellesse.jpg", "comodino_twist_giellesse.jpg", 'Misure: L57xP47xH35; Cassetti: 2; Materiale: Rovere;');
/*INSERIMENTO ARMADI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Golf Battente', 'Colombini', 380, '2018-12-22', 0, "armadio_golf_colombini.jpg", "armadio_golf_colombini.jpg", 'Per un modulo: Misure: L90xP57xH262; Ante: 2; Ripiani interni: 1; Tubo appendiabiti: 2; Tipologia anta: Battente; Materiale: Melaminico; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Golf Scorrevole', 'Colombini', 800, '2018-12-22', 0, "armadio_golf_scorrevole_colombini.jpg", "armadio_golf_scorrevole_colombini.jpg", 'Per due moduli: Misure: L189xP62xH262; Ante: 2; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Scorrevole; Materiale: Melaminico; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Arizona', 'Giellesse', 3000, '2018-12-24', 0, "armadio_arizona_giellesse.jpg", "armadio_arizona_giellesse.jpg", 'Per tre moduli: Misure: L291xP62xH262; Ante: 6; Ripiani interni: 3; Tubo appendiabiti: 6; Tipologia anta: Battente; Materiale: Rovere; In foto mostrati 3 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Wall', 'Giellesse', 3000, '2018-12-24', 0, "armadio_wall_giellesse.jpg", "armadio_wall_giellesse.jpg", 'Per due moduli: Misure: L259xP67xH262; Ante: 2; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Scorrevole; Materiale: Laccato opaco; In foto mostrati 2 moduli;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (7, 'Glide', 'Giellesse', 1400, '2018-12-24', 0, "armadio_glide_giellesse.jpg", "armadio_glide_giellesse.jpg", 'Per due moduli: Misure: L195xP62xH262; Ante: 4; Ripiani interni: 2; Tubo appendiabiti: 4; Tipologia anta: Battente; Materiale: Melaminico; In foto mostrati 2 moduli;');

/*INSERIMENTO ZONA GIORNO*/
/*INSERIMENTO DIVANI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Upper Twist', 'Samoa', 1800, '2018-12-24', 0, "divano_twist_samoa.jpg", "divano_twist_samoa.jpg", 'Misure: L210xP98xH98; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Posh Line', 'Samoa', 1700, '2018-12-24', 0, "divano_posh_samoa.jpg", "divano_posh_samoa.jpg", 'Misure: L212xP98-130xH93; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Skill', 'Samoa', 1200, '2018-12-24', 0, "divano_skill_samoa.jpg", "divano_skill_samoa.jpg", 'Misure: L200xP93xH100; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Glide', 'Errebi', 1700, '2018-12-24', 0, "divano_glide_errebi.jpg", "divano_glide_errebi.jpg", 'Misure: L215xP108xH82; Numero posti: 3; Materiale: Tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (10, 'Vintage', 'Errebi', 1000, '2018-12-24', 0, "divano_vintage_errebi.jpg", "divano_vintage_errebi.jpg", 'Misure: L185xP80xH90; Numero posti: 2; Materiale: Tessuto a scelta a campionario;');
/*INSERIMENTO TAVOLI*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Tabià', 'Sedit', 1600, '2018-12-24', 0, "tavolo_tabia_sedit.jpg", "tavolo_tabia_sedit.jpg", 'Misure: L180xP100xH75; Materiale: Cristallo, legno;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Mix', 'Sedit', 1500, '2018-12-24', 0, "tavolo_mix_sedit.jpg", "tavolo_mix_sedit.jpg", 'Misure: L200xP100xH75; Materiale: Rovere, metallo; Allungabile a L300;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Bio', 'Sedit', 1550, '2018-12-24', 0, "tavolo_bio_sedit.jpg", "tavolo_bio_sedit.jpg", 'Misure: L180xP100xH75; Materiale: Rovere naturale;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Mikol', 'Abitare Giovane', 1000, '2018-12-24', 0, "tavolo_mikol_abitaregiovane.jpg", "tavolo_mikol_abitaregiovane.jpg", 'Misure: L150xP90xH75; Materiale: Vetro, metallo, legno; Allungabile a L205 e L260;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (9, 'Eclipse', 'Abitare Giovane', 890, '2018-12-24', 0, "tavolo_eclipse_abitaregiovane.jpg", "tavolo_eclipse_abitaregiovane.jpg", 'Misure: L160xP90xH76; Materiale: Metallo, melaminico; Allungabile a L220;');
/*INSERIMENTO SEDIE*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Edra', 'Abitare Giovane', 89, '2018-12-24', 0, "sedia_edra_abitaregiovane.jpg", "sedia_edra_abitaregiovane.jpg", 'Misure: L54xP47xH82; Materiale: Tessuto, legno, metallo;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Lara', 'Abitare Giovane', 85, '2018-12-24', 0, "sedia_lara_abitaregiovane.jpg", "sedia_lara_abitaregiovane.jpg", 'Misure: L46xP46xH100; Materiale: Legno, tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Bianca', 'Sedit', 230, '2018-12-24', 0, "sedia_bianca_sedit.jpg", "sedia_bianca_sedit.jpg", 'Misure: L49xP53xH86; Materiale: Metallo, tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Lula', 'Sedit', 400, '2018-12-24', 0, "sedia_lula_sedit.jpg", "sedia_lula_sedit.jpg", 'Misure: L47xP56xH80; Materiale: Legno, tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Victoria Ghost', 'Kartell', 216, '2018-12-24', 0, "sedia_victoriaghost_kartell.jpg", "sedia_victoriaghost_kartell.jpg", 'Misure: L39xP50xH91; Materiale: Policarbonato;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (8, 'Masters', 'Kartell', 180, '2018-12-24', 0, "sedia_masters_kartell.jpg", "sedia_masters_kartell.jpg", 'Misure: L54xP55xH83; Materiale: Polipropilene;');
/*INSERIMENTO LIBRERIE*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 1', 'Colombini', 2000, '2018-12-24', 0, "libreria1.jpg", "libreria1.jpg", 'Misure: L482xP33-46xH262; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 2', 'Colombini', 3100, '2018-12-24', 0, "libreria2.jpg", "libreria2.jpg", 'Misure: L438xP33-45xH227; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Infinity', 'Colombini', 3700, '2018-12-24', 0, "libreria3.jpg", "libreria3.jpg", 'Misure: L600xP33-49xH227; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 3', 'Colombini', 2300, '2018-12-24', 0, "libreria4.jpg", "libreria4.jpg", 'Misure: L365xP33xH195; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (11, 'Libreria Golf - Proposta 4', 'Colombini', 2100, '2018-12-24', 0, "libreria5.jpg", "libreria5.jpg", 'Misure libreria: L365xP33xH195; Misure libreria bassa: L215xP46xH80; Materiale: Melaminico;');

/*INSERIMENTO CUCINE*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (24, 'Quadra', 'Colombini Artec', NULL, '2018-12-24', 0, "cucina_quadra_colombini.jpg", "cucina_quadra_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (24, 'Paragon', 'Colombini Artec', NULL, '2018-12-24', 0, "cucina_paragon_colombini.jpg", "cucina_paragon_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (24, 'Isla', 'Colombini Artec', NULL, '2018-12-24', 0, "cucina_isla_colombini.jpg", "cucina_isla_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (24, 'Mida', 'Colombini Artec', NULL, '2018-12-24', 0, "cucina_mida_colombini.jpg", "cucina_mida_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (24, 'Lungomare', 'Colombini Artec', NULL, '2018-12-24', 0, "cucina_lungomare_colombini.jpg", "cucina_lungomare_colombini.jpg", 'La seguente è una proposta di arredo. Per ulteriori informazioni richiedere un preventivo');

/*INSERIMENTO UFFICI*/
/*INSERIMENTO SEDUTE UFFICIO*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Dafne', 'Mael', 300, '2018-12-24', 0, "sediauff_dafne_mael.jpg", "sediauff_dafne_mael.jpg", 'Ambito d''utilizzo: Operativo; Meccanismo: Syncro; Materiale: Rete;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Evolution H', 'Mael', 450, '2018-12-24', 0, "sediauff_evolution_mael.jpg", "sediauff_evolution_mael.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Oscillante monoblocco; Materiale: Rete;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Berlin', 'Mael', 200, '2018-12-24', 0, "sediauff_berlin_mael.jpg", "sediauff_berlin_mael.jpg", 'Ambito d''utilizzo: Operativo; Meccanismo: Syncro; Materiale: Rete e tessuto a scelta a campionario;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Light', 'Luxy', 650, '2018-12-24', 0, "sediauff_light_luxy.jpg", "sediauff_light_luxy.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Multiblock; Materiale: Rete;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Youster', 'Luxy', 900, '2018-12-24', 0, "sediauff_youster_luxy.jpg", "sediauff_youster_luxy.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Oscillante multiblock; Materiale: Pelle;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Urania', 'Olivo&Groppo', 900, '2018-12-24', 0, "sediauff_urania_olegropp.jpg", "sediauff_urania_olegropp.jpg", 'Ambito d''utilizzo: Direzionale; Meccanismo: Multiblock; Materiale: Pelle;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (13, 'Y', 'Olivo&Groppo', 300, '2018-12-24', 0, "sediauff_y_olegropp.jpg", "sediauff_y_olegropp.jpg", 'Ambito d''utilizzo: Operativo; Meccanismo: Syncro; Materiale: Rete e tessuto a scelta a campionario;');
/*INSERIMENTO SCRIVANIE UFFICIO*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (12, 'Teko', 'Offic''è', 250, '2018-12-24', 0, "scrivania_teko_office.jpg", "scrivania_teko_office.jpg", 'Ambito d''utilizzo: Operativo; Misure: L160xP80xH75; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (12, 'Loft', 'Offic''è', 390, '2018-12-24', 0, "scrivania_loft_office.jpg", "scrivania_loft_office.jpg", 'Ambito d''utilizzo: Semidirezionale; Misure: L160xP80xH75; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (12, 'Over', 'Offic''è', 1200, '2018-12-24', 0, "scrivania_over_office.jpg", "scrivania_over_office.jpg", 'Ambito d''utilizzo: Direzionale; Misure: L200xP100xH75; Materiale: Metallo, vetro;');
/*INSERIMENTO ARMADI UFFICIO*/
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 1', 'Offic''è', 1370, '2018-12-24', 0, "armadiouff1.jpg", "armadiouff1.jpg", 'Misure: L240xP35xH195; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 2', 'Offic''è', 3000, '2018-12-24', 0, "armadiouff2.jpg", "armadiouff2.jpg", 'Misure: L358xP46xH196; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 3', 'Offic''è', 1800, '2018-12-24', 0, "armadiouff3.jpg", "armadiouff3.jpg", 'Misure: L360xP45xH155; Materiale: Melaminico;');
INSERT INTO PRODOTTO (sottoCategoria, Nome, Marca, Prezzo, DataInizio, isOfferta, NomeImmagine, NomeThumbnail, Descrizione) VALUES (14, 'Proposta di armadio contenitore 4', 'Offic''è', 2000, '2018-12-24', 0, "armadiouff4.jpg", "armadiouff4.jpg", 'Misure: L270xP45xH230; Materiale: Melaminico;');

/* INSERIMENTO ALCUNI UTENTI */
INSERT INTO `UTENTE` (UID, Nome, Cognome, Username, Password, Mail) VALUES
('101', 'Charles', 'Babbage', 'c.babbage', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.1@mail.it'),
('102', 'George', 'Boole', 'g.boole', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.2@mail.it'),
('103', 'Noam', 'Chomsky', 'n.chomsky', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.3@mail.it'),
('104', 'Stephen', 'Cook', 's.cook', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.4@mail.it'),
('105', 'Edsger', 'Dijkstra', 'e.dijkstra', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.5@mail.it'),
('106', 'Bertrand', 'Russell', 'b.russell', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.6@mail.it'),
('107', 'Gottfried', 'Leibniz', 'g.leibniz', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.7@mail.it'),
('108', 'Ada', 'Lovelace', 'a.lovelace', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.8@mail.it'),
('109', 'Peter', 'Naur', 'p.naur', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.9@mail.it'),
('110', 'Blaise', 'Pascal', 'b.pascal', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.10@mail.it'),
('111', 'Richard', 'Stallman', 'r.stallman', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.11@mail.it'),
('112', 'Bjarne', 'Stroustrup', 'b.stroustrup', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.12@mail.it'),
('113', 'Aaron', 'Swartz', 'a.swartz', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.13@mail.it'),
('114', 'Linus', 'Torvalds', 'l.torvalds', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.14@mail.it'),
('115', 'Alan', 'Turing', 'a.turing', 'EE11CBB19052E40B07AAC0CA060C23EE', 'notarealemail.15@mail.it')
;


/* INSERIMENTO DI COMMENTI */
INSERT INTO `COMMENTI` (UID, IDProdotto, Commento) VALUES
('102', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('112', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('112', '2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('112', '3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('110', '3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('101', '3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('104', '4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('110', '5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('109', '5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('112', '5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('108', '6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('113', '7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('107', '8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('105', '8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('104', '8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('102', '9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('106', '10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('105', '11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('112', '11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('109', '11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('102', '12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('114', '12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('101', '13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('113', '13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('114', '14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('107', '15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('111', '16', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('103', '16', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('112', '17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('111', '18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('109', '18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('103', '18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('105', '19', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('111', '19', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('107', '21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('102', '21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('115', '22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('107', '22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('105', '23', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('112', '24', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('110', '25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('115', '25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('106', '25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('109', '26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('113', '27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('103', '28', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('107', '29', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('107', '29', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('110', '29', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('105', '30', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('111', '30', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('111', '30', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('106', '31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('105', '31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('103', '31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('112', '32', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('113', '33', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('109', '33', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('114', '33', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('109', '34', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('103', '34', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('113', '34', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('113', '35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('110', '35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('108', '35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('115', '36', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '37', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('104', '37', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('112', '38', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('113', '39', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('111', '40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('103', '41', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('109', '41', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('104', '41', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('105', '42', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('111', '42', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('108', '42', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('104', '43', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('106', '44', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('109', '45', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('110', '45', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('101', '45', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('111', '46', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('104', '46', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('115', '46', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('102', '47', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('105', '47', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('109', '48', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('115', '49', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('104', '49', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('113', '49', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('102', '50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('107', '51', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('107', '51', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('108', '51', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('111', '52', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('101', '52', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('112', '52', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut.'),
('104', '53', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('109', '54', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('107', '55', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('108', '56', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('114', '56', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('113', '57', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('101', '57', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('115', '58', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel.'),
('107', '59', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('104', '60', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor eu augue ut lectus arcu bibendum at varius vel. Elementum sagittis vitae et leo duis ut. Vitae ultricies leo integer malesuada nunc vel risus.'),
('115', '60', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')
;