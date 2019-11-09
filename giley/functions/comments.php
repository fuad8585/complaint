<?php 
$get_id     = $_GET['post_id'];
$get_com    = "select * from comment where object_id='$get_id' ORDER BY `comment`.`rate` DESC";
$run_com    = mysqli_query($con,$get_com);



$user       = $_SESSION['user_email'];
$get_user   = "select * from users where user_email='$user'";
$run_user   = mysqli_query($con, $get_user);
$cc_row        = mysqli_fetch_array($run_user);

$user_iid            = $cc_row['user_id'];




while ($row = mysqli_fetch_array($run_com)){
    //rand color
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $randcol = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    // get giley info
    $com_id      = $row['id'];
    $com         = $row['comment'];
    $com_name    = $row['comment_author'];
    $date        = $row['date'];
    $user_com_id = $row['user_id'];
    $c_rate    = $row['rate'];
    
    //get user image
    $user_image_que   = mysqli_query($con, "select user_image from users where user_id='$user_com_id'");
    $user_image_fetch = mysqli_fetch_array($user_image_que);
    $user_image       = $user_image_fetch['user_image'];

    $c_last_voted_que       = mysqli_query($con,"select last_voted from c_rate where user_id='$user_iid' and comment_id='$com_id'");
    $c_last_voted_fetch     = mysqli_fetch_array($c_last_voted_que);
    $c_last_voted           = $c_last_voted_fetch['last_voted'];

    if ($c_rate == 0) {
        $color_n = 'rgb(44, 44, 44)';
    }
    elseif ($c_rate > 0) {
        $color_n = 'rgb(0, 107, 0)';
    }
    elseif ($c_rate < 0) {
        $color_n = 'rgb(212, 0, 0)';
    }

    if ($c_last_voted == 'up') {
        $color_up = 'green';
        $color_down = 'rgb(44, 44, 44)';
    }
    elseif ($c_last_voted == 'down') {
        $color_up = 'rgb(44, 44, 44)';
        $color_down = 'red';
    } else {
        $color_up = 'rgb(44, 44, 44)';
        $color_down = 'rgb(44, 44, 44)';
    }


     echo"
     <div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-info'>
            <div class='panel-body'> 
            <a href='user_profile.php?u_id=$user_com_id'><img class='comment_user-image' src='image_user/$user_image'></a>
                
                <h4 style='color:$randcol' >$com_name</h4>
                <p>$com</p>
                 <div class='u_inf_inner'><strong>$date tarixində gileyləndi.</strong></div>
                 <div class='rate_container'>
                 <div class='object__rate'>
                    <button style='color:$color_up;' id='$com_id'  class='cr_up'><i class='fas fa-caret-square-up'></i></button>
                    <div  style='color:$color_n'; class='o_r'>$c_rate</div>
                    <button style='color:$color_down;' id='$com_id'  class='cr_down'><i class='fas fa-caret-square-down'></i></button>
                </div>
             
                </div>
		        </div>
            </div>
            <div class='c_reply'></div>
        </div>
    </div>
     ";
    
}


?>
