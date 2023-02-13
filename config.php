<?php

session_start();

require_once('loader.php');

$servername = "localhost";
$username = "root";
$password = strval("\$darker1618");
$dbname = 'shop';

$database = new Database($servername, $username, $password, $dbname);

User::$pdo = $database->connection();
Country::$pdo = $database->connection();
Category::$pdo = $database->connection();
Category_Tag::$pdo = $database->connection();
Product::$pdo = $database->connection();
Images::$pdo = $database->connection();
Color::$pdo = $database->connection();
Colors::$pdo = $database->connection();
Sizes::$pdo = $database->connection();
Comment::$pdo = $database->connection();
Cart_product::$pdo = $database->connection();
Order::$pdo = $database->connection();

?>