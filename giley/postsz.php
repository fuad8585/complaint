<?php
global $con;
$per_page = 4;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}



$userr       = $_SESSION['user_email'];
$get_userr   = "select * from users where user_email='$userr'";
$run_userr   = mysqli_query($con, $get_userr);
$roww        = mysqli_fetch_array($run_userr);

$user_idd            = $roww['user_id'];



if (isset($_POST['rate_up']) || isset($_POST['rate_down'])) {
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

}





$start_from = ($page - 1) * $per_page;

$get_posts = "select * from object ORDER BY `object`.`rate` DESC LIMIT $start_from, $per_page";

$run_posts = mysqli_query($con, $get_posts);




while ($row_posts = mysqli_fetch_array($run_posts)) {
    
    $post_id = $row_posts['id'];
    $user_id = $row_posts['user_id'];
    $title     = $row_posts['title'];
    $content = substr($row_posts['description'], 0, 300);
    $upload_image = $row_posts['upload_image'];
    $post_date = $row_posts['post_date'];
    $location    = $row_posts['location'];
    $rate = $row_posts['rate'];

    $user = "select * from users where user_id='$user_id' AND posts='yes'";
    $run_user = mysqli_query($con, $user);
    $row_user = mysqli_fetch_array($run_user);

    $user_name = $row_user['user_name'];
    $user_image = $row_user['user_image'];
   
    $last_voted_que       = mysqli_query($con,"select last_voted from rate where user_id='$user_idd' and object_id='$post_id'");
    $last_voted_fetch     = mysqli_fetch_array($last_voted_que);
    $last_voted           = $last_voted_fetch['last_voted'];

    if ($rate == 0) {
        $color_n = 'rgb(44, 44, 44)';
    }
    elseif ($rate > 0) {
        $color_n = 'rgb(0, 107, 0)';
    }
    elseif ($rate < 0) {
        $color_n = 'rgb(212, 0, 0)';
    }

    if ($last_voted == 'up') {
        $color_up = 'green';
        $color_down = 'rgb(44, 44, 44)';
    }
    elseif ($last_voted == 'down') {
        $color_up = 'rgb(44, 44, 44)';
        $color_down = 'red';
    } else {
        $color_up = 'rgb(44, 44, 44)';
        $color_down = 'rgb(44, 44, 44)';
    }
    
    
    //hashtagzzz
    $obj_hash_run = mysqli_query($con, $obj_hash_que = "select hashtag_id from object_hashtag where object_id='$post_id'");
    
    $hash_id_arr = array();
    while($obj_hash_fetch = mysqli_fetch_array($obj_hash_run)){
        
       $hash_id_arr[] = $obj_hash_fetch['hashtag_id'];
       
    }
    $hash_arr = array();
    for($i=0;$i<count($hash_id_arr);$i++){
        $hash_id = $hash_id_arr[$i];
        $hash_que = "select hash from hashtag where id='$hash_id'";
        $run_hash_que = mysqli_query($con,$hash_que);
        while ($hash_fetch = mysqli_fetch_array($run_hash_que)){
            $hash_arr[] = $hash_fetch['hash'];
        }
    }

    


///////////
    echo "

		<div class='row'>
		
  
    <input id='$post_id' type='hidden' name='$post_id' value='' />
        <div class='object'>
            <div class='object__inner'>
                <img src='image_post/$upload_image' class='object_image'>
                <div class='object__title'>$title</div>
                <div class='object__description'>$content..</div>
            </div>
            <div class='object__rate'>

                <button style='color:$color_up;' id='$post_id'  class='r_up'><i class='fas fa-caret-square-up'></i></button>
                <div  style='color:$color_n'; class='o_r'>$rate</div>
                <button style='color:$color_down;' id='$post_id'  class='r_down'><i class='fas fa-caret-square-down'></i></button>
            </div>
            <div class='hashs_con'>"; for($i=0; $i<count($hash_arr); $i++){ $hash = $hash_arr[$i]; $hash1 = substr($hash,1); echo"<a href='hashs.php?h_result=$hash1' class='hashs'>$hash</a>";  }  echo"</div>
            <div class='object__complain-btn'>
                <a href='single.php?post_id=$post_id'><button class='btn btn-info'>Şikayət Et</button></a>
            </div>
        </div>
     
	</div>";
}

//RATE]]







?>



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