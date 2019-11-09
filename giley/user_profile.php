<?php
session_start();
$link = 'style/u_profile.css';
$title='susma';
include("includes/header.php");

if (!isset($_SESSION['user_email'])){
    header("location: index.php");
}

?>

<div class="row">
    <?php
        if (isset($_GET['u_id'])){
            $u_id = $_GET['u_id'];
        }
        if ($u_id < 0 || $u_id == ""){
            echo "<script>window.open('home.php','_self')<script/>";
        } else { 
    ?>
    <div class="col-sm-12">
        <?php 
            if(isset($_GET['u_id'])){
                global $con;
                $user_id = $_GET['u_id'];
                $select = "select * from users where user_id='$user_id'";
                $run    = mysqli_query($con,$select);
                $row    = mysqli_fetch_array(($run));

                $name   = $row['user_name'];

            }
        ?>
        <?php 
            if(isset($_GET['u_id'])){
                global $con;

                $user_id    = $_GET['u_id'];
                $select = "select * from users where user_id='$user_id'";
                $run    = mysqli_query($con,$select);
                $row    = mysqli_fetch_array(($run));

                $id            = $row['user_id'];
                $image         = $row['user_image'];
                $name          = $row['user_name'];
                $f_name        = $row['f_name'];
                $l_name        = $row['l_name'];
                $gender        = $row['user_gender'];
                $user_reg_date = $row['user_reg_date'];
                echo "
                <div class='row'>
                <div class='col-sm-1'></div>
                <center>
                    <div class='col-sm-6 col-sm-offset-2'>
                        <h2>İnfo</h2>
                        <img src='image_user/$image'>
                        <br><br>
                        <ul class='list-group'>
                            <li class='list-group-item' ><strong>$f_name $l_name</strong></li>
                            <li class='list-group-item' ><strong>$gender</strong></li>
                            <li class='list-group-item' ><strong>$user_reg_date</strong></li>
                        </ul>
                        </div>
                    </center>        
                 </div>
                ";

            }
        }
        ?>
    </div>
</div>
    <?php include("includes/footer.php");//8KIhOe8asBU( ?>