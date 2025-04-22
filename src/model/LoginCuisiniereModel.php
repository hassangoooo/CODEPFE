<?php
require_once(__DIR__ . '/../Database.php');

class LoginCuisiniereModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * Authentifie une cuisinière en vérifiant son email et son mot de passe.
     *
     * @param string $email L'email de la cuisinière.
     * @param string $password Le mot de passe de la cuisinière.
     * @return array|false Les informations de la cuisinière si l'authentification réussit, sinon false.
     */
    
public function loginCuisiniere($email, $password)
{
    $stmt = $this->db->prepare("SELECT * FROM cuisinieres WHERE email_cuisinieres = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $cuisiniere = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cuisiniere && password_verify($password, $cuisiniere['mot_de_passe'])) {
        return $cuisiniere; // Retourne les informations de la cuisinière si l'authentification réussit
    }
    return false; // Retourne false si l'authentification échoue
}
}