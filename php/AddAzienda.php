<?php
include "./Conf.php";
include "./DB.php";
Database::connect();
$r=Database::executeQuery("select * from azienda where RagioneSocialeAzienda = '".$_GET["RagSoc"]."';");
if ($r->num_rows < 0) {
    $r=Database::executeQuery("insert into azienda (RagioneSocialeAzienda,IndirizzoAzienda) value ('".$_GET["RagSoc"]."','".$_GET["IndAzzienda"]."');");
    if($r==1){
        echo "INSERIMENTO RIUSCITO";
    }else{
        echo "inserimento fallito";
    }
}else{
    echo "Azienda gia salvata nel database";
}
Database::disconnect();
?>
<a href="./Admin.php">go back</a>