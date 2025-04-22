<?php
require_once(__DIR__ . '/../Database.php');

class CuisiniereModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function loginCuisiniere($email, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM cuisinieres WHERE email_cuisinieres = ?");
        $stmt->execute([$email]);
        $cuisiniere = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cuisiniere && password_verify($password, $cuisiniere['mot_de_passe'])) {
            return $cuisiniere;
        }
        return false;
    }

    
    
    public function getCuisiniereById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cuisinieres WHERE Id_Cuisinieres = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Associez le paramètre nommé :id
        $stmt->execute(); // Exécutez la requête
        return $stmt->fetch(PDO::FETCH_ASSOC); // Récupérez les résultats
    }
}