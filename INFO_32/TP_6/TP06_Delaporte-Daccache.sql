--Question III.1.a
create view v_prod as
Select
    concat(categorie.CatPro, '-', produit.NPro) as ref,
    substring(produit.Libelle, 1, 10) as libelle,
    produit.PrixHT as prix
from produit
join categorie on produit.CatPro = categorie.CatPro;

--Question III.1.b
insert into produit (NPro, Libelle, PrixHT, CatPro)
values ('SOU21', 'Microsoft Sculpt Comfort Mouse', 24.95, 103);

--Question III.2
create view habitude_achat as
Select
    client.Ville,
    detail.NPro as NumeroProduit,
    sum(detail.QCom * produit.PrixHT) as MontantTotal
from client
join commande on client.NCli = commande.NCli
join detail on commande.NCom = detail.NCom
join produit on detail.NPro = produit.NPro
group by client.Ville, detail.NPro;
Select * from habitude_achat;

--Question IV.1
create function nbre_cde(@nocli int) 
returns int 
as
begin
    declare @nbre int;

    Select @nbre = count(*)
    from commande
    where NCli = @nocli;

    return @nbre;
end;
select dbo.nbre_cde(3);

--Question IV.2
create function produits_prix_inf(@prix_sel float)
returns table
as return(
    Select NPro,PrixHT
    from produit
    where PrixHT < @prix_sel
);
Select *
from produits_prix_inf(50.0);

--Question IV.3
create function analyse_client(@ClientID int)
returns @Resultat table (
    Libelle VARCHAR(50),
    Valeur VARCHAR(50)
)
as
begin
    declare @MontantTotal float;

    -- Calcul du montant total des commandes du client
    select @MontantTotal = sum(facture.MontantHT)
    from commande
    join facture on commande.NCom = facture.NCom
    where NCli = @ClientID;
    

    -- Insertion des lignes dans la table résultat
    insert into @Resultat (Libelle, Valeur)
    values 
        ('Nombres de commande', cast(dbo.nbre_cde(@ClientID) as VARCHAR(50))),
        ('Montant total des commandes', cast(isnull(@MontantTotal,0) as VARCHAR(50)));

    return;
end;
Select * from analyse_client(1);

--Question V.1.a
create procedure supp_cli
    @ClientID int
as
begin
    set nocount on;

    -- Vérifie si le client existe
    if not exists (select 1 from client where NCli = @ClientID)
    begin
        print 'Le client n''existe pas.';
        return;
    end

    -- Vérifie si le client a passé des commandes
    if exists (select 1 from commande where NCli = @ClientID)
    begin
        print 'Le client a des commandes. Suppression impossible.';
        return;
    end

    -- Suppression du client
    delete from client
    where NCli = @ClientID;

    print 'Client supprimé avec succès.';
end;

--Question V.1.b
exec supp_cli 30;

--Question VI.1
create trigger ins_cde_date on commande
after insert as
begin
    set nocount on;
    update c
    set DateCom = getdate()
    from commande as c
    inner join inserted i on c.NCom = i.NCom;
end;

--Question VI.2
create trigger ins_cde_taux
on commande
after insert
as
begin
    set nocount on;

    declare @ClientID int;
    declare @NombreCommandes int;

    -- Récupérer l'ID du client de la commande insérée
    select @ClientID = NCli
    from inserted;

    -- Calculer le nombre de commandes déjà passées par le client
    select @NombreCommandes = count(*)
    from commande
    where NCli = @ClientID;

    -- Mettre à jour le taux de remise si le client a au moins 10 commandes
    if @NombreCommandes >= 10
    begin
        update commande
        set TauxRemise = 5 
        where NCom = (select NCom from inserted);
    end
end;

--Question VI.3
insert into commande (NCli)
values (2);
insert into commande (NCli)
values (3);