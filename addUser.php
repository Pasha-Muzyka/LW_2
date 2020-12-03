<?php
	session_start();
	require_once 'connection.php';
		
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_confirm = $_POST['confirm_password'];
	if($_POST['role'] == "admin") {
		$id_role = 1;
	} else {
		$id_role = 2;
	}

	if(strlen($password) < 6){
		$_SESSION['message'] = 'Password must be 6characters';
		header('Location: signUp.php');
	}

	if($password === $password_confirm){
		mysqli_query($conn, "INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `photo`, `role_id`, `email`) 
		VALUES (NULL, '$first_name', '$last_name', '$password', NULL, '$id_role', '$email')"); 
		mysqli_close($conn);
		header('Location: table.php');
	}else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: signUp.php');
    }
?>