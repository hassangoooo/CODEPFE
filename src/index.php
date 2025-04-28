<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  
    

    $methode = $_SERVER['REQUEST_METHOD'];
    $route = isset($_GET['route']) ? $_GET['route'] : 'home';

    switch ($route) {
        case 'home':
           require_once("./controller/homeController.php");
            $controller = new HomeController(); 
            $controller->get();
            break;
        case 'notremenu':
            require_once("./controller/Notremenu.php");
            $controller = new NotremenuController();
            $controller->get();
            break;
        case 'loginClient':
            require_once("./controller/LoginClientController.php");
            $controller = new LoginClientController();
           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->post();
            } else {
                $controller->get();
            }
            break;
        case 'client':
            require_once("./controller/ClientController.php");
            $controller = new ClientController();
            $controller->get();
            break;
        case 'cuisinieres':
            require_once("./controller/CuisinieresController.php");
            $controller = new CuisinieresController();
            $controller->get();
            break;
            
        case 'registerClient':
                require_once("./controller/RegisterClientController.php");
                $controller = new RegisterClientController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->post();
                } else {
                    $controller->get();
                }
                break;
        case 'registerCuisinieres':
            require_once("./controller/RegisterCuisiniereController.php");
            $controller = new RegisterCuisiniereController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->post();
            } else {
                $controller->get();
            }
            break;
          
            
            case 'loginCuisiniere':
                require_once("./controller/LoginCuisiniereController.php");
                $controller = new LoginCuisiniereController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->post();
                } else {
                    $controller->get();
                }
                break;
            
            case 'profilCuisiniere':
                require_once("./controller/ProCuisiniereController.php");
                $controller = new ProCuisiniereController();
                $controller->profil();
                break;
                
            case 'logoutCuisiniere':
                    require_once("./controller/LogoutCuisiniereController.php");
                    $controller = new LogoutCuisiniereController();
                    $controller->post();
                    break;
                  
            case 'ajouterPlat':
                require_once("./controller/PlatController.php");
                    $controller = new PlatController();
                    $controller->post();
                    break;
            case 'getPublishedPlats':
                        require_once("./controller/PlatController.php");
                        $controller = new PlatController();
                        $controller->getPublishedPlats();
                        break; 
            case 'getallCuisinieres':
                        require_once("./controller/PlatController.php");
                        $controller = new PlatController();
                        $controller->getAllCuisinieres();
                        break;
            

        default:
            require_once("./controller/HomeController.php");
            $controller = new HomeController();
            break;
    }
