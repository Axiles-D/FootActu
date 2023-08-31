<?php
include 'Calendar.php';
$calendar = new Calendar();
require './php/crud/connexion_bdd.php';

$sql = "SELECT * FROM calendrier";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_array($result)){
            $calendar->add_event($row['equipes'], $row['moment'], 1, $row['color']);
        }
    }else{
        echo '<div class="alert alert-danger"><em>Aucune date trouvé.</em></div>';
    }
}else{
    echo '<div class="alert alert-danger"><em>Aucune date trouvé help me.</em></div>';
}

date_default_timezone_set('Europe/Paris');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/calendrier.css">
    <link rel="stylesheet" href="./css/calendar.css">
    <script src="./js/today.js" defer></script>
</head>

<body>
    <?php include_once('./php/includes/menu.php') ?>

    <section id="calendrier">
        <h1>
            Match à venir
        </h1>

        <div class="content home" background-color>
			<?=$calendar?>
		</div>
    </section>
    
    <footer>
        <?php include_once('./php/includes/footer.php') ?>
    </footer>
</body>

</html>