<?php
$idsp = $_GET["IdSpeech"];
$RelId = $_GET["RelId"];
$SalaId = $_GET["SalaId"];
$Orari = $_GET["Orari"];

include "./DB.php";
include "Conf.php";

Database::connect();

$salaQuery = "SELECT * FROM programma WHERE NomeSala = '" . $SalaId . "' AND FasciaOraria = '" . $Orari . "'";
$saladisp = Database::executeQuery($salaQuery);

$relQuery = "SELECT p.FasciaOraria FROM programma p 
             JOIN relaziona r ON p.IdProgramma = r.IdProgramma 
             WHERE r.IDRel = '" . $RelId . "' AND p.FasciaOraria = '" . $Orari . "'";
$reldisp = Database::executeQuery($relQuery);

if ($reldisp->num_rows > 0) {
    echo "Relatore in quella fascia oraria è già presente ad un'altra sala";
} elseif ($saladisp->num_rows > 0) {
    echo "Sala già occupata in quel orario";
} else {
    echo "Relatore e sala disponibili. Inserimento del programma";

    $insertProgrammaQuery = "INSERT INTO programma (IdSpeech, NomeSala, FasciaOraria) VALUES ('" . $idsp . "', '" . $SalaId . "', '" . $Orari . "')";
    Database::executeQuery($insertProgrammaQuery);

    $lsid = Database::executeQuery("SELECT LAST_INSERT_ID()")->fetch_assoc()["LAST_INSERT_ID()"];

    $insertRelazionaQuery = "INSERT INTO relaziona (IDRel, IdProgramma) VALUES ('" . $RelId . "', '" . $lsid . "')";
    Database::executeQuery($insertRelazionaQuery);

    echo " Programma e relatore inseriti correttamente";
}

Database::disconnect();
echo "<a href='./Admin.php'>go Back</a>";
?>
