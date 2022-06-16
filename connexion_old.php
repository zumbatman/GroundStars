<!DOCTYPE html>
<?php 
session_start();
require('functions.php');
require("PHPMailer/PHPMailerAutoload.php");
$title = "Intranet";
head($title);
topjumbotron($title);
navbar(1);
if (isset($_SESSION['prenom_nom'])){
    echo "Vous êtes déjà connecté";
}
else {
    if(isset($_POST['form_inscription'])){

            $mail = htmlspecialchars($_POST['mail']);
            $mail_v = htmlspecialchars($_POST['mail_v']);
            $pass = htmlspecialchars($_POST['pass']);
            $pass_v = htmlspecialchars($_POST['pass_v']);

        if (!empty($_POST['mail']) AND !empty($_POST['mail_v']) AND !empty($_POST['pass']) AND !empty($_POST['pass_v'])) {

            $passlength = strlen($pass = ($_POST['pass']));
            if ($passlength >= 10){
                if ($mail == $mail_v){
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                        if ($pass == $pass_v){
                            $utilisateur = json_decode(file_get_contents("data/users.json"), true);
                            $knownmail = false;
                            foreach($utilisateur as $key => $JSON){
                                if($JSON['mail'] == $mail){
                                    $erreur = "Vous avez déjà un compte";
                                    $knownmail = true;
                                    break;
                                }
                            }
                                if ($knownmail == false){
                                    $cle = rand(100000, 9000000);
                                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                                    $pass_v = password_hash($pass_v, PASSWORD_DEFAULT);

                                    $idsList = array_column($utilisateur, 'id');
                                    $auto_increment_id = max($idsList) + 1;
                                    array_push($utilisateur, array(
                                        "mail" => $mail,
                                        "motdepasse" => $pass,
                                        "id" => $auto_increment_id,
                                        "cle" => $cle,
                                        "role" => "Utilisateur",
                                    ));

                                    $_SESSION['id'] = $auto_increment_id;
                                
                                    function smtpmailer($to, $from, $from_name, $subject, $body)
                                        {
                                            $email = new PHPMailer();
                                            $email->IsSMTP();
                                            $email->SMTPAuth = true; 
                                    
                                            $email->SMTPSecure = 'starttls'; 
                                            $email->Host = 'partage.univ-rennes1.fr';
                                            $email->Port = 587;  
                                            $email->Username = 'mathurin.boedec@etudiant.univ-rennes1.fr';
                                            $email->Password = 'Vhfofrltq85p*';   
                                    
                                    //   $path = 'reseller.pdf';
                                    //   $mail->AddAttachment($path);
                                    
                                            $email->IsHTML(true);
                                            $email->From="mathurin.boedec@etudiant.univ-rennes1.fr";
                                            $email->FromName=$from_name;
                                            $email->Sender=$from;
                                            $email->AddReplyTo($from, $from_name);
                                            $email->Subject = $subject;
                                            $email->Body = $body;
                                            $email->AddAddress($to);
                                            if(!$email->Send())
                                            {
                                                $error ="Please try Later, Error Occured while Processing...";
                                                return $error; 
                                            }
                                            else 
                                            {
                                                $error = "Thanks You !! Your email is sent.";  
                                                return $error;
                                            }
                                        }
                                        
                                        $to   = $mail;
                                        $from = 'mathurin.boedec@etudiant.univ-rennes1.fr';
                                        $name = 'Mathurin';
                                        $subj = 'Email de confirmation de compte';
                                        $msg = 'http://tdphp/PHP/SAE23/intranet/verif.php?id='.$_SESSION['id'].'&cle='.$cle;
                                        
                                        $error=smtpmailer($to,$from, $name ,$subj, $msg);

                                    file_put_contents("data/users.json", json_encode($utilisateur, JSON_PRETTY_PRINT));
                                    echo "Vous allez recevoir un mail de confirmation !";
                                }
                        }
                        else {
                            $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                    }
                    else {
                        $erreur = "Votre adresse mail n'est pas valide !";
                    }
                }
                else {
                    $erreur = "Vos adresses mail ne correspondent pas !";
                }
            }
            else {
                $erreur ="Votre mot de passe est trop court, il doit être constitué d'au moins 10 caractères !";
            }
        }
        else {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }
    ?>
    
    <div class="container p-5 mb-0 text-center">
        <div class="row justify-content-center">

            <form name="form" action="connexion_traitement.php" class="text-center" method="post">
            <div class="col p-4">
            <h1 class="mb-3">Connexion</h1>
                <table>
                    <tr>
                        <td align="right">
                            <label for="mail"class="p-3">Prenom_Nom :</label>
                        </td>
                        <td>
                            <input class="form" type="text" id="mail" name="mail" placeholder="Jean_Dujardin" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="pass" class="p-3">Mot de passe :</label>
                        </td>
                        <td>
                            <input class="form" type="text" id="pass" name="pass" placeholder="OSS 117" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn p-2" type="submit" name="form_connection">
                        </td>
                        <td>
                            <input class="btn p-2" type="reset" value="Réinitialiser">
                        </td>
                    </tr>
                </table>
            </form>
            </div>

            <form name="form" action="" class="text-center" method="post">
            <div class="col p-4">
            <h1 class="mb-3">Inscription</h1>
                <table>
                    <tr>
                        <td align="right">
                            <label for="user"class="p-3">Mail GroundStars :</label>
                        </td>
                        <td>
                            <input class="form" type="email" id="mail" name="mail" value="<?php if(isset($mail)){echo $mail;} ?>" placeholder="prenom.nom@groundstars.gs" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="user_v"class="p-3">Confirmation Mail :</label>
                        </td>
                        <td>
                            <input class="form" type="email" id="mail_v" name="mail_v" value="<?php if(isset($mail_v)){echo $mail_v;} ?>" placeholder="Confirmez votre adresse mail" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="login" class="p-3">Mot de passe :</label>
                        </td>
                        <td>
                            <input class="form" type="password" id="pass" name="pass" placeholder="Votre mot de passe" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="login_v" class="p-3">Mot de passe :</label>
                        </td>
                        <td>
                            <input class="form" type="password" id="pass_v" name="pass_v" placeholder="Confirmez votre mot de passe"><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <input class="btn p-2" type="submit" value="Envoyer" name="form_inscription">
                        </td>
                        <td>
                            <input class="btn p-2" type="reset" value="Réinitialiser">
                        </td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
        <?php
        if(isset($erreur)){
                    echo '<font color="red">'.$erreur."</font>";
                }
        ?>
    </div>

<?php }
footer();
?>
