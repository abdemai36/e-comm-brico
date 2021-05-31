<?php
    session_start();
    include "Includes/Templates/connection.php";
    include "Includes/Functions/function.php";
    $pageTitle='Login';
    if($_SERVER["REQUEST_METHOD"]=='POST'){

        $username=$_POST["name"];
        $password=$_POST["pass"];
        if(!empty($username) && !empty($password)){

            $query= ("SELECT * FROM user_tb WHERE FullName='$username' AND password='$password' AND GroupID=1 LIMIT 1");

            $result=mysqli_query($conx,$query);
            $rw=mysqli_fetch_array($result);
            if($rw>0)
            {
                    $_SESSION['username']=$username;
                    $_SESSION['id_user']=$rw['ID_user'];
                    header('location:Index.php');
                    
                    exit();
            }else
            {
                echo "<div class='alert-danger'>Nom ou bien mot de passe est incorrect !</div>";
            }

        }else
        {
            echo "<div class='alert-danger'>SVP saisir tous les information !</div>";
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
        <h1 class="text-center mt-5">Se Connecter</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom complet</label>
                <input type="text" class="form-control inputLogin" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control inputLogin" name="pass" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <a href="#" class="form-check-label">j'ai oublie mot de passe ?</a>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">valider</button>
            
            <br>
            <center>
                <a href="SignUp.php" class="pasCompte">Pas de Compte ?</a>
            </center>
        </form>
        
    </div>
</body>
</html>