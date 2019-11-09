<?php include("includes/connection.php");

    if(isset($_POST['sign_up'])){
        $first_name    = htmlentities(mysqli_real_escape_string($con,$_POST['first_name'])); 
        $last_name     = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
        $pass          = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
        $email         = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
        $gender        = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));

        $status  = "verified";
        $posts   = "no";

        $newgid = sprintf("%05d", rand(0, 999999));

        $username             = strtolower($first_name .'_'. $last_name .'_'. $newgid);
        $check_username_query = "select user_name from users where user_email='$email'";
        $run_username         = mysqli_query($con,$check_username_query);

        if(strlen($pass)< 6) {
            echo "<script>  alert('Şifrə ən azı 6 simvol olmalıdır.') </script>";
            exit();
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL)){

       

            $check_email_query   = "select * from users where user_email='$email'";
            $run_email           = mysqli_query($con,$check_email_query);

            $check = mysqli_num_rows($run_email);
        
            if ($check == 1) {
                echo "<script>alert('Bu email artıq mövcuddur. Digərini yazın.')</script>";

                echo "<script>window.open('signup.php','_self')</script>";
                exit();
            }


            $profile_pic = "p.png";
        
            $insert      = "insert into users (f_name,l_name,user_name,user_pass,user_email,user_gender,user_image,user_reg_date,status,posts)
                values('$first_name','$last_name','$username','$pass','$email','$gender','$profile_pic',NOW(),'$status','$posts')";
            $query       = mysqli_query($con, $insert);
            
            if($query){
                echo "<script>alert('Hörmətli $first_name, siz qeydiyyatı bitirdiniz.')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "<script>alert('Qeydiyyat alınmadı. Bir daha yoxlayın.')</script>";

                echo "<script>window.open('signup.php','_self')</script>";
            }
      
      } else {
          echo  "<script>alert('Email ünvan növü düzgün deyil. Bir daha yoxlayın.')</script>";
      }
    }
   
?>

