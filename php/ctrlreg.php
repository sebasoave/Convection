<?php
include "DB.php";
Database::connect();
if (isset($_POST["inviato"])) {
    $cs=Database::executeQuery("INSERT INTO `Partecipante` (`CognomePart`, `NomePart`, `TelefonoPart`, `MailPart`) VALUE ('".$_POST["cognome"]."','". $_POST["nome"]."','". $_POST["numtel"]."','".$_POST["email"]."');");
    $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() FROM `Relatore` ")->fetch_array()[0];
    $cs2=Database::executeQuery("INSERT INTO  `User` (`MailUser`,`PasswordUser`,`IsPar`) VALUE  ('".$_POST["email"]."','".$_POST["password"]."','".$lsid."');");
    if ($cs && $cs2) {
        echo "Registrazione andata a buon fine";
    }
}else{
    echo "Non arrivi dal form di registrazione";
}
Database::disconnect();
?>
<br><a href='../index.php'>Home Page<a>
<a href='./Registrazione.php'>Torna indietro<a>