<?php
session_start();

require './php/crud/protection.php';
require_once './php/crud/connexion_bdd.php';
// if (!empty($_POST['pseudo'])){
//     $pseudo=$_POST['pseudo'];
// }else{
//     $_SESSION['erreur'].='champ incorect';
//     header ('Location: ./inscription.php');
//     exit();
// }

$select = mysqli_query($conn, "SELECT * FROM users WHERE login = '".$_POST['pseudo']."'");

// var_dump(mysqli_num_rows($select));die;

if (!mysqli_num_rows($select)) {
    if (!isset($_POST['pseudo']) || !filter_var($_POST['pseudo'], FILTER_VALIDATE_EMAIL)){
        $_SESSION['erreur']=('Il faut un email valide pour soumettre le formulaire.');
        header ('Location: ./inscription.php');
        exit();
    }else {
        $pseudo=$_POST['pseudo'];
    }
} else {
    $_SESSION['erreur']=('Cet email existe déjà.');
    header ('Location: ./inscription.php');
    exit();
}


if (!empty($_POST['password'])){
    $password=$_POST['password'];
}else{
    $_SESSION['erreur']='Champ "Mot de passe" incorect';
    header ('Location: ./inscription.php');
    exit();
}



$login = protect_montexte($pseudo);
$password = protect_montexte($password);

$pass = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (login, mdp, role) VALUE (?,?,?)";

if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "sss", $param_login, $param_mdp, $param_role);

    $param_login = $login;
    $param_mdp = $pass;
    $param_role = "USER";

    if(mysqli_stmt_execute($stmt)){
        $_SESSION['login'] = "ok";
        $_SESSION['role'] = $row['role'];
        $valide = "ok";
        $_SESSION['erreur'] = '';
        
        header('Location: ./index.php');
        exit();
    }
}
?>