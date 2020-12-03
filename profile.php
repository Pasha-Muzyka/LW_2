<?php
session_start();
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = mysqli_fetch_array( mysqli_query($conn,"SELECT * FROM `users` WHERE id='$id'",MYSQLI_ASSOC));
    $id = $user['id'];
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $role_id = $user['role_id'];
    if (isset($user['photo'])) {
        $avatar = $user['photo'];
    }
} else {
    $id = $_SESSION['id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $role_id = $_SESSION['role_id'];
    if(isset($_SESSION['avatar'])){
        $avatar = $_SESSION['avatar'];
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="table.php" class="btn btn-primary btn-lg mt-5" tabindex="-1" role="button">
                    <h1>Table</h1>
                </a><br>
                <div class="photo" style="margin-top: 100px;">
                    <?php
                    if (isset($avatar)) {
                        echo '<img src=' . $avatar .' width="200" alt="" class="img-thumbnail mt-10">';
                    }
                    if ((isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) || (isset($_SESSION['id']) && $_SESSION['id'] == $id)) {
                        echo '<form action="upload.php?id=' . $id . '" method="post" enctype="multipart/form-data">';
                        echo <<<html
                    Select image to upload:
                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                    html;
                    if (isset($_SESSION['message'])) {
                        echo '<p> ' . $_SESSION['message'] . ' </p>';
                        unset($_SESSION['message']);
                    }                
                    } ?>
                </div>
            </div>
            <div class="col-8">
                <div class="container" style="margin-top: 150px;">
                    <?php
                    if ((isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) || (isset($_SESSION['id']) && $_SESSION['id'] == $id)) {
                        echo <<<html
                                    <form action="updateinfo.php?id=$id" method="post">
                                    <label>Имя</label><br>
                                    <input type="text" name="first_name" class="form-control" value="$first_name">
                                    <label>Фамилия</label><br>
                                    <input type="text" name="last_name" class="form-control" value="$last_name">
                                    <label>Пароль</label><br>
                                    <input type="password" name="password" class="form-control" placeholder="Введите новый пароль">
                                    <label>Подтверждение пароля</label><br>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Подтвердите новый пароль"><br>
                                html;
                                if($_SESSION['role_id']==1){
                                    echo<<<html
                                    <select id="role" name='role' class="form-control">
                                        <option disabled="disabled" selected="selected">Роль</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select><br>
                                    html;
                                }
                                else{
                                    echo '<label>Роль</label><br>';
                                    echo '<input type="text" readonly class="form-control" value="User"><br>';
                                }
                                echo<<<html
                                    <button type="submit" class="btn btn-success mt-1" style="margin-left: 70px;"><h2>Обновить данные</h2></button>
                                    <a href="deleteuser.php?id=$id"  class="btn btn-danger mt-1" role="button"><h2>Удалить профиль</h2></a>
                                html;
                                if(isset($_SESSION['editmessage'])){
                                    echo '<p> ' . $_SESSION['editmessage'] . ' </p>';
                                    unset($_SESSION['editmessage']);
                                }
                    } else {
                        echo <<<html
                                <form action="updateinfo.php" method="post">
                                <label>Имя</label><br>
                                <input type="text" readonly class="form-control" value="$first_name">
                                <label>Фамилия</label><br>
                                <input type="text" readonly class="form-control" value="$last_name">
                        html;
                        if($role_id == 1){
                                echo '<label>Роль</label><br>';
                                echo '<input type="text" readonly class="form-control" value="Admin"><br>';
                        }else{
                            echo '<label>Роль</label><br>';
                            echo '<input type="text" readonly class="form-control" value="User"><br>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>