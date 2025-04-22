<?php
require_once("./model/PlatModel.php");

class PlatController
{
    private $platModel;

    public function __construct()
    {
        $this->platModel = new PlatModel();
    }

    public function post()
    {
        session_start();
        if (!isset($_SESSION['cuisiniere_id'])) {
            header("Location: index.php?route=loginCuisiniere");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomPlat = $_POST['nom_plat'];
            $description = $_POST['description'];
            $typePlat = $_POST['type_plat'];
            $prix = $_POST['prix'];
            $cuisiniereId = $_SESSION['cuisiniere_id'];

            // Gestion de l'image
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo "Erreur lors du téléchargement de l'image.";
                return;
            }

            $image = $_FILES['image']['name'];
            $uploadDir = 'uploads/plats/';
            $imagePath = $uploadDir . $image;

            // Créez le dossier s'il n'existe pas
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Déplacez l'image téléchargée
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                echo "Impossible de déplacer l'image téléchargée.";
                return;
            }

            // Enregistrer le plat dans la base de données
            $this->platModel->addPlat($nomPlat, $description, $typePlat, $prix, $imagePath, $cuisiniereId);

            echo "Plat publié avec succès.";
            header("Location: index.php?route=profilCuisiniere");
            exit();
        }
    }
}