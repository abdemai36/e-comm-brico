<?php

    ob_start();
    
    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');
    $pageTitle='Admins';
    

    if(isset($_SESSION['username'])){
        $do='';
        if(isset($_GET['do'])){
            $do= $_GET['do'];
        }else{
            $do = 'manage';
        }
        

        /**Page manage admins**/
        if($do=='manage'){       //manage page ?>

                    <h1 class="text-center mt-5 title-h">Tous les commandes</h1>

        <?php }elseif($do=='add'){        //Add page ?>
        
                    <h1 class="text-center mt-5 title-h">Ajouter commandes</h1>
        
        
        <?php }elseif($do=='insert'){       //Insert page
        
        
        
        }elseif($do =='delete'){     //delete page
        
        
        }
        elseif($do =='Edit'){      //edit page
        
        
        
        }elseif($do=='update'){     //page update admin
        

        }else{
            echo "<div class='alert-danger'>vous ne peux pas accéder à cette page directement</div>";
        }

        /**End Page manage admins**/

    }else{
        header('location:Login.php');
        exit();
    }
    ob_end_flush();
?>



<?php
    include_once('Includes/Templates/footer.php');
?>