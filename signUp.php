<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center mt-5">
        <form action="addUser.php" method="post">

            <label>Имя</label><br>
            <input type="text" name="first_name" class="form-control" placeholder="Введите свое имя">
            <label>Фамилия</label><br>
            <input type="text" name="last_name" class="form-control" placeholder="Введите свою фамилию">
            <label>Логин</label><br>
            <input type="email" name="email" class="form-control" placeholder="Введите свой логин">
            <label>Пароль</label><br>
            <input type="password" name="password" class="form-control" placeholder="Введите пароль">
            <label>Подтверждение пароля</label><br>
            <input type="password" name="confirm_password" class="form-control" placeholder="Подтвердите пароль"><br>
            <select id="role" name='role' class="form-control">
                <option disabled="disabled" selected="selected">Роль</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br>

            <button type="submit" class="btn btn-success mt-1">Зарегистрироваться</button>

            <?php
            session_start();
            if (isset($_SESSION['message'])) {
                echo '<p> ' . $_SESSION['message'] . ' </p>';
                unset($_SESSION['message']);
            }

            ?>
        </form>
    </div>
</body>

</html>