<?php
session_start();

if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!='ADMIN') header('Location: ../../index.php');
}else{
    $role='';
    if($role!='ADMIN') header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/admin_resultats.css">
    <script src="../../js/preview.js" defer></script>
</head>
<body>
    <?php include_once('../../php/includes/menu_admin.php') ?>
    <center>
        <div class="main">
            <form action="../../insert.php" method="post" enctype="multipart/form-data">
                <h2>Resultats de Matchs</h2>

                <div class="flex">
                    <div class="preview">
                        <img src="" alt="" id="file-preview">
                    </div>

                    <label for="file" class="logo" id="disapear"><span>?</span></label>
                    <label for="file" class="button">
                        Choisi l'image de l'équipe 1
                        <input type="file" id="file" name="image" accept="image/equipe1/*" onchange="readURL(event);">
                    </label>
                </div>
                <p>
                    VS
                </p>
                <div class="flex">
                    <div class="preview">
                        <img src="" alt="" id="file2-preview">
                    </div>

                    <label for="file2" class="logo" id="disapear2"><span>?</span></label>
                    <label for="file2" class="button">
                        Choisi l'image de l'équipe 2
                        <input type="file" id="file2" name="image2" accept="image/equipe2/*" onchange="readURL2(event);">
                    </label>
                </div>
                
                <br>
                Teams Names
                <input type="text" name="name" placeholder="équipe1 VS équipe2">
                <br>
                Teams Results
                <input type="text" name="result" placeholder="ScoreEquipe1 / ScoreEquipe2">
                <br>
                <button name="upload">Upload Match</button>
                <a href="./index_resultats.php" class="annul">Annuler</a>
                <br>
            </form>
        </div>
    </center>
</body>
</html>