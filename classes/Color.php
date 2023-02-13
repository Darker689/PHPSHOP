<?php 

class Color
{
    public static $pdo;

    public static function index(){
        $sql = "SELECT * FROM `color`";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            
        ]);
        $colors = $state->fetchAll();


        return $colors;
    }


    public static function create($color_name){
        $sql = "INSERT INTO `color` (`color_name`) VALUES (:color_name);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "color_name" => $color_name
        ]);

        header("Location: dash-color.php");
    }

    public static function delete($id){
        $sql = "DELETE FROM `color` WHERE `color`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: dash-color.php");
        exit();
    }
}
