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
    <style>
#tableRelatori{
 transform:translatex(781px) translatey(-277px);
}
#RelTit{
 transform:translatex(787px) translatey(-278px);
 width:111px;
}
#ProgTit{
 transform:translatex(617px) translatey(-263px);
 padding-top:11px;
 width:268px;
}

#TableProgrammi{
 transform:translatex(254px) translatey(-272px);
 min-height:253px;
}
#AddAziendaTit{
 transform:translatex(0px) translatey(-256px);
 width:268px;
}
#AddAzienda{
    transform:translatex(0px) translatey(-256px);
    width:500px;
}
#AddRelTit{
    width:300px;
    transform:translatex(650px) translatey(-350px);
}
#AddRell{
    transform:translatex(650px) translatey(-360px);
    width:400px;
}


</style>

</head>
<body id="content">

<h1 id="PartT">Partecipanti</h1>
<table border="4" id="tablePartecipanti">
    <tr>
        <th>IdPar</th>
        <th>CognomePart</th>
        <th>NomePart</th>
        <th>TelefonoPart</th>
        <th>MailPart</th>
    </tr>
    <?php
    include "DB.php";
    $skip=0;
    Database::connect();
    $ris=Database::executeQuery("select * from Partecipante");
    $Par=$ris->fetch_all(MYSQLI_ASSOC);
    for ($i=0; $i < count($Par); $i++) {
        echo "<tr>";
        foreach ($Par[$i] as $key => $value) {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
    }
    ?>
</table>


<h1 id="RelTit">Relatori</h1>
<table border="4" id="tableRelatori">
    <tr>
        <th>IDRel</th>
        <th>CognomeRel</th>
        <th>NomeRel</th>
        <th>TelefonoRel</th>
        <th>MailRel</th>
        <th>IdAzz</th>
    </tr>
    <?php
    $ris=Database::executeQuery("select * from Relatore");
    $Rel=$ris->fetch_all(MYSQLI_ASSOC);
    for ($i=0; $i < count($Rel); $i++) {
        echo "<tr>";
        foreach ($Rel[$i] as $key => $value) {
            echo "<th>".$value."</th>";
        }
        echo "</tr>";
    }
    ?>
</table>
<h1 id="ProgTit">Tabella Programmi</h1>
<table border="2" id="TableProgrammi">
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
   
    for ($i=0; $i < $ris->num_rows; $i++) { 
        echo "<tr>";
        foreach ($ris->fetch_assoc() as $key => $value) {
            echo "<th>".$value."</th>";      
        }
        echo "</tr>";
    }
    ?>
</table>
<h1 id="AddAziendaTit">Aggiungi Azienda </h1>
<form method='get' action='./AddAzienda.php' id="AddAzienda">
    <input type='text' placeholder='Ragione Sociale' name='RagSoc'/>
    <input type='text' placeholder='Indrizzo' name='IndAzzienda'/>
    <button type='submit'>Aggiungi Azienda</button>
</form>

<h1 id="AddRelTit">Aggiungi Relatore</h1>
<form method='get' action='./AddRell.php' id="AddRell">
    <select  name="PartId">
        <?php
        for ($i=0; $i < count($Par) ; $i++) { 
            echo "<option value='".$Par[$i]["IdPar"]."'>".$Par[$i]["CognomePart"]." - ".$Par[$i]["NomePart"] ."</option>";
        }
        ?>
    </select>
    <?php
    $aziende=Database::executeQuery("select * from Azienda");

    if ($aziende->num_rows > 0) {
        $aziende = $aziende->fetch_all(MYSQLI_ASSOC);
        echo "
        <select name='azienda'>
            <option value='Sc'disabled >scegli un azienda</option>";
        foreach ($aziende as $azienda) {
            $rs=$azienda['RagioneSocialeAzienda'];
            echo "<option value='".$rs."'>" .$rs."</option>";
        }
        echo "</select>
        <button type='submit'>Aggiungi Relatore</button>";
    }
?>
</form>


</body>
</html>
<?php

Database::disconnect();
}else{
    echo "Non Puoi Accedere a questa pagina
    <a href='../index.php'>Home</a>";
}?>