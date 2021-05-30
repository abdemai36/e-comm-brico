<?php
    ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if(isset($_GET['id'])){
        $id_M=$_GET['id'];
        
        $query="DELETE FROM marque_tb WHERE ID_marque=$id_M";
        $result=mysqli_query($conx,$query);
        if($result){
            echo "<div class='alert-success'>La suppression avec success</div>";
            header("refresh:1;url='All_marque.php'");
        }else{
            echo "<div class='alert-danger '>les information est incorrect !</div>";
            //header("refresh:1;url='All_marque.php'");
            echo mysqli_error($conx);
        }

        
    }
    ob_end_flush();
?> 



