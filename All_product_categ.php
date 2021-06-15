<?php
        ob_start();
        include_once('Includes/Templates/connection.php');
        include_once('Includes/Templates/header.php');
        include_once('Includes/Templates/SidBar.php');

        if(isset($_GET['id'])){
            //$id_categ=(isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
                $id_categ=$_GET['id'];
            }else{
                $id_categ=0;
            }

            /****************************************************Pagination***************************************************************************/

            $nbr_product_par_page=30;
            $nbr_product_max_avant_apre=30;
            
            

            $q="SELECT * FROM product_tb WHERE Categorie=$id_categ ";
            $r=mysqli_query($conx,$q);
            $nbr_total_product=mysqli_num_rows($r);

            $querNamCat="SELECT Name_Categori FROM categorie_tb where ID_categori=$id_categ ";
            $resultNamCat=mysqli_query($conx,$querNamCat);

            
            /**************************************************** Pagination***************************************************************************/
    ?>
        
        <!-----------------------------------------Models -------------------------------------------->
        <!-- Modal Prefer produit-->
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Les produits préféres</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="model-details">
                        <h5 class="header-details">Détails de prix</h5>
                        <div class="body-details">
                            <?php
                            $total=0;
                                if(isset($_SESSION['card'])){
                                    $count=count($_SESSION['card']);
                                    echo "<h6>Total Prix ($count Produits) </h6>";
                                    $product_id=array_column($_SESSION['card'],'product_iD');
                                    $qe="SELECT * FROM product_tb ORDER BY ID_Product DESC";
                                    $re=mysqli_query($conx,$qe);
                                    if($re){
                                        while($row=mysqli_fetch_array($re))
                                        {
                                            foreach($product_id as $id)
                                            {
                                                if($row['ID_Product']==$id)
                                                {
                                                    $total=$total+$row['Price'];
                                                }
                                            }
                                        }
                                    }
                                    
                                    echo "<h6 style='color: #49ce49;'>$total DH</h6>";
                                }else{
                                    echo "<h6 style='color: #49ce49;'>Total Prix (0 Produit) </h6>";
                                }
                            ?>
                            
                        </div>
                    </div>
                <?php
                if(isset($_SESSION['card'])){
                    $product_id=array_column($_SESSION['card'],'product_iD');
                    $qe="SELECT * FROM product_tb ORDER BY ID_Product DESC";
                    $re=mysqli_query($conx,$qe);
                    if($re){
                        while($row=mysqli_fetch_array($re)){
                            $res=$row['Image'];
                            $res=explode(" ",$res);
                            $count=count($res)-1;
                            foreach($product_id as $id){
                                if($row['ID_Product']==$id)
                                {?>

                                    <div class="content-model-product" id="content-model-prod<?php echo $id;?>">

                                    <?php 
                                        for($i=0;$i<1;$i++){

                                            echo "<img ' src='Admin/avatar/$res[$i]'/>";
                                            
                                        }
                                    ?>
                                        
                                        <div style="width: 100%;">
                                            <h6><?php echo $row['Name_P']?></h6>
                                            <small style="font-weight:bold; color: #49ce49;"><?php echo $row['Price'] ?> dh</small>
                                        </div>
                                        
                                        <a data-id="<?php echo $id?>" class="icon-delete btn-delete" style="background-color: transparent; border:none;">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                <?php }
                            }
                        }
                    }
                    
                }else{
                    echo "<h6>Votre List est Vide !</h6>";
                }
            ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fermer" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary btn-commander">Commender</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal ADh to card-shop-->
        <div class="modal fade " id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Les produits de votre Panier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="model-details">
                        <h5 class="header-details">Détails de prix</h5>
                        <div class="body-details">
                            <?php
                            $total=0;
                                if(isset($_SESSION['card-shop'])){
                                    $count=count($_SESSION['card-shop']);
                                    echo "<h6>Total Prix ($count Produits) </h6>";
                                    $product_id=array_column($_SESSION['card-shop'],'product_id');
                                    $qe="SELECT * FROM product_tb ORDER BY ID_Product DESC";
                                    $re=mysqli_query($conx,$qe);
                                    if($re){
                                        while($row=mysqli_fetch_array($re))
                                        {
                                            foreach($product_id as $id)
                                            {
                                                if($row['ID_Product']==$id)
                                                {
                                                    $total=$total+$row['Price'];
                                                }
                                            }
                                        }
                                    }
                                    
                                    echo "<h6 style='color: #49ce49;'>$total DH</h6>";
                                }else{
                                    echo "<h6 style='color: #49ce49;'>Total Prix (0 Produit) </h6>";
                                }
                            ?>
                            
                        </div>
                    </div>
                <?php
                if(isset($_SESSION['card-shop'])){
                    $product_id=array_column($_SESSION['card-shop'],'product_id');
                    $qe="SELECT * FROM product_tb ORDER BY ID_Product DESC";
                    $re=mysqli_query($conx,$qe);
                    if($re){
                        while($row=mysqli_fetch_array($re)){
                            $res=$row['Image'];
                            $res=explode(" ",$res);
                            $count=count($res)-1;
                            foreach($product_id as $id){
                                if($row['ID_Product']==$id)
                                {?>

                                    <div class="content-model-product" id="content-model-prod-shop<?php echo $id;?>">

                                    <?php 
                                        for($i=0;$i<1;$i++){

                                            echo "<img ' src='Admin/avatar/$res[$i]'/>";
                                            
                                        }
                                    ?>
                                        
                                        <div style="width: 100%;">
                                            <h6><?php echo $row['Name_P']?></h6>
                                            <small style="font-weight:bold; color: #49ce49;"><?php echo $row['Price'] ?> dh</small>
                                        </div>
                                        
                                        <a data-id="<?php echo $id?>" class="icon-delete btn-delete-shop" style="background-color: transparent; border:none;">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                <?php }
                            }
                        }
                    }
                    
                }else{
                    echo "<h6>Votre panier est Vide !</h6>";
                }
            ?>
        <!-----------------------------------------End Models -------------------------------------------->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-fermer" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary btn-commander">Commender</button>
                </div>
                </div>
            </div>
        </div>
                        
            <?php

                $last_page=ceil($nbr_total_product/$nbr_product_par_page);
                if(isset($_GET['page']) && is_numeric($_GET['page'])){
                    $page_num=$_GET['page'];
                }else{
                    $page_num=0;
                    header('location:All_product_categ.php?id='.$id_categ.'&page=1');
                    exit();
                }
                $Limit='LIMIT '.($page_num-1)*$nbr_product_par_page.','.$nbr_product_par_page;

                $pagination='';
            
                    if($last_page!=1){
                        if($page_num>1){
                            $previous=$page_num-1;
                            $pagination.='<a class="pagin-a" href="All_product_categ.php?id='.$id_categ.'&page='.$previous.'"><i style="font-size: 20px;" class="fas fa-chevron-left"></i></a> &nbsp;';
                            for($i=$page_num-$nbr_product_max_avant_apre;$i<$page_num;$i++){
                            if($i>0){
                                $pagination.='<a class="pagin-a" href="All_product_categ.php?id='.$id_categ.'&page='.$i.'">'.$i.'</a> &nbsp;';
                            }
                        }
                    }
    
                        $pagination .='<span class="active pagin-a">'.$page_num.'</span> &nbsp;';
                        for($i=$page_num+1;$i<=$last_page;$i++){
                            $pagination .='<a class="pagin-a" href="All_product_categ.php?id='.$id_categ.'&page='.$i.'">'.$i.'</a> &nbsp;';
                            if($i>=$page_num+$nbr_product_max_avant_apre){
                                break;
                            }
                        }
                        if($page_num!=$last_page){
                            $next=$page_num+1;
                            $pagination.='<a class="pagin-a" href="All_product_categ.php?id='.$id_categ.'&page='.$next.'"><i style="font-size: 20px;" class="fas fa-chevron-right"></i></a>';
                            }
                    }
                
                

            ?>


            

            <?php $query="SELECT * FROM product_tb WHERE Categorie=$id_categ ORDER BY ID_Product DESC $Limit";
            
            $result=mysqli_query($conx,$query);

            if($result){
                echo "<div class='Main'>";?>

                <!----------------------Filer range-------------------------->
                <!-- <div class="wrraper-filter-range">
                    <h6>Filter par tarif </h6>
                    <input type='hidden' id="id_categ" value='<?php echo $id_categ;?>'> 
                    <input type="hidden" id="hidden_minimum_price" value="300"/>
                    <input type="hidden" id="hidden_maximum_price" value="10000"/>
                    <p id="text-show-price">300 dh - 10000 dh</p>
                    <div id="price-range"></div>
                </div> -->


                <?php 
                    if($_GET['page']>$last_page || $_GET['id']!=$id_categ || $_GET['page']==0){
                    $nbr_total_product=0;?>
                    <a href="index.php?page=1" style="color:black;"><i style="margin-right: 9px;" class="fas fa-home"></i></a>
                    <div class="nbr-page">Il y a <?php echo $nbr_total_product;?> produits.</div>
                    <?php
                        if($resultNamCat){
                            while($rowNmCat=mysqli_fetch_array($resultNamCat))#
                            echo "<div class='nbr-page' > > ".$rowNmCat[0]."</div>";
                        }
                        ?>
                <?php }else{?>
                    <a href="index.php?page=1" style="color:black;"><i style="margin-right: 9px;" class="fas fa-home"></i></a>
                    <div class="nbr-page">Il y a  <?php echo $nbr_total_product?> produits.</div>
                    <?php
                        if($resultNamCat){
                            while($rowNmCat=mysqli_fetch_array($resultNamCat))#
                            echo "<div class='nbr-page' > > ".$rowNmCat[0]."</div>";
                        }
                        ?>
                <?php }

                    
                    echo "<div class='rows'>";
                while($row=mysqli_fetch_array($result)){
                    
                        echo "<div class='produit'>";
                            echo "<form action='lovely_page.php' method='GET'>";
                                $id=$row['ID_Product'];
                                $res=$row['Image'];
                                $res=explode(" ",$res);
                                $count=count($res)-1;
                                for($i=0;$i<1;$i++){

                                    echo "<img class='img-produit' src='Admin/avatar/$res[$i]'/>";
                                }
                                echo "<hr style='color:#ffc400;  width:100%;'>";?>
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
                                        <h6 class='title-produit'><?php echo $row['Name_P']?></h6>
                                    </a>
                                    <?php  echo "<div class='starts-icon'>";
                                    echo "<i class='fas fa-star'></i>";
                                    echo "<i class='fas fa-star'></i>";
                                    echo "<i class='fas fa-star'></i>";
                                    echo "<i class='fas fa-star'></i>";
                                    echo "<i class='fas fa-star'></i>";
                                echo "</div>";
                                echo "<div class='price'>";?>
                                    
                                        <h6><span class='new-price'><?php echo $row['Price']?>dh</span></h6>
                                    <?php
                                    if($row['Pric_old']<=0){
                                        echo "<span class='old-price'></span>";
                                    }else{
                                        echo "<span class='old-price'>".$row['Pric_old'] ."dh</span>";
                                    }
                                ?>
                                <?php echo "</div>";
                            echo "</form>";
                        echo "</div>";
                }
                echo "</div>";?>

                <?php 
                
                if($_GET['page']>$last_page || $_GET['id']!=$id_categ || $_GET['page']==0){
                    // header('location:All_product_categ.php?id='.$id_categ.'&page=1');
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

               <?php  }
                ?>  
                 
                <?php echo "</div>";
            }
        }
?>






<?php
    include_once('Includes/Templates/footer.php');
    ob_end_flush();
?>