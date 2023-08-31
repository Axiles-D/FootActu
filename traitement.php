<?php 
session_start();

$_SESSION['erreur'] = '';
$_SESSION['login'] = '';
$_SESSION['role'] = '';
$_SESSION['client'] = '';

require_once './php/crud/protection.php';

$erreur = '';


if(!empty($_POST['login'])){
    $login = $_POST['login'];
}else{
    $_SESSION['erreur'] = "Champ login vide";
    header('Location: ./login.php');
    exit();
}

if(!empty($_POST['password'])){
    $password = $_POST['password'];
}else{
    $_SESSION['erreur'] = "Champ Mot de passe vide";
    header('Location: ./login.php');
    exit();
}

require_once "./php/crud/connexion_bdd.php";

$login_ok = protect_montexte($login);
$password_ok = protect_montexte($password);

$sql = "SELECT * FROM users";


if ($result = mysqli_query($conn, $sql)){
    if (mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
            if(($login_ok == $row['login']) && (password_verify($password_ok, $row['mdp']))){
                $_SESSION['login'] = "ok";
                $_SESSION['role'] = $row['role'];
                $_SESSION['client'] = $row['login'];
                $valide = "ok";
                $_SESSION['erreur'] = '';
                header('Location: ./index.php');
            }
        }
        if($valide != "ok"){
            $_SESSION['erreur'] = "Login ou mot de passe incorrect !";
            header('Location: ./login.php');
            exit();
        }
    }
}

?>