<?php
include "DB.php";
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
        <th></th>
    </tr>
<?php
$idp=0;
$fattibile="Iscriviti";
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_assoc() as $key => $value) {
        if ($key == "IdProgramma") {
            $idp=$value;    
        }
        if ($key == "NpostiSala" && $value == 0) {
            $fattibile="No";
        }
        if ($key != "NpostiSala") {
            echo "<th>".$value."</th>";      
            
        }
    }
    echo "<th><br><form method='post' action='Iscrizione.php'>
        <input hidden name='id_prog'value='".$idp."' >
        <input type='submit' name='invia' value='".$fattibile."'>
    </form></th>";
    echo "</tr>";
}
Database::disconnect();
?>
</table>