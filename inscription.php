<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
   <div class="container">
    <form action="traitement.php" method="POST">
        <?php
            if(isset($_GET['error']))
            {
                echo "<div class='alert alert-danger'>Une erreur est survenue (code erreur: ".$_GET['error']." )</div>";
            }

        ?>

        <div class="form-group my-3">
            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" class="form-control">
        </div>
        <div class="form-group my-3">
            <label for="prenom">Prénom: </label>
            <input type="text" name="prenom" id="prenom" class="form-control">
        </div>
        <div class="form-group my-3">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group my-3">
            <label for="password">Mot de passe: </label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group my-3">
            <input type="submit" value="S'inscrire" class="btn btn-primary">
        </div>

    </form>

   </div>
</body>
</html>