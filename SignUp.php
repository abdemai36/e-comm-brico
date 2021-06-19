<?php
      ob_start();
      include "Includes/Templates/connection.php";
      include_once('Includes/Templates/header.php');
      include_once('Includes/Templates/SidBar.php');
    
    if($_SERVER["REQUEST_METHOD"]=='POST'){

        $username=$_POST["name"];
        $phone=$_POST["tele"];
        $email=$_POST["email"];
        $password=$_POST["pass"];
        $addresse=$_POST["addresse"];

        if(!is_numeric($username)&& !empty($phone)&& !empty($email)&& !empty($password)){

            $query="INSERT INTO user_tb(FullName,Email,password,Adresse,numberPhone) VALUES('$username','$email','$password','$addresse','$phone')";
            mysqli_query($conx,$query);
            header('location:Login.php');
            exit();
        }else{
            echo "<div class='Main'><div class='alert-danger'>Saisir de correct information !</div></div>";
        }
    }
?>


    <div class="container">
        <a href="index.php?page=1" style="color:black;"><i style="margin-right: 9px;" class="fas fa-home"></i></a>
        <h1 class="text-center mt-5">S'inscrire</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom complet</label>
                <input type="text" class="form-control inputLogin" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Numéro téléphone</label>
                <input type="text" class="form-control inputLogin" name="tele" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control inputLogin" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Adresse</label>
                <input type="text" class="form-control inputLogin" name="addresse" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control inputLogin" name="pass" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">valider</button>
            <br>
            <center>
                <a href="Login.php" style="font-weight:bold;">J'ai déjà un compte !</a>
            </center>
        </form>
    </div>
<?php
    ob_end_flush();
    include_once('Includes/Templates/footer.php');
?>