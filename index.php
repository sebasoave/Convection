<?php 
//controllare se sono admin relatore partecipante 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <form action="./php/Login.php" method="post">
        <input type="email" placeholder="email: " name="email" >
        <input type="password" placeholder="password: " name="password"   >
        <button type="submit" name="inviato" value="Login">Login</button>
    </form>
    <a href='./php/Registrazione.php'>Registrazione<a>
</body>
</html>