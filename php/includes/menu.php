<?php
session_start();

if(isset($_SESSION['login'])) {
    $connect = $_SESSION['login']; // on récup "ok"
}else{
    $connect = 'ko';
}

if(isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}else{
    $role = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/menu.css">
</head>

<body>
    
    <header>
        <div>
            <img src="./image/ion_football.png" alt="" id="logo">
        </div>

        <nav>
            <a href="http://localhost/FootClub/index.php">Accueil</a>
            <a href="http://localhost/FootClub/calendrier.php">Calendrier</a>
            <a href="http://localhost/FootClub/resultats.php">Résultats</a>
            <a href="http://localhost/FootClub/contact.php">Contact</a>
            <?php if($role == 'ADMIN') : ?>
            <a href="http://localhost/FootClub/admin/index_admin.php">Admin</a>
            <?php endif ; ?>
        </nav>

        <?php if($connect != 'ok') :  ?>
        <div id="identification">
            <a href="http://localhost/FootClub/login.php">Connexion</a>
            <div>
                <svg width="1" height="38" viewBox="0 0 1 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0.5" x2="0.5" y2="38" stroke="black"/>
                </svg>
            </div>
            <a href="http://localhost/FootClub/inscription.php">Inscription</a>
        </div>
        <?php else: ?>
        <div id="identifié">
            <a href="http://localhost/FootClub/deconnexion.php">Déconnexion</a>
        </div>
        <?php endif ; ?>
    </header>

</body>
</html>
