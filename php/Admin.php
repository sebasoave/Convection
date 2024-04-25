<?php
include "DB.php";
Database::connect();
$ris=Database::executeQuery("select * from Partecipante");
?>
<table border="4">
    <tr>
        <th>IdPar</th>
        <th>CognomePart</th>
        <th>NomePart</th>
        <th>TelefonoPart</th>
        <th>MailPart</th>
    </tr>
<?php
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_object() as $key => $value) {
        echo "<th>".$value."</th>";   
    }
    echo "</tr>";
}
Database::disconnect();
?>
</table>