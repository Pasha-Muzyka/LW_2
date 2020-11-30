<?php
session_start();
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $role_id = $_GET['role_id'];
    if(isset($_GET['avatar'])){
        $avatar = $_GET['avatar'];
    }
} else {
    $id = $_SESSION['id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $role_id = $_SESSION['role_id'];
    $avatar = $_SESSION['avatar'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4" style="background: #ddd">
                <a href="table.php" class="btn btn-primary btn-lg mt-5" tabindex="-1" role="button"><h1>Table</h1></a><br>
                <?php
                if(isset($avatar)){
                    echo '<img src="<?= $avatar ?>" width="480" alt="" class="img-thumbnail mt-10">';
                }?>
                <?php 
                if($role_id == 1 || $role_id == 2){
                    echo '<form action="upload.php?id='.$id.'" method="post" enctype="multipart/form-data">';
                    echo<<<html
                    Select image to upload:
                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                    html;
                }?>
            </div>
            <div class="col-8" style="background: #ccc">

            </div>
        </div>
    </div>
</body>

</html>