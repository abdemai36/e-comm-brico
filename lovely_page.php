<?php
    session_start();
    include_once('Includes/Templates/connection.php');

    $do='';

    if(isset($_GET['do'])){
        $do=$_GET['do'];
    }else{
        $do='manage';
    }

    if($do=='prefer')   //Prefer page
    {
        /******************Start page prefer**********************/
        if(isset($_GET['i']))
        {
            //echo $_GET['i'];
            if(isset($_SESSION['card']))
            {
                $item_array_id=array_column($_SESSION['card'],'product_iD');
                print_r($item_array_id);
                if(in_array($_GET['i'],$item_array_id))
                {
                    echo "<script>alert('Ce produit déjà existé dans votre list préféré')</script>";
                    echo "<script>window.location='index.php?page=1'</script>";
                }else
                {
                    $count=count($_SESSION['card']);
                    $item_array=array(
                        'product_iD'=>$_GET['i']
                    );
                    $_SESSION['card'][$count]=$item_array;
                    header('location:index.php?page=1');
                    exit();
                }
            }else
            {
                $item_array=array(
                    'product_iD'=>$_GET['i']
                );
                $_SESSION['card'][0]=$item_array;
                header('location:index.php?page=1');
                    exit();
            }

        }else{
            header('location:index.php');
            exit();
        }

        /******************End page prefer**********************/
    }elseif($do=='add-card'){

        /******************Start page add-card**********************/

        if(isset($_GET['i']))
        {
            //echo $_GET['i'];
            if(isset($_SESSION['card-shop']))
            {
                $item_array_id=array_column($_SESSION['card-shop'],'product_id');
                //print_r($item_array_id);
                if(in_array($_GET['i'],$item_array_id))
                {
                    // echo "<script>alert('Ce produit déjà existé dans votre panier')</script>";
                    // echo "<script>window.location='index.php'</script>";
                    header('location:index.php');
                    exit();
                }else
                {
                    $count=count($_SESSION['card-shop']);
                    $item_array=array(
                        'product_id'=>$_GET['i']
                    );
                    $_SESSION['card-shop'][$count]=$item_array;
                    header('location:index.php');
                    exit();
                }
            }else
            {
                $item_array=array(
                    'product_id'=>$_GET['i']
                );
                $_SESSION['card-shop'][0]=$item_array;
                
                
            }

        }
        /******************End page add-card**********************/

    }else{
        header('location:index.php');
        exit();
    }

