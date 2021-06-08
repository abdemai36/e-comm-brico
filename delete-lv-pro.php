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

