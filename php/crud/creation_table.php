<?php

require_once("./connexion_bdd.php");

$sql = "CREATE TABLE IF NOT EXISTS users(
    id int(6) unsigned auto_increment primary key,
    login varchar(50) NOT NULL,
    mdp varchar(150) NOT NULL,
    role varchar(15) NOT NULL,
    token_reset varchar(150) NULL,)";

if (!mysqli_query($conn,$sql)){
    echo "Erreur de création table users<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS contact(
    id int(6) unsigned auto_increment primary key,
    Nom varchar(20) NULL,
    Prenom varchar(20)  NULL,
    Mail varchar(50) NOT NULL,
    Tel varchar(10)  NULL,
    Message text NOT NULL)";

if (!mysqli_query($conn,$sql)){
    echo "Erreur de création table Contact<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS calendrier(
    id int(6) unsigned auto_increment PRIMARY KEY,
    equipes varchar(50) NOT NULL,
    moment DATE NOT NULL,
    color varchar(20) NOT NULL)";

if (!mysqli_query($conn,$sql)){
    echo "Erreur de création table Calendrier<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS matchs(
    id int(6) unsigned auto_increment PRIMARY KEY,
    name varchar(50) NOT NULL,
    result varchar(10) NOT NULL,
    image varchar(50) NOT NULL,
    image2 varchar(50) NOT NULL)";

if (!mysqli_query($conn,$sql)){
    echo "Erreur de création table matchs<br>";
}

mysqli_close($conn);
?>