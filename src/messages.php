<style>
  .message span {
    display: flex;
    align-items: center;
  }

  .message h4 {
    margin-right: 5px;
  }
</style>

<?php
//$pdo = new PDO('mysql:host=192.168.65.92;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // VM 192.168.65.92 ONLY
$pdo = new PDO('mysql:host=192.168.1.26;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // VM 192.168.1.26 ONLY
//$pdo = new PDO('mysql:host=127.0.0.1;dbname=unichat', 'UniChatUser', 'r668yMm98FgRtX'); // WAMP or XXAMP ONLY
$bdd = $pdo;

$recupMsg = $bdd->query("SELECT * FROM messages");

while ($message = $recupMsg->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="message">
        <span>
            <h4><?php echo $message['pseudo']; ?></h4>
            <?php
            $recupBadge = $bdd->prepare("SELECT badge FROM users WHERE pseudo = :pseudo");
            $recupBadge->bindParam(':pseudo', $message['pseudo']);
            $recupBadge->execute();
            $badge = $recupBadge->fetchColumn();

            if (!empty($badge)): ?>
                <img src="<?php echo $badge; ?>" style="height: 15px; padding-top: 10px;" alt="">
            <?php endif; ?>
        </span>
        <p><?php echo $message['message']; ?></p>
    </div>
    <?php
}
?>
