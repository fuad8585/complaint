<?php 

$s_r = "localhost";
$u_e = "babayevsafetyaz";
$p_d = "";
$d_e = "babayevsafetyaz_iiumcms";

$con = mysqli_connect($s_r, $u_e, $p_d, $d_e);
mysqli_set_charset($con,'utf-8');



mysqli_query($con,"SET babayevsafetyaz_iiumcms 'utf-8'");
?>