--soave sebastiano 5l creazione del ddl per Convection
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
    Rivisionare boolean not null,
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

create table if not exists Rivisiona(
    IdAdmin int default 1,
    IdRelRev int not null,
    primary key(IdAdmin,IdRelRev),
    foreign key (IdRelRev) references Relatore(IdRel)
);