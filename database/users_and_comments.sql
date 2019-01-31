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
