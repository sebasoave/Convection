<?php
include "DB.php";
Database::connect();
if ($_POST["Tipologia"] == "Relatore") {
    Database::executeQuery("INSERT INTO `Relatore` (`CognomeRel`, `NomeRel`, `TelefonoRel`, `MailRel`,`Rivisionare`) VALUE ('".$_POST["cognome"]."','". $_POST["nome"]."','". $_POST["numtel"]."','".$_POST["email"]."',1);");
    $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() FROM `Relatore` ")->fetch_array()[0];
    echo $lsid;
    if (Database::executeQuery("SELECT `Rivisionare` FROM `Relatore` WHERE `MailRel`='".$_POST["email"]."';")->fetch_array()[0] == 0){
        Database::executeQuery("INSERT INTO  `User` (`MailUser`,`PasswordUser`,`IsRel`) VALUE  ('".$_POST["email"]."','".$_POST["password"]."','".$lsid."');");
    }else{
        echo "Aspetta la rivisione da un admin allora potrai fare il login";
    }
    
}elseif ($_POST["Tipologia"] == "Partecipante") {
    $cs=Database::executeQuery("INSERT INTO `Partecipante` (`CognomePart`, `NomePart`, `TelefonoPart`, `MailPart`) VALUE ('".$_POST["cognome"]."','". $_POST["nome"]."','". $_POST["numtel"]."','".$_POST["email"]."');");
    $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() FROM `Relatore` ")->fetch_array()[0];
    $cs2=Database::executeQuery("INSERT INTO  `User` (`MailUser`,`PasswordUser`,`IsPar`) VALUE  ('".$_POST["email"]."','".$_POST["password"]."','".$lsid."');");
    if ($cs && $cs2) {
        echo "Registrazione andata a buon fine";
    }
}
Database::disconnect();
?>
echo "<br><a href='../index.php'>Home Page<a>";