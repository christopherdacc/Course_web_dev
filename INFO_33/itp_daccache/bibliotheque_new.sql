CREATE DATABASE bibliotheque DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE bibliotheque;

CREATE TABLE auteur (
  IdAuteur bigint(20) NOT NULL AUTO_INCREMENT,
  Nom varchar(40) NOT NULL,
  Prenom varchar(40) NULL,
  PRIMARY KEY (IdAuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO auteur (IdAuteur, Nom, Prenom) VALUES
(1, 'Lemaitre', 'Pierre'),
(2, 'Nothomb', 'Amélie'),
(3, 'Salvayre', 'Lydie'),
(4, 'Juillard', 'André'),
(5, 'Sente', 'Yves'),
(6, 'Cothias', 'André'),
(7, 'Hawking', 'Stephen'),
(8, 'King', 'Stephen'),
(9, 'Hergé', NULL);

CREATE TABLE ouvrage (
  ISBN char(10) NOT NULL,
  Titre varchar(128) NOT NULL,
  Resume text NULL,
  PRIMARY KEY (ISBN)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO ouvrage (ISBN, Titre, Resume) VALUES
('2226249672', 'Au revoir là-haut', '« Pour le commerce, la guerre présente beaucoup d\'avantages, même après. »\r\n\r\nSur les ruines du plus grand carnage du XXe siècle, deux rescapés des tranchées, passablement abîmés, prennent leur revanche en réalisant une escroquerie aussi spectaculaire qu\'amorale. Des sentiers de la gloire à la subversion de la patrie victorieuse, ils vont découvrir que la France ne plaisante pas avec ses morts...\r\nFresque d\'une rare cruauté, remarquable par son architecture et sa puissance d\'évocation, Au revoir là-haut est le grand roman de l\'après-guerre de 14, de l\'illusion de l\'armistice, de l\'État qui glorifie ses disparus et se débarrasse de vivants trop encombrants, de l\'abomination érigée en vertu.\r\nDans l\'atmosphère crépusculaire des lendemains qui déchantent, peuplée de misérables pantins et de lâches reçus en héros, Pierre Lemaitre compose la grande tragédie de cette génération perdue avec un talent et une maîtrise impressionnants.'),
('225314911X', 'Mercure', 'Sur une île au large de Cherbourg, un vieil homme et une jeune fille vivent isolés, entourés de serviteurs et de gardes du corps, à l’abri de tout reflet ; en aucun cas Hazel ne doit voir son propre visage.\r\nEngagée pour soigner la jeune fille, Françoise, une infirmière, va découvrir pourquoi Hazel se résigne aux caresses du vieillard. Elle comprendra au prix de quelle implacable machination ce dernier assouvit un amour fou, paroxystique…\r\nAu cœur de ce huis clos inquiétant, Amélie Nothomb retrouve ses thèmes de prédilection : l’amour absolu et ses illusions, la passion indissociable de la perversité.'),
('2021116190', 'Pas pleurer', 'Deux voix entrelacées.\r\n\r\nCelle, révoltée, de Bernanos, témoin direct de la guerre civile espagnole, qui dénonce la terreur exercée par les Nationaux avec la bénédiction de l\'Église contre \"les mauvais pauvres\".\r\n\r\nCelle, roborative, de Montse, mère de la narratrice et \"mauvaise pauvre\", qui a tout gommé de sa mémoire, hormis les jours enchantés de l\'insurrection libertaire par laquelle s\'ouvrit la guerre de 36 dans certaines régions d\'Espagne, des jours qui comptèrent parmi les plus intenses de sa vie.\r\n\r\nDeux paroles, deux visions qui résonnent étrangement avec notre présent et qui font apparaître l\'art romanesque de Lydie Salvayre dans toute sa force, entre violence et légèreté, entre brutalité et finesse, porté par une prose tantôt impeccable, tantôt joyeusement malmenée.'),
('2870972423', 'Blake et Mortimer - Le testament de William S', NULL),
('2205070487', 'Les 7 vies de l\'épervier - Quinze ans après', 'La nouvelle époque, la troisième, des Sept vies de l\'Épervier commence en 1642. Ariane, Germain et Beau sont de retour après un long voyage sur continent nord-américain. La jeune femme est provoquée en duel par le vicomte de Roquefeuille, qu\'elle a autrefois elle-même gravement blessé. La jeune femme l\'éconduit, et les trois amis décident de quitter Paris en attendant que la situation se calme. Ils se rendent à Fougy, là même où Ariane fut internée et accoucha. Les souvenirs reviennent peu à peu, et Ariane découvre que sa fille, Ninon, a survécu malgré les conditions tragiques de sa naissance. Le groupe part à la recherche de l\'enfant, réveillant certaines blessures du passé, quinze ans après…\r\n'),
('2290006459', 'Une brève histoire du temps : Du Big Bang aux trous noirs', 'Voici le premier livre que Stephen Hawking ait écrit pour le grand public. Il y expose, dans un langage accessible à tous, les plus récentes découvertes des astrophysiciens. Retraçant les grandes théories du cosmos depuis Galilée jusqu\'à Einstein, racontant les ultimes découvertes en cosmologie, expliquant la nature des trous noirs, il propose ensuite de relever le plus grand défi de la science moderne : la recherche d\'une théorie permettant de concilier la relativité générale et la mécanique quantique. Stephen Hawking lutte depuis plus de vingt ans contre une maladie neurologique très grave. Malgré ce handicap, il a consacré sa vie à tenter de percer les secrets de l\'univers et à nous faire partager ses découvertes. Un livre fascinant.'),
('2226328718', 'Fin de ronde', 'Dans la chambre 217 de l\'hôpital Kiner Memorial, Brady Hartsfield, alias Mr Mercedes, gît dans un état végétatif depuis sept ans, soumis aux expérimentations du docteur Babineau.\r\n\r\nMais derrière son rictus douloureux et son regard fixe, Brady est bien vivant. Et capable de commettre un nouveau carnage sans même quitter son lit. Sa première pensée est pour Bill Hodges, son plus vieil ennemi ...'),
('2203136804', 'Tintin au pays des Soviets', 'Créée en 1929, cette première aventure de Tintin, mise en couleur, surprend par sa lisibilité nouvelle et moderne.\r\nDoté déjà d\'une énergie enthousiaste, Tintin prend sa personnalité physique quand il bondit dans une puissante voiture décapotable. Soucieux d\'exprimer la vitesse, Hergé relève la mèche de son front ... pour toujours.\r\nLe jeune auteur avait 21 ans et n\'avait jamais été initié au dessin. Il ne se doutait pas qu\'il venait de créer un héros qui deviendrait universel et mythique au cours de ses vingt-quatre aventures ...\r\nUne coédition Moulinsart et Casterman.');

CREATE TABLE auteur_ouvrage (
  IdAuteur bigint(20) NOT NULL,
  ISBN char(10) NOT NULL,
  PRIMARY KEY (IdAuteur,ISBN),
  FOREIGN KEY (IdAuteur) REFERENCES auteur (IdAuteur),
  FOREIGN KEY (ISBN) REFERENCES ouvrage (ISBN)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO auteur_ouvrage (IdAuteur, ISBN) VALUES
(1, '2226249672'),
(2, '225314911X'),
(3, '2021116190'),
(4, '2870972423'),
(4, '2205070487'),
(5, '2870972423'),
(6, '2205070487'),
(7, '2290006459'),
(8, '2226328718'),
(9, '2203136804');

CREATE TABLE utilisateur (
  IdUtilisateur bigint(20) NOT NULL AUTO_INCREMENT,
  Sexe char(1) NOT NULL,
  Nom varchar(100) NOT NULL,
  Prenom varchar(100) NOT NULL,
  Mail varchar(250) NOT NULL,
  Telephone varchar(20) NULL,
  Pseudo varchar(10) NOT NULL,
  Password varchar(255) NOT NULL,
  AboNewsletter tinyint(1) NOT NULL DEFAULT 0,
  Commentaire text NULL,
  PRIMARY KEY (IdUtilisateur),
  UNIQUE KEY Pseudo (Pseudo),
  UNIQUE KEY Mail (Mail)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO utilisateur (IdUtilisateur, Sexe, Nom, Prenom, Mail, Telephone, Pseudo, Password, AboNewsletter, Commentaire) VALUES
(1, 'H', 'Administrateur', 'Administrateur', 'admin@univ-reims.fr', '03 26 91 30 00', 'admin', '$2y$10$nAxwKHv2rOUNc8/I1EyGNe5AZg0rli1ifImdIaSmsoA9zHItV6z2q', 0, NULL),
(2, 'H', 'Simpson', 'Bart', 'bartsim@springfield.net', NULL, 'bartsim', '$2y$10$fKop0Kf5c3Dpn7dYz6yYQeGOvx3wFE2Iqj2ckmuUjSkt/Hn6KiGru', 1, 'Ay, caramba!'),
(3, 'F', 'Stark', 'Arya', 'arya@winterfell.com', NULL, 'faceless', '$2y$10$iB4T4o3g5mCrrU.FVg9BY.SV0s4MxjlZ4m3c//0c2OiBNoSNcnXQ.', 1, 'Winter is coming !'),
(4, 'H', 'Adams', 'Douglas', 'adams@galaxy.com', NULL, 'dougadams', '$2y$10$BK9Of4ovwzD/7Ft9.DxrHeQnWyLdm23q4WaCnmqbpxYWs7mtozPEG', 0, NULL),
(5, 'H', 'Dusse', 'Jean-Claude', 'jc@clubmed.com', '+33 1 7892 4005 ', 'jcdusse', '$2y$10$IERnNDbZz0S90P7Sx4GRc.lBVBYgibtz74avhddHz4AEjd72GtcIq', 1, NULL),
(6, 'H', 'White', 'Walter', 'ww@polloshermanos.com', '1 505 842 9635', 'waltwhite', '$2y$10$5.poKsFWF1vFEbt6mjzONOir8uC3DgTtV0VUgENRj6x6o/EqdpCQu', 0, 'Stay out of my territory'),
(7, 'H', 'Mulder', 'Fox', 'fox@fbi.com', '+1 5405096995', 'mulder', '$2y$10$3YvU9mYbl7qpcOZR4tx.g.sm7jyNQoFoBZ6iIJir2pIM6XYeF.1xW', 0, NULL),
(8, 'F', 'Hofstadter', 'Penny', 'penny@pasadena.com', NULL, 'pennyh', '$2y$10$O7qGHTVYjAyMzsrl9K0V5eBbVAMZimGfupZpQ3yMtvTlRsoC4BBAS', 1, ''),
(9, 'H', 'Doe', 'John', 'johndoe@nowhere.com', NULL, 'johndoe', '$2y$10$O.y8QIxvyvLo7DmuTrGMOuP0FJjNJvMfIAj1HTVktB8jsrYV1.1r.', 1, NULL),
(10, 'F', 'Musquin', 'Marie-Ange', 'madame.musquin@sosamitie.fr', '01 02 03 04 05', 'mamusquin', '$2y$10$4MjBa1PPuEBEL9UJIgVsD.Q451EqcCpb7.vj/0FNklCZ1Q8wAlcVO', 0, 'Présidente de l\'association SOS Détresse Amitié'),
(11, 'F', 'Doe', 'Jane', 'janedoe@nowhere.com', NULL, 'janedoe', '$2y$10$Q92ZekUaJ3IQzRVhekNZyuhyOi3xTYqq5fH/tF6pz9MtmYvqaDVFW', 0, '');

CREATE TABLE exemplaire (
  Numero bigint(20) NOT NULL AUTO_INCREMENT,
  DateAchat date NOT NULL,
  Empl char(2) NOT NULL,
  ISBN char(10) NOT NULL,
  IdEmpr bigint(20) NULL,
  DateEmpr date NULL,
  PRIMARY KEY (Numero),
  FOREIGN KEY (ISBN) REFERENCES ouvrage (ISBN),
  FOREIGN KEY (IdEmpr) REFERENCES utilisateur (IdUtilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO exemplaire (Numero, DateAchat, Empl, ISBN, IdEmpr, DateEmpr) VALUES
(1022, '2016-10-03', 'G6', '225314911X', NULL, NULL),
(1029, '2016-10-14', 'F3', '2226249672', 2, '2024-10-31'),
(1030, '2016-10-14', 'F3', '2226249672', 5, '2024-11-02'),
(1032, '2016-10-14', 'G5', '225314911X', NULL, NULL),
(1045, '2016-11-02', 'F3', '2021116190', 5, '2024-11-02'),
(1067, '2016-11-22', 'G5', '225314911X', NULL, NULL),
(1092, '2017-03-09', 'G8', '2226328718', 5, '2024-11-02'),
(1095, '2017-03-21', 'G8', '2870972423', NULL, NULL),
(1096, '2017-03-21', 'G8', '2205070487', 2, '2024-11-07'),
(1097, '2017-03-21', 'G7', '2870972423', 2, '2024-11-07'),
(1098, '2018-04-06', 'G9', '2870972423', NULL, NULL),
(1099, '2018-04-06', 'G8', '225314911X', NULL, NULL),
(1100, '2024-10-15', 'G7', '2205070487', 8, '2024-11-04'),
(1101, '2024-10-15', 'G7', '2205070487', NULL, NULL),
(1102, '2024-10-30', 'G7', '2870972423', NULL, NULL),
(1103, '2025-02-06', 'G8', '2203136804', NULL, NULL);

ALTER TABLE auteur AUTO_INCREMENT = 10;

ALTER TABLE utilisateur AUTO_INCREMENT = 12;

ALTER TABLE exemplaire AUTO_INCREMENT = 1104;

--  Création d'une vue pour afficher la liste des exemplaires disponibles
--  avec Titre et Auteurs afin de simplifier l'écriture de la requête en PHP
--  dans le script emprunt.php

create view exemplaires_titre_auteurs_disponibles as
select concat('\"' , Titre , '\" , ', 
  ( select group_concat(a.Nom,' ',coalesce(a.Prenom,'') separator ', ') as 'Auteurs' 
    from auteur a inner join auteur_ouvrage ao
      on ao.IdAuteur = a.IdAuteur inner join ouvrage o
        on ao.ISBN = o.ISBN
    where o.ISBN = exemplaire.ISBN	
    group by o.ISBN )
  , ' (Emplacement : ' , Empl , ')') TitreAuteurs, Numero
from ouvrage inner join exemplaire on exemplaire.ISBN = ouvrage.ISBN 
where exemplaire.IdEmpr is null
order by TitreAuteurs;