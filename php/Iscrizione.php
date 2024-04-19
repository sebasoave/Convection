<?php
include "DB.php";
if (isset($_POST["invia"])) {
    echo "Vuoi Inscriverti al programma ";
    Database::connect();
    $idprog=$_POST["id_prog"];
    $ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria FROM `Programma` , `Speech` WHERE Programma.IdSpeech = Speech.IdSpeech AND (Programma.IdProgramma =".$idprog."); ");
?>
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
    for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_assoc() as $key => $value) {  
        echo "<th>".$value."</th>";   
    }
    echo "</tr>";
    }
    $ris=Database::executeQuery("INSERT INTO Sceglie(IdPar,IdProgramma) VALUE (".$_SESSION["user"]["IdPar"].",".$idprog.")");
    



    Database::disconnect();
}
else{
    echo"non arrivi dal form";
}
?>