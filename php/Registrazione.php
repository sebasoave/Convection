<?php
    echo "Registrati <br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <form action="./ctrlreg.php" method="post">
        <input type="text" placeholder="nome: " name="nome" require >
        <input type="text" placeholder="cognome: " name="cognome" require>
        <input type="text" placeholder="numero tel: " name="numtel" require >
        <input type="email" placeholder="email: " name="email" require >
        <input type="password" placeholder="password: " name="password" require >
        <button type="submit" name="inviato" value="Registrati">Registrati</button>
    </form>
    <a href='../index.php'>Home Page<a>
</body>