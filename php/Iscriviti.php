<?php
include "DB.php";
include "Conf.php";
if (isset($_POST["invia"])) {
    // echo "Vuoi Inscriverti al programma ";
    $idprog=$_POST["id_prog"];
    Database::connect();
    $par=Database::executeQuery("SELECT * FROM Seglie where IdPar = '".$_SESSION["user"][0]["IdPar"]."' AND IdProgramma = '".$idprog."';");
    if ($par->num_rows > 0) {
        echo "sei gia inscritto a questo Programma";
    }else{
        $nms= "";
        $QueryForTable=Database::executeQuery("SELECT Programma.IdProgramma,Speech.IdSpeech,Speech.Titolo,Speech.Argomento,Programma.NomeSala,Programma.FasciaOraria FROM `Programma` , `Speech` WHERE Programma.IdSpeech = Speech.IdSpeech AND (Programma.IdProgramma =".$idprog."); ");
    
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
        $InsertInscrizione=Database::executeQuery("INSERT INTO Seglie(IdPar,IdProgramma) VALUE (".$_SESSION["user"][0]["IdPar"].",".$idprog.")");
        $QtaOnDB=Database::executeQuery("SELECT NpostiSala FROM sala where NomeSala = '".$nms."';")->fetch_assoc()["NpostiSala"]-1;
        $UpDateQta=Database::executeQuery("UPDATE sala SET NpostiSala = '".$QtaOnDB."' WHERE NomeSala = '".$nms."';");
        Database::disconnect();
    }

}
else{
    echo"non arrivi dal form";
}
?><br>
<a href='./Partecipante.php'>Home Page<a>