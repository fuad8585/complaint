<?php
session_start();
$title = "Düzəlt";
$link = 'style/prof_edit.css';



include('includes/header.php');


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


<div class="row">

    <div class="col-sm-16">
    
        <div class='profile__pic'>
        <br><br>
        <?php echo "
            <div class='img__inner'><img src='image_user/$user_image' alt='Profil' class='prof__img'></div> " ?>
            <form action='' method='post' enctype='multipart/form-data'>
            <br>
            <label  for='img' class='filechoose' >Profil şəklini seç
            <input id='img' type='file' class='hidden' name='u_image'>
            </label>
            <br>
            <button class='updatebtn' name='update'>Profil fotonu yenilə</button>
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active"><h2>İnfo</h2></td>
                    </tr>
                    <tr>
                        <td style="font-weight:600";>Ad</td>
                        <td><input class="form-control" type="text" name='f_name' required value="<?php echo $first_name;?>"></td>
                    </tr>
                    <tr>
                        <td style="font-weight:600";>Soyad</td>
                        <td><input class="form-control" type="text" name='l_name' required value="<?php echo $last_name;?>"></td>
                    </tr>
                    <tr>
                        <td style="font-weight:600";>Cins</td>
                        <td>
                        <select name="u_gender" class="form-control" id="">
                            <option><?php echo $user_gender; ?></option>
                            <option>Kişi</option>
                            <option>Qadın</option>
                            <option>?</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td style="font-weight:600";>Şifrə</td>
                        <td><input class="form-control" type="password" name='u_pass' id="mypass" required value="<?php echo $user_pass;?>">
                            <input type="checkbox" onclick="show_password()"><strong>Şifrəni göstər</strong>
                    </td>
                    <tr>
                        <td style="font-weight:600";>Email</td>
                        <td><input class="form-control" type="email" name='u_email' required value="<?php echo $user_email;?>"></td>
                    </tr>
                        
                    </tr>
                    <tr>
                        <td style="font-weight:600">Unudulmuş Şifrə</td>
                        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Qoş</button>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" >&times;</button>
                                        <h4 class="modal-title">Şifrə unudulmuşdur</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="recovery.php?id=<?php echo $user_id;?>" method="post" id="f">
                                        <strong>Vətəndaş mövqeyin nədir?</strong>
                                        <textarea class="form-control" name="content" id="" cols="83" rows="4"></textarea>
                                        <br>
                                        <input class="btn btn-info" type="submit" name="sub" value="Hazır">
                                        <pre>Yuxarıdakı suala cavab ver ki, şifrəni<br>unutsan bərpa etməyinə kömək olsun.</pre>

                                    </form>
                                    <?php
                                        if(isset($_POST['sub'])){
                                            $btn = htmlentities($_POST['content']);

                                            if ($btn == ''){
                                                echo "<script>alert('Zəhmət olamasa cavab yaz.')</script>";
                                                echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
                                                exit();
                                            } else {
                                                $update = "update users set recovery_accaunt='$btn'
                                                where user_id='$user_id'";
                                                $run    = mysqli_query($con, $update);

                                                if($run){
                                                    echo "<script>alert('Proses gedir..')</script>";
                                                    echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
                                                    exit();
                                                } else {
                                                    echo "<script>alert('Error var.')</script>";
                                                    echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
                                                    exit();
                                                }
                                            }
                                        }
                                     ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" type="button" data-dismiss="modal">Bağla</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </td>
                        <tr align="center">
                            <td colspan="6"> 
                                <input type="submit" name="updated" class="btn btn-info" value="Yenilə">
                            </td>
                        </tr>
                    </tr>
                </table>
            </form>
        </div>
 
      
      <?php
        if (isset($_POST['update'])) {
            $u_image        = $_FILES['u_image']['name'];
            $image_tmp       = $_FILES['u_image']['tmp_name'];
            $random_number   = rand(1, 100);

            if ($u_image == '') {
                echo "<script>('Fotonu sech')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                exit();
            } else {
                move_uploaded_file($image_tmp, "image_user/$random_number.$u_image");

                $update = "update users set user_image='$random_number.$u_image' where user_id='$user_id'";
                $run = mysqli_query($con, $update);
                if ($run) {
                    echo "<script>('Foto yenilendi')</script>";
                    echo "<script>window.open('edit_profile.php?','_self')</script>";
                }
            }
        }

        ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
    if(isset($_POST['updated'])){
        $f_name = htmlentities($_POST['f_name']);
        $l_name = htmlentities($_POST['l_name']);
        $u_name = htmlentities($_POST['u_name']);
        $u_pass = htmlentities($_POST['u_pass']);
        $u_email = htmlentities($_POST['u_email']);
        $u_gender = htmlentities($_POST['u_gender']);

        $update     ="update users set f_name='$f_name',l_name='$l_name',user_pass='$u_pass',user_email='$u_email',user_gender='$u_gender' where user_id='$user_id'";
        
        if (strlen($u_pass) >=6 ){
            if (mysqli_query($con,$update)){
                echo "<script>alert('Alındı.')</script>";
                echo "<script>window.open('edit_profile.php?','_self')</script>";
            } else {
                echo "<script>alert('Alınmadı.')</script>";
            }
        } else {
            echo "<script>alert('minimum şifrə simvol sayı 6-dır.')</script>";
                echo "<script>window.open('edit_profile.php?','_self')</script>";
        }
        
    }

?>