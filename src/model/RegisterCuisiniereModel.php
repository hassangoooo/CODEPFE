<?php
require_once(__DIR__ . '/../Database.php');

class RegisterCuisiniereModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    
public function getVilleId($ville, $num_departement)
{
    $stmt = $this->db->prepare("SELECT ville_id FROM villes_france_free WHERE ville_nom = :ville AND ville_departement = :num_departement");
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':num_departement', $num_departement);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['ville_id'];
    }
    return null; // Ville non trouvée
}

    public function registerCuisiniere($nom, $prenom, $email, $password, $telephone, $villeId, $photo, $description)
    {
        try {
            $sql = "INSERT INTO cuisinieres (email_cuisinieres, nom_cuisinieres, prenom_cuisinieres, mot_de_passe, num_de_telephone, image_de_cuisinieres, ville_id, description)     
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $nom);
            $stmt->bindParam(3, $prenom);
            $stmt->bindParam(4, $password);
            $stmt->bindParam(5, $telephone);
            $stmt->bindParam(6, $photo);
            $stmt->bindParam(7, $villeId);
            $stmt->bindParam(8, $description);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }
}