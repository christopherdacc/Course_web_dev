--Question II.1
create database test;
create database carnet_adresses;

--Question II.2
drop database test;

--Question IV.1
use carnet_adresses;
create table telephone(
	IdTelephone bigint NOT NULL IDENTITY(1,1),
	NumeroTelephone varchar(20) NOT NULL,
	primary key(IdTelephone)
);

create table adresse(
	IdAdresse bigint NOT NULL IDENTITY(1,1),
	LigneAdresse varchar(40) NOT NULL,
	CodePostal char(5) NOT NULL,
	Ville varchar(40) NOT NULL,
	primary key(IdAdresse)
);

create table personne(
	IdPersonne bigint NOT NULL IDENTITY(1,1),
	Nom varchar(20) NOT NULL,
	Prenom varchar(20) NOT NULL,
	IdAdresse bigint NOT NULL,
	primary key(IdPersonne)
);

create table personne_telephone(
	IdPersonne bigint NOT NULL,
	IdTelephone bigint NOT NULL,
	primary key(IdPersonne, IdTelephone)
);

alter table personne_telephone 
add foreign key (IdPersonne) references personne(IdPersonne);

alter table personne_telephone
add foreign key (IdTelephone) references telephone(IdTelephone);

alter table personne
add foreign key (IdAdresse) references adresse(IdAdresse);

--Question IV.2
--Bien chargé

--Question IV.3
insert into personne (Nom, Prenom, IdAdresse)
values('Girard', 'Pierre', '1'),
('Vigneau', 'Jean', '2'),
('Mercier', 'Gérard', '3'),
('Avron', 'Maurice', '4'),
('Vilminot', 'Thierry', '5'),
('Monti', 'Claudine', '6'),
('Mercier', 'Gérard', '7'),
('Avron', 'Catherine', '4'),
('Ferard', 'Pierre', '8');

insert into personne_telephone(IdPersonne,IdTelephone)
values('1', '1'),
('3', '2'),
('1', '3'),
('4', '4'),
('6', '5'),
('8', '4'),
('9', '7');


--Question IV.4
insert into adresse(LigneAdresse, CodePostal, Ville)
values('8 chemin de Cluzel', '31000', 'Toulouse'),
('7 rue Verget', '75005', 'Paris');

insert into personne(Nom, Prenom, IdAdresse)
values('Avron', 'Théo', '9'),
('Tortua', 'Carole', '10'),
('Tortua', 'Benoît', '10');

insert into telephone(NumeroTelephone)
values('0922584500'),
('0686914988');

insert into personne_telephone(IdPersonne,IdTelephone)
values('10', '8'),
('12', '9');



--Question IV.5.a
select IdPersonne, Nom, Prenom
from personne;

--Question IV.5.b
select IdPersonne,Nom, Prenom
from personne
where Prenom='Pierre';

--Question IV.5.c
select Ville
from adresse
order by Ville ASC;

--Question IV.5.d
select IdPersonne, Nom, Prenom, Ville
from personne, adresse;

--Question IV.5.e
select p.Nom, a.Ville
from personne as p
join adresse as a on p.IdAdresse = a.IdAdresse
where a.Ville in ('Paris', 'Lyon');

