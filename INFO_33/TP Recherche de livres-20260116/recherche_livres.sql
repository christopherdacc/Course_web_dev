--  Requête de recherche de livres
--  Critères de recherche :
--  par auteur : "Juillard STephen"
--  et par titre : "BLAKE au"

select Titre, 
  ( select group_concat(coalesce(a.Prenom,''),' ',a.Nom separator ', ') 
    from auteur a inner join auteur_ouvrage ao
      on ao.IdAuteur = a.IdAuteur
    where ao.ISBN = ouvrage.ISBN	
    group by ao.ISBN ) Auteurs, ISBN
from ouvrage
where
isbn in ( select distinct ao.isbn
         from auteur_ouvrage ao inner join auteur a on a.IdAuteur = ao.IdAuteur
         where lower(Nom) like '%juillard%' or lower(Prenom) like '%juillard%'
            or lower(Nom) like '%stephen%' or lower(Prenom) like '%stephen%'
)
and
isbn in ( select distinct o.isbn
          from ouvrage o
          where lower(Titre) like '%blake%' or lower(Titre) like '%au%'
)
order by Titre;