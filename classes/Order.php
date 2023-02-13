<?php 

class Order{
    public static $pdo;

    public static function index()
    {
        $sql = "SELECT * FROM `order`";
        $state = self::$pdo->prepare($sql);
        $state->execute();

        $cart_products = $state->fetchAll();

        return $cart_products;
    }

    public function create($id)
    {
        
    }

}



?>