<?php
include "DB.php";
include "Conf.php";
$pw=hash("sha256",$_POST["password"]);
Database::connect();
if ($_SESSION["login"] == false) {
    if (isset($_POST["inviato"])) {
        $EmailTrue=Database::executeQuery("SELECT * FROM `User` where `MailUser` = '".$_POST["email"]."';");
        if ($EmailTrue->num_rows == 0) {
            $cs=Database::executeQuery("INSERT INTO `Partecipante` (`CognomePart`, `NomePart`, `TelefonoPart`, `MailPart`) VALUE ('".$_POST["cognome"]."','". $_POST["nome"]."','". $_POST["numtel"]."','".$_POST["email"]."');");
            $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() FROM `Partecipante` ")->fetch_array()[0];
            $cs2=Database::executeQuery("INSERT INTO  `User` (`MailUser`,`PasswordUser`,`IsPar`) VALUE  ('".$_POST["email"]."','".$pw."','".$lsid."');");
            if ($cs && $cs2) {
                echo "Registrazione andata a buon fine";
                $r=Database::executeQuery("SELECT IdPar,MailPart FROM `Partecipante` WHERE `IdPar` = '".$lsid."';" );
                $_SESSION["user"]=( mysqli_fetch_all($r, MYSQLI_ASSOC));
                $_SESSION["login"]=true;
                $_SESSION["Ruolo"]="Partecipante";
            }
        }else{
            echo "email gia esistente ";
        }

       
    }else{
        echo "Non arrivi dal form di registrazione";
    }
}else{
    echo "Sei gia loggato";
}
Database::disconnect();
?>
<br><a href='../index.php'>Home Page<a>
<br><a href='./Registrazione.php'>Torna indietro<a>