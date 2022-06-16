<?php
$_GET['mail'] = htmlspecialchars($_GET['mail']);
$_GET['role'] = htmlspecialchars($_GET['role']);
$utilisateur = json_decode(file_get_contents("data/users.json"), true);
$idsList = array_column($utilisateur, 'id');
$auto_increment_id = max($idsList) + 1;
array_push($utilisateur, array(
    "mail" => $_GET['mail'],
    "motdepasse" => password_hash($_GET['motdepasse'], PASSWORD_DEFAULT),
    "cle" => rand(100000, 9000000),
    "id" => $auto_increment_id,
    "role" => $_GET['role'],
    "confirme" => 1,
));
file_put_contents("data/users.json", json_encode($utilisateur, JSON_PRETTY_PRINT));
//header("location: page02.php");
?>