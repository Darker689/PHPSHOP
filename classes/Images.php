<?php 

class Images
{
    public static $pdo;

    public static function index($id){
        $sql = "SELECT * FROM `images` WHERE `product_id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id"=>$id
        ]);
        $images = $state->fetchAll();

        return $images;
    }


    public static function create($id, $url){
        $sql = "INSERT INTO `images` (`product_id`, `url`) VALUES (:product_id, :url);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "product_id" => $id,
            "url" => $url
        ]);

        header("Location: dash-product-show.php?id=$id");
    }

    public static function delete($id, $product_id){
        $sql = "DELETE FROM `images` WHERE `images`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: dash-product-show.php?id=$product_id");
        exit();
    }
}
