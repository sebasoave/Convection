<?php 
include "Conf.php";
if ($_SESSION["Ruolo"] == "Admin") {
?>
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
<table border="4">
    <tr>
        <th>IdPar</th>
        <th>CognomePart</th>
        <th>NomePart</th>
        <th>TelefonoPart</th>
        <th>MailPart</th>
        <th>Relatore</th>
    </tr>
    <?php
    include "DB.php";
    $skip=0;
    Database::connect();
    $ris=Database::executeQuery("select * from Partecipante");
    $row=$ris->fetch_all(MYSQLI_ASSOC);
    for ($i=0; $i < count($row); $i++) {
        foreach ($row[$i] as $key => $value) {
            if ($key == "IdPar" ) {
                $us=Database::executeQuery("select IsRel from user where IsPar = ".$value.";");
                if($us->fetch_assoc()["IsRel"]!=null){
                    $skip=1;
                    break;
                }else{
                    $skip=0;
                }
            }
            echo "<th>".$value."</th>";
        }
        if ($skip == 0) {
            echo "<th><a href='CtrlRel.php?id=".$row[$i] ['IdPar']."'>Rendi</a></th>";
            echo "</tr>";
        }
    }
    ?>
</table>

<h1>Tabella Programmi</h1>
<table border="2">
    <tr>
        <th>IdProgramma</th>
        <th>IdSpeech</th>
        <th>Titolo</th>
        <th>Argomento</th>
        <th>NomeSala</th>
        <th>FasciaOraria</th>
        <th>PostiDisponibili</th>
    </tr>
    <?php
    $ris=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria,Sala.NpostiSala FROM `Programma` , `Speech`,`Sala` WHERE Programma.IdSpeech = Speech.IdSpeech AND Programma.NomeSala = Sala.NomeSala; ");
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
</html>
<?php

}else{
    echo "Non Puoi Accedere a questa pagina
    <a href='../index.php'>Home</a>";
}?>