<?php
require_once(__DIR__ . '/../Database.php');

class RegisterClientModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getVilleId($ville, $num_departement)
    {
        $stmt = $this->db->prepare("SELECT ville_id FROM villes_france_free WHERE ville_nom = :ville and ville_departement = :num_departement");
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':num_departement', $num_departement); // Assurez-vous que $num_departement est défini
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['ville_id'];
        }
        return null; // Ville non trouvée
    }

    public function registerClient($nom, $prenom, $email, $password, $telephone, $adresse, $villeId)
    {
        try {
            $sql = "INSERT INTO client (nom_client, prenom, email, mot_de_passe, num_Client, adress_Client, ville_id)
                    VALUES (:nom, :prenom, :email, :password, :telephone, :adresse, :ville_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':ville_id', $villeId);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }
}