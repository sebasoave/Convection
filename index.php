<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        /* Stile per la navbar */
        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Stile per il form */
        form {
            margin: 20px auto; /* Imposta il margine automatico per centrare il form */
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            width: 300px;
        }

        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Stile per il resto della pagina */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href='./php/Registrazione.php'>Registrazione</a>
        <a href='./TabellaProgrammi.php'>Tabella Programmi</a>
    </div>
<?php 
include "./php/Conf.php";
if ($_SESSION["login"] == false) {
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
