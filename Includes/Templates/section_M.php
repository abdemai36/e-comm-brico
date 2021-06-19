<?php
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
?>

    <div class="Section_marc Section">
    <h3 class='h3-categ'><span>Tous les marques</span></h3>
    <div class="wrraper-product" style="height:100px;">
            <div class="slider-product">
        
            <?php 
                    $query="SELECT * FROM marque_tb";
                    $result=mysqli_query($conx,$query);
                    if($result){
                        while($row=mysqli_fetch_array($result)){
                            echo "<img src='Admin/avatar/".$row['Image_M']."' style='max-width:100px; max-height:100px;margin:5px 15px;'>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    

<?php
    include_once('Includes/Templates/footer.php');
?>