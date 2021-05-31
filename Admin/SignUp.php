<?php
    session_start();
    include "Includes/Templates/connection.php";
    include "Includes/Functions/function.php";
    
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
            echo "<div class='alert-danger'>Saisir de correct information !</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>
    <link href="Layout/CSS/StyleSite.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
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
                <a href="Login.php" class="pasCompte">J'ai déjà un compte !</a>
            </center>
        </form>
    </div>
</body>
</html>