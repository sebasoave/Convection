<?php
include "DB.php";
echo "CONTROLLO REL IN LAVORAZIONE<br>";
$idp=$_GET["id"];
Database::connect();
$par=Database::executeQuery("select * from Partecipante where IdPar='".$idp."';")->fetch_assoc();
echo "<h1>Aggiungi Relatore (azienda gia esistente)</h1>";
foreach ($par as $key => $value) {
	echo "<p>".$key.":".$value."<br><p>";
}
$aziende=Database::executeQuery("select * from Azienda");
if ($aziende->num_rows > 0) {
	$aziende = $aziende->fetch_all(MYSQLI_ASSOC);
	echo "
	<form method='get' action='./AddRell.php' >
	<select>";
	foreach ($aziende as $azienda) {
		$rs=$azienda['RagioneSocialeAzienda'];
		echo "<option value='".$rs."'>" .$rs."</option>";
	}
	echo "</select><br><br><button type='submit'>Aggiungi Relatore</button>
	</form>";
	echo "<h1>Aggiungi Azienda </h1>";
	echo "
	<form method='get' action='./AddAzienda.php' >
		<input type='text' placeholder='Ragione Sociale' name='RagSoc'/>
		<input type='text' placeholder='Indrizzo' name='IndAzzienda'/>
		<button type='submit'>Aggiungi Azienda</button>
	</form>";

}else{
	echo "non ci sono aziende nel db";
}

Database::disconnect();
?>
