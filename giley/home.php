<?php
session_start();
$title = "Giley";




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


<form method="get" action="results.php">
    <div class="search_box">
        <input type="text" name="user_query" placeholder="Şikayət edəcəyin məkan, servis, şəxs..">
        <button type="submit" class="submit" name="search"><i class="fas fa-search"></i></button>
    </div>
</form>

<a href="insert__object.php?$u_id = $user_id" class="insert__object">Tapa bilmədinsə əlavə et..</a>
<div class="objects__inner">
    <h2 class="recent__objects">Son Paylaşımlar</h2>

    <?php include("postsz.php"); ?>
</div>

<?php include('includes/footer.php'); ?>


