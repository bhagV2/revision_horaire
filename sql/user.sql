--
-- User: `horaireUSer`
--
DROP USER IF EXISTS 'horaireUser'@'localhost';
CREATE USER 'horaireUser'@'localhost' IDENTIFIED BY 'horaireSuper';

GRANT INSERT ON horaire.* TO 'horaireUser'@'localhost';
GRANT SELECT ON horaire.* TO 'horaireUser'@'localhost';
GRANT UPDATE ON horaire.* TO 'horaireUser'@'localhost';
GRANT DELETE ON horaire.* TO 'horaireUser'@'localhost';

DROP USER IF EXISTS 'horaireUser'@'%';
CREATE USER 'horaireUser'@'%' IDENTIFIED BY 'horaireSuper';

GRANT INSERT ON horaire.* TO 'horaireUser'@'%';
GRANT SELECT ON horaire.* TO 'horaireUser'@'%';
GRANT UPDATE ON horaire.* TO 'horaireUser'@'%';
GRANT DELETE ON horaire.* TO 'horaireUser'@'%';