<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    

    if(isset($_POST['submit'])){
            $product_id= $_POST['id'];
            $quantity=$_POST['quantity'];
            ?>

            <div class="Commander">
                <a href="index.php?page=1" style="color:black;"><i style="margin-right: 9px;" class="fas fa-home"></i></a>
                <h1 class="titel-commande">Commander</h1>
                <div class="command-body">
                    <div class="form-command">
                        <h3 class="notification-send"></h3>
                        <!--Start form-->
                        <form class="row g-3" action="contact.php" method="POST" id="from-send">
                            <input type="hidden" value=<?php echo $quantity;?> name="quantit" >
                            <div class="col-md-6">
                                <label for="validationDefault01" class="form-label">Nom <span style="color:red;">*</span></label>
                                <input type="text" class="form-control l-name" id="validationDefault01" name="l-name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">Prénom <span style="color:red;">*</span></label>
                                <input type="text" class="form-control f-name" id="validationDefault02" name='f-name' required>
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefaultUsername" class="form-label">Adresse email <span style="color:red;">*</span></label>
                                <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                <input type="email" class="form-control email" id="validationDefaultUsername" name="email"  aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault05" class="form-label">Téléphone <span style="color:red;">*</span></label>
                                <input type="tel" class="form-control phone" id="validationDefault05"name="phone" required>
                            </div>
                            <div class="col-md-12">
                                <label for="validationDefault03" class="form-label">Adresse et Ville <span style="color:red;">*</span></label>
                                <input type="text" class="form-control city" name="city" id="validationDefault03" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" name="submit">Commander</button>
                            </div>
                        
                        </form>  
                        <!--End form-->
                    </div>
                    <div class="your-command">
                        <h5 class="header-details">Détails de votre commande</h5>
                        <div class="body-details-command">
                            <div class="details-command">
                            <?php 
                            $total=0;
                            $query="SELECT * FROM product_tb WHERE ID_Product=$product_id";
                            $result=mysqli_query($conx,$query);
                            $count=mysqli_num_rows($result);
                            if($result){
                            while($row=mysqli_fetch_array($result)){
                                $total=$quantity*$row[3];
                                $res=$row['Image'];
                                $res=explode(" ",$res);
                                $count=count($res)-1;
                                for($i=0;$i<1;$i++){?>

                                    <img  src='Admin/avatar/<?php echo $res[$i]?>'/>
                                    
                                    <div style="width: 100%; position:relative;">
                                        <h6 name="product-name"><?php echo $row['Name_P']?></h6>
                                        <small style="font-weight:bold; color: #49ce49;"><?php echo $row['Price'] ?> dh</small>  
                                    </div>
                                    <div style="text-align: center; border-left: 1px solid #ddd;padding-left: 3px;">
                                        <h6 style='font-weight:bold;'>Quantité</h6>
                                        <small style='font-weight:bold;' class='QNT' name="QNT">&#215;<?php echo $quantity?></small>
                                    </div>
                                    
                                <?php }
                                
                            }
                            }
                                    
                                ?>
                        </div>
                        <div class="total-pric-command">
                            <h6 style='font-weight:bold;'>Total Prix (<?php echo $count?> Produit<small>(s)</small> ) </h6>
                            <h6 style='color: #49ce49;font-weight:bold;' name="totalPrice"><?php echo $total?> DH</h6>
                        </div>
                        
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        <?php 
    }else{  
        echo "<div class='Commander'>";
        echo "<div class='select-none'>Vous n'avez pas accédé en cette page directement.</div>";
        echo "/<div>";
        
    }
?>
    
            
        
        
    

<?php
    ob_end_flush();
    include_once('Includes/Templates/footer.php');
?>