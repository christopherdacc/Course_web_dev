--Question II.1
Select Ncli, Nom, Prenom, Adresse, CP, Ville, Telephone
from client
order by nom, prenom, ville ASC;
--Question II.2
Select Ncom, DateCom
from commande
where Ncli = 1;
--Question II.3
Select Nom 
from client 
where CP like '%44%';
--Question II.4
Select Ncli, Nom, Prenom
from client
where Prenom like 'No_m%' 
and (Ville is null or ville like 'N%');
--Question II.5
Select Nom,
	COALESCE(Prenom, '?') as Prenom
from client
where ville = 'Nantes';
--Question II.6
Select NPro, Libelle, PrixHT
from produit
where PrixHT+(PrixHT*0.196) <=100;
--Question II.7
Select NCom, DateCom
from commande
where month(DateCom) = 3
  AND year(DateCom) >= year(getdate())-4;
--Question II.8
Select NPro, PrixHT, 
	PrixHT+(PrixHT*0.196) as "Prix + 10%"
from produit;
--Question II.9
Select Nom + Prenom as NomPrenom, 
	left(CP, 2) as Departement
from client;
--Question II.10 a
Select distinct Ville
from client
--Question II.10 b
Select Ville
from client
group by ville;
--Question II.11
Select Ville, CP
from client
group by Ville, CP;
--Question II.12
Select Ville ,count(distinct CP) as "Nombre de CP"
from client
group by Ville;
--Question II.13
Select
    min(PrixHT) as "Prix Minimum",
    avg(PrixHT) as "Prix Moyen",
    max(PrixHT) as "Prix Max"
from produit;
--Question II.14
Select NPro, sum(QStock) as "Quantité totale"
from stock
group by NPro;
--Question II.15
Select left(CP,2) as "Département"
from client
group by left(CP,2)
having count(*) >= 2; 
--Question II.16
Select distinct c.NCli, c.Nom, c.Prenom, com.NCom, com.DateCom, p.NPro, p.PrixHT, s.QStock
from client as c
join commande as com on c.NCli = com.NCli
join detail as d on com.NCom = d.NCom
join produit as p on d.NPro = p.NPro
join stock as s on d.NPro = s.Npro;
--Question II.17
Select top 3  com.NCom, f.MontantHT
from commande as com
join facture as f on com.NCom = f.NCom
order by f.MontantHT desc;
--Question II.18
Select top 5 percent  com.NCom, f.MontantHT
from commande as com
join facture as f on com.NCom = f.NCom
order by f.MontantHT desc;
--Question II.19
Select distinct p.NPro, p.PrixHT, cat.LibelleCatPro, s.Depot, sum(s.QStock) as "Quantité totale"
from produit as p
join stock as s on p.NPro = s.Npro
join categorie as cat on p.CatPro = cat.CatPro
where s.Depot = 'N' or s.Depot = 'P1'
GROUP BY s.Depot, cat.LibelleCatPro, p.NPro, p.PrixHT;
--Question II.20
Select com.NCom, com.DateCom, com.TauxRemise, com.NCli, com.EtatCom
from commande as com
join client as c on com.Ncli = c.NCli
where Nom = 'Kornu';
--Question II.21
Select CatPro, LibelleCatPro
from categorie
where LibelleCatPro like 'Cl%';
--Question II.22 a
Select NPro
from detail
where NPro not in (
	Select NPro
	from produit);
--Question II.22 b
Select d.NPro
from detail as d
join produit as p on d.NPro = p.NPro
where not exists (
    select 1
    from detail as d
    where d.NPro = p.NPro
);
--Question II.23
Select p.NPro, p.Libelle, p.PrixHT, cat.LibelleCatPro
from produit as p 
join categorie as cat on p.CatPro = cat.CatPro
--Question II.24
Select distinct c.NCli, c.Nom, com.NCom
from client as c 
join commande as com on c.NCli = com.Ncli;
--Question II.25
Select NPro, PrixHT
from produit
where PrixHT in (
    Select PrixHT
    from produit
    group by PrixHT
    having count(*) > 1
)
order by PrixHT, NPro;