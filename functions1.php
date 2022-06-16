<?php

function head($title){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    echo ('<head>
	<title>'.$title.'</title>
	<link rel="icon" type="image/png" href="data/img/logo.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet">
    </head>
    <style>
    :root {
        --shadow-color: #FF9E9E;
        --shadow-color-light: white;
      }
      
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      
      .jumbotron {
        font-family: "Archivo", sans-serif;
        background-color: #192824;
      }
      
      .logo-1 {
        margin: calc(50vh - 40px) auto 0 auto;
        font-size: 65px;
        text-transform: uppercase;
        font-family: "Archivo Black", "Archivo", sans-serif;
        font-weight: normal;
        display: block;
        height: auto;
        text-align: center;
      }
      
      .logo-1 {
        color: white;
        animation: neon 3s infinite;
      }
      
      @keyframes neon {
        0% {
          text-shadow: -1px -1px 1px var(--shadow-color-light), -1px 1px 1px var(--shadow-color-light), 1px -1px 1px var(--shadow-color-light), 1px 1px 1px var(--shadow-color-light),
          0 0 3px var(--shadow-color-light), 0 0 10px var(--shadow-color-light), 0 0 20px var(--shadow-color-light),
          0 0 30px var(--shadow-color), 0 0 40px var(--shadow-color), 0 0 50px var(--shadow-color), 0 0 70px var(--shadow-color), 0 0 100px var(--shadow-color), 0 0 200px var(--shadow-color);
        }
        50% {
          text-shadow: -1px -1px 1px var(--shadow-color-light), -1px 1px 1px var(--shadow-color-light), 1px -1px 1px var(--shadow-color-light), 1px 1px 1px var(--shadow-color-light),
          0 0 5px var(--shadow-color-light), 0 0 15px var(--shadow-color-light), 0 0 25px var(--shadow-color-light),
          0 0 40px var(--shadow-color), 0 0 50px var(--shadow-color), 0 0 60px var(--shadow-color), 0 0 80px var(--shadow-color), 0 0 110px var(--shadow-color), 0 0 210px var(--shadow-color);
        }
        100% {
          text-shadow: -1px -1px 1px var(--shadow-color-light), -1px 1px 1px var(--shadow-color-light), 1px -1px 1px var(--shadow-color-light), 1px 1px 1px var(--shadow-color-light),
          0 0 3px var(--shadow-color-light), 0 0 10px var(--shadow-color-light), 0 0 20px var(--shadow-color-light),
          0 0 30px var(--shadow-color), 0 0 40px var(--shadow-color), 0 0 50px var(--shadow-color), 0 0 70px var(--shadow-color), 0 0 100px var(--shadow-color), 0 0 200px var(--shadow-color);
        }
      }</style>');
}
function topjumbotron($title){
    echo ('<body>
	<div class="jumbotron bg-dark text-white mb-0">
                <p class="logo-1">GroundStars</p>
                <h2 class="text-center">Intranet</h2>
			');
            if (isset($_SESSION['prenom_nom'])){
                echo "Bonjour ".$_SESSION['prenom_nom']."    ";
                echo "<br><br>";
                echo '<a href="deconnexion.php" class="btn btn-outline-white btn-sm text-white">Se déconnecter</a>';
            }
            else {
                echo "Vous n'êtes pas connecté ";
                echo "<br><br>";
                echo '<a href="connexion.php" class="btn btn-outline-white btn-sm text-white">Se connecter</a>';
            };
	echo ('
	</div>');
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

    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"){ 
        echo ('<li class="nav-item"><a class="nav-link ').$dark5.(' " href="page02.php">Administration</a></li>');
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
