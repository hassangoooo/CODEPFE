<?php
require_once("./model/CuisiniereModel.php");


/*public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?route=loginCuisiniere");
        exit();
    }
    public function get()
    {
        require_once("./view/LoginCuisiniere.php");
    }*/
class LogoutCuisiniereController
{
    public function __construct()
    {
        session_start();
    }
    /**
     * Affiche la page de déconnexion.
     *
     * @return void
     */
public function get()
{
    require_once("/../view/LoginCuisiniere.php");
}
    public function post()
    {
        session_destroy(); // Détruire la session
        header("Location: index.php?route=loginCuisiniere"); // Rediriger vers la page de connexion
        exit();
    }
    /*public function logout()
    {
        session_destroy(); // Détruire la session
        header("Location: index.php?route=loginCuisiniere"); // Rediriger vers la page de connexion
        exit();
    }*/
}


   
 