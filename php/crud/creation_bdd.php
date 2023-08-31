<?php

$host="localhost";
$user="root";
$pass="";

$conn = mysqli_connect($host,$user,$pass);


//création bdd
$sql = "CREATE DATABASE IF NOT EXISTS footactu";

if (mysqli_query($conn,$sql)){
    echo "La BDD à été créée";
}else {
    echo "Création KO";
}
echo '<hr>';

mysqli_close($conn);
?>