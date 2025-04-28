<?php
require_once("./model/PlatModel.php");

class PlatController
{
    private $platModel;

    public function __construct()
    {
        $this->platModel = new PlatModel();
    }
    /**
     * Affiche la page de publication de plat.
     *
     * @return void
     */
    public function get()
    {
      
    }

    public function post()
    {
       
session_start();
if (!isset($_SESSION['cuisiniere_id'])) {
    echo "Erreur : Aucun ID de cuisinière trouvé dans la session.";
    exit();
}

$cuisiniereId = $_SESSION['cuisiniere_id'];
echo "ID de la cuisinière : " . $cuisiniereId;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomPlat = $_POST['nom_plat'];
            $typePlat = $_POST['type_plat'];
            $prix = $_POST['prix'];
            $descriptionImage = $_POST['description_image'];
            $cuisiniereId = $_SESSION['cuisiniere_id'];

            // Gestion de l'image
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo "Erreur lors du téléchargement de l'image.";
                return;
            }

            $image = $_FILES['image']['name'];
            $uploadDir = 'images/plats/';
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

            // Enregistrer le plat et l'image dans la base de données
            $this->platModel->addPlatWithImage($nomPlat,  $typePlat, $prix, $cuisiniereId, $image, $descriptionImage);

            echo "Plat publié avec succès.";
            header("Location: index.php?route=profilCuisiniere");
            exit();
        }
    }
    public function getPublishedPlats()
{
    session_start();
    if (!isset($_SESSION['cuisiniere_id'])) {
        echo json_encode(['error' => 'Utilisateur non connecté']);
        exit();
    }

    $cuisiniereId = $_SESSION['cuisiniere_id'];
    $plats = $this->platModel->getPlatsByCuisiniereId($cuisiniereId);

    header('Content-Type: application/json');
    echo json_encode($plats);
    exit();
}
    public function getAllCuisinieres()
    {
        $plats = $this->platModel->getAllCuisinieres();
        header('Content-Type: application/json');
        echo json_encode($plats);
        exit();
    }
}