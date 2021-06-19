<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
?>

 <!--Start  Main -->
 <div class="Main">
     <div class="Public">   
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="Admin/avatar/444_50bv30-acier-au-chrome-vanadium.jpg" style="height:500px; width:100%;" >
                </div>
                <div class="carousel-item">
                <img src="Admin/avatar/444_50bv30-acier-au-chrome-vanadium.jpg" style="height:500px; width:100%;" >
                </div>
                <div class="carousel-item">
                <img src="Admin/avatar/444_50bv30-acier-au-chrome-vanadium.jpg" style="height:500px; width:100%;" >
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
     </div>
            <?php
            if(!isset($_GET['page']))
            {
                $_GET['page']=1;
                header("location:index.php?page=1");
                exit();
            }else{

            
                $nbr_product_par_page=15;
                $nbr_product_max_avant_apre=15;
                
                $q="SELECT * FROM product_tb";
                $r=mysqli_query($conx,$q);
                $nbr_total_product=mysqli_num_rows($r);

                $last_page=ceil($nbr_total_product/$nbr_product_par_page);
                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                        $page_num=$_GET['page'];
                    }else{
                        $page_num=1;
                        // header('location:index.php?page=1');
                        // exit();
                    }
                
                    $Limit='LIMIT '.($page_num-1)*$nbr_product_par_page.','.$nbr_product_par_page;
                
                    $product_query="SELECT * FROM product_tb ORDER BY ID_Product DESC $Limit";
                    $product_result=mysqli_query($conx,$product_query);
                    ?>
                <?php

        $pagination='';
        if($last_page!=1){
            if($page_num>1){
                $previous=$page_num-1;
                $pagination.='<a class="pagin-a" href="index.php?page='.$previous.'"><i style="font-size: 20px;" class="fas fa-chevron-left"></i></a> &nbsp;';
                for($i=$page_num-$nbr_product_max_avant_apre;$i<$page_num;$i++){
                    if($i>0){
                        $pagination.='<a class="pagin-a" href="index.php?page='.$i.'">'.$i.'</a> &nbsp;';
                    }
                }

            }
            $pagination .='<span class="active pagin-a">'.$page_num.'</span> &nbsp;';
            for($i=$page_num+1;$i<=$last_page;$i++){
                $pagination .='<a class="pagin-a" href="index.php?page='.$i.'">'.$i.'</a> &nbsp;';
                if($i>=$page_num+$nbr_product_max_avant_apre){
                    break;
                }
            }
            if($page_num!=$last_page){
                $next=$page_num+1;
                $pagination.='<a class="pagin-a" href="index.php?page='.$next.'"><i style="font-size: 20px;" class="fas fa-chevron-right"></i></a>';
            }
        }

        ?>
            
        <?php
            if($_GET['page']>$last_page || $_GET['page']==0){
                // header('location:index.php?page=1');
                // exit();
                
                $nbr_total_product=0;?>
                <div class="nbr-page">Il y a <?php echo $nbr_total_product;?> produits.</div>
            <?php }else{?>
                <div class="nbr-page">Il y a <?php echo $nbr_total_product;?> produits.</div>
            <?php } 
        ?>
            
            <div class="rows"><?php
            /****Select All product****/
                
                
                if($product_result){
                    while($row=mysqli_fetch_array($product_result)){?>
                    <!--Image product-->
                        <div class="produit">
                            <form action="lovely_page.php" method='GET'>
                            <?php
                                    $id=$row['ID_Product'];
                                    $res=$row['Image'];
                                    $res=explode(" ",$res);
                                    $count=count($res)-1;
                                    for($i=0;$i<1;$i++)
                                    {?>
                                    <a href="view_ly_Pr.php?id=<?php echo $id?>" style="text-decoration:none; color:#000;">
                                        <img class="img-produit" src='Admin/avatar/<?php echo $res[$i];?>'/>
                                    </a>
                            <?php }?>

                            <hr style="color:#ffc400;width:100%;">

                            <div class="icon-heart">
                                <a href="lovely_page.php?do=prefer&i=<?php echo $id ?>">
                                    <img src="Layout/Images/heart.png" alt="">
                                </a>
                            </div>

                            <div class="icon-add-produit">
                                <a href="lovely_page.php?do=add-card&i=<?php echo $id ?>">
                                    <img src="Layout/Images/add_shopping.png" alt="">
                                </a>
                            </div>
                            <a href="view_ly_Pr.php?id=<?php echo $id?>" style="text-decoration:none; color:#000;">
                                <h6 class="title-produit"><?php echo $row['Name_P'];?></h6>
                            </a>
                            <div class="starts-icon">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="price">
                                <h6 class="new-price"><span style="background:#fff;"><?php echo $row['Price'];?> dh</span></h6>
                                <?php 
                                    if($row['Pric_old']>0){?>
                                        <span class="old-price"><?php echo $row['Pric_old'];?> dh</span>
                                    <?php }elseif($row['Pric_old']==0){?>
                                        <span class="old-price"></span>
                                    <?php }
                                ?>
                            </div>
                        </div>
                <?php    }
                
            }
            ?>
            </form>
            </div>
    <?php 
    
    if($_GET['page']>$last_page || $_GET['page']==0){
        // header('location:index.php?page=1');
        // exit();
        echo "<div class='select-none'>Aucun produit ne correspond à votre sélection.</div>";

    }else{?>

            <div class="pagina">
                <div>
                    <span style="font-variant: small-caps;" >page <?php echo $page_num;?>/<?php echo $last_page;?></span>
                </div>
                <div>
                    <?php echo $pagination;?>
                </div>
                
            </div>

    <?php }}
        
    ?>
            
            
        </div>
        <!--End Main-->

        <?php
            include_once('Includes/Templates/SidBar.php');
        ?> 
        
        <!--Start Section-->
        <div class="Section">
        <form action="" method='GET'>
        <?php
                $best_categ_query="SELECT DISTINCT c.Name_Categori as nameC ,c.ID_categori FROM product_tb p INNER JOIN categorie_tb c ON p.Categorie=c.ID_categori GROUP BY c.Name_Categori having count(c.ID_categori)>=1 limit 3";
                $best_categ_result=mysqli_query($conx,$best_categ_query);
                if($best_categ_result)
                {
                    /**Select The catetigorie has geater then 3 product**/
                    while($ro=mysqli_fetch_array($best_categ_result))
                    {
                        $res=$ro;
                        $count=count($res)-1;
                        for($i=0;$i<1;$i++)
                        {?> 
                        <h3 class='h3-categ'><span><?php echo $res[$i];?></span></h3>
                            <div class="wrraper-product">
                                <div class="slider-product"> 
                                <?php
                            /**content slid product */
                            $query1="SELECT * FROM  product_tb p WHERE Categorie = $ro[1]";
                                $result1=mysqli_query($conx,$query1);
                                if($result1)
                                {
                                    while($row1=mysqli_fetch_array($result1))
                                    {?>
                                    
                                        <div class="produit">
                                            <form action="lovely_page.php" method='GET'>
                                            <?php
                                                $id=$row1['ID_Product'];
                                                $res=$row1['Image'];
                                                $res=explode(" ",$res);
                                                $count=count($res)-1;
                                                for($i=0;$i<1;$i++){?>
                                                    <a href="view_ly_Pr.php?id=<?php echo $id?>" style="text-decoration:none; color:#000;">
                                                        <img class='img-produit' src='Admin/avatar/<?php echo $res[$i];?>'/>
                                                    </a>
                                                <?php }
                                            ?>

                                                <hr style="color:#ffc400;  width:100%;">
                                                <div class="icon-heart">
                                                    <a href="lovely_page.php?do=prefer&i=<?php echo $id ?>">
                                                        <img src="Layout/Images/heart.png" alt="">
                                                    </a>
                                                </div>

                                                <div class="icon-add-produit">
                                                    <a href="lovely_page.php?do=add-card&i=<?php echo $id ?>">
                                                        <img src="Layout/Images/add_shopping.png" alt="">
                                                    </a>
                                                </div>
                                                <a href="view_ly_Pr.php?id=<?php echo $id?>" style="text-decoration:none; color:#000;">
                                                    <h6 class="title-produit"><?php echo $row1['Name_P'];?></h6>
                                                </a>
                                                
                                                <div class="starts-icon">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="price">
                                                    <h6 class="new-price"><span><?php echo $row1['Price'];?> dh</span></h6>
                                                    <?php 
                                                        if($row1['Pric_old']>0){?>
                                                            <span class="old-price"><?php echo $row1['Pric_old'];?> dh</span>
                                                        <?php }elseif($row1['Pric_old']==0){?>
                                                            <span class="old-price"></span>
                                                        <?php }
                                                    ?>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    
                                    <?php }
                                    
                                }
                                ?>
                                </div>
                            </div>
                            <a href="All_product_categ.php?id=<?php echo $ro[1];?>&page=1" class="btn-afficher">Vois plus...</a>
                        <?php }

                    }

                }
            ?> 
            </form>    
        </div>
        <!--End Section-->

       


<?php
    ob_end_flush();
    include_once('Includes/Templates/footer.php');
?>