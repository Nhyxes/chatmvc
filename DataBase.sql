-- Création de la base de données
CREATE
DATABASE IF NOT EXISTS messagerie;

-- Utilisation de la base de données
USE
messagerie;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users
(
    id
    INT
    AUTO_INCREMENT
    PRIMARY
    KEY,
    username
    VARCHAR
(
    255
) NOT NULL,
    password VARCHAR
(
    255
) NOT NULL,
    email VARCHAR
(
    255
) NOT NULL
    );

-- Table des salons (rooms)
CREATE TABLE IF NOT EXISTS rooms
(
    id
    INT
    AUTO_INCREMENT
    PRIMARY
    KEY,
    name
    VARCHAR
(
    255
) NOT NULL
    );
