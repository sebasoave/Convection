
<?php
include "Conf.php";
include "./DB.php";
Database::connect();
if ($_SESSION["Ruolo"] == "both" || $_SESSION["Ruolo"] == "Relatore" ) {
$idrel=$_SESSION["user"][0]["IDRel"];
$relProg=database::executeQuery("SELECT IdProgramma from relaziona where IDRel =".$idrel)->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatore</title>
</head>
<body>
<h1>Relatore</h1>
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
for ($i=0; $i < count($relProg); $i++) {
    $ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria,Sala.NpostiSala FROM `Programma` , `Speech`,`Sala` WHERE Programma.IdSpeech = Speech.IdSpeech AND Programma.NomeSala = Sala.NomeSala AND ( Programma.IdProgramma = '".$relProg[$i]["IdProgramma"]."')  ; ");
    for ($i=0; $i < $ris->num_rows; $i++) { 
        echo "<tr>";
        foreach ($ris->fetch_assoc() as $key => $value) {
            echo "<th>".$value."</th>";      
        }
        echo "</tr>";
    }
}?>
</table>
</body>
</html><?php

if ($_SESSION["Ruolo"] == "both") {
    echo "<a href='./Partecipante.php'>Partecipante</a>";
}
}else{
    echo "Non Puoi Accedere a questa pagina
    <a href='../index.php'>Home</a>";
}
?>