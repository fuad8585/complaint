<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Giley - Qeydiyyat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,700|Muli:400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/signup.css">
</head>
<body>
    <div class="bg__plyonka">
        <form method="post" accept-charset="UTF-8" action="signup.php">
            <div class="signup__box">
                <h1>Qeydiyyat</h1>
                <div class="textbox">
                    <input type="text" name="first_name" placeholder="Ad" required="required">
                </div>
                <div class="textbox">
                    <input type="text" name="last_name" placeholder="Soyad" required="required">
                </div>
                <div class="textbox">
                    <input class="email" type="text" name="u_email" placeholder="Email" required="required">
                </div>
                <div class="textbox">
                    <input class="password" type="text" name="u_pass" placeholder="Şifrə" required="required">
                </div>
                <div class="textbox">
                    <select class="gender" name="u_gender" id="" required="required">
                        <option disabled>Cins:</option>
                        <option>Kişi</option>
                        <option>Qadın</option>
                        <option>?</option>
                    </select>
                </div>
                <a data-toggle="tooltip" class="registr_yes" title="Daxil Ol" href="index.php">Qeydiyyatdan keçmisən?</a>
                <center><button id="signup" class="q__btn" name="sign_up">Qeydiyyatı bitir</button></center>
                <?php include("insert_user.php"); ?>
            </div>
        </form>
    </div>
</body>
</html>