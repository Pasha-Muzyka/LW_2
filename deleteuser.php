<?php
session_start();
require_once 'connection.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM `users` WHERE `id` = '$id'");
if($id == $_SESSION['id']){
    header('Location: logout.php');
}
else{
    header('Location: table.php');
}