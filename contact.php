<?php
require_once "./php/crud/connexion_bdd.php";

$nom = $pre = $mail = $tel = $mess = "";
$nom_err = $pre_err = $mail_err = $tel_err = $err_mess = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nom = trim($_POST["nom"]);
    if (empty($input_nom)) {
        $nom_err = "entrer un nom";
    } else {
        $nom = $input_nom;
    }

    $input_pre = trim($_POST["pre"]);
    if (empty($input_pre)) {
        $pre_err = "entrer un prénom";
    } else {
        $pre = $input_pre;
    }

    $input_mail = trim($_POST["mail"]);
    if (empty($input_mail)) {
        $mail_err = "entrer un mail";
    } else {
        $mail = $input_mail;
    }

    $input_tel = trim($_POST["tel"]);
    if (empty($input_tel)) {
        $tel_err = "entrer un tel";
    } else {
        $tel = $input_tel;
    }

    $input_mess = trim($_POST["mess"]);
    if (empty($input_mess)) {
        $mess_err = "entrer un message";
    } else {
        $mess = $input_mess;
    }

    if (empty($nom_err) && empty($pre_err) && empty($mail_err) && empty($tel_err) && empty($mess_err)) {

        $param_nom = $nom;
        $param_pre = $pre;
        $param_mail = $mail;
        $param_tel = $tel;
        $param_mess = $mess;

        $sql = "INSERT INTO contact (Nom, Prenom, Mail, Tel, Message) VALUES ('$param_nom', '$param_pre', '$param_mail', '$param_tel', '$param_mess')";

        $result = mysqli_query($conn, $sql);


        if ($result) {
            //envoie mail
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            $from = $mail;
            $to = 'destinataire@domaine.com';
            $subject = 'Essai de PHP Mail';
            $message = $mess;
            $header = "De :" . $from;
            mail($to, $subject, $message, $header);
            //fin mail

            mysqli_close($conn);
            header("location: ./index.php");
            exit();
        } else {
            echo "Oops! erreur inattendu, rééssayez ultérieurement";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="./css/contact.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <?php include_once('./php/includes/menu.php') ?>

    <h1>Contactez-nous</h1>

    <div class="center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="contact">
            <div class="espace">
                <div class="column">
                    <label for="nom">Nom</label>
                    <label for="pre">Prénom</label>
                    <label for="mail">Mail</label>
                    <label for="tel">Téléphone</label>
                    <label for="mess">Message</label>

                </div>
                <div class="column">
                    <input type="text" name="nom" id="nom" placeholder="Dupont">
                    <input type="text" name="pre" id="pre" placeholder="Dupont">
                    <input type="text" name="mail" id="mail" placeholder="abcdef@domaine.com">
                    <input type="text" name="tel" id="tel" placeholder="0699999999">
                    <textarea name="mess" id="mess" cols="50" rows="5" placeholder="Bla Bla..."></textarea>
                </div>
            </div>
            <div class="center top">
                <input type="submit" name="submit" value="Enregistrer">
                <a href="./index.php">Annuler</a>
            </div>

        </form>
    </div>

    <footer>
        <?php include_once('./php/includes/footer.php') ?>
    </footer>
</body>

</html>