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
    ?>

<form method='get' action='./AddProg.php' id="AddRell">
    <input name="IdSpeech"  hidden value=<?=$lsid ?>>
    <select  name="RelId">
        <?php
        for ($i=0; $i < count($Par) ; $i++) { 
            echo "<option value='".$Par[$i]["IDRel"]."'>".$Par[$i]["CognomeRel"]." - ".$Par[$i]["NomeRel"] ."</option>";
        }
        ?>
    </select>
    <select  name="SalaId">
    <?php
    $salesql=Database::executeQuery("select * from sala");
    $Sala=$salesql->fetch_all(MYSQLI_ASSOC);
        for ($i=0; $i < count($Sala) ; $i++) { 
            echo "<option value='".$Sala[$i]["NomeSala"]."'>".$Sala[$i]["NomeSala"]." - ".$Sala[$i]["NpostiSala"] ."</option>";
        }
    ?>
    </select>
    <select name="Orari">
        <option value="08:00 - 09:00">08:00 - 09:00</option>
        <option value="09:00 - 10:00">09:00 - 10:00</option>
        <option value="10:00 - 11:00">10:00 - 11:00</option>
        <option value="11:00 - 12:00">11:00 - 12:00</option>
        <option value="12:00 - 13:00">12:00 - 13:00</option>
        <option value="14:00 - 15:00">14:00 - 15:00</option>
        <option value="15:00 - 16:00">15:00 - 16:00</option>
        <option value="16:00 - 17:00">16:00 - 17:00</option>
    </select>
    <button type='submit'>Aggiungi Programma</button>
</form>



<?php
}else{
    echo "Il titolo dello speach è gia scritto<br>
    <a href='./Admin.php'>go Back</a>";
}
Database::disconnect();
?>