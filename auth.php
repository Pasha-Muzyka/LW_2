<?php
    session_start();

    $_SESSION['login'] = $_POST['login'];
    $_SESSION['password'] = $_POST['password'];
    require_once 'connection.php';

    header('Location: restricted.php');
?>