<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if(isset($_GET['id'])){
        $id_categ=$_GET['id'];
        
        $query="DELETE FROM categorie_tb WHERE ID_categori=$id_categ";
        $result=mysqli_query($conx,$query);
        if($result){
            echo "<div class='alert-success'>La suppression avec success</div>";
            header("refresh:1;url='All_categories.php'");
        }else{
            echo "<div class='alert-danger '>les information est incorrect !</div>";
           // header("refresh:1;url='All_categories.php'");
            echo mysqli_error($conx);
        }

        
    }
    ob_end_flush();
?>  