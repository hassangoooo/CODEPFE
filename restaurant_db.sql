-- Database: restaurant_db

-- Table Client
CREATE TABLE Client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom_client VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    adress_Client VARCHAR(255),
    num_Client VARCHAR(20),
    ville_id INT
);

-- Table Cuisinières
CREATE TABLE Cuisinieres (
    Id_Cuisinieres INT AUTO_INCREMENT PRIMARY KEY,
    email_cuisinieres VARCHAR(100) UNIQUE,
    nom_cuisinieres VARCHAR(50),
    prenom_cuisinieres VARCHAR(50),
    mot_de_passe VARCHAR(255),
    num_de_telephone VARCHAR(20),
    image_de_cuisinieres VARCHAR(255),
    ville_cuisinieres VARCHAR(100),
    ville_id INT
);

-- Table Produit
CREATE TABLE produit (
    Id_produit INT AUTO_INCREMENT PRIMARY KEY,
    prix_produit DECIMAL(10,2),
    nom_produit VARCHAR(100),
    Id_Cuisinieres INT,
    FOREIGN KEY (Id_Cuisinieres) REFERENCES Cuisinieres(Id_Cuisinieres) ON DELETE CASCADE
);

-- Table Commande
CREATE TABLE commande (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    id_produit INT,
    quantite_commande INT,
    date_commande DATE,
    date_livraison DATE,
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE,
    FOREIGN KEY (id_produit) REFERENCES produit(Id_produit) ON DELETE CASCADE
);

-- Table Image
CREATE TABLE image (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255),
    description_image TEXT,
    id_produit INT,
    FOREIGN KEY (id_produit) REFERENCES produit(Id_produit) ON DELETE CASCADE
);

-- Table Type_Cuisine
CREATE TABLE type_cuisine (
    Id_type_cuisine INT AUTO_INCREMENT PRIMARY KEY,
    nom_de_cuisine VARCHAR(100)
);

-- Table Recouvre (relation entre Cuisinières et Type_Cuisine)
CREATE TABLE recouvre (
    Id_Cuisinieres INT,
    Id_type_cuisine INT,
    PRIMARY KEY (Id_Cuisinieres, Id_type_cuisine),
    FOREIGN KEY (Id_Cuisinieres) REFERENCES Cuisinieres(Id_Cuisinieres) ON DELETE CASCADE,
    FOREIGN KEY (Id_type_cuisine) REFERENCES type_cuisine(Id_type_cuisine) ON DELETE CASCADE
);

-- Table Ingrédient
CREATE TABLE ingredient (
    id_ingredient INT AUTO_INCREMENT PRIMARY KEY,
    nom_ingredient VARCHAR(100)
);

-- Table Compose (relation entre Produit et Ingrédient)
CREATE TABLE compose (
    id_produit INT,
    id_ingredient INT,
    PRIMARY KEY (id_produit, id_ingredient),
    FOREIGN KEY (id_produit) REFERENCES produit(Id_produit) ON DELETE CASCADE,
    FOREIGN KEY (id_ingredient) REFERENCES ingredient(id_ingredient) ON DELETE CASCADE
);

