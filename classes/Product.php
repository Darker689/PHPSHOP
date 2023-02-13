<?php

class Product
{
    public static $pdo;

    public static function index()
    {
        $sql = "SELECT * FROM `products`";
        $state = self::$pdo->prepare($sql);
        $state->execute();
        $products = $state->fetchAll();


        return $products;
    }

    public static function create($name, $price, $discount, $category, $category_tag, $count, $main_img)
    {


        $sql = "INSERT INTO `products` (`name`, `price`, `discount`, `category`, `category_tag`, `count`, `main_img`) VALUES (:name, :price, :discount, :category, :category_tag, :count, :main_img);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "name" => $name,
            "price" => $price,
            "discount" => $discount,
            "category" => $category,
            "category_tag" => $category_tag,
            "count" => $count,
            "main_img" => $main_img
        ]);

        header("Location: dash-product.php");
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM `products` WHERE `products`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);
        
        $sql = "DELETE FROM `cartproduct` WHERE `cartproduct`.`product_id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);
        
        unlink($_POST['main_img']);

        header("Location: dash-product.php");
        exit();
    }



    public static function edit($name, $price, $discount, $category, $category_tag, $count, $main_img, $id)
    {
        $sql = "UPDATE `products` SET `name` = :name, `price` = :price, `discount` = :discount, `category` = :category, `category_tag` = :category_tag, `count` = :count, `main_img` = :main_img WHERE id =:id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "name" => $name,
            "price" => $price,
            "discount" => $discount,
            "category" => $category,
            "category_tag" => $category_tag,
            "count" => $count,
            "main_img" => $main_img,
            "id" => $id
        ]);

        unlink($_POST['old_img']);

        header("Location: dash-product.php");
        exit();
    }

    public static function show($id)
    {
        $sql = "SELECT * FROM `products` WHERE `id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);
        return $state->fetch();
    }
}
