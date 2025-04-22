<?php
require_once(__DIR__ . '/../model/RegisterClientModel.php');

class RegisterClientController
{
    private $registerClientModel;

    public function __construct()
    {
        $this->registerClientModel = new RegisterClientModel();
    }

    public function get()
    {
        include("../view/Client.php");
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hachage du mot de passe
            $telephone = $_POST['telephone'];
            $adresse = $_POST['adresse'];
            $ville = $_POST['ville'];
            $num_departement = $_POST['num_departement']; // Assurez-vous que ce champ est présent dans le formulaire

            // Récupérer l'ID de la ville
            $villeId = $this->registerClientModel->getVilleId($ville ,$num_departement);

            if (!$villeId) {
                echo json_encode(array("status" => "error", "message" => "Ville non trouvée."));
                return;
            }

            try {
                // Enregistrer le client
                $this->registerClientModel->registerClient($nom, $prenom, $email, $password, $telephone, $adresse, $villeId);
                echo json_encode(array("status" => "success", "message" => "Client enregistré avec succès."));
                header("Location: index.php?route=loginClient");
                exit();
            } catch (Exception $e) {
                echo json_encode(array("status" => "error", "message" => $e->getMessage()));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Méthode de requête invalide."));
        }
    }
}