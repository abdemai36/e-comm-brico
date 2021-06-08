<?php

    ob_start();

    include('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Functions/function.php');
    $pageTitle='Admins';


    if(isset($_SESSION['username'])){
        $do='';

        if(isset($_GET['do'])){
            $do=$_GET['do'];
        }else{
            $do='manage';
        }

        if($do=='manage')   //manage page
        {
            $query= ("SELECT `ID_Product`,`Reference`,`Name_P`,`Price`,`Pric_old`, m.Name_M,c.Name_Categori,`Image`,`discription`,`InStock` FROM
                `product_tb` p inner join marque_tb m on p.Marque=m.ID_marque inner join categorie_tb c on p.Categorie=c.ID_categori ORDER BY `ID_Product` desc");



            $result=mysqli_query($conx,$query);
            if($result){?>
                <form action="" method="GET">
                <h1 class="text-center mt-5 title-h">Tout Les Produits</h1>
                    <a href="Produits.php?do=add" class="btn btn-success ajouterbtn"><i class="fas fa-plus"></i>&nbsp; Produit</a>
                <div class="table-responsive">
                        <table class="table mt-3 table-bordered table-responsive table-hover">
                                <tr>
                                    <th>Référence</th>
                                    <th>Nom Produit</th>
                                    <th>Prix</th>
                                    <th>Ancien prix</th>
                                    <th>La marque</th>
                                    <th>La catégorie</th>
                                    <th>Image</th>
                                    <th>Déscription</th>
                                    <th>disponibilité</th>
                                    <th class="th-control">contrôle</th>
                                </tr>
                                <?php
                                    while($ro=mysqli_fetch_array($result)){
                                        $res=$ro[7];
                                        $res=explode(" ",$res);
                                        $count=count($res)-1;

                                        echo "<tr>";
                                        echo "<td>".$ro[1]."</td>";
                                        echo "<td>".$ro[2]."</td>";
                                        echo "<td>".$ro[3]."</td>";
                                        echo "<td>".$ro[4]."</td>";
                                        echo "<td>".$ro[5]."</td>";
                                        echo "<td>".$ro[6]."</td>";
                                        echo "<td>";
                                            for($i=0;$i<1;$i++)
                                            {
                                                echo "<img class='img-marque' src='avatar/".$res[$i]."'/>";

                                            }
                                        echo "</td>";

                                        echo "<td>".$ro[8]."</td>";
                                        if($ro[9]==1)
                                        {
                                            echo "<td style='color:#30d730;'>En stock</td>";
                                        }
                                        elseif($ro[9]==0){
                                            echo "<td style='color:red;'>Pas en stock</td>";
                                        }

                                        echo "<td>
                                                <a href='?do=view&id=$ro[0]' class='btn btn-warning btn-Norespons'>Afficher</a>
                                                <a href='?do=view&id=$ro[0]' class='btn btn-warning btn-respons'><i style='font-size:18px;' class='fas fa-eye'></i></a>
                                                <a href='?do=Edit&id=$ro[0]' class='btn btn-info btn-Norespons'>Modifier</a>
                                                <a href='?do=Edit&id=$ro[0]' class='btn btn-info btn-respons'><i class='far fa-edit'></i></a>
                                                <a href='?do=delete&id=$ro[0]' class='btn btn-danger btn-Norespons' name='del'>Supprimer</a>
                                                <a href='?do=delete&id=$ro[0]' class='btn btn-danger btn-respons' name='del'><i class='far fa-trash-alt'></i></a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </table>
                    </div>
                </form>
<?php       }
        }elseif($do=='add'){        //add page

        $query="SELECT ID_marque,Name_M FROM marque_tb ORDER BY Name_M";
        $result=mysqli_query($conx,$query);


        $query_Categ="SELECT ID_categori,Name_Categori FROM categorie_tb ORDER BY Name_Categori ";
        $result_Categ=mysqli_query($conx,$query_Categ);
            ?>

        <div class="container addAdmins">
                    <h1 class="text-center mt-5">Ajouter produit</h1>
                    <form action="?do=insert" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Référence</label>
                            <input type="text" class="form-control inputLogin" name="ref" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom Produit</label>
                            <input type="text" class="form-control inputLogin" name="Name_p" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Prix</label>
                            <input type="text" class="form-control inputLogin" name="price" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ancien prix</label>
                            <input type="text" class="form-control inputLogin" name="price_old" >
                        </div>
                        <div class="mb-3 DropD_marque">
                            <label for="marque">La marque</label>
                                <select name="marque" id="marque">
                                    <?php
                                        if($result){
                                            while($row=mysqli_fetch_array($result)){
                                                $id_M=$row['ID_marque'];
                                                $name_M=$row['Name_M'];
                                                echo "<option value='$id_M'>$name_M</option>";
                                            }
                                        }

                                    ?>
                                </select>
                        </div>
                        <div class="mb-3 DropD_categ">
                            <label for="categori">Catégorie</label>
                                <select name="categori" id="categori">
                                    <?php
                                        if($result_Categ){
                                            while($row=mysqli_fetch_array($result_Categ)){
                                                $id_categ=$row['ID_categori'];
                                                $name_Categ=$row['Name_Categori'];
                                                echo "<option value='$id_categ'>$name_Categ</option>";
                                            }
                                        }
                                    ?>
                                </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rb_stock" value="1" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    En Stock
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rb_stock" value="0" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Pas en Stock
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control form-control-lg" name="image_P[]" type="file" id="formFile" multiple>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" name="descrip" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mb-5">Ajouter</button>
                    </form>
                </div>
        <?php  }elseif($do=='insert'){   //page insert

                if(isset($_POST['submit'])){
                    $ref=$_POST['ref'];
                    //$name_P=$_POST['Name_p'];
                    $price=$_POST['price'];
                    $price_old=$_POST['price_old'];
                    $id_Marque=$_POST['marque'];
                    $id_categori=$_POST['categori'];
                    $stock=$_POST['rb_stock'];
                    $descrip=$_POST['descrip'];
                    $name_P=str_replace("'","\\'",$_POST['Name_p']);
                    $desc=str_replace("'", "\\'",$descrip);


                    $Image_P_Name = $_FILES['image_P']['name'];
                    $Image_P_Size = $_FILES['image_P']['size'];
                    $Image_P_tmpN = $_FILES['image_P']['tmp_name'];
                    //$Image_P_Extansion="";
                    $image='';
                    $Image_P_type = $_FILES['image_P']['type'];
                    $Image_P_Allow_Extansion = array("jpeg","png","jpg","gif");
                    $dataImg='';

                    if(empty($ref) && empty($name_P) && empty($price)){
                        echo "<div class='alert-danger'>S'il vous plait saisir tous les information</div>";

                    }else{
                        if (is_array($_FILES['image_P']['name']) || is_object($_FILES['image_P']['name'])){
                            foreach($_FILES['image_P']['name'] as $key=>$val){

                                $image=$_FILES['image_P']['name'][$key];
                                $Image_P_tmpN=$_FILES['image_P']['tmp_name'][$key];
                                // $tmp=explode('.',$image);
                                // $Image_P_Extansion = strtolower(end($tmp));
                                $Image_P_Extansion =pathinfo($image,PATHINFO_EXTENSION);
                                $image=rand(0,1000) . '_' .$image;
                                move_uploaded_file($Image_P_tmpN,'avatar/'.$image);
                                $dataImg .=$image." ";
                            }
                            if(!in_array($Image_P_Extansion,$Image_P_Allow_Extansion))
                            {
                                echo "<div class='alert-danger'>S'il vous plait saisir seulement des image (png | jpg | jpeg | gif) </div>";
                                header("refresh:2;url='Produits.php?do=add'");
                            }else
                            {
                                $query="INSERT INTO product_tb(`Reference`,Name_P,Price,Pric_old,Marque,Categorie,discription,`Image`,InStock)
                                VALUES('$ref','$name_P','$price','$price_old','$id_Marque','$id_categori','$desc','$dataImg','$stock')";
                                $result=mysqli_query($conx,$query);
                                if($result){
                                    echo "<div class='alert-success'>Ajouté avec success</div>";
                                    header("refresh:1;url='Produits.php?do=manage'");
                                }else{
                                    echo "<div class='alert-danger'>L'ajoute de produit a échoué !</div>";
                                    echo mysqli_error($conx);
                                }
                            }

                        }
                    }

                }
        }elseif($do=="delete")
        {

            $product_id=(isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
            $query="DELETE FROM product_tb WHERE ID_Product=$product_id";
            $result=mysqli_query($conx,$query);
            if($result){
                echo "<div class='alert-success'>La suppression avec succès</div>";
                header("refresh:1;url='Produits.php?do=manage'");
            }else{
                echo "<div class='alert-danger'>La suppression echoué</div>";
                header("refresh:1;url='Produits.php?do=manage'");
            }

        }elseif($do=='Edit')        //page edit
        {
            $product_id=(isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
            $query= ("SELECT `ID_Product`,`Reference`,`Name_P`,`Price`,`Pric_old`, m.Name_M,c.Name_Categori,`Image`,`discription`,`InStock` FROM
            `product_tb` p inner join marque_tb m on p.Marque=m.ID_marque inner join categorie_tb c on p.Categorie=c.ID_categori WHERE ID_Product=$product_id LIMIT 1");
            $result=mysqli_query($conx,$query);
            $rw=mysqli_fetch_array($result);

            $query_Marqur="SELECT ID_marque,Name_M FROM marque_tb ORDER BY Name_M";
            $result_Marque=mysqli_query($conx,$query_Marqur);


            $query_Categ="SELECT ID_categori,Name_Categori FROM categorie_tb ORDER BY Name_Categori ";
            $result_Categ=mysqli_query($conx,$query_Categ);

            if($rw>0) ?>
            <div class="container addAdmins">
                    <h1 class="text-center mt-5">Modifier produit</h1>
                    <form action="?do=update" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" class="form-control inputLogin" name="id" value='<?php echo $product_id?>'  id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Référence</label>
                            <input type="text" class="form-control inputLogin" name="ref" value='<?php echo $rw['Reference']?>' >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom Produit</label>
                            <input type="text" class="form-control inputLogin" name="Name_p" value='<?php echo $rw['Name_P']?>' >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Prix</label>
                            <input type="text" class="form-control inputLogin" name="price"  value='<?php echo $rw['Price']?>'>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ancien prix</label>
                            <input type="text" class="form-control inputLogin" name="price_old" value='<?php echo $rw['Pric_old']?>' >
                        </div>
                        <div class="mb-3 DropD_marque">
                            <label for="marque">La marque</label>
                                <select name="marque" id="marque">
                                <?php
                                        if($result_Marque){
                                            while($row_M=mysqli_fetch_array($result_Marque)){
                                                $id_M=$row_M['ID_marque'];
                                                $name_M=$row_M['Name_M'];
                                                echo "<option value='$id_M'>$name_M</option>";
                                            }
                                        }
                                    ?>
                                </select>
                        </div>
                        <div class="mb-3 DropD_categ">
                            <label for="categori">Catégorie</label>
                                <select name="categori" id="categori">
                                    <?php
                                        if($result_Categ){
                                            while($row_C=mysqli_fetch_array($result_Categ)){
                                                $id_C=$row_C['ID_categori'];
                                                $name_C=$row_C['Name_Categori'];
                                                echo "<option value='$id_C'>$name_C</option>";
                                            }
                                        }
                                    ?>
                                </select>
                        </div>
                        <div class="mb-3">

                        <?php
                            if($rw['InStock']==1)
                            {?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rb_stock" value="1" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        En Stock
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rb_stock" value="0" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Pas en Stock
                                    </label>
                                </div>

                            <?php }elseif($rw['InStock']==0){?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rb_stock" value="1" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        En Stock
                                    </label>
                                    </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rb_stock" value="0" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Pas en Stock
                                    </label>
                                </div>
                        <?php }?>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control form-control-lg" name="image_P[]" type="file" id="formFile" multiple>
                        </div>
                        <div>
                                <?php
                                    $res=$rw[7];
                                    $res=explode(" ",$res);
                                    $count=count($res)-1;
                                    for($i=0;$i<$count;$i++)
                                    {?>
                                        <img class="multi-img-view" src='avatar/<?php echo $res[$i];?>'/>

                                <?php }?>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here"  name="descrip" id="floatingTextarea2" style="height: 100px"><?php echo $rw['discription']?></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mb-5">Modifier</button>
                    </form>
                </div>


        <?php }elseif($do=='view')         //view product
            {
                $product_id=(isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;
                $query= ("SELECT `ID_Product`,`Reference`,`Name_P`,`Price`,`Pric_old`, m.Name_M,c.Name_Categori,`Image`,`discription`,`InStock` FROM
                `product_tb` p inner join marque_tb m on p.Marque=m.ID_marque inner join categorie_tb c on p.Categorie=c.ID_categori WHERE ID_Product=$product_id LIMIT 1");
                $result=mysqli_query($conx,$query);
                $row=mysqli_fetch_array($result);


                if($row>0)
                {?>

                <h1 class="text-center  title-h">Le produit</h1>
                <div class="container-view">

                        <div class="image" id="imgContainer">
                            <!-- <div id="lens"></div> -->
                                <?php
                                    $res=$row[7];
                                    $res=explode(" ",$res);
                                    $count=count($res)-1;
                                    for($i=0;$i<1;$i++)
                                    {?>
                                        
                                        <img class="Big-img-view" id='zoomImg' src='avatar/<?php echo $res[$i];?>'/>
                                <?php }?>
                        </div>

                        <div class="title-P">
                            <h2><?php echo $row['Name_P']?></h2>
                        </div>

                        <div class="categorie">
                            <p><span style="font-weight:bold;margin-right: 1rem;font-size: 21px;">Catégorie :</span><?php echo $row[6]?></p>
                        </div>

                        <div class="marque-view">
                            <p><span style="font-weight:bold;margin-right: 1rem;font-size: 21px;">Marque :</span><?php echo $row[5]?></p>
                        </div>

                        <div class="pric">
                            <div>
                                <span class='new-pric'><?php echo $row['Price']?> DH</span>
                            </div>
                            <div>
                                <?php if($row['Pric_old']==0){
                                    $row['Pric_old']="";
                                } else{
                                    $row['Pric_old']=$row['Pric_old']." DH";
                                } ?>
                                <span class='old-pric'><?php echo $row['Pric_old']?></span>
                            </div>
                            <div>
                                <?php
                                if($row['InStock']==1)
                                {
                                    $row['InStock']='En stock';
                                    echo "<span style='color:#30d730; font-weight:bold;'>".$row['InStock']."</span>";
                                }else{
                                    $row['InStock']='Pas es stock';
                                    echo "<span style='color:red;font-weight:bold;'>".$row['InStock']."</span>";
                                }
                                ?>

                            </div>
                        </div>

                        <div class="discription">
                            <p><?php echo $row['discription']?></p>
                        </div>

                        <div class="images">
                            <div>
                                <?php
                                    $res=$row[7];
                                    $res=explode(" ",$res);
                                    $count=count($res)-1;
                                    for($i=0;$i<$count;$i++)
                                    {?>
                                        <img class="multi-img-view" id='zoomImg' src='avatar/<?php echo $res[$i];?>'/>
                                    <!-- <a data-zoom-id="jeans" href='avatar/<?php echo $res[$i];?>' data-image='avatar/<?php echo $res[$i];?>'><img class="multi-img-view" src='avatar/<?php echo $res[$i];?>' /></a> -->
                                <?php }?>
                            </div>
                        </div>

                </div>

    <?php
            }
        }elseif($do='update')        //page update
        {
            /** Start page update**/
            if(isset($_POST['submit'])){
                $id_produit=$_POST['id'];
                $ref=$_POST['ref'];
                $name_P=$_POST['Name_p'];
                $price=$_POST['price'];
                $price_old=$_POST['price_old'];
                $id_Marque=$_POST['marque'];
                $id_categori=$_POST['categori'];
                $stock=$_POST['rb_stock'];
                $descrip=$_POST['descrip'];
                $name_P=str_replace("'","\\'",$_POST['Name_p']);
                $desc=str_replace("'", "\\'",$descrip);


                $Image_P_Name = $_FILES['image_P']['name'];
                $Image_P_Size = $_FILES['image_P']['size'];
                $Image_P_tmpN = $_FILES['image_P']['tmp_name'];
                //$Image_P_Extansion="";
                $image='';
                $Image_P_type = $_FILES['image_P']['type'];
                $Image_P_Allow_Extansion = array("jpeg","png","jpg","gif");
                $dataImg='';

                if(empty($ref) && empty($name_P) && empty($price)){
                    echo "<div class='alert-danger'>S'il vous plait saisir tous les information</div>";

                }else{
                    if (is_array($_FILES['image_P']['name']) || is_object($_FILES['image_P']['name'])){
                        foreach($_FILES['image_P']['name'] as $key=>$val){

                            $image=$_FILES['image_P']['name'][$key];
                            $Image_P_tmpN=$_FILES['image_P']['tmp_name'][$key];
                            // $tmp=explode('.',$image);
                            // $Image_P_Extansion = strtolower(end($tmp));
                            $Image_P_Extansion =pathinfo($image,PATHINFO_EXTENSION);
                            $image=rand(0,1000) . '_' .$image;
                            move_uploaded_file($Image_P_tmpN,'avatar/'.$image);
                            $dataImg .=$image." ";
                        }
                        if(!in_array($Image_P_Extansion,$Image_P_Allow_Extansion))
                        {
                            echo "<div class='alert-danger'>S'il vous plait saisir seulement des image (png | jpg | jpeg | gif) </div>";
                            header("refresh:2;url='Produits.php?do=Edit'");
                        }else
                        {
                            $query="UPDATE product_tb SET `Reference`='$ref',Name_P='$name_P',Price='$price',Pric_old='$price_old',Marque='$id_Marque',
                            Categorie='$id_categori',discription='$desc',Image='$dataImg',InStock='$stock' WHERE ID_Product=$id_produit ";
                            $result=mysqli_query($conx,$query);
                            if($result){
                                echo "<div class='alert-success'>La mise à ajour avec success</div>";
                                header("refresh:1;url='Produits.php?do=manage'");
                            }else{
                                echo "<div class='alert-danger'>La mise à ajour de produit a échoué !</div>";
                                //header("refresh:1;url='Produits.php?do=manage'");
                                echo mysqli_error($conx);
                            }
                        }

                    }
                }

            }



            /** End page update**/
        }else{
            header("location:Produits.php");
            exit();
        }


    }else{
        header('location:Login.php');
        exit();
    }
?>






<?php
    include_once('Includes/Templates/footer.php');
?>