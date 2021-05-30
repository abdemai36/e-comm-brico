<?php
ob_start();
    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
        
        header('location:All_categories.php');
        exit();
    }else{
        $query="SELECT * FROM categorie_tb WHERE ID_categori=".$_GET['id']."";
        $result=mysqli_query($conx,$query);

        if($result){
            
            while($ro=mysqli_fetch_array($result)){
                $id_categori=$ro[0];
                $name_categori=$ro[1];
            }
        }else{
            header('location:All_categories.php');
            exit();
        }
    }
    ob_end_flush();
?>

<div class=categori>
                <div class="head-categori">
                    <h1 class="text-center title-h">Modifier La Catégorie</h1>
                </div>
                <div class="body-categori">
                    <form action="update_categorie.php" method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="Name_categ" value="<?php echo $name_categori;?>" id="floatingInput">
                            <label for="floatingInput">Nom de Catégorie </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="hidden" class="form-control" name="id_categ" value="<?php echo $id_categori;?>">
                        </div>
                            <input type="submit" class="btn btn-primary mt-3" name="submit" value="Modifier">
                    </form> 
                </div>
            </div>
            


<?php
    include_once('Includes/Templates/footer.php');
?>