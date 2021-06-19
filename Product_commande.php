<?php
ob_start();
    include_once('Includes/Templates/connection.php');
    include_once('Includes/Templates/header.php');
    include_once('Includes/Templates/SidBar.php');



    $do='';

    if(isset($_GET['do'])){
        $do=$_GET['do'];
    }else
    {
        $do='manage';
    }

    if($do=='prefer')   //Prefer page
    {

        if(isset($_SESSION['card']) && $_SESSION['card']>0)
        {
            $item_array_id=array_column($_SESSION['card'],'product_iD');
            $product_id=array_column($_SESSION['card'],'product_iD');


            $query="SELECT * from product_tb";
            $result=mysqli_query($conx,$query);
            
            ?>
            <div class="Main">
            <a href="index.php?page=1" style="color:black;"><i style="margin-right: 9px;" class="fas fa-home"></i></a>
            <h1 style="text-align: center; display:inline-block;">Produits préférés</h1>
            <form action="">
                <div class="panier">
                        <div class="procudt-panair">
                            <?php
                                if($result){
                                    while($row=mysqli_fetch_array($result)){
                                        $res=$row['Image'];
                                        $res=explode(" ",$res);
                                        $count=count($res)-1;
                                        foreach($product_id as $id){
                                            if($row['ID_Product']==$id){
                                                
                                                ?>
                                                <div class="body-product-panair">
                                                    <?php
                                                        for($i=0;$i<1;$i++){
                                                            echo "<img src='Admin/avatar/$res[$i]' />";                                                          
                                                        }
                                                    ?>
                                                    <h6 style="width:40%;"><?php echo $row['Name_P']?></h6>
                                                    <div class="input-qntyt-paniar">
                                                        <div class="quantity">
                                                                <input type="number" onchange='suTotal();' class="qnt" min="1" max="100" step="1" value="1">
                                                        </div>
                                                        <span  style="font-weight:bold; color:#49ce49; height: 32px; line-height: 32px;"><?php echo $row['Price']?> DH</span>
                                                        <input class="iprice" type="hidden" value="<?php echo $row['Price']?>">
                                                            
                                                        <a style="margin:0px 5px 0px 0px; cursor:pointer;">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                    }
                                }else{
                                    echo "<div class='select-none'>Aucun produit ne correspond à votre sélection.</div>";
                                }
                                
                            ?>
                                
                            
                        </div>
                        <div class="detail-panar">
                            <h5> détails Produits préférés</h5>
                            <div style="display:flex;margin:8px;">
                                <span style="width: 75%; font-weight:bold; ">Produit</span>
                                <span style="width:11%; font-weight:bold;">Prix</span>
                                <span style="width:10%; font-weight:bold;">Quantité</span>
                            </div>
                            <?php
                                $query="SELECT * from product_tb";
                                $result=mysqli_query($conx,$query);
                                $total=0;
                                if($result){
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        foreach($product_id as $id){
                                            if($row['ID_Product']==$id)
                                            {
                                            $total =$total+$row['Price'];
                                            ?>
                                            <div class="body-details-product">
                                                <div style="width: 85%;">
                                                    <h6 style="width: 80%;" ><?php echo $row['Name_P'] ?></h6>
                                                    <small style="font-weight:bold; color: #49ce49; width: 20%; text-align: center;"><?php echo $row['Price']?> DH</small>
                                                    <input type="hidden" valeu="<?php echo $row['Price']?>">  
                                                </div>
                                                <div style="text-align: center; border-left: 1px solid #ddd;padding-left: 3px; width: 15%;">
                                                    x<input class="Detail-qnt" type="text" disabled style="font-weight:bold; width:30px; border:none; background:none;" value="">
                                                </div>   
                                            </div> 
                                            <?php }
                                        }
                                    }
                                }
                            ?>
                            <div style="background:#eeeeee3d;">
                            <div style="display:flex;padding:20px 8px 20px 8px; border-top:1px solid #eee;">
                                <span style="width: 80%; font-weight:bold;font-size:18px; ">Total </span>
                                <div style=" font-weight:bold; color:#49ce49;font-size:18px;">
                                <span class="itotal" ></span>
                                <span>DH</span>
                                </div>
                            </div>
                            </div>
                            <button type="submit" name="submit" class="btn-buy-prod"><i class="fas fa-shopping-basket"></i>Commandez maintenant</button>
                        </div>
                        
                    </div>
                    
                </div>
            </form>
        

        <?php }else{
            echo "<div class='select-none'>Aucun produit ne correspond à votre sélection.</div>";
        }
        


        
    }elseif($do == 'Added'){    //Added page



        if(isset($_SESSION['card-shop']) && $_SESSION['card-shop']>0)
        {
            $item_array_id=array_column($_SESSION['card-shop'],'product_id');
            $product_id=array_column($_SESSION['card-shop'],'product_id');


            $query="SELECT * from product_tb";
            $result=mysqli_query($conx,$query);
            
            ?>
            <div class="Main">
            <a href="index.php?page=1" style="color:black;"><i style="margin-right: 9px;" class="fas fa-home"></i></a>
            <h1 style="text-align: center; display:inline-block;">  Panier</h1>
            <form action="">
                <div class="panier">
                        <div class="procudt-panair">
                            <?php
                                if($result){
                                    while($row=mysqli_fetch_array($result)){
                                        $res=$row['Image'];
                                        $res=explode(" ",$res);
                                        $count=count($res)-1;
                                        foreach($product_id as $id){
                                            if($row['ID_Product']==$id){
                                                
                                                ?>
                                                <div class="body-product-panair">
                                                    <?php
                                                        for($i=0;$i<1;$i++){
                                                            echo "<img src='Admin/avatar/$res[$i]' />";                                                          
                                                        }
                                                    ?>
                                                    <h6 style="width:40%;"><?php echo $row['Name_P']?></h6>
                                                    <div class="input-qntyt-paniar">
                                                        <div class="quantity">
                                                                <input type="number" onchange='suTotal();' class="qnt" min="1" max="100" step="1" value="1">
                                                        </div>
                                                        <span  style="font-weight:bold; color:#49ce49; height: 32px; line-height: 32px;"><?php echo $row['Price']?> DH</span>
                                                        <input class="iprice" type="hidden" value="<?php echo $row['Price']?>">
                                                            
                                                        <a style="margin:0px 5px 0px 0px; cursor:pointer;">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php }
                                        }
                                    }
                                }else{
                                    echo "<div class='select-none'>Aucun produit ne correspond à votre sélection.</div>";
                                }
                                
                            ?>
                                
                            
                        </div>
                        <div class="detail-panar">
                            <h5> détails paniar</h5>
                            <div style="display:flex;margin:8px;">
                                <span style="width: 75%; font-weight:bold; ">Produit</span>
                                <span style="width:11%; font-weight:bold;">Prix</span>
                                <span style="width:10%; font-weight:bold;">Quantité</span>
                            </div>
                            <?php
                                $query="SELECT * from product_tb";
                                $result=mysqli_query($conx,$query);
                                $total=0;
                                if($result){
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        foreach($product_id as $id){
                                            if($row['ID_Product']==$id)
                                            {
                                            $total =$total+$row['Price'];
                                            ?>
                                            <div class="body-details-product">
                                                <div style="width: 85%;">
                                                    <h6 style="width: 80%;" ><?php echo $row['Name_P'] ?></h6>
                                                    <small style="font-weight:bold; color: #49ce49; width: 20%; text-align: center;"><?php echo $row['Price']?> DH</small>
                                                    <input type="hidden" valeu="<?php echo $row['Price']?>">  
                                                </div>
                                                <div style="text-align: center; border-left: 1px solid #ddd;padding-left: 3px; width: 15%;">
                                                    x<input class="Detail-qnt" type="text" disabled style="font-weight:bold; width:30px; border:none; background:none;" value="">
                                                </div>   
                                            </div> 
                                            <?php }
                                        }
                                    }
                                }
                            ?>
                            <div style="background:#eeeeee3d;">
                            <div style="display:flex;padding:20px 8px 20px 8px; border-top:1px solid #eee;">
                                <span style="width: 80%; font-weight:bold;font-size:18px; ">Total </span>
                                <div style=" font-weight:bold; color:#49ce49;font-size:18px;">
                                <span class="itotal" ></span>
                                <span>DH</span>
                                </div>
                            </div>
                            </div>
                            <button type="submit" name="submit" class="btn-buy-prod"><i class="fas fa-shopping-basket"></i>Commandez maintenant</button>
                        </div>
                        
                    </div>
                    
                </div>
            </form>
        

        <?php }else{
            echo "<div class='select-none'>Aucun produit ne correspond à votre sélection.</div>";
        }
        

    }
?>


<?php

    include_once('Includes/Templates/footer.php');
    ob_end_flush();

 
?>