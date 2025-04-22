<?php
require_once("./model/CuisiniereModel.php");

class ProCuisiniereController
{
    private $cuisiniereModel;

    public function __construct()
    {
        $this->cuisiniereModel = new CuisiniereModel();
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
        require_once("./css/style.css");
    }
}