<?php
session_start();

if(isset($_SESSION['role'])){
    $role=$_SESSION['role'];
    if($role!='ADMIN') header('Location: ../../../index.php');
}else{
    $role='';
    if($role!='ADMIN') header('Location: ../../../index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        .center{
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <?php include_once('../../../php/includes/menu_admin.php') ?>
    <h1>Calendrier</h1>

    <h2>Tableau des dates inscrites dans le Calendrier</h2>

    <div class="center">
        <button onclick="location.href='./create_calendrier.php'" class="btn btn-outline-secondary">Ajouter une date dans le Calendrier</button>
    </div><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        require '../../../php/crud/connexion_bdd.php';

                        $sql = "SELECT * FROM calendrier";

                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result)>0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>ID</th>';
                                            echo '<th>Equipes</th>';
                                            echo '<th>Date</th>';
                                            echo '<th>Couleur</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row = mysqli_fetch_array($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['equipes'] . '</td>';
                                            echo '<td>' . $row['moment'] . '</td>';
                                            echo '<td>' . $row['color'] . '</td>';
                                            echo '<td>';
                                            echo '<a href="./update_calendrier.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span></a>';
                                            echo '<a href="./delete_calendrier.php?id='.$row['id'].'" class="mr-3" title="delete" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            }else{
                                echo '<div class="alert alert-danger"><em>Aucune date trouvé.</em></div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger"><em>Aucune date trouvé help me.</em></div>';
                        }
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>