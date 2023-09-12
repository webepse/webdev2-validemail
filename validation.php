<?php
    if(isset($_GET['hash']))
    {
        $hashValidation = $_GET['hash'];
        require_once "connexion.php";
        $req = $bdd->prepare("SELECT id, validation FROM utilisateurs WHERE email=?");
        $email = htmlentities($_GET['email']);
        $req->execute([$email]);
        $don = $req->fetch();
        $req->closeCursor();
        if($don['validation']==$hashValidation)
        {
            // update de la bdd
            $update = $bdd->prepare("UPDATE utilisateurs SET actif='ok' WHERE id=?");
            $update->execute([$don['id']]);
            $update->closeCursor();
            header("LOCATION:index.php?validation=ok");
        }else{
            header("LOCATION:index.php");
        }




    }else{
        header("LOCATION:index.php");
    }



?>