<?php 

class Comment 
{
    public static $pdo;


    public static function index($id){
        $sql = "SELECT * FROM `comments` WHERE `product_id` = :id";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "id" => $id
        ]);
        $comments = $state->fetchAll();


        return $comments; 
    }


    public static function create($id, $username, $comment)
    {
        $sql = "INSERT INTO `comments` (`product_id`, `username`, `comment`) VALUES (:product_id, :username, :comment);";
        $state = self::$pdo->prepare($sql);
        $state->execute([
            "product_id" => $id,
            "username" => $username,
            "comment" => $comment
        ]);

        header("Location: dash-product-show.php?id=$id");
    }
}
