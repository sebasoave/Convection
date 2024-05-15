<?php
include "Conf.php";
include "./DB.php";

Database::connect();
$idrel=$_SESSION["user"]["IDRel"];
$ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria,Sala.NpostiSala FROM `Programma` , `Speech`,`Sala` WHERE Programma.IdSpeech = Speech.IdSpeech AND Programma.NomeSala = Sala.NomeSala  ; ");
?>
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
$idp=0;
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_assoc() as $key => $value) {
        echo "<th>".$value."</th>";      
    }
    echo "</tr>";
}

if ($_SESSION["Ruolo"] == "both") {
    echo "<a href='./Partecipante.php'>Partecipante</a>";
}
?>