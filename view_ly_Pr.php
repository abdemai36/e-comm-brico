<?php

    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Templates/SidBar.php');

?>

    <div class="Main">
    
    <?php
        $id=(isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
        $query="SELECT * FROM product_tb WHERE ID_Product=$id";
        $result=mysqli_query($conx,$query);
        if($result)
        {
            while($row=mysqli_fetch_array($result)){?>
                <div class="Card">
                    <div class="Card-images">
                        <?php 
                            $res=$row[8];
                            $res=explode(" ",$res);
                            $count=count($res)-1;
                            for($i=0;$i<1;$i++)
                            {?>
                                <img class="Big-img" src='Admin/avatar/<?php echo $res[$i]?>' alt="image">
                            <?php }
                        ?>
                        

                        <div class="small-imgs">
                        <?php 
                            $res=$row[8];
                            $res=explode(" ",$res);
                            $count=count($res)-1;
                            for($i=0;$i<$count;$i++)
                            {?>
                                <img  src='Admin/avatar/<?php echo $res[$i]?>' alt='image'>
                            <?php }
                        ?>
                        </div>
                    </div>
                    <div class="Card-body">
                        <h2><?php echo $row['Name_P']?></h2>
                        <span class="ref">Ref : <?php echo $row['Reference']?></span>
                        <div class="Prices">
                            <span><?php echo $row['Price']?>DH</span>
                            <span><?php echo $row['Pric_old']?>DH</span>
                        </div>
                        <?php
                                if($row['InStock']==1)
                                {
                                    $row['InStock']='En stock';
                                    echo "<span style='margin-top: 8px; font-weight:bold;text-align: end;'>Disponibilité: <span style='color:#30d730; margin-right:5px;' >".$row['InStock']."</span></span>";
                                }else{
                                    $row['InStock']='Pas es stock';
                                    echo "<span style='margin-top: 8px;font-weight:bold;text-align: end;'>Disponibilité:<span style='color:red;margin-right:5px;'>".$row['InStock']."</span></span>";
                                }
                                ?>
                        
                        <div class="controls-qeuntity">
                            <input type="number">
                            <button>acheter maintenant</button>
                        </div>
                        <div class="contactes">
                            <i class="fab fa-whatsapp-square wtsp"></i>
                            <i class="fab fa-facebook-square fb"></i>
                            <i class="fab fa-instagram insta"></i>
                        </div>
                    </div>
                </div>
            <?php }
        }
    ?>
    </div>

<?php
    include_once('Includes/Templates/footer.php');
?>