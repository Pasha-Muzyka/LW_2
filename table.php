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
    <div class="container">
        <div class="row">
            <div class="col mt-3" style="height: 80px;">
                <?php
                if (isset($_SESSION['first_name'])) {
                    echo '<a href="profile.php" class="btn btn-link"><h1>' . $_SESSION['first_name'] . '</h1></a>';
                    echo "<b> | </b>";
                    echo '<a href="logout.php" class="btn btn-link"><h1>Log Out</h1></a>';
                } else {
                    //echo '<a href="login.php" class="btn btn-link" tabindex="-1" role="button"><h1>Log In</h1></a>';
                    echo '<button type="button" class="btn btn-link" data-toggle="modal" data-target="#logIn"><h1>Log In</h1></button>'; ?>
                    <div class="modal fade" id="logIn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <form action="auth.php" method="post">
                                            <label>Логин</label><br>
                                            <input type="email" name="login" class="form-control" placeholder="Введите свой логин"><br>
                                            <label>Пароль</label><br>
                                            <input type="password" name="password" class="form-control" placeholder="Введите пароль"><br>
                                            <button type="submit" class="btn btn-success mt-1">Войти</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo "<b> | </b>";
                    echo '<a href="signUp.php" class="btn btn-link" role="button"><h1>Sign Up</h1></a>';
                }
                if(isset($_SESSION['message'])){
                    echo '<p><h1>' . $_SESSION['message'] . '</h1> </p>';
                    unset($_SESSION['message']);
                }
                ?>
            </div>
        </div>
        <div class="row align-items-center" style="min-height: 360px;">
            <div class="col-md align-middle">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Email</td>
                            <td>Role</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'connection.php';

                        $res = mysqli_query($conn, "SELECT * FROM `users` LIMIT 10");
                        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

                            echo '<tr>';
                            echo '<td><a href="profile.php?' . http_build_query($row) . '">', $row['id'], '</a></td>';
                            echo '<td>' . $row['first_name'] . '</td>';
                            echo '<td>' . $row['last_name'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            if ($row['role_id'] == 1) {
                                echo '<td>Admin</td>';
                            } else {
                                echo '<td>User</td>';
                            }
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row align-items-end">
        <div class="col-md-3 offset-md-8">
            <?php
            if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                echo '<a href="signUp.php" class="btn btn-primary btn-lg" tabindex="-1" role="button"><h1>Add User</h1></a>';
            }
            ?>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>