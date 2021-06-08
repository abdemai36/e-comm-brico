<?php
    session_start();
    include_once('Includes/Templates/connection.php');

    if(isset($_POST['del_id'])){
        foreach($_SESSION['card'] as $key => $value){
            if($value['product_iD']==$_POST['del_id']){
                unset($_SESSION['card'][$key]);
            }
        }
    }
    

    if(isset($_POST['del_id_shop'])){
        foreach($_SESSION['card-shop'] as $key => $value){
            if($value['product_id']==$_POST['del_id_shop']){
                unset($_SESSION['card-shop'][$key]);
            }
        }
    }
