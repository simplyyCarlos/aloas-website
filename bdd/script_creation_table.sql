USE Aloas;

DROP TABLE IF EXISTS articles; 
DROP TABLE IF EXISTS evenements; 
DROP TABLE IF EXISTS utilisateurs; 
DROP TABLE IF EXISTS types_articles; 
DROP TABLE IF EXISTS disciplines; 


CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mail VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE types_articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
	libelle varchar(255) NOT NULL
);

CREATE TABLE disciplines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur INT NOT NULL,
    date_de_parution DATE NOT NULL,
    type_article INT NOT NULL,
    FOREIGN KEY (auteur) REFERENCES utilisateurs(id),
    FOREIGN KEY (type_article) REFERENCES types_articles(id)
);

CREATE TABLE evenements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    discipline INT NOT NULL,
    createur INT NOT NULL,
    date_creation DATE NOT NULL,
    date_debut_evenement DATETIME NOT NULL,
    date_fin_evenement DATETIME NOT NULL,
    FOREIGN KEY (discipline) REFERENCES disciplines(id),
    FOREIGN KEY (createur) REFERENCES utilisateurs(id)
);