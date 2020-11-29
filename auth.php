<?php
    session_start();
    require_once 'connection.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($res) > 0) {

        $row = mysqli_fetch_array($res);
        if (is_array($row)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['login'] = $row['email'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['avatar'] = $row['avatar'];
            $_SESSION['role_id'] = $row['role_id'];
        }

        header('Location: table.php');

    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: login.php');
    }
?>