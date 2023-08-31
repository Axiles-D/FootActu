<?php
session_start();

if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!='ADMIN') header('Location: ../../../index.php');
}else{
    $role='';
    if($role!='ADMIN') header('Location: ../../../index.php');
}
require '../../../php/crud/connexion_bdd.php';

$equ = $mom = $color = '';
$equ_err = $mom_err = $color_err = '';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $input_equ = trim($_POST['equ']);

    if (empty($input_equ)) {
        $equ_err = "Entrez les équipes";
    } else {
        $equ = $input_equ;
    }

    $input_mom = trim($_POST['mom']);

    if (empty($input_mom)) {
        $mom_err = "Entrez la date";
    } else {
        $mom = $input_mom;
    }

    $input_color = trim($_POST['color']);

    if (empty($input_color)) {
        $color_err = "Entrez une couleur";
    } else {
        $color = $input_color;
    }
    
    if (empty($equ_err) && empty($mom_err) && empty($color_err)) {
        $sql = 'UPDATE calendrier SET equipes=?, moment=?, color=? WHERE id=?';

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_equ, $param_mom, $param_color, $param_id);

            $param_equ = $equ;
            $param_mom = $mom;
            $param_color = $color;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ./index_calendrier.php");
                exit();
            } else {
                echo "Oops ! erreur inattendu, rééssayez plus tard ou parlez-en au concepteur du site qui a du faire de la merde";
            }
        }
    }
    mysqli_close($conn);
} else {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = trim($_GET['id']);

        $sql = "SELECT * FROM calendrier WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $equ = $row['equipes'];
                    $mom = $row['moment'];
                    $color = $row['color'];
                    $id = $row['id'];
                } else {
                    header('Location: ./index_calendrier.php');
                    exit();
                }
            } else {
                echo "Oops ! erreur inattendu, rééssayez plus tard ou parlez en au dev du site qui a du faire de la merde";
            }
        }
    } else {
        header('Location: ./index_calendrier.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
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
                <div class="col-md-12 center">
                    <h2 class="mt-5">Mise à jour de la date du match</h2>
                </div>
                <p>Changez les valeurs et validez !!!</p>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                    <div class="form-group">
                        <label>Equipes</label>
                        <input type="text" name="equ" class="form-controle <?php echo (!empty($equ_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $equ; ?>">
                        <span class="invalid-feedback"><?php echo $equ_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Date du Match</label>
                        <input type="date" name="mom" class="form-controle <?php echo (!empty($mom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mom; ?>">
                        <span class="invalid-feedback"><?php echo $mom_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Couleur</label>
                        <input type="color" name="color" class="form-controle <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $color; ?>">
                        <span class="invalid-feedback"><?php echo $color_err; ?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" class="btn btn-primary" value="Enregistrer">
                    <a href="./index_calendrier.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>