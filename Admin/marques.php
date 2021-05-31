<?php

    ob_start();
    
    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');
    $pageTitle='Marques';
    

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
            /*********Start page manage ********/
            $query="SELECT * FROM marque_tb";
            $result=mysqli_query($conx,$query);
        ?>

                <div class="head-marque">
                    <h1 class="text-center title-h">Tous Les marques</h1>
                </div>
                <a href="marques.php?do=add" class="btn btn-success ajouterbtn"><i class="fas fa-plus"></i>&nbsp; Marque</a
                <form action="" method="GET">
                    <div class="table-responsive">
                        <table class="table mt-3 table-bordered align-middle table-hover">
                                <tr>
                                    <th>ID marque</th>
                                    <th>Nom marque</th>
                                    <th>Image marque</th>
                                    <th>contrôler</th>
                                </tr>
                                <?php 
                                    while($ro=mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>".$ro[0]."</td>";
                                        echo "<td>".$ro[1]."</td>";
                                        echo "<td><img class='img-marque' src='avatar/".$ro[2]."'/></td>";
                                        echo "<td class='controls'> 
                                                <a href='?do=Edit&id=".$ro[0]."' class='btn btn-info btn-Norespons'>Modifier</a>  
                                                <a href='?do=Edit&id=".$ro[0]."' class='btn btn-info btn-respons'><i class='far fa-edit'></i></a>  
                                                <a href='?do=delete&id=".$ro[0]."' class='btn btn-danger btn-Norespons' >Supprimer</a> 
                                                <a href='?do=delete&id=".$ro[0]."' class='btn btn-danger btn-respons'><i class='far fa-trash-alt'></i></a> 

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
            /*********Start page add ********/ ?>

            <div class=marque>
            <div class="head-marque">
                <h1 class="text-center title-h">Ajouter la marques</h1>
            </div>
            <div class="body-marque">
                <form action="?do=insert" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Name_M" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Nom de la marque </label>
                    </div>
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control form-control-lg" name="Image_M" type="file" id="formFile">
                    </div>
                        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Ajouter">
                    
                        <a href="?do=manage"  class="btn btn-dark mt-3">Afficher tous les marques</a>
                    
                </form> 
            </div>
        </div>

        <?php    /*********End page add ********/

        }elseif($do=='insert')
        {
            /*********Start page insert ********/

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
                        header("refresh:1;url='marques.php?do=manage'");
                    }else{
                        echo "<div class='alert-danger'>L'ajoute de la marque a échoué !</div>";
                        header("refresh:1;url='marques.php?do=add'");
                    }
                }
            }

            /*********End page insert ********/
        }elseif($do=='Edit')
        {
            /*********Start page Edit ********/ 
            if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
        
                header('location:marques.php?do=manage');
                exit();
            }else{
                $query="SELECT * FROM marque_tb WHERE ID_marque=".$_GET['id']."";
                $result=mysqli_query($conx,$query);
        
                if($result){
                    
                    while($ro=mysqli_fetch_array($result)){
                        $id_marque=$ro[0];
                        $name_marque=$ro[1];
                        $img_marque=$ro[2];
                    }
                }else{
                    header('location:marques.php?do=manage');
                    exit();
                }
            }
            
            ?>
            <div class=marque>
            <div class="head-marque">
                <h1 class="text-center title-h">Modifier La marque</h1>
            </div>
            <div class="body-marque">
                <form action="?do=update" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="Name_M" value="<?php echo $name_marque;?>" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Nom de la marque </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="hidden" class="form-control" name="id_M" value="<?php echo $id_marque;?>">
                    </div>
                    <div class="mt-3">
                        <input type="hidden" class="form-control" name="img_M" value="<?php echo $img_marque;?>">
                        <img src="avatar/<?php echo $img_marque; ?>" class="img-marque"  />
                    </div>
                        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Modifier">
                </form> 
            </div>
        </div>
            

        <?php   /*********End page Edit ********/

        }elseif($do=='update')
        {
            /*********Start page Update ********/

            if(isset($_POST['submit']))
            {
                $name_M=$_POST['Name_M'];
                $id_M=$_POST['id_M'];
                $img_M=$_POST['img_M'];
        
        
                if(empty($name_M) || empty($img_M))
                {
                    echo "<div class='alert-danger '>SVP saisir tous les information !</div>";
                    header("refresh:1;url='marques.php?do=Edit'");
                }
                else
                {
                    $query="SELECT * FROM marque_tb WHERE ID_marque=".$id_M."";
                    $result=mysqli_query($conx,$query);
                    if($result)
                    {
                        $query="UPDATE marque_tb SET Name_M='$name_M',Image_M='$img_M' WHERE ID_marque='$id_M'";
                        mysqli_query($conx,$query);
                        echo "<div class='alert-success'>Mise à jour avec success</div>";
                        header("refresh:1;url='marques.php?do=manage'");
                    }else{
                        echo "<div class='alert-danger '>les information est incorrect !</div>";
                        header("refresh:1;url='marques.php?do=Edit'");
                    }
                }
            }
            


            /*********Start page Update ********/

        }elseif($do=='delete')
        {
            /*********Start page delete ********/
            if(isset($_GET['id']))
            {
                $id_M=$_GET['id'];
                
                $query="DELETE FROM marque_tb WHERE ID_marque=$id_M";
                $result=mysqli_query($conx,$query);
                if($result)
                {
                    echo "<div class='alert-success'>La suppression avec success</div>";
                    header("refresh:1;url='marques.php?do=manage'");
                }else
                {
                    echo "<div class='alert-danger '>les information est incorrect !</div>";
                    header("refresh:1;url='marques.php?do=manage'");
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