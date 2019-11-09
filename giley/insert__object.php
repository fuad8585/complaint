<?php
session_start();
$title = "Giley - Əlavə et";
$link  = "style/insert.css";
include("includes/header.php");



if (!(isset($_SESSION['user_email']))) {
    header("location: index.php");
}
?>
<form  accept-charset="utf-8" class="insert" action="insert__object.php?id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
    <label>Google lokasiya: <input name="location" type="text" class="form-control" required="required"></label>
    <label>Servis adı: <input name="title" type="text" class="form-control" required="required"></label>
    <label>Servis izahı: <input name="description" type="text" class="form-control" required="required"></label>
    <label>Foto:<input name='u_image' type="file" class="custom-file-input" value="Foto" required="required"></label>
    <label>Xeşteq:<input data-role="tagsinput" class="hash form-control" name="hashtag" type="text" required="required"></label>
    <div class="btn"><input name="submit" class="submit__btn" type="submit" value="Okey"></div>
</form>
<?php
if (isset($_POST['submit'])) {
    $u_image        = $_FILES['u_image']['name'];
    $image_tmp       = $_FILES['u_image']['tmp_name'];
    $random_number   = rand(1, 100);

    if ($u_image == '') {
        echo "<script>('Fotonu sech')</script>";
        echo "<script>window.open('insert__object.php?u_id=$user_id','_self')</script>";
        exit();
    } else {
        move_uploaded_file($image_tmp, "image_post/$random_number.$u_image");

        $location       = htmlentities(mysqli_real_escape_string($con, $_POST['location']));
        $object_name    = htmlentities(mysqli_real_escape_string($con, $_POST['title']));
        $object_desc    = htmlentities(mysqli_real_escape_string($con, $_POST['description']));
        $foto           = "$random_number.$u_image";
        $hash           = htmlentities(mysqli_real_escape_string($con, $_POST['hashtag']));
        $rate           = "0";
        echo $object_name;
        if (is_string(get_hash_arr($hash))) {
            echo get_hash_arr($hash);
            echo "<script>window.open('insert__object.php','_self')</script>";
            exit();
        } else {

            $insert         = "insert into object (user_id,title,upload_image,location,rate,post_date,description)
                values ('$user_id','$object_name','$foto','$location','$rate',NOW(),'$object_desc')";

            $query          = mysqli_query($con, $insert);

            if ($query) {
                $updt = "update users set posts='yes' where user_id='$user_id'";
                $run_update = mysqli_query($con, $updt);

                $hash_arr = get_hash_arr($hash);

                foreach($hash_arr as $n => $hash_var){

                    $check_hash   = "select * from hashtag where hash='$hash_var'";
                    $check_hash_q = mysqli_query($con, $check_hash);
                    $check_hash_r = mysqli_num_rows($check_hash_q);

                    if ($check_hash_r == 1){
                        $hash_id        = "select id from hashtag where hash='$hash_var'";
                        $hash_id_q      =  mysqli_query($con,$hash_id);
                        $hash_id_out    =  mysqli_fetch_array($hash_id_q);
    
                        $h_id           =  $hash_id_out['id'];


                        $object_id      = "select id from object where upload_image='$random_number.$u_image'";
                        $object_id_q    =  mysqli_query($con,$object_id);
                        $object_id_out  =  mysqli_fetch_array($object_id_q);
    
                        $o_id           =  $object_id_out['id'];

                        $insert_object_hastag = "insert into object_hashtag (object_id,hashtag_id) values ('$o_id','$h_id')";
                        $object_hastag_query  = mysqli_query($con, $insert_object_hastag);


                    } else {
                        $add_hashtags   = "insert into hashtag (hash) values ('$hash_var')";
                        $hash_query     = mysqli_query($con, $add_hashtags);

                        $hash_id        = "select id from hashtag where hash='$hash_var'";
                        $hash_id_q      =  mysqli_query($con,$hash_id);
                        $hash_id_out    =  mysqli_fetch_array($hash_id_q);
    
                        $h_id           =  $hash_id_out['id'];


                        $object_id      = "select id from object where upload_image='$random_number.$u_image'";
                        $object_id_q    =  mysqli_query($con,$object_id);
                        $object_id_out  =  mysqli_fetch_array($object_id_q);
    
                        $o_id           =  $object_id_out['id'];

                        $insert_object_hastag = "insert into object_hashtag (object_id,hashtag_id) values ('$o_id','$h_id')";
                        $object_hastag_query  = mysqli_query($con, $insert_object_hastag);
                    }

                }

                echo "<script>alert('Hörmətli $first_name, siz yeri elave etdiniz.')</script>";
                echo "<script>window.open('home.php','_self')</script>";


                exit();
            } else {
                echo "<script>alert('alınmadı. Bir daha yoxlayın.')</script>";

                echo "<script>window.open('insert__object.php','_self')</script>";
            }
        }
    }
}

?>


<?php include("includes/footer.php"); ?>