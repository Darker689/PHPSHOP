<?php 

class Colors
{
    public static $pdo;

    public static function index($id){
        $sql = "SELECT * FROM `colors` WHERE `product_id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);
        $colors = $state->fetchAll();


        return $colors; 
    }


    public static function create($id, $color_name){
        $sql = "INSERT INTO `colors` (`product_id`, `color_name`) VALUES (:product_id, :color_name);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "product_id" => $id,
            "color_name" => $color_name
        ]);

        header("Location: dash-product-show.php?id=$id");
    }

    public static function delete($id, $product_id){
        $sql = "DELETE FROM `colors` WHERE `colors`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: dash-product-show.php?id=$product_id");
        exit();
    }
}
