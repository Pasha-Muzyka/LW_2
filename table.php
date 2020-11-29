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
    <?php
        if(isset($_SESSION['first_name'])){
            echo '<a href="profile.php">'.$_SESSION['first_name'].'   </a> |';
            echo '<a href="logout.php">   Log Out</a>';
        }else{
            echo '<a href="login.php">Log In   </a> |';
            echo '<a href="signUp.php">   Sign Up</a>';
        }
        ?>
        <table cellpadding="5" cellspacing="0" border="1">
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
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                           
                echo '<tr>';
                    echo '<td><a href="profile.php/?'.http_build_query($row).'">',$row['id'],'</a></td>';
                    echo '<td>'.$row['first_name'].'</td>';
                    echo '<td>'.$row['last_name'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    if($row['role_id'] == 1){
                        echo '<td>Admin</td>';
                    }else{
                        echo '<td>User</td>';
                    }
                echo '</tr>';
            }
            if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1){
                echo '<p>1</p>';
            }
            ?>
            </tbody>
            </table>
    </body>
</html>