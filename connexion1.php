<!DOCTYPE html>
<?php 
session_start();
require('functions.php');
require("PHPMailer/PHPMailerAutoload.php");
$title = "Intranet";
head($title);
topjumbotron($title);
navbar(0);
if (isset($_SESSION['mail'])){
    echo "Vous êtes déjà connecté";
}
else {
    $knownUser = false;
    $knownMail = false;
    $erreur = null;

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    function auth($jsonTable,$mail,$password) {
        foreach ($jsonTable as $value) {
            if ($value['mail'] == $mail) {
                $knownMail = true;
                if (password_verify($password, $value['motdepasse'])){
                    if ($value['confirme'] == 1){
                        $_SESSION['mail'] = $mail;
                        $_SESSION['motdepasse'] = $password;
                        $_SESSION['id'] = $value['id'];
                        $_SESSION['role'] = $value['role'];
                        $_SESSION['groupe'] = array();
                        $knownUser = true;
                        header('location: index.php');
                        break;
                    }
                    else {
                        $erreur = "Votre adresse mail n'est pas vérifié";
                    }
                }else {
                    $erreur = "mot de passe incorrect.";
                }
            }        
        }
    }
    if (isset($_POST['form_connection'])){
        $mail = $_POST['mail'];
        $password = $_POST['pass'];
        $file = file_get_contents("data/users.json");
        $tab = json_decode($file,true);
        auth($tab,$mail,$password);
    }?>
    <div class="container p-5 mb-0 text-center">
        <div class="row justify-content-center">

            <form name="form" action="" class="text-center" method="post">
            <div class="col p-4">
            <h1 class="mb-3">Connexion</h1>
                <table>
                    <tr>
                        <td align="right">
                            <label for="mail"class="p-3">Prenom_Nom :</label>
                        </td>
                        <td>
                            <input class="form" type="text" id="mail" name="mail" placeholder="Jean_Dujardin" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="pass" class="p-3">Mot de passe :</label>
                        </td>
                        <td>
                            <input class="form" type="text" id="pass" name="pass" placeholder="OSS 117" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn p-2" type="submit" name="form_connection">
                        </td>
                        <td>
                            <input class="btn p-2" type="reset" value="Réinitialiser">
                        </td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
    </div>
    <?php
    if ($erreur) {
        echo '<div class="alert alert-danger"';
        echo $erreur;
        echo '</div></div>';
    }
}
footer();
?>
