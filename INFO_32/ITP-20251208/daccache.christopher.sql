-- INFO32	Interrogation de TP
--
-- Nom : Daccache
-- Prénom : Christopher
-- N° de PC : 08
-- 
-- *************************************
-- Remarque : Veuillez indiquer clairement le numéro de la question
--            correspondant à la requête SQL
-- *************************************

-- I. Extraction de données
-- I.1
use clicom;
select Distinct CAT 
from client
where CAT !='NULL'
order by CAT DESC;

-- I.2
select NCli, Nom
from client
where ville = 'Toulouse' and CAT is NULL;

-- I.3
select sum(QCom) as 'Quantité totale'
from detail
where NPro = 'CLE22';

-- I.4
select distinct CAT as 'Catégorie', count(CAT) as 'Nombre de clients'
from client
where CAT !='NULL'
group by CAT
order by CAT ASC;

-- I.5
select c.NCom, cl.NCli, cl.CAT
from commande as c
join client as cl on c.NCli = cl.NCli
where cl.CAT = 'C1';

-- I.6
select distinct (cl.CAT)
from client as cl
join commande as c on cl.NCli = c.NCli
join detail as d on c.NCom = d.NCom
where d.NPro like '%CLA%';

-- II. Modification de la structure de la base
-- II.2
--Création de la table categoriec
create table categoriec(
	CAT char(2) not null,
	DesignationCat varchar(40) not null,
	primary key(CAT)
);

--Création de la table categorisation
create table categorisation(
	NCli varchar(10) not null,
	CAT char(2) not null,
	primary key (NCli, CAT),
	foreign key (NCli) references client (NCli),
	foreign key (CAT) references categoriec (CAT)
);
--Modification de la table client
alter table client drop column CAT;

-- II.3
insert into categoriec (CAT, DesignationCat)
values ('B1', 'Nouveau client n''ayant jamais commandé'),
('B2', 'Client occasionnel'),
('C1', 'Bon client'),
('C2', 'Très bon client'),
('D1', 'Mauvais payeur'),
('D2', 'Bon payeur');

-- II.4
insert into categorisation (NCli, CAT)
values ('B062', 'B2'),
('B112', 'C1'),
('B332', 'B2'),
('B332', 'D1'),
('B512', 'B1'),
('C003', 'B1'),
('C003', 'D2'),
('C123', 'C1'),
('C123', 'D2'),
('C400', 'B2'),
('C400', 'D1'),
('F010', 'C1'),
('F011', 'B2'),
('F400', 'C2'),
('F400', 'D1'),
('K111', 'B1'),
('L422', 'C1'),
('S127', 'C1'),
('S712', 'B1');

-- III.	Extraction de données dans la base modifiée
-- III.1
select NCli, count(CAT) as 'Nombres de catégories'
from categorisation
group by NCli;

-- III.2
select NCli
from categorisation
group by NCli
having count(CAT)=2;

-- III.3
select cl.NCli, count(cat.CAT) 'Nombres de catégories'
from client as cl
join categorisation as cat on cl.NCli = cat.NCli
group by cl.NCli;

-- III.4
select cat.NCli, catc.DesignationCat 
from categoriec as catc
join categorisation as cat on catc.CAT = cat.CAT
where cat.NCli = 'C400';

-- III.5
select cl.CP, catc.DesignationCat
from client as cl
join categorisation as cat on cl.NCli = cat.NCli
join categoriec as catc on cat.CAT = catc.CAT
where cl.CP like '%31%';