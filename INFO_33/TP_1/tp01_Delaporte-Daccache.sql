--Question II.2
DROP DATABASE `essai`; 

--Question III.1
CREATE TABLE `familles`.`parents` (`CodeFamille` BIGINT NOT NULL , `Nom` VARCHAR(40) NOT NULL , `PrenomPere` VARCHAR(40) NOT NULL , `PrenomMere` VARCHAR(40) NOT NULL , `Adresse1` VARCHAR(40) NOT NULL , `Adresse2` VARCHAR(40) NULL , `CodePostal` CHAR(5) NOT NULL , `Ville` VARCHAR(40) NOT NULL , `ProfPere` VARCHAR(40) NULL , `ProfMere` VARCHAR(40) NULL , `TelDom` VARCHAR(20) NULL , `PortPere` VARCHAR(20) NULL , `PortMere` VARCHAR(20) NULL , `Email` VARCHAR(60) NULL , PRIMARY KEY (`CodeFamille`)) ENGINE = InnoDB;
CREATE TABLE `familles`.`enfant` (`CodeFamille` BIGINT NOT NULL , `Prenom` VARCHAR(40) NOT NULL , `Sexe` CHAR(1) NOT NULL , `DateNaissance` DATE NOT NULL , PRIMARY KEY (`CodeFamille`, `Prenom`)) ENGINE = InnoDB;
--Question III.2
CREATE TABLE `bibliotheque`.`livre` (`Numero` INT(4) NOT NULL , `Titre` VARCHAR(40) NOT NULL , `Auteurs` VARCHAR(40) NOT NULL , `ISBN` BIGINT NOT NULL , `DateAchat` DATE NOT NULL , `Empl` VARCHAR(2) NOT NULL , PRIMARY KEY (`Numero`)) ENGINE = InnoDB;
--Question III.3
CREATE TABLE `clicom`.`client` (`NCli` BIGINT NOT NULL , `Nom` VARCHAR(20) NOT NULL , `Adresse` VARCHAR(40) NOT NULL , `CP` CHAR(5) NOT NULL , `Ville` VARCHAR(40) NOT NULL , `Cat` CHAR(2) NOT NULL , `Compte` DECIMAL(6,2) NOT NULL , PRIMARY KEY (`NCli`)) ENGINE = InnoDB;
CREATE TABLE `clicom`.`commande` (`NCom` BIGINT NOT NULL , `NCli` BIGINT NOT NULL , `DateCom` DATE NOT NULL , PRIMARY KEY (`NCom`)) ENGINE = InnoDB;
CREATE TABLE `clicom`.`produit` (`NPro` CHAR(5) NOT NULL , `Libelle` VARCHAR(60) NOT NULL , `PrixHT` DECIMAL(5,2) NOT NULL , `QStock` INT(3) NOT NULL , PRIMARY KEY (`NPro`)) ENGINE = InnoDB;
CREATE TABLE `clicom`.`detail` (`NCom` BIGINT NOT NULL , `NPro` CHAR(5) NOT NULL , `QCom` INT(1) NOT NULL , PRIMARY KEY (`NCom`, `NPro`)) ENGINE = InnoDB;
--Question IV.1
ALTER TABLE `enfant` ADD `TelPort` VARCHAR(40) NULL AFTER `Prenom`;
ALTER TABLE `enfant` ADD `Test` VARCHAR(40) NOT NULL AFTER `DateNaissance`;
--Question IV.2
ALTER TABLE `enfant` CHANGE `TelPort` `TelPort` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
--Question IV.3
ALTER TABLE `enfant`
  DROP `Test`;
