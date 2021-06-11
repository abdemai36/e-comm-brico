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
                                    echo "<span style='margin-top: 8px; font-weight:bold;text-align: end; font-size: 12px;'>Disponibilité: <span style='color:#30d730; margin-right:5px;' >".$row['InStock']."</span></span>";
                                }else{
                                    $row['InStock']='Pas es stock';
                                    echo "<span style='margin-top: 8px;font-weight:bold;text-align: end; font-size: 12px;'>Disponibilité:<span style='color:red;margin-right:5px;'>".$row['InStock']."</span></span>";
                                }
                                ?>
                        
                        <div class="controls-qeuntity">
                            <input type="number">
                            <button class="btn-buy"><i class="fas fa-shopping-basket"></i>acheter maintenant</button>
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
    

    <div class="description">
        <h3 class="titel-description">Déscription</h3>
        <div class=description-body>
            <?php 
                $id=(isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
                $query="SELECT ID_categori,c.Name_Categori,m.Name_M,discription,ID_marque FROM product_tb p inner join categorie_tb c on p.Categorie =c.ID_categori inner join marque_tb m on p.Marque=m.ID_marque WHERE ID_Product=$id";
                $result=mysqli_query($conx,$query);
                if($result)
                {
                    while($row=mysqli_fetch_array($result)){
                        $_SESSION['id-categ']=$row[0];
                        ?>
                        <div>
                            <span class="sp-descrip-categ">Catégorie :</span> <a href="All_product_categ.php?id=<?php echo $row[0]?>"><?php echo $row[1]?></a>
                            <br>
                            <br>
                            <span class="sp-descrip-marque">Marque : </span> <span><?php echo $row[2]?></span>
                        </div>
                        <p>
                            <?php echo $row[3]?>
                        </p>
                    <?php }
                }else{
                    echo "waloooo";
                }
            ?>
         
        </div>
    </div>
    </div>

    <div class="Section">
        <h3 class='h3-categ'><span>Produits apparentés</span></h3>
        <div class="wrraper-product">
            <div class="slider-product">

        <?php
            $query="SELECT * FROM product_tb WHERE Categorie=".$_SESSION['id-categ']."";
            $result=mysqli_query($conx,$query);
            if($result){
                while($row=mysqli_fetch_array($result)){?>
                    <div class="produit">
                    <?php
                            $id=$row['ID_Product'];
                            $res=$row['Image'];
                            $res=explode(" ",$res);
                            $count=count($res)-1;
                            for($i=0;$i<1;$i++)
                            {?>
                                
                                <img class="img-produit" src='Admin/avatar/<?php echo $res[$i];?>'/>
                    <?php }?>
                    <hr style="color:#ffc400;  width:100%;">
                    <div class="icon-heart"><img src="Layout/Images/heart.png" alt=""></div>
                    <div class="icon-add-produit"><img src="Layout/Images/add_shopping.png" alt=""></div>
                    <h6 class="title-produit"><a href="" ><?php echo $row['Name_P'];?></a></h6>
                    <div class="starts-icon">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="price">
                        <h6><span class="new-price"><?php echo $row['Price'];?> dh</span></h6>
                        <span class="old-price"><?php echo $row['Pric_old'];?> dh</span>
                    </div>

                    </div>
                <?php }
            }
        ?>
            </div>
        </div>
    </div>
    

<?php
    include_once('Includes/Templates/footer.php');
?>