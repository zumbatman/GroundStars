<DOCTYPE html>
<?php 
require('functions.php');
$title = "Administration";
head($title);
topjumbotron($title);
navbar(5);
if (isset($_SESSION['role']) && $_SESSION['role'] == "Administrateur" || $_SESSION['role'] == "Modérateur"){
    echo ('
    <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
      <a class="nav-link" href="page02.php">Utilisateurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Groupes</a>
    </li>
  </ul>');
echo "<div class='Groupes'>"; 
echo "<h2 class='my-4 text-center'>Ajouter un groupe</h2>";
echo "<form class='ajax' action='ajouter_groupe.php'><br>
    <div class='form-row justify-content-center'>
        <div class='offset-1 col-2'>
            <input type='text' class='form-control' placeholder='groupe' name='groupe' required>
        </div>
        <div class='col-2'>
            <input type='submit' class='btn btn-primary' value='Ajouter'>
        </div>
    </div>
</form><br>";
echo "<div class='row'>";

    $groups = json_decode(file_get_contents("data/groups.json"), true);
    foreach($groups as $key => $value){
        echo ('
        <div class=col-md-4 p-3">
        <div class="card m-5" style="width: 24rem;">
                    <div class="card-header text-center">
                        <h3>'.$key.'</h3>
                        <a href="supprimer_groupe.php?name=').$key.('" class="ajaxbtn btn btn-sm btn-secondary material-icons">Supprimer</a>
                    </div>
                    <ul class="list-group list-group-flush">');
        foreach($value as $id){
        $utilisateurs = json_decode(file_get_contents("data/users.json"), true);
            foreach($utilisateurs as $utilisateurs){
                if ($utilisateurs['id'] == $id){
                    echo ('<li class="list-group-item">('.$utilisateurs['id'].') => '.$utilisateurs['mail'].'</li>');
                }
            }
        }
        echo  ('<form class="ajax" action="ajouter_utilisateur_groupe.php"><br>
        <div class="form-row justify-content-center">
            <div class="col-5 m-1">
                <input type="hidden" class="form-control" value="').$key.('"name="groupe">
                <input type="text" class="form-control" placeholder="id" name="id" required>
            </div>
            <div class="col-5 m-1">
                <input type="submit" class="btn btn-primary" value="Ajouter/Supprimer">
            </div>
        </div>
    </form>');
        echo "</ul></div></div>";
    }echo "</div></div>
    <script src='ajax.js'></script>
    ";
}
else {
    echo "Vous n'êtes pas administrateur.";
};
footer();
?>