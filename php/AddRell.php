<?php
include "./Conf.php";
include "./DB.php";
$IdAzz=$_GET["azienda"];
$idPar=$_GET["PartId"];
// echo $idPar.$IdAzz;
Database::connect();
$parql=Database::executeQuery("select * from Partecipante where IdPar= '".$idPar."';");
if ($parql->num_rows > 0) {
    $par=$parql->fetch_all(MYSQLI_ASSOC)[0];
    $nome=$par["NomePart"]; 
    $cognome=$par["CognomePart"];
    // echo $nome.$cognome; 
    $relExists=Database::executeQuery("select * from relatore where NomeRel='".$nome."' and CognomeRel = '".$cognome."';");
    // print_r($relExists);
    if ($relExists->num_rows == 0) {
        echo "<br>Inserimento fattibile<br>";
        $r=Database::executeQuery("INSERT INTO Relatore (CognomeRel, NomeRel, TelefonoRel, MailRel, IdAzz) VALUES('".$par["CognomePart"]."', '".$par["NomePart"]."', '".$par["TelefonoPart"]."', '".$par["MailPart"]."', '".$IdAzz."');");
        if($r==1){
            $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() from relatore;")->num_rows;
            $up=Database::executeQuery("UPDATE `user` SET `IsRel`='".$lsid."' WHERE `IsPar` = '".$par["IdPar"]."';");
            if($up==1){
                echo "INSERIMENTO RIUSCITO<br>";
            }
        }else{
            echo "inserimento fallito";
        }


    }else{
        echo "<br>".$nome." ".$cognome."è gia un relatore<br>";
    }
}
// Database::disconnect();
?>
<a href="./Admin.php">go back</a>