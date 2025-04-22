<?php
require_once("./model/LoginCuisiniereModel.php");

class LoginCuisiniereController
{
    

    public function __construct()
    {
        
    }

    public function get()
    {
       
        require_once("/../view/LoginCuisinieres.php");
    }

    
    public function post()
    {
        session_start();
        $error = null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['login_email'];
            $password = $_POST['login_password'];
    
            $loginCuisiniereModel = new LoginCuisiniereModel();
            $cuisiniere = $loginCuisiniereModel->loginCuisiniere($email, $password);
    
            if ($cuisiniere) {
                $_SESSION['cuisiniere_id'] = $cuisiniere['Id_Cuisinieres'];
                header("Location: index.php?route=profilCuisiniere");
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }
    
        require_once("./view/LoginCuisinieres.php");
    }
}