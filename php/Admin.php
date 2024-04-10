<?php
include "DB.php";
Database::connect();
$ris=Database::executeQuery("select * from Relatore");
?>
<table border="4">
    <tr>
        <th>IdRel</th>
        <th>CognomeRel</th>
        <th>NomeRel	</th>
        <th>TelefonoRel	</th>
        <th>MailRel	</th>
        <th>IdAzz</th>
        <th>Rivisionare</th>
    </tr>
<?php
for ($i=0; $i < $ris->num_rows; $i++) { 
    echo "<tr>";
    foreach ($ris->fetch_object() as $key => $value) {
        if ($key == "Rivisionare" && $value==0 ) {
            echo "<th>aposto</th>";   
        }elseif ($key == "Rivisionare" && $value==1) {
            echo "<th>Rivisionare</th>";
        }else{
            echo "<th>".$value."</th>";   
        }
    }
    echo "</tr>";
}
Database::disconnect();
?>
</table>