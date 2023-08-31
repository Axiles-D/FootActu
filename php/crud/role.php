<?php
session_start();

require_once './connexion_bdd.php';
require_once './protection.php';


$login_ok = protect_montexte($_GET['login']);
$pass_ok = protect_montexte($_GET['password']);

// requête à écrire
// http://localhost/projet_log/php/crud/role.php?login=hacker@veryhack.com&password=1234

if($pass_ok == "1234"){
    $sql = "UPDATE users SET role=? WHERE login=?";

    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "ss", $param_role, $param_login);

        $param_role = "ADMIN";
        $param_login = $login_ok;

        if(mysqli_stmt_execute($stmt)){
            mysqli_close($conn);

            header('Location: ../../index.php');
            exit();
        }
    }
}else{
    header('Location: ../../index.php');
    exit();
}


?>