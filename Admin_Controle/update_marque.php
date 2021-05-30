<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if(isset($_POST['submit'])){
        $name_M=$_POST['Name_M'];
        $id_M=$_POST['id_M'];
        $img_M=$_POST['img_M'];


    if(empty($name_M) || empty($img_M)){
            echo "<div class='alert-danger '>SVP saisir tous les information !</div>";
            header("refresh:1;url='All_marque.php'");
        }
    else{
        $query="SELECT * FROM marque_tb WHERE ID_marque=".$id_M."";
        $result=mysqli_query($conx,$query);
        if($result){
            $query="UPDATE marque_tb SET Name_M='$name_M',Image_M='$img_M' WHERE ID_marque='$id_M'";
            mysqli_query($conx,$query);
            echo "<div class='alert-success'>Mise à jour avec success</div>";
            header("refresh:1;url='All_marque.php'");
        }else{
            echo "<div class='alert-danger '>les information est incorrect !</div>";
        }

        
    }
    }
ob_end_flush();
?>



<?php
    include_once('Includes/Templates/footer.php');
?>
