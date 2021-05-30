<?php
function check_connection($conx){
    $FullName=$_SESSION["username"];
    if(isset($_SESSION["username"])){
    
        $FullName=$_SESSION["username"];
        $Query="SELECT * FROM user_tb where Fullname='$FullName' LIMIT 1";

        $result=mysqli_query($conx,$Query);
        if($result && mysqli_num_rows($result)>0){
            $user_data=mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("location:Login.php");
    exit();
}

function CheckeEmpty($value){

    if(empty($value)){
        return false;
    }
    return true;
}

function printTitle(){
    global $pageTitle;

    if(isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo 'Brico bakir';
    }
}

