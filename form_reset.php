<?php
session_start();

require './php/crud/connexion_bdd.php';

if (isset($_POST['btn_modif'])) {
    $id = $_SESSION['id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET token_reset = NULL, mdp = '$password' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: ./login.php');
        exit();
    } else {
        echo 'erreur de mise à jour !';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="styles/blog.css">
    <title>Formulaire reset pwd</title>
</head>

<body>

    <div class="container">

        <div class="row mylogin">
            <div class="offset-3 col-md-6 myform">
                <form class="form-horizontal" action="" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Création de mot de passe</legend>

                        <!-- Password input-->
                        <div class="form-group">

                            <label class="col-md-12 control-label" for="password">Mot de passe :</label>
                            <div class="col-md-12">
                                <input id="password" name="password" type="password" placeholder="entrez votre mot de passe" class="form-control input-md" required="">
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="col-md-12 control-label" for="confirm_password">Confirme mot de passe :</label>
                            <div class="col-md-12">
                                <input id="password" name="confirm_password" type="password" placeholder="entrez votre mot de passe" class="form-control input-md" required="">
                            </div>

                        </div>
                        <!-- Button -->
                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="col-md-12">
                                    <button id="btn_modif" name="btn_modif" class="btn btn-primary" value="modifier">modifier</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <div class="row">
                        <p class="col-md-12 text-center">

                            retourner à l'<a href="./index.php">accueil</a>...
                        </p>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>