<?php
    session_start();
    include_once('Includes/Functions/function.php');
    if(!isset($_SESSION['username'])){
        header('location:Login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo printTitle();?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>
    <link href="Layout/CSS/StyleSite.css" rel="stylesheet"/>
    <!--Image Zoom-->
    <link type="text/css" rel="stylesheet" href="magiczoomplus/magiczoomplus.css"/>
    <script type="text/javascript" src="magiczoomplus/magiczoomplus.js"></script>
</head>
<body>
    <div class="container-grid">
        <!--Navbar start-->
        <div class="navbar">
            <div id="toggle-nabvar">
                <i class="fas fa-bars"></i>
            </div>
            <div class="brand">
                <span>Brico Bakir</span>
            </div>
            <form action="">
                <div class="List-Navbar">
                    <ul>
                        <li>
                            <input type="text" class="txt-search" placeholder="Rechercher">
                            <input type="submit" value="Recherche">
                        </li>
                        <!-- <li>
                            <span class="fas fa-dot f1"></span>
                            <i class="fas fa-shopping-cart"></i>
                        </li>
                        <li>
                            <i class="fas fa-user fa-2x"></i>
                        </li>
                        <li>
                            <span class="fas fa-dot f3" ></span>
                            <i class="fas fa-bell fa-2x"></i>
                        </li>
                        <li>
                        <span class="fas fa-dot f4"></span>
                            <i class="fas fa-heart fa-2x"></i>
                        </li> -->
                    </ul>
                </div>
                <div class="navbar-respons">
                    <i class="fas fa-shopping-cart"></i>
                    <i class="fas fa-search"></i>
                    
                </div>
                
                <input type="text" class="txt-search-respons" placeholder="Rechercher">
            </form>
        </div>
        <div class="search-respons">
                    <input type="text" placeholder="Recherchez sur Produits,Catégories ,Marques ... ">
                    <img  src="<?php echo $IMGPath?>close.png">
        </div>
        <!--Navbar End-->

        <!--SidBar start-->
<div class="SidBar">
            <ul>
                <li class="title">
                    <a href="">
                        <img src="Layout/Images/Login.png" alt="">
                        <span><?php echo $_SESSION['username'];?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="Layout/Images/go_to.png" alt="">
                        Allez à site
                    </a>
                </li>
                <li>
                    <a href="Marque.php">
                        <img src="Layout/Images/marque.png" alt="">
                        Marques
                    </a>
                </li>
                <li>
                    <a href="Produits.php" >
                        <img src="Layout/Images/product.png" alt="">
                        Produits
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="Layout/Images/promotion.png" alt="">
                        Promos
                    </a> 
                </li>
                <li>
                    <a href="Add_categories.php">
                        <img src="Layout/Images/categorize.png" alt="">
                        Catégories
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="Layout/Images/statistics.png" alt="">
                        statistics
                    </a>
                </li>
                <li>
                    <a href="admins.php?do=manage">
                        <img src="Layout/Images/admins.png" alt="">
                        les admins
                    </a>
                </li>
                <li>
                    <a href="LogOut.php">
                        <img src="Layout/Images/loogoutDashbord.png" alt="">
                        Déconnecter
                    </a>
                </li>
            </ul>
        </div>

        <div class="SidBar-respons">
            <ul>
                <li class="title">
                    <a href="">
                        <img src="Layout/Images/Login.png" alt="">
                        <span><?php echo $_SESSION['username'];?></span>
                        <h6>Afficher votre profile</h6>
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="Layout/Images/go_to.png" alt="">
                        Allez à site
                    </a>
                </li>
                <li>
                    <a href="Marque.php">
                        <img src="Layout/Images/marque.png" alt="">
                        Marques
                    </a>
                </li>
                <li>
                    <a href="Produits.php" >
                        <img src="Layout/Images/product.png" alt="">
                        Produits
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="Layout/Images/promotion.png" alt="">
                        Promos
                    </a> 
                </li>
                <li>
                    <a href="Add_categories.php">
                        <img src="Layout/Images/categorize.png" alt="">
                        Catégories
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="Layout/Images/statistics.png" alt="">
                        statistics
                    </a>
                </li>
                <li>
                    <a href="admins.php?do=manage">
                        <img src="Layout/Images/admins.png" alt="">
                        les admins
                    </a>
                </li>
                <li>
                    <a href="LogOut.php">
                        <img src="Layout/Images/loogoutDashbord.png" alt="">
                        Déconnecter
                    </a>
                </li>
            </ul>
        </div>
        <!--Navbar end-->
<div class="main">