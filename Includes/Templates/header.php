<?php
    session_start();
    include_once('Includes/Templates/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brico bakir</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<!-- CSS only -->



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>
    <link href="Layout/CSS/jquery-ui.css" rel="stylesheet">
    <link href="Layout/CSS/Style.css" rel="stylesheet"/>
</head>
<body>
    <!--Start container-->
    <div class="container-Grid">

        <!-- Modal -->
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
                                    
                                    echo "<h6 style='color: #42d842;'>$total DH</h6>";
                                }else{
                                    echo "<h6 style='color: #42d842;'>Total Prix (0 Produit) </h6>";
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
                                            <small style="font-weight:bold; color: #42d842;"><?php echo $row['Price'] ?> dh</small>
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


            <!-- Modal add shop-->
            <div class="modal fade " id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Les produits de votre panier</h5>
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
                                    
                                    echo "<h6 style='color: #42d842;'>$total DH</h6>";
                                }else{
                                    echo "<h6 style='color: #42d842;'>Total Prix (0 Produit) </h6>";
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
                                            <small style="font-weight:bold; color: #42d842;"><?php echo $row['Price'] ?> dh</small>
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
                    echo "<h6>Votre Panier est Vide !</h6>";
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
    <!--Start  Navbar -->
    <div class="NavBar">
        <div class="brand">
                <span>Brico Bakir</span>
        </div>
        <div class="List-Navbar">
            <ul>
                <li>
                    <input type="text" class="txt-search" placeholder="Rechercher">
                    <button class='btn'>Rechercher</button>
                </li>

                <li>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn-nav-lovely-add">
                    <a>
                    <a><i class="fas fa-shopping-cart"></i></a>
                        <?php
                            if(isset($_SESSION['card-shop']))
                            {
                                $count=count($_SESSION['card-shop']);
                                //if($count>=9){
                                    echo "<span class='badge rounded-pill bg-danger badge-paniar'>$count</span>";
                                //}
                            }else
                            {
                                echo "<span class='badge rounded-pill bg-danger badge-paniar '>0</span>";
                            }
                        ?>
                    </a>
                </button>
                </li>
                <li>
                    <a href="Login.php">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </li>
                <li>
                    <a><i class="fas fa-bell fa-2x"></i></a>
                    <span class="badge rounded-pill bg-danger badge-paniar"></span>
                </li>
                <li>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn-nav-lovely-add">
                    <a href="">
                        <a><i class="fas fa-heart fa-2x"></i></a>
                        <?php
                            if(isset($_SESSION['card']))
                            {
                                $count=count($_SESSION['card']);
                                //if($count>=9){
                                    echo "<span class='badge rounded-pill bg-danger badge-paniar prefer-count'>$count</span>";
                                //}
                            }else
                            {
                                echo "<span class='badge rounded-pill bg-danger badge-paniar prefer-count'>0</span>";
                            }
                        ?>
                    </a>
                </button>
                </li>
            </ul>
        </div>
    </div>
        <!--End NavBar-->
    

