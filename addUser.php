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

	if(strlen($password) > 6){
		$_SESSION['message'] = 'Password must be 8characters';
		header('Location: signUp.php');
	}

	if($password === $password_confirm){
	
		$target_dir = "public/images/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				$_SESSION['message'] = 'File is not an image.';
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$_SESSION['message'] = $_SESSION['message'] . '<br>' . 'Sorry, file already exists.';
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$_SESSION['message'] = $_SESSION['message'] . '<br>' . 'Sorry, your file is too large.';
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$_SESSION['message'] = $_SESSION['message'] . '<br>' . 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$_SESSION['message'] = $_SESSION['message'] . '<br>' . 'Sorry, your file was not uploaded.';
			header('Location: signUp.php');
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "";
				$_SESSION['message'] = $_SESSION['message'] . '<br>' . 'Sorry, there was an error uploading your file.';
				header('Location: signUp.php');
			}
		}		

		mysqli_query($conn, "INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `photo`, `role_id`, `email`) 
		VALUES (NULL, '$first_name', '$last_name', '$password', NULL, '$id_role', '$email')"); 
		mysqli_close($conn);
		header('Location: login.php');
	}else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: signUp.php');
    }
?>