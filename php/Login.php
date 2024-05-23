<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ControllaLogin</title>
</head>
<body>
<?php
include "Conf.php";
include "./DB.php";
if ($_SESSION["login"]  == false) {
    if ($_POST["inviato"]) {
        if ($_POST["email"]) {
            if ($_POST["password"]) {
                $pw=hash("sha256",$_POST["password"]);
                if(Database::connect()){
                    $EmailTrue=Database::executeQuery("SELECT * FROM `User` where `MailUser` = '".$_POST["email"]."';");
                    if ($EmailTrue->num_rows > 0) {
                        $PasswordTrue=Database::executeQuery("SELECT * FROM `User` where `PasswordUser` = '".$pw."';");
                        if ($PasswordTrue->num_rows > 0) {
                            echo "<div class='popup'>";
                            echo "<h2>Utente Loggato</h2>";
                            $ris=Database::executeQuery("SELECT `IsRel`, `IsPar`, `IsAdmin` FROM `User` WHERE `MailUser` = '".$_POST["email"]."' AND `PasswordUser` = '".$pw."'  ;" );
                            if($ris){
                                $user=$ris->fetch_object();
                                if ($user != null) {
                                    if ($user->IsAdmin == 1) {
                                        echo "<a href='./Admin.php'>Admin</a>";
                                        $_SESSION["login"]=true;
                                        $_SESSION["Ruolo"]="Admin";
                                        setcookie("ruolo", "admin", time() + 1200, "/");
                                    }
                                    if ($user->IsRel != null) {
                                        $r=Database::executeQuery("SELECT IDRel,MailRel FROM `Relatore` WHERE `IDRel` = '".$user->IsRel."';" );
                                        $_SESSION["user"]=( mysqli_fetch_all($r, MYSQLI_ASSOC));
                                        $_SESSION["login"]=true;
                                        $_SESSION["Ruolo"]="Relatore";
                                        setcookie("ruolo", "Relatore", time() + 1200, "/");
                                        echo "<a href='./Relatore.php'>Relatore</a>";
                                    }
                                    if ($user->IsPar != null) {
                                        $r=Database::executeQuery("SELECT IdPar,MailPart FROM `Partecipante` WHERE `IdPar` = '".$user->IsPar."';" );
                                        $_SESSION["login"]=true;
                                        if (isset($_SESSION["Ruolo"])) {
                                            $idp=$r->fetch_assoc()["IdPar"];
                                            $_SESSION["Ruolo"] ="both";
                                            array_push($_SESSION["user"],$idp);
                                            setcookie("ruolo", "both", time() + 1200, "/");
                                        }else{
                                            $_SESSION["user"]=( mysqli_fetch_all($r, MYSQLI_ASSOC));
                                            $_SESSION["Ruolo"]="Partecipante";
                                            setcookie("ruolo", "Partecipante", time() + 1200, "/");
                                        }
                                        echo "<a href='./Partecipante.php'>Partecipante</a>";
                                    }
                                }
                            }
                            echo "</div>";
                        }else{
                            echo "<div class='popup'>";
                            echo "<h2>Password errata ritenta</h2>";
                            echo "<a href='../index.php'>Back</a>";
                            echo "</div>";
                        }
                    }else{
                        echo "<div class='popup'>";
                        echo "<h2>Email non esistente</h2>";
                        echo "<a href='./Registrazione.php'>Registrazione</a>";
                        echo "</div>";
                    }
                    
                }
            }else{
                echo "<div class='popup'>";
                echo "<h2>Non hai inserito password</h2>";
                echo "</div>";
            }
        }else{  
            echo "<div class='popup'>";
            echo "<h2>Non hai inserito email</h2>";
            echo "</div>";
        }
    }else{
        echo "<div class='popup'>";
        echo "<h2>Non arrivi dal form</h2>";
        echo "</div>";
    }
}else{
    echo "<div class='popup'>";
    echo "<h2>Login già effettuato</h2>";
    echo "<a href='../index.php'>Go back</a>";
    echo "</div>";
}
?>
</body>
</html>
