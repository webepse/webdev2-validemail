<?php
    if(isset($_POST['nom']))
    {

        $err=0;
        if(empty($_POST['nom']))
        {
            $err=1;
        }else{
            $nom = htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['prenom']))
        {
            $err=2;
        }else{
            $prenom = htmlspecialchars($_POST['prenom']);
        }

        if(empty($_POST['email']))
        {
            $err=3;
        }else{
            $email = $_POST['email'];
            if(!preg_match("#^[a-z0-9\._-]+@[a-z0-9_-]{2,}\.[a-z]{2,}$#",$email))
            {
                $err=4;
            }
        }

        if(empty($_POST['password']))
        {
            $err=5;
        }else{
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        if($err==0)
        {

            $valid = md5(uniqid(rand(), true));

            require_once "connexion.php";
            // insertion dans la bdd
            $req = $bdd->prepare("INSERT INTO utilisateurs(email, nom, prenom, validation, password, actif) VALUES(:email,:nom, :prenom,:validation, :password, 'no')");
            $req->execute([
                ":email" => $email,
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":validation" => $valid,
                ":password" => $hash
            ]);

            // envoyer un mail pour la validation
            $message = 'Bonjour '.$nom.' '.$prenom.' , Merci pour votre inscription sur notre site. Pour valider votre compte, cliquez sur le lien suivant : <a href="http://localhost/validation/validation.php?email='.$email.'&hash='.$valid.'">Validation</a>'; 

            mail($email, 'Validation de compte', $message);
            
            // redirection vers la page index avec un flash success
            header("LOCATION:index.php?inscription=valid");


        }else{
            header("LOCATION:inscription.php?error=".$err);
        }

    }else{
        header("LOCATION:index.php");
    }


?>