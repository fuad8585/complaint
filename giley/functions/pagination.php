<style>
.pagination a{
    margin-top: 20px;
    color:#4caf50;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: all .3s;
    border: 1px solid #f5f4f2;
}
.pagination a:hover:not(.active){ background-color: #ddd;}
</style>


<?php

    $query = "select * from object";
    $result = mysqli_query($con, $query);

    $total_posts = mysqli_num_rows($result);

    $total_pages = ceil($total_posts / $per_page);

    echo "
        <center>
        <div class='pagination'>
        <a href='home.php?page=1'>First Page</a>
    ";
    for ($i=1; $i<=$total_pages; $i++){
        echo "<a href='home.php?page=$i'>$i</a>";
    }

    echo "<a href='home.php?page=$total_pages'>Last Page</a></div>";

?>