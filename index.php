<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

</head>
<body>
    <div class="navbar">
        <a href='./php/Registrazione.php'>Registrazione</a>
        <a href='./TabellaProgrammi.php'>Tabella Programmi</a>
    </div>
<?php 
include "./php/Conf.php";
if ($_SESSION["login"] == false || isCookieValide() == false) {
?>
    <form action="./php/Login.php" method="post">
        <input type="email" placeholder="Email" name="email" >
        <input type="password" placeholder="Password" name="password"   >
        <button type="submit" name="inviato" value="Login">Login</button>
    </form>

<?php }else{
    echo "<h1>Utente già loggato</h1>";
    if ($_SESSION["Ruolo"] == "both") {
        echo "<div class='navbar'>";
        echo "<a href='./php/Relatore.php'>Relatore</a>";
        echo "<a href='./php/Partecipante.php'>Partecipante</a>";
        echo "</div>";
    }elseif ($_SESSION["Ruolo"] == "Relatore") {
        echo "<div class='navbar'>";
        echo "<a href='./php/Relatore.php'>Relatore</a>";
        echo "</div>";
    }elseif($_SESSION["Ruolo"] == "Partecipante") {
        echo "<div class='navbar'>";
        echo "<a href='./php/Partecipante.php'>Partecipante</a>";
        echo "</div>";
    }elseif ($_SESSION["Ruolo"] == "Admin") {
        echo "<div class='navbar'>";
        echo "<a href='./php//Admin.php'>Admin</a>";
        echo "</div>";
    }
    
    ?><br>
    <p><a href='./php/LogOut.php'>LogOut</a></p>
<?php
}?>
</body>
</html>
