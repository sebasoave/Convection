<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <style>
        /* Stile per il form */
        form {
            margin: 20px auto; /* Imposta il margine automatico per centrare il form */
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            width: 300px;
        }

        input[type="text"],
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

        /* Stile per il link "Home Page" */
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }
    </style>
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
