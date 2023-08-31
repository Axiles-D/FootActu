<?php
require './php/crud/connexion_bdd.php';
if (!empty($_POST['btn_submit'])){
    function str_random($var){
        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnopqrstuvwxyz1234567890";
        srand((double)microtime()*1000000);
        for($i=0; $i<$var; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

    $token = str_random(60);
    $email = $_POST['email'];
    $errors = array();
    $message = '';

    
    if(empty($_POST['email'])){
        $errors[] = "Le champs email n'a pas était rempli ou n'est pas correct";

    }else{
        $email = $_POST['email'];
        $sql = "SELECT id FROM users WHERE login = '$email'";

        $resstmt = mysqli_query($conn, $sql);
        $nbre = mysqli_affected_rows($conn);
        
        if($nbre > 0){
            $user = mysqli_fetch_array($resstmt);
            $user_id = $user['id'];
            $message = "Demande envoyé, Vérifier votre boite mail ! (N'oubliez pas de regarder les spams)";
            $sql = "UPDATE users SET token_reset = '$token' WHERE id = '$user_id'";

            if (mysqli_query($conn, $sql)){
                if (mail($email, 'Reset password', 'Afin de changer votre mot de passe, merci de cliquer sur ce lien : \n\nhttp://localhost/PHP_Squelette/confirm_reset.php?id=$user_id&token=$token')){
                    header('Location: ./index.php');
                    exit();
                }else{
                    echo "Echec d'envoie de mail";
                }

            }

        }else{
            $message = "Cette adresse mail est introuvable";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="container">

        <div class="row mylogin">
            <div class="offset-3 col-md-6 myform">
                <form class="form-horizontal" action="" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Reset Mot de Passe</legend>

                        <!-- Text input-->


                        <div class="form-group">
                            <label class="col-md-12 control-label" for="email">E-mail</label>
                            <div class="col-md-12">
                                <input id="email" name="email" type="text" placeholder="entrez votre émail" class="form-control input-md" required="">

                            </div>
                        </div>


                        <!-- Button -->
                        <div class="row">
                            <div class="form-group col-md-2">
                                <div class="col-md-10">
                                    <button id="btn_submit" name="btn_submit" class="btn btn-primary" value="envoyer">Envoyer</button>
                                </div>
                            </div>
                            <div class="form-group col-md-10">
                                <div class="col-md-12">
                                    <?php
                                if (isset($message)) : echo $message;
                                else : echo "";
                                endif;
                                    ?>
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
</body>

</html>