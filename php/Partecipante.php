<?php
include "DB.php";
include "Conf.php";
Database::connect();
$ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria,Sala.NpostiSala FROM `Programma` , `Speech`,`Sala` WHERE Programma.IdSpeech = Speech.IdSpeech AND Programma.NomeSala = Sala.NomeSala; ");
?>
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
$par=Database::executeQuery("SELECT * FROM Seglie where IdPar = '".$_SESSION["user"][0]["IdPar"]."';");
if ($par->num_rows > 0) {?>

<table border="2">
    <tr>
        <th>IdProgramma</th>
        <th>IdSpeech</th>
        <th>Titolo	</th>
        <th>Argomento	</th>
        <th>NomeSala	</th>
        <th>FasciaOraria</th>
    </tr>
<?php
    for ($i=0; $i < $par->num_rows; $i++) { 
        $idp=$par->fetch_assoc()["IdPar"];
        $QueryForTable=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria FROM `Programma` , `Speech` WHERE Programma.IdSpeech = Speech.IdSpeech AND (Programma.IdProgramma =".$idp."); ");

        for ($i=0; $i < $QueryForTable->num_rows; $i++) { 
        echo "<tr>";
        foreach ($QueryForTable->fetch_assoc() as $key => $value) { 
            if ($key == "NomeSala") {
                $nms=$value;
            }
            echo "<th>".$value."</th>";   
        }
        echo "</tr>";
        }
    }
}
?>
</table>

<?php


Database::disconnect();
?>
</table>