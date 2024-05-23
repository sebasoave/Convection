<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
<?php include "Conf.php"; if ($_SESSION["login"] == false) {?>
    <form action="./ctrlreg.php" method="post">
        <input type="text" placeholder="Nome" name="nome" required >
        <input type="text" placeholder="Cognome" name="cognome" required>
        <input type="text" placeholder="Numero telefono" name="numtel" required >
        <input type="email" placeholder="Email" name="email" required >
        <input type="password" placeholder="Password" name="password" required >
        <button type="submit" name="inviato" value="Registrati">Registrati</button>
    </form>
    <a href='../index.php'>Home Page</a>
<?php }else{echo "Hai già eseguito il login";}?>
</body>
</html>
