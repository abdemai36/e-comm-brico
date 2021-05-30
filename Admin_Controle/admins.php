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
        if($do=='manage'){       //manage page
            $user_id=(isset($_GET['userid']) && is_numeric($_GET['userid'])) ? intval($_GET['userid']) : 0;
            
            $query= ("SELECT * FROM user_tb WHERE GroupID=1");
            $result=mysqli_query($conx,$query);
            if($result){?>
                
                <form action="" method="GET">
                <h1 class="text-center mt-5 title-h">Tout Les Admins</h1>
                    <a href="admins.php?do=add" class="btn btn-success ajouterbtn"><i class="fas fa-plus"></i>&nbsp; Admin</a>
                <div class="table-responsive">
                        <table class="table mt-3 table-bordered table-responsive table-hover">
                                <tr>
                                    <th>ID admin</th>
                                    <th>Nom complet</th>
                                    <th>E-mail</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Mot de passe</th>
                                    <th>contrôle</th>
                                </tr>
                                <?php 
                                    while($ro=mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>".$ro[0]."</td>";
                                        echo "<td>".$ro[1]."</td>";
                                        echo "<td>".$ro[2]."</td>";
                                        echo "<td>".$ro[5]."</td>";
                                        echo "<td>".$ro[6]."</td>";
                                        echo "<td>".$ro[3]."</td>";
                                        echo "<td> 
                                                <a href='?do=Edit&userid=$ro[0]' class='btn btn-info btn-Norespons'>Modifier</a>
                                                <a href='?do=Edit&userid=$ro[0]' class='btn btn-info btn-respons'><i class='far fa-edit'></i></a>  
                                                <a href='?do=delete&userid=$ro[0]' class='btn btn-danger btn-Norespons' name='del'>Supprimer</a> 
                                                <a href='?do=delete&userid=$ro[0]' class='btn btn-danger btn-respons' name='del'><i class='far fa-trash-alt'></i></a> 
                                            </td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </table>
                    </div>
                </form>

                <?php }
        }elseif($do=='add'){?>

                <div class="container addAdmins">
                    <h1 class="text-center mt-5">Ajouter Admin</h1>
                    <form action="?do=insert" method="POST" class="">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom complet</label>
                            <input type="text" class="form-control inputLogin" name="name" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Numéro téléphone</label>
                            <input type="text" class="form-control inputLogin" name="tele" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control inputLogin" name="email" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Adresse</label>
                            <input type="text" class="form-control inputLogin" name="addresse" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control inputLogin" name="pass" id="exampleInputPassword1">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div> 



            <?php }elseif($do=='insert'){       //Insert page

                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $name=$_POST['name'];
                    $tele=$_POST['tele'];
                    $email=$_POST['email'];
                    $adresse=$_POST['addresse'];
                    $pass=$_POST['pass'];
                    if(empty($name)|| empty($tele)||empty($email)||empty($adresse)||empty($pass)){
                        echo "<div class='alert-danger'>Saisir tous les informations !</div>";
                        header("refresh:1;url='admins.php?do=add'");
                    }else{

                        $query="INSERT INTO user_tb (FullName,Email,password,GroupID,Adresse,numberPhone) VALUES('$name','$email','$pass',1,'$adresse',$tele)";
                        $result=mysqli_query($conx,$query);
                        if($result){
                            echo "<div class='alert-success'>L'ajoute avec succès</div>";
                            header("refresh:1;url='admins.php?do=manage'");
                        }else{
                            echo "<div class='alert-danger'>L'ajoute avec echoué</div>";
                            header("refresh:1;url='admins.php?do=add'");
                        }
                    }
                }
            }
            elseif($do =='delete'){     //delete page

            $user_id=(isset($_GET['userid']) && is_numeric($_GET['userid'])) ? intval($_GET['userid']) : 0;
            $query="DELETE FROM user_tb WHERE ID_user=$user_id";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "<div class='alert-success'>La suppression avec succès</div>";
                header("refresh:1;url='admins.php?do=manage'");
            }else{
                echo "<div class='alert-danger'>La suppression echoué</div>";
                header("refresh:1;url='admins.php?do=manage'");
            }
        }
        elseif($do =='Edit'){      //edit page
            
            $user_id=(isset($_GET['userid']) && is_numeric($_GET['userid'])) ? intval($_GET['userid']) : 0;
            $query= ("SELECT * FROM user_tb WHERE ID_user=$user_id LIMIT 1");

            $result=mysqli_query($conx,$query);
            $rw=mysqli_fetch_array($result);
            if($rw>0){ ?>
                <div class="container editAdmins">
                    <h1 class="text-center mt-5">Modifier Admin</h1>
                    <form action="?do=update" method="POST">
                        <div class="mb-3">
                            <input type="hidden" class="form-control inputLogin" name="id" value='<?php echo $user_id?>'  id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom complet</label>
                            <input type="text" class="form-control inputLogin" name="name" value='<?php echo $rw['FullName']?>'  id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Numéro téléphone</label>
                            <input type="text" class="form-control inputLogin" name="tele" value='<?php echo $rw['numberPhone']?>' id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control inputLogin" name="email" value='<?php echo $rw['Email']?>' id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Adresse</label>
                            <input type="text" class="form-control inputLogin" name="addresse" value='<?php echo $rw['Adresse']?>' id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control inputLogin" name="pass" value='<?php echo $rw['password']?>' id="exampleInputPassword1">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Modiffire</button>
                    </form>
                </div> 

        <?php   }else{
            echo "<div class='alert-danger'>admin n'existe pas !!</div>";
        }
            }elseif($do=='update'){     //page update admin
            
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $id_user=$_POST['id'];
                    $name_user=$_POST['name'];
                    $tele_user=$_POST['tele'];
                    $email_user=$_POST['email'];
                    $addresse_user=$_POST['addresse'];
                    $pass_user=$_POST['pass'];
                    if(empty($id_user) || empty($name_user)|| empty($tele_user)||empty($email_user)||empty($addresse_user)||empty($pass_user)){
                        echo "<div class='alert-danger'>Saisir tous les informations !</div>";
                        header("refresh:1;url='admins.php?do=Edit&userid=$id_user'");
                    }else{

                        $query="UPDATE user_tb SET FullName='$name_user',Email='$email_user',password='$pass_user',GroupID=1,Adresse='$addresse_user',numberPhone='$tele_user' WHERE ID_user=$id_user";
                        $result=mysqli_query($conx,$query);
                        if($result){
                            echo "<div class='alert-success'>La mise à jour avec succès</div>";
                            header("refresh:1;url='admins.php?do=manage'");
                            //exit();
                        }else{
                            echo "<div class='alert-danger'>La mise à jour  echoué</div>";
                            header("refresh:1;url='admins.php?do=manage'");
                            //echo mysqli_error($conx);
                        }  
                    }

                    
                }else{
                    echo "<div class='alert-danger'>vous ne peux pas accéder à cette page directement</div>";
                    
                }
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