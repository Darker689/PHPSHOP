<?php 

class Country
{
    public static $pdo;

    public static function index(){
        $sql = "SELECT * FROM `countries`";
        $state = self::$pdo->prepare($sql);
        $state->execute();
        $countries = $state->fetchAll();


        return $countries;
    }


    public static function create($name){
        $sql = "INSERT INTO `countries` (`name`) VALUES (:name);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "name" => $name
        ]);

        header("Location: countries.php");
    }

    public static function delete($id){
        $sql = "DELETE FROM `countries` WHERE `countries`.`id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);

        header("Location: countries.php");
        exit();
    }
}
