<?php

class Category_Tag
{
    public static $pdo;

    public static function index()
    {
        $sql = "SELECT * FROM `category_tags`";
        $state = self::$pdo->prepare($sql);
        $state->execute();
        $category_tags = $state->fetchAll();


        return $category_tags;
    }

    public static function list($id)
    {
        $sql = "SELECT * FROM `category_tags` WHERE `category_id` = :category_id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "category_id" => $id
        ]);
        $category_tagses = $state->fetchAll();


        return $category_tagses;
    }


    public static function create($id, $name)
    {
        $sql = "INSERT INTO `category_tags` (`category_id`, `name`) VALUES (:category_id, :name);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "category_id" => $id,
            "name" => $name
        ]);

        header("Location: dash-category.php");
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM `category_tags` WHERE `category_tags`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: dash-category.php");
        exit();
    }

    public static function fillter($category)
    {
        $sql = "SELECT * FROM `products` WHERE `category_tag` = :category_tag";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "category_tag" => $category
        ]);
        $categories = $state->fetchAll();


        return $categories;
    }
}
