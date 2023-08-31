<?php
include('./php/crud/connexion_bdd.php');

if(isset($_POST['upload'])){
    $NAME = $_POST['name'];
    $RESULT = $_POST['result'];
    $IMAGE = $_FILES['image'];
    $IMAGE2 = $_FILES['image2'];

    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up = "image/equipe1/" . $image_name;

    $image2_location = $_FILES['image2']['tmp_name'];
    $image2_name = $_FILES['image2']['name'];
    $image2_up = "image/equipe2/" . $image2_name;

    $insert = "INSERT INTO matchs (name, result, image, image2) VALUES ('$NAME', '$RESULT', '$image_up', '$image2_up')";
    mysqli_query($conn, $insert);

    if (move_uploaded_file($image_location, './image/equipe1/' . $image_name) && move_uploaded_file($image2_location, './image/equipe2/' . $image2_name)){
        echo "<script>alert('done!!!')</script>";
        header ('Location: ./resultats.php');
        exit();
    } else {
        echo "<script>alert('Error while moving images')</script>";
    }

}
?>
