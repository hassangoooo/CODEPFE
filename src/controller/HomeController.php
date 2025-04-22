<?php
class HomeController {
    public function __construct() {
        
    }
    function get() {
        include("./view/home.php");
    }
}