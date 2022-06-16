<!DOCTYPE html>
<?php
$_GET['groupe'] = htmlspecialchars($_GET['groupe']);
$groupe = json_decode(file_get_contents("data/groups.json"), true);
$name = $_GET['groupe'];
$groupe[$name] = [];
file_put_contents("data/groups.json", json_encode($groupe, JSON_PRETTY_PRINT));
header("location: admin_vue2.php");
?>