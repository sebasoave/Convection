<?php
$idsp=$_GET["IdSpeech"]-1;
$RelId=$_GET["RelId"];
$SalaId=$_GET["SalaId"];
$Orari=$_GET["Orari"];
include "./DB.php";
include "Conf.php";
Database::connect();
Database::executeQuery("INSERT INTO programma( IdSpeech, NomeSala, FasciaOraria) VALUE ('".$idsp."','".$SalaId."','".$Orari."');");
$lsid=Database::executeQuery("SELECT LAST_INSERT_ID() from programma")->fetch_assoc()["LAST_INSERT_ID()"];
Database::executeQuery("INSERT INTO relaziona (IDRel,IdProgramma) value (".$idsp.",".$lsid.")");
echo "Programma inserito";
Database::disconnect();
?>