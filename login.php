<?php
    session_start();

    // test si déjà connecté
    if(isset($_SESSION['email']))
    {
        header("LOCATION:dashboard.php");
    }

    // test si formulaire envoyé
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        // vérification du formulaire
        if(empty($_POST['email']) OR empty($_POST['password']))
        {
            $error = "Veuillez remplir correctement le formulaire";
        }else{
            $login = htmlspecialchars($_POST['email']);
            $password= $_POST['password'];
            require "connexion.php";
            $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE email=?");
            $req->execute([$login]);
            if($don = $req->fetch())
            {
                if(password_verify($password, $don['password']))
                {
                    if($don['actif']=="ok")
                    {
                        $_SESSION['email'] = $don['email'];
                        header('LOCATION:dashboard.php');
                    }else{
                        $error="Votre compte n'est pas actif";
                    }
                }else{
                    $error = "Le mot de passe ne correspond pas";
                }
            }else{
                $error = "le compte n'existe pas";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Stock - Administration</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 my-5">
                <form action="login.php" method="POST">
                    <h1>Connexion</h1>
                    <?php
                        if(isset($error))
                        {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                        }
                    ?>
                   
                    <div class="form-group my-3">
                        <label for="email">E-mail: </label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <input type="submit" value="Connexion" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>