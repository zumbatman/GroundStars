<?php
session_start();
if(isset($_GET['id']) AND !empty($_GET['id']) AND isset($_GET['cle']) AND !empty($_GET['cle'])){

    $utilisateur = json_decode(file_get_contents("data/users.json"), true);
    $getid = $_GET['id'];
    $getcle = $_GET['cle'];
    foreach($utilisateur as $key => $JSON) {
        if($JSON['id'] == $_GET['id'] && $JSON['cle'] == $_GET['cle']) {
                    unset($utilisateur[$key]);
                    array_push($utilisateur, array(
                    "mail" => $JSON['mail'],
                    "motdepasse" => $JSON['motdepasse'],
                    "cle" => $JSON['cle'],
                    "id" => $JSON['id'],
                    "role" => "Utilisateur",
                    "confirme" => 1,
                ));
                file_put_contents("data/users.json", json_encode($utilisateur, JSON_PRETTY_PRINT));
                echo "Votre email est maintenant confirmé";
        }else{
            header('Location: index.php');
        }
    }
}
else {
    echo "Aucun utilisateur trouvé !";
}
?>