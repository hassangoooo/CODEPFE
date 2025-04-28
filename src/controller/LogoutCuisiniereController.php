<?php
require_once("./model/CuisiniereModel.php");



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
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php?route=home");
    exit();
}
}


   
 