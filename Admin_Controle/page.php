<?php

    $do='';
    if(isset($_GET['do'])){
        
        $do= $_GET['do'];
    }else{
        $do = 'manage';
    }

    if($do=='manage'){
        echo "wel to manage";
    }elseif($do=='add'){
        echo "wel to add";
    }else{
        
    }