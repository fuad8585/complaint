<?php
session_start();
$title = "Nəticə";
$link = 'style/results.css';



include('includes/header.php');


if (!(isset($_SESSION['user_email']))) {
    header("location: index.php");
}

?>
<h1 class="results_h1">Nəticələr</h1>
<form method="get" action="results.php">
    <div class="search_box">
        <input type="text" name="user_query" placeholder="Şikayət edəcəyin məkan, servis, şəxs..">
        <button type="submit" class="submit" name="search"><i class="fas fa-search"></i></button>
    </div>
</form>
<?php results() ?>


<script>
    $(document).ready(function() {

        $('.r_up').click(function() {

            var postid = $(this).attr('id');
            $.ajax({

                url: 'results.php',
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

                url: 'results.php',
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
<?php include('includes/footer.php'); ?>


