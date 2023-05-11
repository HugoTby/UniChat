<?php
$bdd = new PDO('mysql:host=192.168.65.92;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX');

$recupMsg = $bdd->query("SELECT * FROM messages");
while ($message = $recupMsg->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="message">
            <h4><?php echo $message['pseudo']; ?></h4>
            <p><?php echo $message['message']; ?></p>
        </div>
    <?php
}

?>