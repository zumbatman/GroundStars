<DOCTYPE html>
<?php 
require('functions.php');
$title = "Annonces internes";
head($title);
session_checker();
topjumbotron($title);
navbar(2);
echo 'Annonces internes';
print_r($_SESSION['groupe']);
Print_r ($_SESSION);
footer();
?>