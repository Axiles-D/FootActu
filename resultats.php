<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matchs</title>
    <link rel="stylesheet" href="./css/resultats.css">
</head>

<body>
    <?php include_once('./php/includes/menu.php') ?>
    
    <center>
        <h1>Résultats des derniers matchs</h1>
    </center>

    <?php if($connect != 'ok') :  ?>

    <div class="alert">
        <h2>
            Vous devez être connecté pour accéder aux résultats
        </h2>
    </div>

    <?php else:
    include('./php/crud/connexion_bdd.php');
    $results = mysqli_query($conn, "SELECT * FROM matchs");
    while($info = mysqli_fetch_array($results)){
        echo"
        <center>
            <main>
                <div class='card''>
                    <div class='container-img1'>
                        <img src='$info[image]' class='card-img1' alt='....'>
                    </div>
                
                    <div class='stick'>
                        <svg width='2' height='80' viewBox='0 0 1 30' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <line x1='0.5' x2='0.5' y2='80' stroke='black'/>
                        </svg>
                    </div>

                    <div class='container-text'>
                        <h2 class='card-title'>$info[name]</h2>
                        <h2 class='card-result'>$info[result]</h2>
                    </div>

                    <div class='stick'>
                        <svg width='2' height='80' viewBox='0 0 1 30' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <line x1='0.5' x2='0.5' y2='80' stroke='black'/>
                        </svg>
                    </div>
                    <div class='container-img2'>
                        <img src='$info[image2]' class='card-img2' alt='....'>
                    </div>
                </div>
            </main>
        </center>
        ";
    }
    endif ; ?>

    <div id="space"></div>

    <footer>
        <?php include_once('./php/includes/footer.php') ?>
    </footer>

</body>
</html>