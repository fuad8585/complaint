</div>
<div class="rightside">
    <?php 
    $hash_q = "SELECT * FROM hashtag ORDER BY id DESC LIMIT 10";
    $hash_r = mysqli_query($con,$hash_q);
    
    while ($hash_f = mysqli_fetch_array($hash_r)){
        $hash = $hash_f['hash'];
        $hash1 = substr($hash,1);
        echo "<a href='hashs.php?h_result=$hash1'><p>$hash</p></a>";
    }
    
    ?>
 
</div>

</div>
</div>







</body>

</html>