<?php
require_once("./model/CuisiniereModel.php");
require_once("./model/PlatModel.php");

class ProCuisiniereController
{
    private $cuisiniereModel;
    private $platModel;

    public function __construct()
    {
        $this->cuisiniereModel = new CuisiniereModel();
        $this->platModel = new PlatModel();
    }

    /**
     * Affiche le profil de la cuisinière.
     *
     * @return void
     */
    
    public function profil()
    {
        session_start();
        if (!isset($_SESSION['cuisiniere_id'])) {
            header("Location: index.php?route=loginCuisiniere");
            exit();
        }
    
        $cuisiniereId = $_SESSION['cuisiniere_id'];
        $info = $this->cuisiniereModel->getCuisiniereById($cuisiniereId);
    
        if (!$info) {
            echo "Erreur : Les informations de la cuisinière n'ont pas été trouvées.";
            exit();
        }
    
        require_once("./view/Profile.php");
        
    }
    
    
    public function voirProfilCuisiniere($id)
    {
        $cuisiniere = $this->cuisiniereModel->getCuisiniereById($id);
        $plats = $this->platModel->getPlatsByCuisiniereId($id);
    
        if (!$cuisiniere) {
            echo "Cuisinière introuvable.";
            exit();
        }
    
        require_once __DIR__ . '/../view/voirProfilCuisiniere.php';
    }
}
