<?php
session_start();

if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!='ADMIN') header('Location: ../../index.php');
}else{
    $role='';
    if($role!='ADMIN') header('Location: ../../index.php');
}
require '../../php/crud/connexion_bdd.php';

$equ = $res = $img1 = $img2 = '';
$equ_err = $res_err = $img1_err = $img2_err = '';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $input_equ = trim($_POST['equ']);

    if (empty($input_equ)) {
        $equ_err = "Entrez les équipes";
    } else {
        $equ = $input_equ;
    }

    $input_res = trim($_POST['res']);

    if (empty($input_res)) {
        $res_err = "Entrez le résultat";
    } else {
        $res = $input_res;
    }

    $img1 = $_FILES['img1']['name'];

    $img2 = $_FILES['img2']['name'];
    
    if (empty($equ_err) && empty($res_err)) {
        $sql = 'UPDATE matchs SET name=?, result=?, image=?, image2=? WHERE id=?';

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $param_equ, $param_res, $param_img1, $param_img2, $param_id);

            $param_equ = $equ;
            $param_res = $res;
            $param_id = $id;
            // var_dump($img1);die;
            if (empty($img1)){
                
                $sql = "SELECT * FROM matchs WHERE id=?";

                if ($stmt2 = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt2, "i", $param_id);
        
                    $param_id = $id;
        
                    if (mysqli_stmt_execute($stmt2)) {
                        $result = mysqli_stmt_get_result($stmt2);
        
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
                            $param_img1 = $row['image'];
                        }
                    }
                }

            }else{
                $param_img1 = "image/equipe1/" . $img1;
                $image_location = $_FILES['img1']['tmp_name'];
                $image_name = $_FILES['img1']['name'];

                if (move_uploaded_file($image_location, '../../image/equipe1/' . $image_name)){
                    echo "<script>alert('done!!!')</script>";
                } else {
                    echo "<script>alert('Error while moving images')</script>";
                }
            }
            
            if (empty($img2)){

                $sql = "SELECT * FROM matchs WHERE id=?";

                if ($stmt3 = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt3, "i", $param_id);
        
                    $param_id = $id;
        
                    if (mysqli_stmt_execute($stmt3)) {
                        $result = mysqli_stmt_get_result($stmt3);
        
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
                            $param_img2 = $row['image2'];
                        } else {
                            header('Location: ./index_resultats.php');
                            exit();
                        }
                    } else {
                        echo "Oops ! erreur inattendu, rééssayez plus tard ou parlez en au dev du site qui a du faire de la merde";
                    }
                }

            }else{
                $param_img2 = "image/equipe2/" . $img2;
                
                $image2_location = $_FILES['img2']['tmp_name'];
                $image2_name = $_FILES['img2']['name'];

                if (move_uploaded_file($image2_location, '../../image/equipe2/' . $image2_name)){
                    
                }
            }


            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ./index_resultats.php");
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

        $sql = "SELECT * FROM matchs WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $equ = $row['name'];
                    $res = $row['result'];
                    $img1 = $row['image'];
                    $img2 = $row['image2'];
                    $id = $row['id'];
                } else {
                    header('Location: ./index_resultats.php');
                    exit();
                }
            } else {
                echo "Oops ! erreur inattendu, rééssayez plus tard ou parlez en au dev du site qui a du faire de la merde";
            }
        }
    } else {
        header('Location: ./index_resultats.php');
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
    <link rel="stylesheet" href="../../css/admin_resultats.css">
    <script src="../../js/preview.js" defer></script>

<body>
    <?php include_once('../../php/includes/menu_admin.php') ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="mt-5">Mise à jour du résultat du match</h2>
                </div>
                <p>Changez les valeurs et validez</p>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="flex">
                        <?php if(empty($row['image'])) : ?>
                        <label for="file" class="logo"><span>?</span></label>
                        <?php else : ?>

                        <div class="preview" id="disapear">
                            <img src="../../<?php echo $row['image']; ?>" alt="" style="width: 70px; height: 70px">
                        </div>
                        <div class="preview">
                            <img src="" alt="" id="file-preview">
                        </div>
                        <?php endif; ?>
                        <label for="file" class="button">
                            Choisi l'image de l'équipe 1
                            <input type="file" id="file" name="img1" accept="image/equipe1/*" onchange="readURL(event);">
                        </label>
                    </div>
                    <p>
                        VS
                    </p>
                    <div class="flex">
                        <?php if(empty($row['image'])) : ?>

                        <label for="file2" class="logo"><span>?</span></label>
                        <?php else : ?>

                        <div class="preview" id="disapear2">
                            <img src="../../<?php echo $row['image2']; ?>" alt="" style="width: 70px; height: 70px">
                        </div>
                        <div>
                            <img src="" alt="" id="file2-preview">
                        </div>
                        <?php endif; ?>

                        <label for="file2" class="button">
                            Choisi l'image de l'équipe 2
                            <input type="file" id="file2" name="img2" accept="image/equipe2/*" onchange="readURL2(event);">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Equipes</label>
                        <input type="text" name="equ" class="form-controle <?php echo (!empty($equ_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $equ; ?>">
                        <span class="invalid-feedback"><?php echo $equ_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Résultat du Match</label>
                        <input type="text" name="res" class="form-controle <?php echo (!empty($res_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $res; ?>">
                        <span class="invalid-feedback"><?php echo $res_err; ?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" class="btn btn-primary" name="envoyer" value="Enregistrer">
                    <a href="./index_resultats.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>