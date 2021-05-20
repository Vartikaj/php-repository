<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                include "config.php";
                $sql = "SELECT * FROM settings";
                $data = mysqli_query($con,$sql) or die("Query failed");
                if(mysqli_num_rows($data) > 0){
                    while($row = mysqli_fetch_assoc($data)){
            ?>
                <span><?php echo $row['footerdes'];?></span>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
