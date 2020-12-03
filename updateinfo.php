<?php
session_start();
require_once 'connection.php';
$id = $_GET['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
if (isset($_POST['role_id'])) {
    $role_id = $_POST['role_id'];
}

if(strlen($password) < 6){
    $_SESSION['editmessage'] = 'Password must be 8characters';
    header('Location: profile.php?id='.$id);
}

if ($password === $confirm_password) {
    if (isset($role_id)) {
        mysqli_query($conn,"UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `password` = '$password', `role_id` = '$role_id' WHERE `id`= '$id'");
    } else {
        mysqli_query($conn, "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `password` = '$password' WHERE `id`= '$id'")   ;
    }
    header('Location: profile.php?id=' . $id);
} else {
    $_SESSION['editmessage'] = 'Пароли не совпадают';
    header('Location: profile.php?id='. $id);
}
