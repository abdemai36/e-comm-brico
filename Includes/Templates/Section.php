<?php
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
?>

<div class="Section">
                
        <?php
                $best_categ_query="SELECT DISTINCT c.Name_Categori as nameC ,c.ID_categori FROM product_tb p INNER JOIN categorie_tb c ON p.Categorie=c.ID_categori GROUP BY c.Name_Categori having count(c.ID_categori)>=1 limit 3";
                $best_categ_result=mysqli_query($conx,$best_categ_query);
                if($best_categ_result)
                {
                    /**Select The catetigorie has geater then 3 product**/
                    while($row=mysqli_fetch_array($best_categ_result))
                    {
                        $res=$row;
                        $count=count($res)-1;
                        for($i=0;$i<1;$i++)
                        {?> 
                        <h3 class='h3-categ'><span><?php echo $res[$i];?></span></h3>
                            <div class="wrraper-product">
                                <div class="slider-product">
                                    <form action="">
                        <?php
                /****Select All product****/
                $product_query="SELECT * FROM product_tb ORDER BY ID_Product";
                $product_result=mysqli_query($conx,$product_query);
                if($product_result){
                    while($row=mysqli_fetch_array($product_result)){?>
                    <!--Image product-->
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
                <?php    }
                
            }
            ?>                  </form>
                                </div>
                                
                            </div>
                            <input type="submit" class="btn-afficher" value="voir plus">
                        <?php }

                    }

                }
            ?>   
          

        </div>

   

        <!--End Section-->

<?php
    include_once('Includes/Templates/footer.php');
?>