
<?php
      /****Select all categories****/
      $categ_query="SELECT * FROM categorie_tb";
      $categ_result=mysqli_query($conx,$categ_query);
?>
        <!--Start  SidBar -->
        <div class="SidBar">
            
            <h5>Les Catégories</h5>
            <ul>
                <?php 
                if($categ_result)
                {
                        while($ro=mysqli_fetch_array($categ_result))
                        {?>
                            <li>
                                <a href="All_product_categ.php?id=<?php echo $ro['ID_categori']?>&page=1"><?php echo $ro['Name_Categori'];?></a>
                            </li>
                        <?php }
                }
                ?>
            
            </ul>
            <img src='Layout/Images/promotion.png'/>
            
        </div>
        <!--End SidBar-->