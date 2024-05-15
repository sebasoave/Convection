
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
<?php 
include "./php/Conf.php";
if ($_SESSION["login"] == false) {
?>
    <form action="./php/Login.php" method="post">
        <input type="email" placeholder="email: " name="email" >
        <input type="password" placeholder="password: " name="password"   >
        <button type="submit" name="inviato" value="Login">Login</button>
    </form>
    <a href='./php/Registrazione.php'>Registrazione</a>
    <a href='./TabellaProgrammi.php'>Tabella Programmi</a>
    

<?php }else{
    echo "Utente gia loggato";
    if ($_SESSION["Ruolo"] == "both") {
        echo "<br><a href='./php/Relatore.php'>Relatore</a>";
        echo "<br><a href='./php/Partecipante.php'>Partecipante</a>";
    }elseif ($_SESSION["Ruolo"] == "Relatore") {
        echo "<br><a href='./php/Relatore.php'>Relatore</a>";
    }elseif($_SESSION["Ruolo"] == "Partecipante") {
        echo "<br><a href='./php/Partecipante.php'>Partecipante</a>";
    }elseif ($_SESSION["Ruolo"] == "Admin") {
        echo "<br><a href='./php//Admin.php'>Admin</a>";
    }
    
    ?><br>
    <a href='./php/LogOut.php'>LogOut<a></a>
<?php
}?>
</body>
</html>
