<?php include("includes/connection.php");
include("functions/functions.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,700|Muli:400,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="<?php echo $link; ?>">

</head>

<body>
    <?php

    $user       = $_SESSION['user_email'];
    $get_user   = "select * from users where user_email='$user'";
    $run_user   = mysqli_query($con, $get_user);
    $row        = mysqli_fetch_array($run_user);

    $user_id            = $row['user_id'];
    $user_name          = $row['user_name'];
    $first_name         = $row['f_name'];
    $last_name          = $row['l_name'];
    $user_pass          = $row['user_pass'];
    $user_email         = $row['user_email'];
    $user_gender        = $row['user_gender'];
    $user_image         = $row['user_image'];
    $recovery_accaunt   = $row['recovery_accaunt'];
    $register_date      = $row['user_reg_date'];
    $voted              = $row['voted'];


    $user_posts = "select * from object where user_id='$user_id'";
    $run_posts  = mysqli_query($con, $user_posts);
    $posts      = mysqli_num_rows($run_posts);
    ?>

    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="home.php">
                    <h1 class="header__logo">
                        Giley.
                    </h1>
                </a>
            </div>

        </div>
    </header>
    <div class="container">

        <div class="main__inner">
            <div class="leftside">
                <ul>
                    <li><a href="home.php?<?php $u_id = $user_id;?>"><i class="fas fa-home"></i>Ev</a></li>
                    <li><a href="notifications.php?<?php $u_id = $user_id; ?>"><i class="fas fa-bell"></i>Bildirimlər</a></li>
                    <li><a href="profile.php?<?php $u_id = $user_id;?>"><i class="fas fa-user-alt"></i></i>Profil</a></li>
                    <li><a href="edit_profile.php?<?php $u_id = $user_id;?>"><i class="fas fa-user-edit"></i>Tənzimləmə</a></li>
                    <li><a class="logout" name="exit" href="logout.php?$u_id=$user_id"><i class="fas fa-sign-out-alt"></i>Çıxış</a></li>
                </ul>
            </div>
            <div class="middle">
                <div class="m_links">
            <ul>
                    <li><a href="home.php?<?php $u_id = $user_id;?>"><i class="fas fa-home"></i>Ev</a></li>
                    <li><a href="notifications.php?<?php $u_id = $user_id; ?>"><i class="fas fa-bell"></i>Bildirim</a></li>
                    <li><a href="profile.php?<?php $u_id = $user_id;?>"><i class="fas fa-user-alt"></i></i>Profil</a></li>
                    <li><a href="edit_profile.php?<?php $u_id = $user_id;?>"><i class="fas fa-user-edit"></i>Düzəlt</a></li>
                    <li><a class="logout" name="exit" href="logout.php?$u_id=$user_id"><i class="fas fa-sign-out-alt"></i>Çıxış</a></li>
                </ul>
                </div>