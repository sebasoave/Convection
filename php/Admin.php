<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console</title>
</head>
<body>
<h1>Partecipanti</h1>
<?php
include "DB.php";
Database::connect();
$ris=Database::executeQuery("select * from Partecipante");
?>
<table border="4">
    <tr>
        <th>IdPar</th>
        <th>CognomePart</th>
        <th>NomePart</th>
        <th>TelefonoPart</th>
        <th>MailPart</th>
    </tr>
<?php
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_object() as $key => $value) {
        echo "<th>".$value."</th>";   
    }
    echo "</tr>";
}
$ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria,Sala.NpostiSala FROM `Programma` , `Speech`,`Sala` WHERE Programma.IdSpeech = Speech.IdSpeech AND Programma.NomeSala = Sala.NomeSala; ");
?>
<h1>Tabella Programmi</h1>
<table border="2">
    <tr>
        <th>IdProgramma</th>
        <th>IdSpeech</th>
        <th>Titolo	</th>
        <th>Argomento	</th>
        <th>NomeSala	</th>
        <th>FasciaOraria</th>
        <th>PostiDisponibili</th>
    </tr>
<?php
$idp=0;
$fattibile="Iscriviti";
$FlagFattibile="enable";
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_assoc() as $key => $value) {
        echo "<th>".$value."</th>";      
    }
    echo "</tr>";
}
Database::disconnect();
?>

</table>
</body>