<?php
require_once("./model/RegisterCuisiniereModel.php");
class RegisterCuisiniereController
{
    public function get()
    {
        require_once("./view/LoginCuisinieres.php");
    }

    public function post()
    {
        try {
            if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Erreur lors du téléchargement de la photo.");
            }
    
            $photo = $_FILES['photo']['name'];
            $uploadDir = 'images/profil/';
            $photoPath = $uploadDir . $photo;
    
            // Vérifiez si le dossier existe, sinon créez-le
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true)) {
                    throw new Exception("Impossible de créer le dossier pour les photos.");
                }
            }
    
            // Déplacez le fichier téléchargé
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                throw new Exception("Impossible de déplacer la photo téléchargée.");
            }
    
            $photoPath = htmlspecialchars($photoPath, ENT_QUOTES, 'UTF-8'); // Échapper les caractères spéciaux
    
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash du mot de passe
            $telephone = $_POST['telephone'];
            $ville = $_POST['ville'];
            $num_departement = $_POST['num_departement'];
            $description = $_POST['description'];
    
            $registerCuisiniereModel = new RegisterCuisiniereModel();
    
            // Récupérer l'ID de la ville
            $villeId = $registerCuisiniereModel->getVilleId($ville, $num_departement);
    
            if (!$villeId) {
                throw new Exception("Ville non trouvée.");
            }
    
            // Enregistrer la cuisinière
            $registerCuisiniereModel->registerCuisiniere($nom, $prenom, $email, $password, $telephone, $villeId, $photoPath, $description);
            
            header("Location: index.php?route=loginCuisiniere"); // Rediriger vers la page de connexion après l'enregistrement
            echo "<script>alert('Cuisinière enregistrée avec succès.');</script>";
        } catch (Exception $e) {
            echo json_encode(array("status" => "error", "message" => $e->getMessage()));
        }
    }
}