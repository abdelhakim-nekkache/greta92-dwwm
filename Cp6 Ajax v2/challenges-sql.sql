SELECT now()
;

-- Challenge 1 : Liste des employés (titre, prenom, nom) concaténés,
-- âge, salaire (salaire + commission)
SELECT titre, nom, prenom, date_naissance, salaire, commission
FROM employes
;
--
SELECT CONCAT(titre, ' ', prenom, ' ', nom) AS Employee,
FLOOR(DATEDIFF(NOW(), date_naissance)/365.25) AS Age,
salaire+COALESCE(commission,0) AS Salaire
FROM employes
;

-- Challenge 2 : nom, prix unitaire et unites en stock 
-- des produits dont le code fournisseur n'est pas 1 ou 3 ou 5
-- et dont la quantité contient 'carton' ou 'bouteille' 
-- OU 
-- des produits dont le code catégorie est un multiple de 2
-- et soit disponible
SELECT nom_produit, prix_unitaire, unites_stock, no_fournisseur, quantite
FROM produits
-- WHERE (no_fournisseur != 1 AND no_fournisseur != 3 AND no_fournisseur != 5)
WHERE (no_fournisseur NOT IN (1, 3, 5) 
AND (quantite LIKE '%carton%' OR quantite LIKE '%bouteille%'))
-- OR (code_categorie IN (2,4,6,8))
OR (MOD(code_categorie,2) = 0
AND indisponible = 0)
;

-- Challenge 3 : combien y a-t'il de produits valant
-- moins de 50 EUR qui sont livrés en bouteille ?
SELECT *
FROM produits
WHERE prix_unitaire < 50
AND quantite LIKE '%bouteille%'
;

-- Challenge 4 : afficher le nom des produits, leur catégorie et
-- le nom du fournisseur pour les produits valant plus de
-- 25 EUR et provenant d'Italie, de France et d'Allemagne
SELECT p.nom_produit, c.nom_categorie, f.societe
FROM produits p
	JOIN categories c
		ON c.code_categorie = p.code_categorie
	JOIN fournisseurs f
		ON f.no_fournisseur = p.no_fournisseur
WHERE p.prix_unitaire > 25
AND f.pays IN ('Italie','France','Allemagne')
;

-- Challenge 5 : Liste des clients ayant acheté des produits fournis
-- par des sociétés japonaises, norvégiennes et brésiliennes
SELECT DISTINCT cl.societe
FROM clients cl
	JOIN commandes co
		ON cl.code_client = co.code_client
	JOIN details_commandes d
		ON co.no_commande = d.no_commande
	JOIN produits p
		ON d.ref_produit = p.ref_produit
	JOIN fournisseurs f
		ON p.no_fournisseur = f.no_fournisseur
WHERE f.pays IN ('Japon','Norvège','Brésil')
;

-- Challenge 6 : Qui a réalisé le meilleur CA en 2019 ?
SELECT e.prenom, 
		e.nom, 
		ROUND(SUM(d.prix_unitaire * d.quantite * (1 - d.remise)),2) AS CA
FROM employes e
	JOIN commandes c
		ON e.no_employe = c.no_employe
	JOIN details_commandes d
		ON c.no_commande = d.no_commande
WHERE YEAR(c.date_commande) = 2019
GROUP BY e.prenom, e.nom
ORDER BY CA DESC
LIMIT 1
;

-- Challenge 7 : Quel client a payé la plus grosse facture ?
SELECT cl.societe, 
		co.no_commande,
		SUM(d.prix_unitaire * d.quantite * (1 - d.remise)) + AVG(co.port) AS montant
FROM commandes co
	JOIN details_commandes d
		ON co.no_commande = d.no_commande
	JOIN clients cl
		ON cl.code_client = co.code_client
GROUP BY cl.societe, co.no_commande
ORDER BY montant DESC
LIMIT 1
;