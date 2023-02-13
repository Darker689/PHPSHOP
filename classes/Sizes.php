<?php

class Sizes
{
    public static $pdo;

    public static function index($id)
    {
        $sql = "SELECT * FROM `sizes` WHERE `product_id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);
        $sizes = $state->fetchAll();


        return $sizes;
    }

    public static function create($id, $size)
    {
        $sql = "INSERT INTO `sizes` (`product_id`, `size`) VALUES (:product_id, :size);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "product_id" => $id,
            "size" => $size
        ]);

        header("Location: dash-product-show.php?id=$id");
    }

    public static function delete($id, $product_id){
        $sql = "DELETE FROM `sizes` WHERE `sizes`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: dash-product-show.php?id=$product_id");
        exit();
    }
}
