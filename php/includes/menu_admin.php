<?php

if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!='ADMIN') header('Location: http://localhost/FootClub/index.php');
}else{
    $role='';
    if($role!='ADMIN') header('Location: http://localhost/FootClub/index.php');
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
    
    <header>
        <nav>
            <a href="http://localhost/FootClub/index.php">Accueil</a>
            <p>| ADMIN navigation | -></p>
            <a href="http://localhost/FootClub/admin/index_admin.php">Utilisateurs</a>
            <a href="http://localhost/FootClub/admin/Calendrier/CRUD/index_calendrier.php">Calendrier</a>
            <a href="http://localhost/FootClub/admin/Resultats/index_resultats.php">Résultats</a>
        </nav>

        <div>
            <p>
                Bonjour, ADMIN
            </p>
        </div>
    </header>

</body>
</html>

<!-- Balise style necessaire pour le header Admin, les différents fichiers ne sont pas au même niveau (problème de chemin avec le fichier css)-->
<style> 
    body {
        margin: 0;
    }

    header {
        padding-top: 10px;
        padding-bottom: 10px;
    
        display: flex;
        justify-content: space-around;
        gap: 25%;
        align-items: center;

        text-align: center;

        border-bottom: 2px solid #000;
        background-color: #D9D9D9;
    }

    header p {
        margin: 0;
    }

    nav {
        display: flex;
        align-items: center;
        gap: 25%;
        margin-right: 15%;
    }

    nav p {
        flex-shrink: 0;
    }

    #logo {
        margin-top: 4px;
        width: 60px;
        margin-left: 100%;
    }

    #identification {
        display: flex;
        align-items: center;
        gap: 20%;
    }

    a {  
        outline: none;
        color: #000000 !important;
    }

    @media screen and (max-width: 1600px) {
        header{
            gap: 20%;
        }
    }

    @media screen and (max-width: 1200px) {
        header{
            gap: 15%;
        }

        nav {
            gap: 35%;
        }
    }
</style>