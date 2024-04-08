<?php
    if ($_POST["inviato"]) {
        echo "arrivi dal form<br>";
        echo "Email: ".$_POST["email"]."<br>";
        //controllare table on db utenti for admin relatore or partecipante
    }else{
        echo "non arrivi dal form<br>";
    }
?>