<?php 
 //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function
        
        // use PHPMailer\PHPMailer\PHPMailer;
        // use PHPMailer\PHPMailer\SMTP;
        // use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])){
       
        $email_Client=$_POST["email"];
        $F_name_Client=$_POST["f-name"];
        $l_name_Client=$_POST["l-name"];
        $Phone_Client=$_POST["phone"];
        $city_Client=$_POST["city"];
        $quantit=$_POST["quantit"];
        $recievedMail="abdellahmailal36@gmail.com";
        $message="message ".$email_Client;
        $subject="hello a ".$email_Client;
        $res =mail($recievedMail,$F_name_Client,$subject,$message,$email_Client);
    if($res){
        echo "good";
    }else{
        echo "noo";
    }







        //Load Composer's autoloader
        // require 'app/Mailer/autoload.php';

        // //Instantiation and passing `true` enables exceptions
        // $mail = new PHPMailer(true);


        // //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        // $mail->isSMTP();                                            //Send using SMTP
        // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        // $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
        // $mail->Username   = 'abde.mai36@gmail.com';                     //SMTP username
        // $mail->Password   = 'abdellah@mailal2021';                               //SMTP password
        // $mail->SMTPSecure = "ssl";         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        // $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    

        // //Content
        // $mail->isHTML(true); 
        // $mail->CharSet="UTF-8";

        // $mail->setFrom($email_Client, $F_name_Client." ".$l_name_Client);
        // $mail->addAddress('abdellahmailal36@gmail.com'); 

        // $mail->Subject = 'Message trial 3';
        // $mail->Body    = "This is the HTML message body <b>in bold!</b> $quantit";
        // $mail->send();
}else{
    echo 'rnoo';
}
      

