<?php
include("../black_list.php");
include("../classes/User.php");

// Récupérer l'adresse IP de l'utilisateur
$ip = $_SERVER['REMOTE_ADDR'];


session_start();

//$pdo = new PDO('mysql:host=192.168.65.92;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // VM 192.168.65.92 ONLY
$pdo = new PDO('mysql:host=192.168.1.26;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // VM 192.168.1.26 ONLY
//$pdo = new PDO('mysql:host=127.0.0.1;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // WAMP or XXAMP ONLY
$User1 = new user(null, null, null);
$id = $_SESSION['id'];
$User1->getUserById($id);


//// & Requetes ////

//~ Préparation et exécution de la requête SQL
$header = "SELECT * FROM header";
$header_request = $pdo->query($header);
//~ Récupération des résultats
$header_result = $header_request->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["deco"])) {
    session_unset();
    session_destroy();
    header("Location: ../login/connexion.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>UniChat - Version 1.7.4+20230507.1452 [DESKTOP]</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script defer src="../js/topbar.js"></script>
    <link rel="stylesheet" href="../css/topbar.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/log-out.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/info.css' rel='stylesheet'>
    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        var clickCount = 0;
        var lastClickTime = 0;

        function handleClick2() {
            var currentTime = new Date().getTime();

            if (clickCount === 0 || (currentTime - lastClickTime <= 10000)) {
                clickCount++;
                lastClickTime = currentTime;

                if (clickCount === 1) {
                    window.location.href = "../index.php"; // Remplacez cette URL par votre URL de destination
                }
            } else {
                clickCount = 0;
                lastClickTime = 0;
            }
        }
    </script>
</head>
<div class="mainApp">
    <div class="topBar" style="background-color: rgba(255, 0, 0, 0.4);">
        <div class="titleBar">
            <button id="showHideMenus" class="toggleButton" onclick="handleClick2()"></button>
            <a href="https://github.com/HugoTby/UniChat/releases/tag/v1.0.0" target="_blank"><img style="padding-left:15px;height: 35px;" src="../icons/icon_top_bar.png" alt="GitHub"></a>
            <a href="https://la-providence.net" target="_blank"><img style="padding-left:15px;padding-right:15px;height: 35px;" src="../icons/icon_top_bar2.png" alt="La Providence"></a>
            <div class="title">

                <?php
                foreach ($header_result as $row) {
                ?>
                    <span style="font-size: 20px;">UniChat</span>&nbsp;&nbsp;
                    <span style="font-size: 11px;">Version <strong><?php echo $row['version'] ?></strong></span>&nbsp;&nbsp;
                    <span style="font-size: 11px;">Auteur : <u><?php echo $row['auteur'] ?></u> - BTS SN1 2022-2023 &copy;</span>
                    <span style="padding-left: 30px;">** MODE ADMINISTRATEUR **</span>
                <?php } ?>

            </div>
        </div>
        <div class="titleBarBtns">
            <button id="minimizeBtn" class="topBtn minimizeBtn" title="Minimize"></button>
            <button id="maximizeBtn" class="topBtn maximizeBtn" title="Maximize"></button>
            <button id="closeBtn" class="topBtn closeBtn" title="Close"></button>
        </div>
    </div>
    <div class="contentArea">
        <!--<div id="mySidebar" class="leftMenu">
            <div class="deco" style="padding-left: 20px;padding-top:25px" >
                <form method="post">
                    <input type="submit" name="deco" id="deco" style="display:none">
                    <label for="deco"><i class="gg-log-out" style="color:red;cursor:pointer;"></i></label>
                </form>
            </div>
        </div>-->
        <div class="contentPages">
            <?php
            if ($User1->confirmAdmin()) {
                // La fonction a renvoyé true, effectuer l'action souhaitée

            ?>
                
                
            <?php
            } else {
                // La fonction a renvoyé false, faire autre chose
            ?><style>
                    .center {
                        text-align: center;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 90vh;
                        overflow-y: hidden;
                    }

                    .error {
                        background: rgba(255, 0, 0, 0.4);
                        padding: 10px;
                        border-radius: 5px;
                        text-align: center;
                    }
                </style>
                <div class='center'>
                    <div class='error'>
                        Désolé, le serveur d'UniChat à renvoyé l'erreur <strong>**Accès refusé**</strong> à la ressource voulue<br><br>
                        Votre identifiant est <strong><?php $User1->getPseudo(); ?></strong> et il correspond à : &nbsp; <strong><mark style='border-radius:2px;padding:2px'>Utilisateur UniChat</mark></strong><br><br>
                        Vous n'avez pas la permission d'accéder à la section dédiée à l'administration de l'application.
                    </div>
                </div><?php
                    }

                        ?>
        </div>
    </div>




    <script>
        setTimeout(() => {
            console.log("%c Attends ! ", "color:#fff; background-color: rgb(25,25,50); padding:24px;font-weight:bold;font-size:5em; border-radius:5px");
            console.log("%c Si quelqu'un t'a dit de copier/coller quelque chose ici, il y a à peu près 11 chances sur 10 que ce soit une arnaque. ", "color:#fff;font-weight:bold;font-size:1.5em; ");
            console.log("%c Coller quelque chose ici pourrait donner aux assaillants accès à ton compte UniChat. ", "color:red;font-weight:bold;font-size:1.5em; ");
        }, 5000);
    </script>
    </body>

</html>