--Question IV.4
ALTER TABLE `commande` ADD INDEX(`NCli`);
ALTER TABLE `detail` ADD INDEX(`NCom`, `NPro`);
--Question V.1
INSERT INTO `livre` (`Numero`, `Titre`, `Auteurs`, `ISBN`, `DateAchat`, `Empl`) VALUES ('1029', 'Au revoir là-haut', 'Lemaitre Piere', '2226249672', '2016-10-14', 'F3');
INSERT INTO `livre` (`Numero`, `Titre`, `Auteurs`, `ISBN`, `DateAchat`, `Empl`) VALUES ('1030', 'Au revoir là-haut', 'Lemaitre Piere', '2226249672', '2016-10-14', 'F3');
INSERT INTO `livre` (`Numero`, `Titre`, `Auteurs`, `ISBN`, `DateAchat`, `Empl`) VALUES ('1032', 'Mercure', 'Nothomb Amélie', '225314911', '2016-10-14', 'G5');
INSERT INTO `livre` (`Numero`, `Titre`, `Auteurs`, `ISBN`, `DateAchat`, `Empl`) VALUES ('1045', 'Pas pleurer', 'Salvayre Lydie', '2021116190', '2016-02-22', 'F3');
INSERT INTO `livre` (`Numero`, `Titre`, `Auteurs`, `ISBN`, `DateAchat`, `Empl`) VALUES ('1067', 'Mercure', 'Nothomb Amélie', '225314911', '2016-04-22', 'G5');
INSERT INTO `livre` (`Numero`, `Titre`, `Auteurs`, `ISBN`, `DateAchat`, `Empl`) VALUES ('1022', 'Mercure', 'Nothomb Amélie', '225314911', '2016-10-03', 'G6');
--Ceci est fastidieux car on doit insérer les données une par une. Ceci va prendre du temps si nous avons une table avec beaucoup plus de livres. Et on a plusieurs 
--fois le même livre. On a une redondance d'information, il faut faire une normalisation pour résoudre ce problème.
--Question V.2
--Modification du type 
ALTER TABLE `client` CHANGE `NCli` `NCli` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `commande` CHANGE `NCli` `NCli` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
SELECT * FROM `client`
--Table client.csv
ALTER TABLE `client` CHANGE `Cat` `Cat` CHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
INSERT INTO `client` VALUES ('B062', 'Girard', '72 rue de la Gare', '69001', 'Lyon', 'B2', '-3200.00');
INSERT INTO `client` VALUES ('B112', 'Herbin', '23 allée Dumont', '86000', 'Poitiers', 'C1', '1250.00');
INSERT INTO `client` VALUES ('B332', 'Monti', '112 rue Neuve', '06000', 'Nice', 'B2', '0.00');
INSERT INTO `client` VALUES ('B512', 'Gillet', '14 rue d\''El Alamein', '31000', 'Toulouse', 'B1', '-8700.00');
INSERT INTO `client` VALUES ('C003', 'Avron', '8 chemin de Cluzel', '31000', 'Toulouse', 'B1', '-1700.00');
INSERT INTO `client` VALUES ('C123', 'Mercier', '25 rue Lemaitre', '69003', 'Lyon', 'C1', '-2300.00');
INSERT INTO `client` VALUES ('C400', 'Ferard', '65 rue du Touffenet', '86000', 'Poitiers', 'B2', '350.00');
INSERT INTO `client` VALUES ('D063', 'Mercier', '201 boulevard du Nord', '31000', 'Toulouse', NULL, '-2250.00');
INSERT INTO `client` VALUES ('F010', 'Toussaint', '5 rue Girouard', '86000', 'Poitiers', 'C1', '0.00');
INSERT INTO `client` VALUES ('F011', 'Poncelet', '17 Clos des Erables', '31000', 'Toulouse', 'B2', '0.00');
INSERT INTO `client` VALUES ('F400', 'Jacob', '78 chemin du Moulin', '33000', 'Bordeaux', 'C2', '0.00');
INSERT INTO `client` VALUES ('K111', 'Vigneau', '18 rue Faraday', '59000', 'Lille', 'B1', '720.00');
INSERT INTO `client` VALUES ('K729', 'Noirot', '40 rue Fines', '31000', 'Toulouse', NULL, '0.00');
INSERT INTO `client` VALUES ('L422', 'Franck', '60 rue Bellecordière', '69003', 'Lyon', 'C1', '0.00');
INSERT INTO `client` VALUES ('S127', 'Vilminot', '3 avenue des Roses', '69001', 'Lyon', 'C1', '-4580.00');
INSERT INTO `client` VALUES ('S712', 'Guillaume', '14a chemin des Roses', '75013', 'Paris', 'B1', '0.00');
--Table commande.csv
INSERT INTO `commande` VALUES ('30178', 'K111', '2019-12-21');
INSERT INTO `commande` VALUES ('30179', 'C400', '2019-12-22');
INSERT INTO `commande` VALUES ('30182', 'S127', '2019-12-23');
INSERT INTO `commande` VALUES ('30184', 'C400', '2019-12-23');
INSERT INTO `commande` VALUES ('30185', 'F011', '2020-01-02');
INSERT INTO `commande` VALUES ('30186', 'C400', '2020-01-02');
INSERT INTO `commande` VALUES ('30188', 'B512', '2020-01-03');
--Table detail.csv
INSERT INTO `detail` VALUES ('30178', 'CLA13', '5');
INSERT INTO `detail` VALUES ('30179', 'CLA11', '6');
INSERT INTO `detail` VALUES ('30179', 'CLE22', '2');
INSERT INTO `detail` VALUES ('30182', 'CLE22', '3');
INSERT INTO `detail` VALUES ('30184', 'CLA13', '2');
INSERT INTO `detail` VALUES ('30184', 'CLE21', '2');
INSERT INTO `detail` VALUES ('30185', 'CLA13', '6');
INSERT INTO `detail` VALUES ('30185', 'CLE22', '5');
INSERT INTO `detail` VALUES ('30185', 'SCA06', '6');
INSERT INTO `detail` VALUES ('30186', 'CLE21', '3');
INSERT INTO `detail` VALUES ('30188', 'CLA13', '8');
INSERT INTO `detail` VALUES ('30188', 'CLE21', '2');
INSERT INTO `detail` VALUES ('30188', 'CLE22', '7');
INSERT INTO `detail` VALUES ('30188', 'IMP01', '2');
--Table produit.csv
INSERT INTO `produit` VALUES ('CLA11', 'Logitech G910 Orion Spectrum RGB', '149.96', '227');
INSERT INTO `produit` VALUES ('CLA12', 'Logitech Wireless Solar Keyboard K750', '74.96', '124');
INSERT INTO `produit` VALUES ('CLA13', 'Microsoft Wireless Comfort Desktop 5050', '56.54', '75');
INSERT INTO `produit` VALUES ('CLE21', 'SanDisk Extreme Go USB 3.1- 64 Go', '41.63', '121');
INSERT INTO `produit` VALUES ('CLE22', 'Corsair Flash Voyager USB 3.0 16 Go', '14.58', '70');
INSERT INTO `produit` VALUES ('IMP01', 'Imprimante laser Canon i-SENSYS LBP113W', '95.79', '117');
INSERT INTO `produit` VALUES ('SCA06', 'SCA06 Scanner Canon CanoScan LiDE 300', '58.29', '44');
--Question VI.1
SELECT `client`.`NCli`, `client`.`Nom`, `client`.`Ville`
FROM `client`;
--Question VI.2
SELECT `client`.`Ville` FROM `client` ORDER BY `client`.`Ville` ASC
SELECT DISTINCT `client`.`Ville` FROM `client` ORDER BY `client`.`Ville` ASC
--Question VI.3
SELECT `client`.`Nom`, `client`.`NCli`
FROM `client`
WHERE `client`.`Ville` = 'Toulouse';
--Question VI.4
SELECT `client`.`Nom`, `client`.`NCli`, `client`.`Ville` FROM `client` WHERE `client`.`Ville` = 'Toulouse' || `client`.`Ville` = 'Lyon' ORDER BY `Ville` ASC
--Question VI.5