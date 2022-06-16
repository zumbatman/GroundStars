<!DOCTYPE html>
<?php 
session_start();
require('functions.php');
$title = "Intranet";
head($title);
topjumbotron($title);
navbar(0);
?>
<div class="text-center mt-5">
    <h1 class="mb-5">Accéder à l'intranet</h1>
    <div class="mb-5">
        <a href="connexion1.php">
            <button class = "btn btn-primary r-4">Connexion</button>
        </a>
        <a href="inscription.php">
            <button class = "btn btn-primary l-4">Inscription</button>
        </a>
    </div>
</div>
<?php
footer();
?>
