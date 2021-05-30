<?php
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    $pageTitle='Marque';

    if(isset($_POST['submit'])){
        $name_M=$_POST['Name_M'];


        $Image_M_Name = $_FILES['Image_M']['name'];
        $Image_M_Size = $_FILES['Image_M']['size'];
        $Image_M_tmpN = $_FILES['Image_M']['tmp_name'];
        $Image_M_type = $_FILES['Image_M']['type'];
        $Image_M_Allow_Extansion = array("jpeg","png","jpg","gif");

        $tmp=explode('.',$Image_M_Name);
        $Image_M_Extansion = strtolower(end($tmp));


        if(!in_array($Image_M_Extansion,$Image_M_Allow_Extansion)){
            echo "<div class='alert-danger '>S'il vous plaît saisir seulement les images !!</div>";
        }
        elseif($Image_M_Size>1000000){
                echo "<div class='alert-danger'>l'image ne peut pas être plus grande que 1MB</div>";
            //echo "<script> alert('l\'image ne peut pas être plus grande que 1MB')</script>";
        }elseif(empty($name_M) && empty($Image_M)){
            echo "<div class='alert-danger '>SVP saisir tous les information !</div>";
        }
        else{
            $image=rand(0,10000000) . '_' .$Image_M_Name;
            move_uploaded_file($Image_M_tmpN,'avatar/'.$image);
            $query="INSERT INTO marque_tb(Name_M,Image_M) VALUES('$name_M','$image')";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "<div class='alert-success'>Ajouté avec success</div>";
            }else{
                echo "<div class='alert-danger'>L'ajoute de la marque a échoué !</div>";
            }
        }
    }
    
?>

            <div class=marque>
                <div class="head-marque">
                    <h1 class="text-center title-h">Ajouter la marques</h1>
                </div>
                <div class="body-marque">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="Name_M" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nom de la marque </label>
                        </div>
                        <div class="mt-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control form-control-lg" name="Image_M" type="file" id="formFile">
                        </div>
                            <input type="submit" class="btn btn-primary mt-3" name="submit" value="Ajouter">
                        
                            <a href="All_marque.php"  class="btn btn-dark mt-3">Afficher tous les marques</a>
                        
                    </form> 
                </div>
            </div>
            
            
            

<?php
    include_once('Includes/Templates/footer.php');
?>

