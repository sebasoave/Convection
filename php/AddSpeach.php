<?php
include "./DB.php";
include "Conf.php";
Database::connect();
$spechsql=Database::executeQuery("select * from speech where Titolo= '".$_GET["titolo"]."';");
if ($spechsql->num_rows == 0) {
    echo "Aggiunta dello Speach";
    $AddSpeach=Database::executeQuery("insert into speech (Titolo,Argomento) value ('".$_GET["titolo"]."','".$_GET["Argomento"]."');");
    $lsid=Database::executeQuery("SELECT LAST_INSERT_ID() from speech")->fetch_assoc()["LAST_INSERT_ID()"];
    $ris=Database::executeQuery("select * from relatore");
    $Par=$ris->fetch_all(MYSQLI_ASSOC);
}else{
    echo "Il titolo dello speach è gia scritto<br>";
}
Database::disconnect();
?>
<br>
<a href='./Admin.php'>go Back</a>