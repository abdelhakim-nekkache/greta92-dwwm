-- Supprime la BDD si existe
DROP DATABASE IF EXISTS friends
;

-- Création de la BDD
CREATE DATABASE friends
	DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

USE friends
;

-- Création de la table VILLES
CREATE TABLE villes(
	cp CHAR(5) PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
;

-- Ajoute une contrainte sur CP dans la table VILLES 
ALTER TABLE villes
	ADD CONSTRAINT ck_villes_cp CHECK (cp BETWEEN '01000' AND '95999')
;

-- Peuple la table VILLES
INSERT INTO villes(cp, nom) VALUES('92700', 'Colombes');
INSERT INTO villes(cp, nom) VALUES('92140', 'Clamart');
INSERT INTO villes(cp, nom) VALUES('95120', 'Ermont');
INSERT INTO villes(cp, nom) VALUES('93200', 'Saint-Denis');
INSERT INTO villes(cp, nom) VALUES('95610', 'Eragny');
INSERT INTO villes(cp, nom) VALUES('95140', 'Garges');
INSERT INTO villes(cp, nom) VALUES('92380', 'Garches');
INSERT INTO villes(cp, nom) VALUES('92400', 'Courbevoie');
INSERT INTO villes(cp, nom) VALUES('92600', 'Asnières');
INSERT INTO villes(cp, nom) VALUES('78260', 'Achères');
INSERT INTO villes(cp, nom) VALUES('75017', 'Paris');
-- INSERT INTO villes(cp, nom) VALUES('97110', 'Lapwent');
INSERT INTO villes(cp, nom) VALUES('06000', 'Nice');

-- Création de la table CONTACTS
CREATE TABLE contacts(
	id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    prenom VARCHAR(20) NOT NULL,
    mail VARCHAR(100) UNIQUE,
    ddn DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
;

-- Ajoute la clé étrangère CP à CONTACTS
ALTER TABLE contacts
	ADD COLUMN cp CHAR(5),
	ADD CONSTRAINT fk_contacts_cp FOREIGN KEY (cp) REFERENCES villes(cp)
;

-- Peuple la table CONTACTS
INSERT INTO contacts(prenom, ddn, cp) VALUES('Emma', '2000-09-26', '92140');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Asma', '2000-12-21', '92700');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Jérémy', '1988-10-14', '92380');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Kevin', '1995-10-25', '92600');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Hakim', '1996-05-11', '95610');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Jean-Marc', '1982-02-13', '92400');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Nathan', '1997-05-03', '78260');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Mohamed', '1991-07-24', '95140');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Samir', '1977-12-04', '93200');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Rémy', '1978-01-22', '92140');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Thomas', '1987-05-23', '75017');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Oihid', '1980-04-28', '92700');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Alex', '1998-03-15', '92700');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Aymane', '2001-01-10', '95120');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Aymen', '1993-06-15', '92400');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Lesly', '1967-11-11', '92700');
INSERT INTO contacts(prenom, ddn, cp) VALUES('Pierre', '1958-04-09', '06000');

-- Déduction du mail via mise à jour
SELECT *
FROM contacts
;

START TRANSACTION;

UPDATE contacts
SET mail = CONCAT(LOWER(REPLACE(prenom, 'é', 'e')), '@darons-coders.org')
WHERE id>0
;

-- ROLLBACK;
COMMIT;