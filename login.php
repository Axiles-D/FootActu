<?php
session_start();
    if (isset($_SESSION['erreur'])){
        $erreur = $_SESSION['erreur'];
    } else {
        $erreur = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./css/connexion_inscription.css">
</head>
<body>
    <?php
        session_destroy();
        include './php/includes/menu.php';
    ?>
    <h1>Connectez-vous</h1>

    <div class="center">
        <form action="traitement.php" method="post">
            <div class="espace">
                <div class="column">
                    <label for="login">Votre Login</label>
                    <label for="password">Mot de passe</label>
                </div>
                <div class="column">
                    <input type="text" name="login" placeholder="abcdef@exemple.com" id="login">
                    <input type="password" name="password" placeholder="Mot de passe" id="password">
                </div>
            </div>
            <div class="center top">
                <input type="submit" value="Connexion">
                <a href="./reset_password.php">Mot de passe oublié ?</a> 
            </div>
            <div <?php if (!empty($erreur)) echo 'class="erreur"'; ?>>
                <?php echo $erreur; ?>
            </div>
        </form>
    </div>
    


    <footer>
        <?php include './php/includes/footer.php'; ?>
    </footer>
    
</body>
</html>