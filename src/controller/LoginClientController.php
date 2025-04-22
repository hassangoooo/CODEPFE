<?php
require_once(__DIR__ . '/../model/LoginClientModel.php'); // Inclure le modèle LoginClientModel
class LoginClientController {
    public function __construct() {
        // ...existing code...
    }

    public function get() {
      
      require_once(__DIR__ . '/../view/Client.php');
    }
    public function post(){
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];
        $loginClientModel = new LoginClientModel();
        $result = $loginClientModel->loginClient($email, $password);
        if($result){
            session_start(); // Démarrer la session
           // $_SESSION['email'] = $email; // Stocker l'email dans la session
          echo json_encode(array("status" => "success", "message" => "Login successful"));
          header("Location: index.php?route=home"); // Rediriger vers la page home après connexion réussie
          exit(); // Assurez-vous d'arrêter l'exécution après la redirection
        }else{
          echo json_encode(array("status" => "error", "message" => "Invalid email or password"));
        }
      }else{
        echo json_encode(array("status" => "error", "message" => "Invalid request method"));
      }
    }
}
