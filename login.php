<?php
session_start();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>

    <form action="auth.php" method="post">
        <label>Логин</label><br>
        <input type="email" name="login" placeholder="Введите свой логин"><br>
        <label>Пароль</label><br>
        <input type="password" name="password" placeholder="Введите пароль"><br>
        <button type="submit">Войти</button>
    </form>

</body>
</html>