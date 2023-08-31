<?php
session_start();
if (isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'];
} else {
    $erreur = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./css/connexion_inscription.css">
</head>

<body>

    <?php
    session_destroy();
    include './php/includes/menu.php'
    ?>
    <h1>Inscrivez vous</h1>

    <div class="center">
        <form action="./inscrit.php" method="post">
            <div class="espace">
                <div class="column">
                    <label for="pseudo">Email</label>
                    <label for="password">Mot de passe</label>
                </div>
                <div class="column">
                    <input type="text" placeholder="Votre email" name="pseudo" id="pseudo">
                    <input type="password" name="password" placeholder="Mot de passe" id="password">
                </div>
            </div>
            <div class="center top">
                <input type="submit" value="Inscription">
            </div>
            <div <?php if (!empty($erreur)) echo 'class="erreur"'; ?>>
                <?php echo $erreur ?>
            </div>
        </form>
    </div>




    <footer>
        <?php include './php/includes/footer.php' ?>
    </footer>

</body>

</html>