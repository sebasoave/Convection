<?php
include "./Conf.php";
include "./DB.php";
$rel=$_SESSION["Rel"];
// print_r($rel);
Database::connect();
$r=Database::executeQuery("INSERT INTO Relatore (CognomeRel, NomeRel, TelefonoRel, MailRel, IdAzz,Rivisionare) VALUES('".$rel["CognomePart"]."', '".$rel["NomePart"]."', '".$rel["TelefonoPart"]."', '".$rel["MailPart"]."', '".$_GET["azienda"]."',0);");
if($r==1){
    $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() from relatore;")->num_rows;
    $up=Database::executeQuery("UPDATE `user` SET `IsRel`='".$lsid."' WHERE `IsPar` = '".$rel["IdPar"]."';");
    if($up==1){
        echo "INSERIMENTO RIUSCITO<br>";
    }
}else{
    echo "inserimento fallito";
}
Database::disconnect();
?>
<a href="./Admin.php">go back</a>