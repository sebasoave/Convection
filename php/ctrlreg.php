<?php
include "DB.php";
Database::connect();
if ($_POST["Tipologia"] == "Relatore") {
    Database::executeQuery("INSERT INTO `Relatore` (`CognomeRel`, `NomeRel`, `TelefonoRel`, `MailRel`,`Rivisionare`) 
    VALUE ('".$_POST["cognome"]."','". $_POST["nome"]."','". $_POST["numtel"]."','".$_POST["email"]."',1);");

}

?>