
drop database if exists Convection;
create database if not exists Convection;
use Convection;

create table if not exists Azienda (
    RagioneSocialeAzienda varchar(30) not null,
    IndirizzoAzienda varchar(30) not null,
    primary key(RagioneSocialeAzienda)
);
create table if not exists Relatore(
    IDRel int not null auto_increment,
    CognomeRel varchar(30) not null,
    NomeRel  varchar(30) not null,
    TelefonoRel  varchar(15),
    MailRel varchar(30),
    IdAzz varchar(30) null,
    primary key(IDRel),
    foreign key (IdAzz) references Azienda(RagioneSocialeAzienda)
);
create table if not exists Speech(
    IdSpeech int not null auto_increment,
    Titolo varchar(40) not null,
    Argomento text not null,
    primary key (IdSpeech)
);

create table if not exists Piano(
    NumeroPiano int not null,
    primary key (NumeroPiano)
);

create table if not exists Sala(
    NomeSala varchar(20) not null,
    NpostiSala int not null,
    NPiano int not null,
    primary key (NomeSala),
    foreign key (NPiano) references Piano(NumeroPiano)
);
create table if not exists Programma(
    IdProgramma int not null auto_increment,
    IdSpeech int not null,
    NomeSala varchar(20) not null,
    FasciaOraria varchar(20) not null,
    primary key (IdProgramma),
    foreign key (IdSpeech) references Speech(IdSpeech),
    foreign key (NomeSala) references Sala(NomeSala)
);

create table if not exists Partecipante(
    IdPar int not null auto_increment,
    CognomePart varchar(30) not null,
    NomePart  varchar(30) not null,
    TelefonoPart  varchar(15),
    MailPart varchar(30),
    primary key (IdPar)
);

create table if not exists Seglie(
    IdPar int not null,
    IdProgramma int not null ,
    primary key(IdPar,IdProgramma),
    foreign key (IdProgramma) references Programma(IdProgramma),
    foreign key (IdPar) references Partecipante(IdPar)
);

create table if not exists Relaziona(
    IDRel int not null ,
    IdProgramma int not null ,
    primary key(IDRel,IdProgramma),
    foreign key (IdProgramma) references Programma(IdProgramma),
    foreign key (IDRel) references Relatore(IDRel)
);

create table if not exists User(
    idUser int auto_increment not null,
    MailUser varchar(30),
    PasswordUser varchar(30),
    IsRel int null,
    IsPar int null,
    IsAdmin boolean null,
    foreign key (IsPar) references Partecipante(IdPar),
    foreign key (IsRel) references Relatore(IdRel),
    primary key(idUser)
);


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

INSERT INTO Partecipante (CognomePart, NomePart, TelefonoPart, MailPart) VALUES
('Rossi', 'Paolo', '1234567890', 'paolo.rossi@example.com'),
('Bianchi', 'Maria', '0987654321', 'maria.bianchi@example.com'),
('Verdi', 'Luigi', '1122334455', 'luigi.verdi@example.com'),
('Russo', 'Giovanna', '5544332211', 'giovanna.russo@example.com'),
('Ferrari', 'Marco', '6677889900', 'marco.ferrari@example.com'),
('Esposito', 'Giulia', '9900112233', 'giulia.esposito@example.com'),
('Romano', 'Luca', '8877665544', 'luca.romano@example.com');

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

INSERT INTO User(MailUser,PasswordUser,IsAdmin) VALUE 
("admin@example.com","admin.admin",1);


INSERT INTO User(MailUser,PasswordUser,IsPar) VALUES
('paolo.rossi@example.com','paolo.rossi',1),
( 'maria.bianchi@example.com', 'maria.bianchi',2 ),
('luigi.verdi@example.com', 'luigi.verdi',3),
('giovanna.russo@example.com', 'giovanna.russo',4),
('marco.ferrari@example.com', 'marco.ferrari',5),
('giulia.esposito@example.com', 'giulia.esposito' ,6 ),
('luca.romano@example.com','luca.romano',7);


INSERT INTO User (PasswordUser, MailUser, IsRel) VALUES
('Rossi.Mario','mario.rossi@example.com', 1),
('Bianchi.Luca', 'luca.bianchi@example.com',2 ),
('Verdi.Anna', 'anna.verdi@example.com', 3 ),
('Russo.Giuseppe', 'giuseppe.russo@example.com',4 ),
('Ferrari.Laura',  'laura.ferrari@example.com',5 ),
('Esposito.Antonio', 'antonio.esposito@example.com',6 ),
('Romano.Giovanna',  'giovanna.romano@example.com',7 );