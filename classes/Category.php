<?php 

class Category
{
    public static $pdo;

    public static function index(){
        $sql = "SELECT * FROM `categories`";
        $state = self::$pdo->prepare($sql);
        $state->execute();
        $categories = $state->fetchAll();


        return $categories;
    }

    public static function list($category){
        $sql = "SELECT * FROM `products` WHERE `category` = :category";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "category" => $category
        ]);
        $categories = $state->fetchAll();


        return $categories;
    }


    public static function create($name){
        $sql = "INSERT INTO `categories` (`name`) VALUES (:name);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "name" => $name
        ]);

        header("Location: dash-category.php");
    }

    public static function delete($id){
        $sql = "DELETE FROM `categories` WHERE `categories`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: dash-category.php");
        exit();
    }
    public static function getId($category){
        $sql = "SELECT * FROM `categories` WHERE name = :name";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            'name'=>$category
        ]);

        $cat = $state->fetch();



        return $cat['id'];
    }
}
