<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name_categ=$_POST['Name_categ'];
        $id_categ=$_POST['id_categ'];


        if(empty($name_categ)){
                echo "<div class='alert-danger '>SVP saisir nom de catégorie !</div>";
                header("refresh:1;url='Edit_categories.php'");
            }
        else{
            $query="SELECT * FROM categorie_tb WHERE ID_categori=$id_categ";
            $result=mysqli_query($conx,$query);
            if($result){
                $query="UPDATE categorie_tb SET Name_Categori='$name_categ' WHERE ID_categori=$id_categ";
                mysqli_query($conx,$query);
                echo "<div class='alert-success'>Mise à jour avec success</div>";
                header("refresh:1;url='All_categories.php'");
            }else{
                echo "<div class='alert-danger '>les information est incorrect !</div>";
                header("refresh:1;url='All_categories.php'");
            }
        }
    }
ob_end_flush();
?>



<?php
    include_once('Includes/Templates/footer.php');
?>
