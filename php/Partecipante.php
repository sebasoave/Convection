<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partecipanti</title>
</head>
<body>
<?php
include "DB.php";
include "Conf.php";
Database::connect();
$ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria,Sala.NpostiSala FROM `Programma` , `Speech`,`Sala` WHERE Programma.IdSpeech = Speech.IdSpeech AND Programma.NomeSala = Sala.NomeSala; ");
?>
<h1>Programmi</h1>
<table border="2">
    <tr>
        <th>IdProgramma</th>
        <th>IdSpeech</th>
        <th>Titolo	</th>
        <th>Argomento	</th>
        <th>NomeSala	</th>
        <th>FasciaOraria</th>
        <th>PostiDisponibili</th>
        <th>Iscriviti</th>
    </tr>
<?php
$idp=0;
$fattibile="Iscriviti";
$FlagFattibile="enable";
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_assoc() as $key => $value) {
        if ($key == "IdProgramma") {
            $idp=$value;   
            $par=Database::executeQuery("SELECT * FROM Seglie where IdPar = '".$_SESSION["user"][0]["IdPar"]."' AND IdProgramma = '".$idp."';");
            if ($par->num_rows > 0) { 
                $FlagFattibile="disabled";
                $fattibile="No";
            }else{
                $fattibile="Iscriviti";
                $FlagFattibile="enable";
            } 
        }
        if ($fattibile==="Iscriviti") {
            if ($key == "NpostiSala" && $value == 0) {
                    $FlagFattibile="disabled";
                    $fattibile="No";
            }elseif($key == "NpostiSala" && $value > 0){
                    $fattibile="Iscriviti";
                    $FlagFattibile="enable";
            }
        }
        echo "<th>".$value."</th>";      
            
    }
    echo "<th><br><form method='post' action='Iscrizione.php'>
        <input hidden name='id_prog'value='".$idp."' >
        <input type='submit' name='invia' value='".$fattibile."' ".$FlagFattibile.">
    </form></th>";
    echo "</tr>";
}
Database::disconnect();
?>
   
</body>
</html>