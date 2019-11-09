<?php
session_start();
$title = 'Gileylən';
$link  = 'style/single.css';
include("includes/header.php") 

?>

<div class="row">


<?php if (isset($_POST['rate_up']) || isset($_POST['rate_down'])) {
    $postid = $_POST['object_id'];
    $object_que = mysqli_query($con, "select * from object where id='$postid'");
    $object_row = mysqli_fetch_array($object_que);
    $object_rate = $object_row['rate'];

    $rate_que = mysqli_query($con, "select * from rate where user_id='$user_idd' and object_id='$postid'");
    
    if (mysqli_num_rows($rate_que) == 1) {
        $last_voted_que       = mysqli_query($con,"select last_voted from rate where user_id='$user_idd' and object_id='$postid'");
        $last_voted_fetch     = mysqli_fetch_array($last_voted_que);
        $last_voted           = $last_voted_fetch['last_voted'];

        if ($last_voted == 'up') {


            if (isset($_POST['rate_up'])) {
                $object_rate = $object_rate - 1;
        
                mysqli_query($con, "update object set rate='$object_rate' where id='$postid'");
                mysqli_query($con, "delete from rate where user_id='$user_idd' and object_id='$postid' and last_voted='up'");
                
                exit();
            } 
            elseif (isset($_POST['rate_down'])) {
                $object_rate = $object_rate - 2;

                mysqli_query($con, "update object set rate='$object_rate' where id='$postid'");
                mysqli_query($con, "update rate set last_voted='down' where user_id='$user_idd' and object_id='$postid' and last_voted='up'");

                exit();
            }
        }
        elseif ($last_voted == 'down') {

            if (isset($_POST['rate_up'])) {
                $object_rate = $object_rate + 2;
        
                mysqli_query($con, "update object set rate='$object_rate' where id='$postid'");
                mysqli_query($con, "update rate set last_voted='up' where user_id='$user_idd' and object_id='$postid' and last_voted='down'");
                
                exit();
            } 
            elseif (isset($_POST['rate_down'])) {
                $object_rate = $object_rate + 1;

                mysqli_query($con, "update object set rate='$object_rate' where id='$postid'");
                mysqli_query($con, "delete from rate where user_id='$user_idd' and object_id='$postid' and last_voted='down'");

                exit();
            }
        }




    } else {
        if (isset($_POST['rate_up'])) {
            $object_rate++;
    
            mysqli_query($con, "update object set rate='$object_rate' where id='$postid'");
            mysqli_query($con, "insert into rate (user_id,object_id,last_voted) values ('$user_idd','$postid','up')");
            exit();
        } 
        elseif (isset($_POST['rate_down'])) {
            $object_rate--;
    
            
            mysqli_query($con, "update object set rate='$object_rate' where id='$postid'");
            mysqli_query($con, "insert into rate (user_id,object_id,last_voted) values ('$user_idd','$postid','down')");
  
            exit();
        }
    }

}?>

<?php $user       = $_SESSION['user_email'];
$get_user   = "select * from users where user_email='$user'";
$run_user   = mysqli_query($con, $get_user);
$cc_row        = mysqli_fetch_array($run_user);

$user_iid            = $cc_row['user_id'];


if (isset($_POST['crate_up']) || isset($_POST['crate_down'])) {
    $comment_id = $_POST['comment_id'];
    $c_que = mysqli_query($con, "select * from comment where id='$comment_id'");
    $c_row = mysqli_fetch_array($c_que);
    $c_rate = $c_row['rate'];

    $c_rate_que = mysqli_query($con, "select * from c_rate where user_id='$user_iid' and comment_id='$comment_id'");
    
    if (mysqli_num_rows($c_rate_que) == 1) {
        $c_last_voted_que       = mysqli_query($con,"select last_voted from c_rate where user_id='$user_iid' and comment_id='$comment_id'");
        $c_last_voted_fetch     = mysqli_fetch_array($c_last_voted_que);
        $c_last_voted           = $c_last_voted_fetch['last_voted'];

        if ($c_last_voted == 'up') {


            if (isset($_POST['crate_up'])) {
                $c_rate = $c_rate - 1;
        
                mysqli_query($con, "update comment set rate='$c_rate' where id='$comment_id'");
                mysqli_query($con, "delete from c_rate where user_id='$user_iid' and comment_id='$comment_id' and last_voted='up'");
                
                exit();
            } 
            elseif (isset($_POST['crate_down'])) {
                $c_rate = $c_rate - 2;

                mysqli_query($con, "update comment set rate='$c_rate' where id='$comment_id'");
                mysqli_query($con, "update c_rate set last_voted='down' where user_id='$user_iid' and comment_id='$comment_id' and last_voted='up'");

                exit();
            }
        }
        elseif ($c_last_voted == 'down') {

            if (isset($_POST['crate_up'])) {
                $c_rate = $c_rate + 2;
        
                mysqli_query($con, "update comment set rate='$c_rate' where id='$comment_id'");
                mysqli_query($con, "update c_rate set last_voted='up' where user_id='$user_iid' and comment_id='$comment_id' and last_voted='down'");
                
                exit();
            } 
            elseif (isset($_POST['crate_down'])) {
                $c_rate = $c_rate + 1;

                mysqli_query($con, "update comment set rate='$c_rate' where id='$comment_id'");
                mysqli_query($con, "delete from c_rate where user_id='$user_iid' and comment_id='$comment_id' and last_voted='down'");

                exit();
            }
        }




    } else {
        echo"<script>alert('sds');</script>";
        if (isset($_POST['crate_up'])) {
            $c_rate++;
    
            mysqli_query($con, "update comment set rate='$c_rate' where id='$comment_id'");
            mysqli_query($con, "insert into c_rate (user_id,comment_id,last_voted) values ('$user_iid','$comment_id','up')");
            exit();
        } 
        elseif (isset($_POST['crate_down'])) {
            $c_rate--;
    
            
            mysqli_query($con, "update comment set rate='$c_rate' where id='$comment_id'");
            mysqli_query($con, "insert into c_rate (user_id,comment_id,last_voted) values ('$user_iid','$comment_id','down')");
  
            exit();
        }
    }

} ?>


<?php single_post(); ?>

</div>
<script>
    $(document).ready(function() {

        $('.r_up').click(function() {

            var postid = $(this).attr('id');
            $.ajax({

                url: 'home.php',
                type: 'post',
                async: false,
                data: {
                    'rate_up': 1,
                    'object_id': postid

                },
                success: function() {

                }

            });
            document.location.reload(true)
        });

    });

    $(document).ready(function() {

        $('.r_down').click(function() {
            var postid = $(this).attr('id');
            $.ajax({

                url: 'home.php',
                type: 'post',
                async: false,
                data: {
                    'rate_down': 1,
                    'object_id': postid

                },
                success: function() {

                }

            });
            document.location.reload(true)
        });
    });
</script>



<script>
    $(document).ready(function() {

        $('.cr_up').click(function() {

            var comment_id = $(this).attr('id');
            $.ajax({

                url: 'single.php',
                type: 'post',
                async: false,
                data: {
                    'crate_up': 1,
                    'comment_id': comment_id

                },
                success: function() {

                }

            });
            document.location.reload(true)
        });

    });

    $(document).ready(function() {

        $('.cr_down').click(function() {
            var comment_id = $(this).attr('id');
            $.ajax({

                url: 'single.php',
                type: 'post',
                async: false,
                data: {
                    'crate_down': 1,
                    'comment_id': comment_id

                },
                success: function() {

                }

            });
            document.location.reload(true)
        });
    });




</script>
<?php include('includes/footer.php'); ?>

