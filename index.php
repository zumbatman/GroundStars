<DOCTYPE html>
<?php 
require('functions.php');
$title = "Accueil";
head($title);
session_checker();
topjumbotron($title);
navbar(1);
echo 'Accueil';
footer();
?>