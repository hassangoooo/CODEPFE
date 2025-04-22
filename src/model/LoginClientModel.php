<?php
require_once(__DIR__ . '/../Database.php'); // Assurez-vous que le chemin est correct
class LoginClientModel
{
    private $db;
    public function __construct()
    {
        $this->db = DB::getInstance(); // Assurez-vous que la classe DB est correctement définie
    }
    public function loginClient($email, $password)
    {
        try {
            $sql = "SELECT * FROM client WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $client = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($client && password_verify($password, $client['mot_de_passe'])) {
                return true; // Authentification réussie
            } else {
                return false; // Échec de l'authentification
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la connexion : " . $e->getMessage());
        }
    }
}
