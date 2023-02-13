<?php

class User
{
    public static $pdo;

    public static function index()
    {
        $sql = "SELECT * FROM `users`";
        $state = self::$pdo->prepare($sql);
        $state->execute();
        $users = $state->fetchAll();


        return $users;
    }

    public static function register($name, $email, $password, $country, $address)
    {

        $sqlUser = "SELECT * FROM `users` WHERE `email` = :email";
        $stateUser = self::$pdo->prepare($sqlUser);
        $stateUser->execute([
            "email" => $email
        ]);

        $userError = $stateUser->fetch();
        

        if ($userError) {
            $_SESSION['error'] = "Email is already taken!!";
        } else {
            $sql = "INSERT INTO `users` (`name`, `email`, `password`, `role_id`, `country`, `address`) VALUES (:name, :email, :password, :role_id, :country, :address);";
            $state = self::$pdo->prepare($sql);
            $state->execute([
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "role_id" => 2,
                "country" => $country,
                "address" => $address
            ]);
            
            header("Location: login.php");
        }
    }

    public static function login($email, $password)
    {
        $sqlUser = "SELECT * FROM `users` WHERE `email` = :email";
        $stateUser = self::$pdo->prepare($sqlUser);
        $stateUser->execute([
            "email" => $email
        ]);
        $user = $stateUser->fetch();
        if (!$user) {
            $_SESSION['error'] = "Email is not registered!!!";
        } else {
            if ($password == $user['password'] && ($email == $user['email'])) {
                $_SESSION['user'] = $user;
                if ($user['role_id'] == 1) {
                    header('Location: dashboard.php');
                } else {
                    header('Location: index.php');
                }
            } else {
                $_SESSION['error'] = "Password is wrong!!!";
            }
        }
    }
}

?>
