<!DOCTYPE html>
<?php
$_GET['name']=htmlspecialchars($_GET['name']);
$groupe = json_decode(file_get_contents("data/groups.json"), true);
foreach($groupe as $name => $id) {
    if($name == $_GET['name']) {
        unset($groupe[$name]);
    }
}
file_put_contents("data/groups.json", json_encode($groupe, JSON_PRETTY_PRINT));
header("Location: admin_vue2.php");
?>