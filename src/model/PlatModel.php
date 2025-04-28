<?php
require_once(__DIR__ . '/../Database.php');

class PlatModel
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addPlatWithImage($nomPlat, $typePlat, $prix, $cuisiniereId, $image, $descriptionImage)
    {
        try {

            // Insérer dans la table `plat`
            $stmt = $this->db->prepare("INSERT INTO plats (nom_plat,prix_plat, Id_Cuisinieres, type_plat ) VALUES (?, ?, ?,  ?)");
            $stmt->execute([$nomPlat,$prix, $cuisiniereId,  $typePlat ]);

            // Récupérer l'ID du plat inséré
            $idPlat = $this->db->lastInsertId();

            // Insérer dans la table `image`
            $stmt = $this->db->prepare("INSERT INTO image (image, description_image, id_plats) VALUES (?, ?, ?)");
            $stmt->execute([$image, $descriptionImage, $idPlat]);

            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }
    /**
     * Récupère tous les plats d'une cuisinière donnée.
     * Param int $cuisiniereId L'ID de la cuisinière.
     * @return array Un tableau associatif contenant les plats de la cuisinière.
     */
    
     public function getPlatsByCuisiniereId($cuisiniereId)
     {
         $query = $this->db->prepare("
             SELECT plats.nom_plat, plats.prix_plat , plats.type_plat, image.image, image.description_image 
             FROM plats 
             LEFT JOIN image  ON plats.id_plats = image.id_plats
             WHERE plats.Id_Cuisinieres = :cuisiniere_id
         ");
         $query->bindParam(':cuisiniere_id', $cuisiniereId, PDO::PARAM_INT);
         $query->execute();
         return $query->fetchAll(PDO::FETCH_ASSOC);
     }

    /**
     * Récupère tous les plats publiés par une cuisinière donnée.
     * Param int $cuisiniereId L'ID de la cuisinière.
     * @return array Un tableau associatif contenant les plats publiés par la cuisinière.
     */
    public function getPublishedPlatsByCuisiniereId($cuisiniereId)
    {
        $query = $this->db->prepare("SELECT * FROM plats WHERE cuisiniere_id = :cuisiniere_id AND est_publie = 1");
        $query->bindParam(':cuisiniere_id', $cuisiniereId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Récupère tous les plats publiés.
     * @return array Un tableau associatif contenant tous les plats publiés.
     */
    public function getAllCuisinieres()
    {
        $query = $this->db->prepare("SELECT * FROM cuisinieres  ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}