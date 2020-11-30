<?php
session_start();

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

    <form action="auth.php" method="post">
        <label>Логин</label><br>
        <input type="email" name="login" placeholder="Введите свой логин"><br>
        <label>Пароль</label><br>
        <input type="password" name="password" placeholder="Введите пароль"><br>
        <button type="submit">Войти</button>
    </form>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p> ' . $_SESSION['message'] . ' </p>';
        unset($_SESSION['message']);
    }

    ?>
</body>

</html>