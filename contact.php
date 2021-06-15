<?php 

    if(isset($_POST['submit'])){
        $L_name=$_POST['l-name'];
        $F_name=$_POST['f-name'];
        $email=$_POST['email'];

        
        $phone=$_POST['phone'];
        $city=$_POST['city'];
        //$QNT=$_POST['QNT'];
        //$product_name=$_POST['product-name'];
        //$totalPrice=$_POST['totalPrice'];
        //$ref=$_POST['ref'];
        //echo  $L_name;
        $s="hg";
        $mailTo="abde.mai36@gmail.com";
        $headers="De ".$email;
        $text="vous avez reçu un demander de M.".$L_name." ".$F_name ."\n\n"."Il a demande le produit "." avec référance "
        ."\n\n"."Quantité : "."Total de prix :"."numéro de téléphone est : ".$phone ;



        mail($mailTo,$s,$text,$headers);
        echo "<script>alert('gooooood')</script>";
        //header("location: index.php?page=1");
        
    }
