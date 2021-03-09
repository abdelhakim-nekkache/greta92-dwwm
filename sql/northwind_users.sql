USE northwind
;

-- Création de la table users
DROP TABLE IF EXISTS users
;

CREATE TABLE users (
	mail VARCHAR(255) PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    land VARCHAR(100),
    active INT -- DEFAULT 1
) ENGINE=InnoDB
;

-- Ajoute 3 users : admin, reader, writer
INSERT INTO users(mail, fname, pass, land, active)
VALUES('root@localhost.org', 'root', 'secret', null, 1)
;

INSERT INTO users(mail, fname, pass, land, active)
VALUES('jean@localhost.org', 'jean', 'secret', null, 1)
;

INSERT INTO users(mail, fname, pass, land, active)
VALUES('karima@localhost.org', 'karima', 'secret', null, 1)
;

-- Cryptage du mail et du mot de passe
-- Mail : MD5(mail)
-- Pass : SHA2(CONCAT(SHA1(pass), mail), 512)
UPDATE users
SET mail = MD5(mail),
pass = SHA2(CONCAT(SHA1(pass), mail), 512)
WHERE mail <> ''
;

SELECT *
FROM users
;

-- Tests
-- karima@localhost.org
-- secret
SELECT * 
FROM users
WHERE mail = 'karima@localhost.org'
AND pass = 'secret'
;
-- Devient
SELECT * 
FROM users
WHERE mail = MD5('karima@localhost.org')
AND pass = SHA2(CONCAT(SHA1('secret'), MD5('karima@localhost.org')), 512) 
;