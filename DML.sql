use Convection;

INSERT INTO Piano (NumeroPiano) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

INSERT INTO Azienda (RagioneSocialeAzienda, IndirizzoAzienda) VALUES
('Azienda Uno', 'Via Roma, 123'),
('Azienda Due', 'Via Milano, 456'),
('Azienda Tre', 'Via Napoli, 789'),
('Azienda Quattro', 'Via Firenze, 101'),
('Azienda Cinque', 'Corso Torino, 202'),
('Azienda Sei', 'Via Venezia, 303'),
('Azienda Sette', 'Corso Genova, 404');

INSERT INTO Relatore (CognomeRel, NomeRel, TelefonoRel, MailRel, IdAzz) VALUES
('Rossi', 'Mario', '1234567890', 'mario.rossi@example.com', 'Azienda Uno'),
('Bianchi', 'Luca', '0987654321', 'luca.bianchi@example.com', 'Azienda Due'),
('Verdi', 'Anna', '1122334455', 'anna.verdi@example.com', 'Azienda Tre'),
('Russo', 'Giuseppe', '5544332211', 'giuseppe.russo@example.com', 'Azienda Quattro'),
('Ferrari', 'Laura', '6677889900', 'laura.ferrari@example.com', 'Azienda Cinque'),
('Esposito', 'Antonio', '9900112233', 'antonio.esposito@example.com', 'Azienda Sei'),
('Romano', 'Giovanna', '8877665544', 'giovanna.romano@example.com', 'Azienda Sette');

INSERT INTO Speech (Titolo, Argomento) VALUES
('Introduzione a SQL', 'Panoramica sui concetti base di SQL'),
('Gestione dei dati in MySQL', 'Principali operazioni CRUD in MySQL'),
('Ottimizzazione delle query', 'Tecniche per migliorare le prestazioni delle query'),
('Modellazione dei dati', 'Approfondimento sulla progettazione di database'),
('Sicurezza nei database', 'Principali minacce e strategie di difesa'),
('Database distribuiti', 'Concetti fondamentali sui database distribuiti'),
('Tendenze nel mondo dei database', 'Analisi delle ultime innovazioni nel settore dei database');

INSERT INTO Sala (NomeSala, NpostiSala, NPiano) VALUES
('Sala A', 50, 1),
('Sala B', 30, 1),
('Sala C', 40, 2),
('Sala D', 25, 2),
('Sala E', 60, 3),
('Sala F', 35, 3),
('Sala G', 45, 4);

INSERT INTO Programma (IdSpeech, NomeSala, FasciaOraria) VALUES
(1, 'Sala A', '09:00 - 10:30'),
(2, 'Sala B', '10:45 - 12:15'),
(3, 'Sala C', '13:30 - 15:00'),
(4, 'Sala D', '15:15 - 16:45'),
(5, 'Sala E', '09:00 - 10:30'),
(6, 'Sala F', '10:45 - 12:15'),
(7, 'Sala G', '13:30 - 15:00');

INSERT INTO Partecipante (CognomePart, NomePart, TelefonoPart, TipologiaPart, MailPart) VALUES
('Rossi', 'Paolo', '1234567890', 'Speaker', 'paolo.rossi@example.com'),
('Bianchi', 'Maria', '0987654321', 'Partecipante', 'maria.bianchi@example.com'),
('Verdi', 'Luigi', '1122334455', 'Partecipante', 'luigi.verdi@example.com'),
('Russo', 'Giovanna', '5544332211', 'Partecipante', 'giovanna.russo@example.com'),
('Ferrari', 'Marco', '6677889900', 'Partecipante', 'marco.ferrari@example.com'),
('Esposito', 'Giulia', '9900112233', 'Partecipante', 'giulia.esposito@example.com'),
('Romano', 'Luca', '8877665544', 'Partecipante', 'luca.romano@example.com');

INSERT INTO Seglie (IdPar, IdProgramma) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(1, 7);

INSERT INTO Relaziona (IDRel, IdProgramma) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);
