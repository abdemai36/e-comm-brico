<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');

    if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
        
        header('location:All_marque.php');
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
            header('location:All_marque.php');
            exit();
        }
    }
    ob_end_flush();
?>

            <div class=marque>
                <div class="head-marque">
                    <h1 class="text-center title-h">Modifier La marque</h1>
                </div>
                <div class="body-marque">
                    <form action="update_marque.php" method="POST" enctype="multipart/form-data">
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
            
            
            

<?php
    include_once('Includes/Templates/footer.php');
?>
