<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giley - Giriş, Qeydiyyat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,700|Muli:400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
    <div class="bg__plyonka">
        <h1>giley bir olsa, dağ oynayar yerindən.</h1>
        <form method="post" action="" class="login">
            <div class="login-box">
                <h2>Giriş</h2>
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Email" required="required">
                </div>

                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pass" placeholder="Şifrə" required="required">
                </div>

                <input type="submit" name="login" class="login__btn" value="Daxil Ol">

                <?php include('login.php'); ?>

                <a href="signup.php"  title="Qeydiyyat" class="registr" >Qeydiyyatdan keç</a>
                <a href="forgot_password.php?" class="registr" >Şifrəni unutmuşam</a>
            
            </div>
        </form>
    </div>


</body>

</html>
