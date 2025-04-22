<?php
require_once(__DIR__ . '/../Database.php');

class PlatModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addPlat($nomPlat, $description, $typePlat, $prix, $imagePath, $cuisiniereId)
    {
        $stmt = $this->db->prepare("INSERT INTO produit (nom_plat, description, type_plat, prix, image, cuisiniere_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nomPlat, $description, $typePlat, $prix, $imagePath, $cuisiniereId]);
    }
  
public function getPlatsByCuisiniere($cuisiniereId)
{
    $stmt = $this->db->prepare("SELECT * FROM plats WHERE cuisiniere_id = ?");
    $stmt->execute([$cuisiniereId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}