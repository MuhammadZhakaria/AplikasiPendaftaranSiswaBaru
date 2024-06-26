<?php 
// Include the database configuration file  
include 'config.php';
 
// Get image data from database 
$result = $connection->query("SELECT FotoSiswa FROM ptb_master_datasiswa WHERE Id_calonSiswa=11"); 
?>

<!-- Display images with BLOB data from database -->
<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){ ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['FotoSiswa']); ?>"  style="width:300px;height:450px;"/>
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>