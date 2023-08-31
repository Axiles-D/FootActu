<?php
session_start();

if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!='ADMIN') header('Location: ../../../index.php');
}else{
    $role='';
    if($role!='ADMIN') header('Location: ../../../index.php');
}
require_once "../../../php/crud/connexion_bdd.php";

$equ = $mom = $color ="";
$equ_err = $mom_err = $color_err ="";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_equ = trim($_POST["equ"]);
    if(empty($input_equ)){
        $equ_err = "entrer une équipe"; 
    } else{
        $equ = $input_equ;
    }
    
    $input_mom = trim($_POST["mom"]);
    if(empty($input_mom)){
        $mom_err = "entrer une date";     
    } else{
        $mom = $input_mom;
    }

    $input_color = trim($_POST["color"]);
    if(empty($input_color)){
        $color_err = "entrer une couleur";
    } else{
        $color = $input_color;
    }

    if(empty($equ_err) && empty($mom_err) && empty($color_err)){

            $param_equ = $equ;
            $param_mom = $mom;
            $param_color = $color;

            $sql = "INSERT INTO calendrier (equipes, moment, color) VALUES ( '$param_equ', '$param_mom', '$param_color')";
            
            $result = mysqli_query($conn, $sql);
            
            if($result){
                mysqli_close($conn);
                header("location: ./index_calendrier.php");
                exit();
            } else{
                echo "Oops! erreur inattendu, rééssayez ultérieusement";
            }
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php include_once('../../../php/includes/menu_admin.php') ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Insertion d'une Date de match dans le Calendrier</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
                        <div class="form-group">
                            <label>Nom des équipes</label>
                            <input type="text" name="equ" class="form-control" placeholder="équipe1 VS équipe2">
                        </div>
                        <div class="form-group">
                            <label>Date du Match</label>
                            <input type="date" name="mom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Couleur désirée</label>
                            <input type="color" name="color" class="form-control">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="./index_calendrier.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>