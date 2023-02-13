<?php

class Cart_product
{
    public static $pdo;

    public static function index($id)
    {
        $sql = "SELECT * FROM `cartproduct` WHERE `user_id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        $cart_products = $state->fetchAll();

        return $cart_products;
    }

    public static function create($user_id, $product_id)
    {
        $sql = "INSERT INTO `cartproduct` (`user_id`, `product_id`) VALUES (:user_id, :product_id);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "user_id" => $user_id,
            "product_id" => $product_id
        ]);

        header("Location: product.php?id=$product_id");
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM `cartproduct` WHERE `cartproduct`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: cart.php");
        exit();
    }
}
