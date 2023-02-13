<?php
    require_once('config.php');
    session_unset();
    $_SESSION = [];
    session_destroy();
    header('Location: login.php')
?>