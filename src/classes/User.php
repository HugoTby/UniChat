<?php
class user
{
    private $id_;
    private $mail_;
    private $login_;
    private $token_;
    private $admin_;




    public function __construct($id, $mail, $login)
    {
        $this->id_ = $id;
        $this->mail_ = $mail;
        $this->login_ = $login;
    }

    public function seConnecter($login, $pass)
    {

        $newpass = hash('sha256', $pass);
        //$newpass = password_verify($pass, PASSWORD_DEFAULT);
        $requete = "SELECT * FROM `users` 
        WHERE
        `pseudo` = '" . $login . "'
        AND
        `password` = '" . $newpass . "' ;";

        $result = $GLOBALS["pdo"]->query($requete);
        if ($result->rowCount() > 0) {
            $tab = $result->fetch();
            $_SESSION['Connexion'] = true;
            $_SESSION['id'] = $tab['id'];

            $this->id_ = $tab['id'];
            $this->mail_ = $tab['mail'];
            $this->login_ = $tab['pseudo'];

            return true;
        } else {
            return false;
        }
    }

    public function CreateNewUser($login1, $pass1, $mail1)
    {
        $requete = "SELECT * FROM users
        WHERE
        `pseudo` = '" . $login1 . "';";
        $result = $GLOBALS["pdo"]->query($requete);
        if ($result->rowCount() > 0) {
            $tab = $result->fetch();
            $this->id_ = $tab['id'];
            $this->mail_ = $tab['mail'];
            $this->login_ = $tab['pseudo'];
            $pass = $tab['password'];
        } else {
            $requete = "INSERT INTO `users`(`pseudo`, `mail`,`password`) 
            VALUES('$login1', '$mail1','$pass1');";
            $result = $GLOBALS["pdo"]->query($requete);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            $this->login_ = $login1;
            //echo $requete;
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM `users` 
        WHERE `id` = '" . $id . "'";
        $resultat = $GLOBALS["pdo"]->query($sql);
        if ($tab = $resultat->fetch()) {
            $this->id_ = $tab['id'];
            $this->mail_ = $tab['mail'];
            $this->login_ = $tab['pseudo'];
            $this->token_ = $tab['token'];
        }
    }
    public function isConnect()
    {
        if (isset($_SESSION['id'])) {
            $sql = "SELECT * FROM `users` 
            WHERE `id` = '" . $_SESSION['id'] . "'";
            $resultat = $GLOBALS["pdo"]->query($sql);
            if ($tab = $resultat->fetch()) {
                $this->login_ = $tab['pseudo'];
                $this->id_ = $tab['id'];
                return true;
            }
        } else {
            return false;
        }
    }



    public function getPseudo()
    {
        echo $this->login_;
    }
    public function getMail()
    {
        echo $this->mail_;
    }
    public function getLogin()
    {
        return $this->login_;
    }
    public function getToken()
    {
        echo $this->token_;
    }


    public function confirmAdmin()
    {
        $sql = "SELECT * FROM `users` 
            WHERE `id` = :id";
        $statement = $GLOBALS["pdo"]->prepare($sql);
        $statement->bindParam(':id', $_SESSION['id']);
        $statement->execute();

        if ($tab = $statement->fetch()) {
            $this->admin_ = $tab['permissions'];
            if ($this->admin_ === '1') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
