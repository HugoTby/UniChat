<?php include("../classes/User.php");


session_start();

//$pdo = new PDO('mysql:host=192.168.65.92;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // VM 192.168.65.92 ONLY
$pdo = new PDO('mysql:host=192.168.1.26;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // VM 192.168.1.26 ONLY
//$pdo = new PDO('mysql:host=127.0.0.1;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // WAMP or XXAMP ONLY
$User1 = new user(null, null, null);

//// & Requetes ////

//~ Préparation et exécution de la requête SQL
$header = "SELECT * FROM header";
$header_request = $pdo->query($header);
//~ Récupération des résultats
$header_result = $header_request->fetchAll(PDO::FETCH_ASSOC);

$erreur = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>UniChat - Version 1.7.4+20230507.1452 [DESKTOP]</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script defer src="../js/topbar.js"></script>
    <link rel="stylesheet" href="../css/topbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/info.css' rel='stylesheet'>
    <script src='https://meet.jit.si/external_api.js'></script>
</head>
<div class="mainApp">
    <div class="topBar">
        <div class="titleBar">

            <a onclick="openExternalLink('https://github.com/HugoTby/UniChat/releases/tag/v1.0.0')"><img style="padding-left:15px;height: 35px;" src="../icons/icon_top_bar.png" alt="GitHub"></a>
            <a onclick="openExternalLink('https://la-providence.net')"><img style="padding-left:15px;padding-right:15px;height: 35px;" src="../icons/icon_top_bar2.png" alt="La Providence"></a>
            <div class="title">

                <?php
                foreach ($header_result as $row) {
                ?>
                    <span style="font-size: 20px;">UniChat</span>&nbsp;&nbsp;
                    <span style="font-size: 11px;">Version <strong><?php echo $row['version'] ?></strong></span>&nbsp;&nbsp;
                    <span style="font-size: 11px;">Auteur : <u><?php echo $row['auteur'] ?></u> - BTS SN1 2022-2023 &copy;</span>
                    <span style="padding-left: 30px;">Statut du serveur : &nbsp;<?php echo $row['statut2'] ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="titleBarBtns">
            <button id="minimizeBtn" class="topBtn minimizeBtn" title="Minimize"></button>
            <button id="maximizeBtn" class="topBtn maximizeBtn" title="Maximize"></button>
            <button id="closeBtn" class="topBtn closeBtn" title="Close"></button>
        </div>
    </div>



    <?php

    if (isset($_POST['envoyer'])) {
        $login = $_POST['login'];

        // Inclure le fichier contenant la liste des utilisateurs non autorisés
        include 'unauthorizedUsersList.php';

        // Vérifier si le login fait partie de la liste des utilisateurs non autorisés
        if (in_array($login, $unauthorizedUsersList)) {
            $erreur = 1; // Initialiser la variable d'erreur à 1
        } else {
            // Si le login n'est pas dans la liste des utilisateurs non autorisés, poursuivre le processus d'inscription
            $motDePasse = $_POST['password'];
            $motDePasseCrypte = hash('sha256', $motDePasse);
            //$motDePasseCrypte = password_hash($motDePasse, PASSWORD_DEFAULT);
            $User1->CreateNewUser($login, $motDePasseCrypte,  $_POST['mail']);

            $User1->seConnecter($login, $_POST["password"]);

            header('Location: ../index.php');
        }
    }




    ?>






    <div class="contentArea">
        <div class="contentPages">


            <form class="login-form" action="" method="post">
                <div class="input-floating-label">
                    <input class="input" type="text" id="input" name="mail" placeholder="Adresse-mail">
                    <label for="input">Adresse-mail</label>
                    <span class="focus-bg"></span>
                </div>
                <div class="input-floating-label">
                    <input class="input" type="text" id="input" name="login" placeholder="username" maxlength="15">
                    <label for="input">Nom d'utilisateur</label>
                    <span class="focus-bg"></span>
                </div>
                <div class="input-floating-label">
                    <input class="input" type="password" id="input" name="password" placeholder="password">
                    <label for="input">Mot de passe</label>
                    <span class="focus-bg"></span>
                </div>
                <!--<button id="submit" class="btn-submit">Login</button>-->
                <input class="btn-submit" type="submit" name="envoyer" value="S'inscrire">
                <a href="connexion.php" style="padding-left:10px;font-family: sans-serif;text-decoration: none;color:#26d9ac;">Vous avez déjà un compte?&nbsp;Se connecter</a><br><br>
                <?php

                if ($erreur === 1) {
                    // Message d'erreur si le mdp ou login incorrets
                    echo "  <div style='display:flex; align-items:center; justify-content:center;'>
                    <i class='gg-info' style='margin-right:5px; color:#fff;background-color:red'></i>
                    <span style='color:#fff;background-color:red;border-radius:4px;padding:5px;font-size:12px'>
                        UniChat ne permet pas l'utilisation d'un pseudo inapproprié.
                    </span>
                </div>";
                }
                ?>
            </form>

        </div>
    </div>


    <script>
        document.getElementById("submit").addEventListener("click", function(event) {
            event.preventDefault()
        });
    </script>

    <script>
        setTimeout(() => {
            console.log("%c Attends ! ", "color:#fff; background-color: rgb(25,25,50); padding:24px;font-weight:bold;font-size:5em; border-radius:5px");
            console.log("%c Si quelqu'un t'a dit de copier/coller quelque chose ici, il y a à peu près 11 chances sur 10 que ce soit une arnaque. ", "color:#fff;font-weight:bold;font-size:1.5em; ");
            console.log("%c Coller quelque chose ici pourrait donner aux assaillants accès à ton compte UniChat. ", "color:red;font-weight:bold;font-size:1.5em; ");
        }, 5000);
    </script>
    <script>
        const {
            shell
        } = require('electron');

        function openExternalLink(url) {
            shell.openExternal(url);
        }
    </script>
    </body>

</html>