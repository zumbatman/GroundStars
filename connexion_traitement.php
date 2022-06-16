<?php 
session_start();
$mail = $_POST['mail'];
$password = $_POST['pass'];
$file = file_get_contents("data/users.json");
$tab = json_decode($file,true);
auth($tab,$mail,$password);

function auth($jsonTable,$mail,$password) {
    $knownUser = false;
    foreach ($jsonTable as $value) {
        if ($value['mail'] == $mail) {
            if (password_verify($password, $value['motdepasse'])){
                if ($value['confirme'] == 1){
                    $_SESSION['mail'] = $mail;
                    $_SESSION['motdepasse'] = $password;
                    $_SESSION['id'] = $value['id'];
                    $_SESSION['role'] = $value['role'];
                    $_SESSION['groupe'] = array();
                    $knownUser = true;
                    break;
                }
                else {
                    echo "Votre adresse mail n'est pas vérifié";
                }
            } else {
                echo "mot de passe incorrect.";
            }
        }
    }
    if ($knownUser) {
        header('Location: index.php');
    }
}
?>
