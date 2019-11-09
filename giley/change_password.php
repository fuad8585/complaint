<?php
session_start();
$title = "Giley";




include('includes/connection.php');


if (!(isset($_SESSION['user_email']))) {
    header("location: index.php");
}

?>
<?php $user      = $_SESSION['user_email'];
$get_user   = "select * from users where user_email='$user'";
$run_user   = mysqli_query($con, $get_user);
$row        = mysqli_fetch_array($run_user);

$user_id    = $row['user_id'];
$user_name  = $row['user_name']; ?>
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
                <h3><strong>Şifrəni Dəyiş</strong></h3>
            </div>
            <div class="l_pass">
                <form action="" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="pass" placeholder="Yeni Şifrə" id="password" required>
                        </div>                  
                        <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Yeni Şifrə - Təkrar" name="pass1" required>
                    </div>
                    <br>
                    <center><button id="signup" class="btn btn-info btn-lg" name="change">Ok</button></center>
                </form>
            </div>
        </div>
    </div>
</div>  

</body>
</html>

<?php 
    if(isset($_POST['change'])){
        $pass = htmlentities(mysqli_real_escape_string($con,$_POST['pass']));
        $pass1 = htmlentities(mysqli_real_escape_string($con,$_POST['pass1']));
        
        if ($pass ==$pass1){
            if(strlen($pass) >5 && strlen($pass) <= 60){
                $run = mysqli_query($con,"update users set user_pass='$pass' where user_id='$user_id'");
                echo "<script>alert('Şifrə dəyişdirilib.')</script>";
                echo "<script>window.open('home.php','_self')</script>";
    
            } else {
                echo "<script>alert('Şifrə 6 simvoldan çox olmalıdır')</script>";
            }
        } else {
            echo "<script>alert('Şifrə üst-üstə düşmür.')</script>";
            echo "<script>window.open('change_password.php','_self')</script>";
        }
    }

?>