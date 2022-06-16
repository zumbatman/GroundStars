<!DOCTYPE html>
<?php
$utilisateur = json_decode(file_get_contents("data/users.json"), true);
foreach($utilisateur as $key => $id) {
    if($id['id'] == $_GET['id']) {
        unset($utilisateur[$key]);
    }
}
file_put_contents("data/users.json", json_encode($utilisateur, JSON_PRETTY_PRINT));
header("Location: page02.php");
?>