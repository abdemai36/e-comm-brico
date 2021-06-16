<?php 
    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['submit'])){
        $L_name=$_POST['l-name'];
        $F_name=$_POST['f-name'];
        $email=$_POST['email'];

        $subject="hellofgtyjt drth";
        $phone=$_POST['phone'];
        $city=$_POST['city'];
        //$QNT=$_POST['QNT'];
        //$product_name=$_POST['product-name'];
        //$totalPrice=$_POST['totalPrice'];
        //$ref=$_POST['ref'];
        //echo  $L_name;
        // $s="hg";
        // $mailTo="abde.mai36@gmail.com";
        $headers="De ".$email;
        // $text="vous avez reçu un demander de M.".$L_name." ".$F_name ."\n\n"."Il a demande le produit "." avec référance "
        // ."\n\n"."Quantité : "."Total de prix :"."numéro de téléphone est : ".$phone ;


        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host ="smtp.gmail.com";
        $mail->SMTPAuth=true;
        $mail->"abde.mai36@gmail.com";
        $mail->Password="abdellah@mailal2021";
        $mail->Port=465;
        $mail->SMTPSecure="ssl";

        $mail->isHTML(true);
        $mail->setForm($email,$F_name);
        $mail->addAddresse("abde.mai36@gmail.com");
        $mail->Subject=("$email ($subject)");
        $mail->Body=$headers;

        if($mail->send()){
            $statut="success";
            $response="Email is send";
        }else{
            $statut="failed";
            $response="Something is wrong <br>" .$mail->ErrorInfo;
        }

        exit(json_encode(array("statut" =>$statut,"response"=>$response)));
        mail($mailTo,$s,$text,$headers);
        echo "<script>alert('gooooood')</script>";
        //header("location: index.php?page=1");
        
    }
