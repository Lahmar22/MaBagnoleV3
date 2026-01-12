CREATE DATABASE MaBagnole;
use MaBagnole;

CREATE TABLE utilisateur(
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(60),
    prenom VARCHAR(60),
    email VARCHAR(100),
    PASSWORD VARCHAR(100)
); 

CREATE TABLE administrator(
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(60),
    prenom VARCHAR(60),
    email VARCHAR(100),
    PASSWORD VARCHAR(100)
); 

CREATE TABLE categorie(
    id_Categorie INT PRIMARY KEY AUTO_INCREMENT,
    nomCategorie VARCHAR(100),
    description_categorie TEXT
); 

CREATE TABLE vehicule(
    id_Vehicule INT PRIMARY KEY AUTO_INCREMENT,
    modele VARCHAR(100),
    marque VARCHAR(100),
    prixParJour VARCHAR(60),
    description TEXT,
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie (id_Categorie)
); 


CREATE TABLE reservation(
    id_Reservation INT PRIMARY KEY AUTO_INCREMENT,
    dateDebut DATETIME,
    dateFin DATETIME,
    lieuPrise VARCHAR(60),
    lieuRetour VARCHAR(60),
    statut VARCHAR(60) DEFAULT 'En attente',
    id_vehicule INT,
    id_utilisateur INT,
    FOREIGN KEY (id_vehicule) REFERENCES vehicule (id_Vehicule),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
);

CREATE TABLE avis(
    id_Avis INT PRIMARY KEY AUTO_INCREMENT,
    note INT,
    commentaire TEXT,
    dateAvis DATETIME,
    isDeleted VARCHAR(60),
    description TEXT,
    id_reservation INT,
    id_utilisateur INT,
    FOREIGN KEY (id_reservation) REFERENCES reservation (id_Reservation),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
); 

