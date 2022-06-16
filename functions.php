<?php

function get_group(){
    $id = $_SESSION['id'];
    $_SESSION['groupe'] = array();
    $groups = json_decode(file_get_contents("data/groups.json"), true);
    foreach($groups as $name => $value) {
    $check = $groups[$name];
    if (in_array($id, $check)) {
        if (!in_array($name, $_SESSION['groupe'])){
            $_SESSION['groupe'][] = $name;
        }
    }
    }
}

function print_group(){
    $length = count($_SESSION['groupe']);
        $i = 1;
        foreach ($_SESSION['groupe'] as $value => $name){
            if ($i == $length){
                echo $name;
                $i++;
            } else {
                echo $name.", ";
                $i++;
            }
        }
}


function session_checker(){
    $session = false;
    if(isset($_SESSION['mail'])){
        $session = true;
        get_group();
    }else{
        header('Location: connect.php');
    }
}
function head($title){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    echo ('<head>
	<title>'.$title.'</title>
	<link rel="icon" type="image/png" href="data/img/logo.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d91027752f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet">
    </head>
   ');
}
function topjumbotron($title){
    echo ('<body>
	<div class="jumbotron bg-dark text-white mb-0">
        <div class="row">
            <div class="col mt-3 text-center">
            ');
            if (isset($_SESSION['mail'])){
                echo ('<i class="mb-3 fa-3x fa-solid fa-user"></i><br>');
                echo $_SESSION['role'];
                echo "<br>";
                echo $_SESSION['mail'];
                echo "<br>";
                print_group();
                echo "<br><br>";
                echo '<a href="deconnexion.php" class="btn btn-outline-white btn-sm text-white">Se déconnecter</a>';
            }
            else {
                echo "Vous n'êtes pas connecté ";
                echo "<br><br>";
                echo '<a href="connect.php" class="btn btn-outline-white btn-sm text-white">Se connecter</a>';
            };
    echo ('
            </div>
            <div class="col-6">
                <br>
                <h1 class="text-center">GroundStars</h1>
                <h2 class="text-center">Intranet</h2>
            </div>
            <div class="col"></div>
        </div> ');
	echo ('</div>');
}
function navbar($page){

    $dark1 = "";
    $dark2 = "";
    $dark3 = "";
    $dark4 = "";
    $dark5 = "";


    switch ($page) {
        case 1:
            $dark1 ="text-white";
            break;
        case 2:
            $dark2 ="text-white";
            break;
        case 3:
            $dark3 ="text-white";
            break;
        case 4:
            $dark4 ="text-white";
            break;
        case 5:
            $dark5 ="text-white";
            break;
    }
    echo ('<nav class="navbar navbar-expand bg-dark justify-content-center">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link ').$dark1.(' " href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link ').$dark2.(' " href="page03.php">Annonces interne</a></li>
        <li class="nav-item"><a class="nav-link ').$dark3.(' " href="page04.php">Partage de fichiers</a></li>
        <li class="nav-item"><a class="nav-link ').$dark4.(' " href="page01.php">Chat</a></li>');

    if (isset($_SESSION['role'])){
        if($_SESSION['role'] == "Administrateur" || $_SESSION['role'] == "Modérateur"){
            echo ('<li class="nav-item"><a class="nav-link ').$dark5.(' " href="page02.php">Administration</a></li>');
        }
    }  
    echo '</ul></nav>';
}
function footer(){
    echo ('<div class="jumbotron bg-dark text-white text-center mb-0">
    <p>
        contact@groundstars.gs | 0299861782 | '.date('Y-m-d H:i').'
        <br>
        <br>
        ©'.date('Y').'
    </p>
</div>
</body>
</html>');
}

?>
