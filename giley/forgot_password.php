<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unudulmuş Şifrə</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,700|Muli:400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/f_pass.css">

</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header__content">
                <h3><strong>Şifrə unudulub?</strong></h3>
            </div>
            <div class="l_pass">
                <form action="" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
                        </div>
                        <hr>
                        
                        <pre class="text">Vətəndaş mövqeyin nədir?</pre>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class="form-control" placeholder="Cavab" name="recover_accaunt" required>
                    </div>
                    <br>
                    <a href="main.php">Girişə qayıt.</a> <br><br>
                    <center><button id="signup" class="btn btn-info btn-lg" name="submit">Ok</button></center>
                </form>
            </div>
        </div>
    </div>
</div>  

</body>
</html>

<?php
session_start();
include("includes/connection.php");

    if (isset($_POST['submit'])) {
        $email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
        $recover_accaunt  = htmlentities(mysqli_real_escape_string($con,$_POST['recover_accaunt']));

        $select_user = "select * from users where user_email='$email' AND
        recovery_accaunt='$recover_accaunt' AND status='verified'";
        $query       = mysqli_query($con,$select_user);
        $check_user = mysqli_num_rows($query);

        if ($check_user == 1) {
            $_SESSION['user_email'] = $email;

            echo "<script>window.open('change_password.php','_self')</script>";
        } else {
            echo "<script>alert('Email və ya Cavab səhvdir. Yenidən yoxlayın.')</script>";
        }

    }



?>