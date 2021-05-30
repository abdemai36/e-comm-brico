<?php
    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name_C=$_POST['Name_Cat'];
        if(empty($name_C)){
            echo "<div class='alert-danger'>S'il vous plait saisir nom de catégorie </div>";
        }elseif(is_numeric($name_C)){
            echo "<div class='alert-danger'>Nom de Catégorie est incorrect ! </div>";
        }else{
            $query="INSERT INTO categorie_tb(Name_Categori) VALUES ('$name_C')";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "<div class='alert-success'>Ajouté avec success</div>";
            }else{
                echo "<div class='alert-danger'>L'ajoute de la catégorie a échoué !</div>";
            }
        }

    }

?>

<h1 class="text-center title-h">Ajouter Catégories</h1>

                <div class="body-categori">
                    <form action="Add_categories.php" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="Name_Cat" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Nom de Catégorie </label>
                        </div>
                            <input type="submit" class="btn btn-primary mt-3" name="submit" value="Ajouter">
                        
                        <a href="All_categories.php" class="btn btn-dark mt-3">Afficher tous les Catégories</a>
                        
                    </form> 
                </div>


<?php
    include_once('Includes/Templates/footer.php');
?>
