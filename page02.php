<!DOCTYPE html>
<?php 
require('functions.php');
$title = "Administration";
head($title);
session_checker();
topjumbotron($title);
navbar(5);
if (isset($_SESSION['role']) && $_SESSION['role'] == "Administrateur" || $_SESSION['role'] == "Modérateur"){
    echo ('
    <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
      <a class="nav-link active" href="#">Utilisateurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="a" href="admin_vue2.php">Groupes</a>
    </li>
  </ul>');
    echo "<div id=wrap>";
    echo "<div class='Utilisateurs' id='1'>";
    echo "<h2 class='my-4 text-center'>Ajouter un utilisateur</h2>
    <form action='ajouter_utilisateur.php' class='ajax'><br>
        <div class='form-row justify-content-center'>
            <div class='offset-1 col-2'>
                <input type='text' class='form-control' placeholder='mail' name='mail' required>
            </div>
            <div class='col-2'>
                <input type='text' class='form-control' placeholder='motdepasse' name='motdepasse' required>
            </div>
            <div class='col-2'>
            <select class ='form-control' name='role' id='role' type='text'>
            <option value='Utilisateur'>Utilisateur</option>
            <option value='Modérateur'>Modérateur</option>
            <option value='Administrateur'>Administrateur</option>
            </select>
            </div>
            <div class='col-2'>
                <input type='submit' class='btn btn-primary' value='Ajouter'>
            </div>
        </div>
    </form>";
    echo ('<div class="container-fluid mt-5 pb-5 text-dark">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mail</th>
                            <th>motdepasse</th>
                            <th>ID</th>
                            <th>cle</th>
                            <th>Rôle</th>
                            <th>Confirme</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>');

    $utilisateurs = json_decode(file_get_contents("data/users.json"), true);
    foreach ($utilisateurs as $utilisateurs) {
        echo ('<tr>
                    <th scope="row">'.$utilisateurs['mail'].'</th>');/*
        foreach($utilisateurs['groupe'] as $groupe) {
                        echo ''.$groupe.'<br>';
                    }*/
        echo ('</td>
                    <td>'.$utilisateurs['motdepasse'].'</td>
                    <td>'.$utilisateurs['id'].'</td>
                    <td>'.$utilisateurs['cle'].'</td>
                    <td>'.$utilisateurs['role'].'</td>
                    <td class="text-center">');
                    if($utilisateurs['confirme']==1){
                        echo ('<i class="fa-solid fa-circle-check"></i>');
                    }else {
                        echo ('<i class="fa-solid fa-circle-xmark"></i>');
                    }
                    echo ('</td>
                    <td><a  href="supprimer_utilisateur.php?id=').$utilisateurs['id'].('" class="ajaxbtn btn btn-sm btn-secondary material-icons">Au revoir</a></td>
                </tr>');
    }
    echo ('</tbody></table></div></div>
    <script src="ajax.js"></script>
');
}
else {
    echo "Vous ne disposez pas des droits suffisant pour accéder à l'Administration.";
};
footer();
?>