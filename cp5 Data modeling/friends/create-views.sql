USE friends;

-- Affiche liste des contacts avec leur ville de résidence
SELECT c.prenom, v.nom
FROM villes v JOIN contacts c ON c.cp = v.cp
;

-- Nombre de contacts par ville
-- step 1
SELECT cp
FROM contacts
;
-- step 2
SELECT cp, COUNT(id)
FROM contacts
GROUP BY cp
;
-- step 3
SELECT v.nom, COUNT(c.id)
FROM villes v JOIN contacts c ON c.cp = v.cp
WHERE v.nom NOT LIKE '%a%'
GROUP BY v.nom
;
-- step 4
SELECT v.nom, COUNT(c.id)
FROM villes v JOIN contacts c ON c.cp = v.cp
GROUP BY v.nom
HAVING COUNT(id) > 1
;
-- step 5
SELECT v.nom, COUNT(c.id)
FROM villes v JOIN contacts c ON c.cp = v.cp
WHERE v.nom NOT LIKE '%a%'
GROUP BY v.nom
HAVING COUNT(id) > 1
ORDER BY v.nom
;

-- Liste des contacts Parisiens IM
SELECT c.prenom, v.nom
FROM villes v JOIN contacts c ON c.cp = v.cp
WHERE v.cp LIKE '75%'
;

-- Liste des contacts Parisiens GC
SELECT c.prenom, v.nom
FROM villes v JOIN contacts c ON c.cp = v.cp
WHERE SUBSTR(v.cp, 1, 2) IN ('77', '78', '91', '92', '93', '94', '95') 
;

SELECT SUBSTR('Emma aime la barbapapa et le chocolat', 14, 9)
;

-- Création objet VIEW  = Liste des contacts Parisiens GC
CREATE OR REPLACE VIEW paris_gc AS
	SELECT c.prenom, v.nom
	FROM villes v JOIN contacts c ON c.cp = v.cp
	WHERE SUBSTR(v.cp, 1, 2) IN ('77', '78', '91', '92', '93', '94', '95') 
;

SELECT *
FROM paris_gc
;