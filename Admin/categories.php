<?php

    ob_start();
    
    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');
    $pageTitle='Catégories';
    

    if(isset($_SESSION['username']))
    {
        
        $do='';
        if(isset($_GET['do'])){
            $do= $_GET['do'];
        }else{
            $do = 'manage';
        }
        
        if($do=='manage')
        {
            $query="SELECT * FROM categorie_tb";
            $result=mysqli_query($conx,$query);
            /*********Start page manage ********/?>

                <div class="head-categori">
                    <h1 class="text-center title-h">Tous Les catégoriess</h1>
                </div>
                <a href="categories.php?do=add" class="btn btn-success ajouterbtn"><i class="fas fa-plus"></i>&nbsp; Catégorie</a>
                <form action="" method="GET">
                    <div class="table-responsive">
                        <table class="table mt-3 table-bordered table-responsive table-hover">
                                <tr>
                                    <th>ID catégorie</th>
                                    <th>Nom Catégorie</th>
                                    <th>contrôler</th>
                                </tr>
                                <?php 
                                    while($ro=mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>".$ro[0]."</td>";
                                        echo "<td>".$ro[1]."</td>";
                                        echo "<td> 
                                                <a href='?do=Edit&id=".$ro[0]."' class='btn btn-info btn-Norespons'>Modifier</a>
                                                <a href='?do=Edit&id=".$ro[0]."' class='btn btn-info btn-respons'><i class='far fa-edit'></i></a>  
                                                <a href='?do=delete&id=".$ro[0]."' class='btn btn-danger btn-Norespons' name='del'>Supprimer</a> 
                                                <a href='?do=delete&id=".$ro[0]."' class='btn btn-danger btn-respons' name='del'><i class='far fa-trash-alt'></i></a> 
                                            </td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </table>
                    </div>
                </form>


        <?php   /*********End page manage ********/

        }elseif($do=='add')
        {
            /*********Start page add ********/?>

            <h1 class="text-center title-h">Ajouter Catégories</h1>

            <div class="body-categori">
                <form action="?do=insert" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Name_Cat" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Nom de Catégorie </label>
                    </div>
                        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Ajouter">
                    
                    <a href="categories.php?do=manage" class="btn btn-dark mt-3">Afficher tous les Catégories</a>
                    
                </form> 
            </div>

       <?php     /*********End page add ********/

        }elseif($do=='insert')
        {
            /*********Start page insert ********/


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $name_C=$_POST['Name_Cat'];
                if(empty($name_C)){
                    echo "<div class='alert-danger'>S'il vous plait saisir nom de catégorie </div>";
                    header("refresh:1;url='categories.php?do=add'");
                }elseif(is_numeric($name_C)){
                    echo "<div class='alert-danger'>Nom de Catégorie est incorrect ! </div>";
                }else{
                    $query="INSERT INTO categorie_tb(Name_Categori) VALUES ('$name_C')";
                    $result=mysqli_query($conx,$query);
                    if($result){
                        echo "<div class='alert-success'>Ajouté avec success</div>";
                        header("refresh:1;url='categories.php?do=manage'");
                    }else{
                        echo "<div class='alert-danger'>L'ajoute de la catégorie a échoué !</div>";
                        header("refresh:1;url='categories.php?do=add'");
                    }
                }
        
            }


            /*********End page insert ********/
        }elseif($do=='Edit')
        {
            /*********Start page Edit ********/
            
            if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
        
                header('location:categories.php?do=manage');
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
                    header('location:categories.php?do=manage');
                    exit();
                }
            }
            
            ?>

            <div class=categori>
                <div class="head-categori">
                    <h1 class="text-center title-h">Modifier La Catégorie</h1>
                </div>
                <div class="body-categori">
                    <form action="?do=update" method="POST" enctype="multipart/form-data">
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

        <?php    /*********End page Edit ********/

        }elseif($do=='update')
        {
            /*********Start page Update ********/


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $name_categ=$_POST['Name_categ'];
                $id_categ=$_POST['id_categ'];
                if(empty($name_categ))
                {
                        echo "<div class='alert-danger '>SVP saisir nom de catégorie !</div>";
                        header("refresh:1;url='Edit_categories.php'");
                }
                else{
                    $query="SELECT * FROM categorie_tb WHERE ID_categori=$id_categ";
                    $result=mysqli_query($conx,$query);
                    if($result)
                    {
                        $query="UPDATE categorie_tb SET Name_Categori='$name_categ' WHERE ID_categori=$id_categ";
                        mysqli_query($conx,$query);
                        echo "<div class='alert-success'>Mise à jour avec success</div>";
                        header("refresh:1;url='categories.php?do=manage'");
                    }else
                    {
                        echo "<div class='alert-danger '>les information est incorrect !</div>";
                        header("refresh:1;url='categories.php?do=Edit'");
                    }
                }
            }


            /*********Start page Update ********/

        }elseif($do=='delete')
        {
            /*********Start page delete ********/
            if(isset($_GET['id'])){
                $id_categ=$_GET['id'];
                
                $query="DELETE FROM categorie_tb WHERE ID_categori=$id_categ";
                $result=mysqli_query($conx,$query);
                if($result){
                    echo "<div class='alert-success'>La suppression avec success</div>";
                    header("refresh:1;url='categories.php?do=manage'");
                }else{
                    echo "<div class='alert-danger '>les information est incorrect !</div>";
                    header("refresh:1;url='categories.php?do=manage'");
                    echo mysqli_error($conx);
                }
        
                
            }
            /*********End page detele ********/

        }else{
            echo "<div class='alert-danger'>vous ne peux pas accéder à cette page directement</div>";
        }












    }else{
        header('location:Login.php');
        exit();
    }
    ob_end_flush();
?>



<?php
    include_once('Includes/Templates/footer.php');
?>