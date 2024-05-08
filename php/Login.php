<?php
include "Conf.php";
include "./DB.php";
if ($_POST["inviato"]) {
    if ($_POST["email"]) {

        if ($_POST["password"]) {
            // echo "arrivi dal form<br>";
            // echo "Email: ".$_POST["email"]."<br>";
            if(Database::connect()){
                $EmailTrue=Database::executeQuery("SELECT * FROM `User` where `MailUser` = '".$_POST["email"]."';");
                if ($EmailTrue->num_rows > 0) {
                    $PasswordTrue=Database::executeQuery("SELECT * FROM `User` where `PasswordUser` = '".$_POST["password"]."';");
                    if ($PasswordTrue->num_rows > 0) {
                        echo "Utente Loggato";
                        $ris=Database::executeQuery("SELECT `IsRel`, `IsPar`, `IsAdmin` FROM `User` WHERE `MailUser` = '".$_POST["email"]."' AND `PasswordUser` = '".$_POST["password"]."'  ;" );
                        if($ris){
                            $user=$ris->fetch_object();
                            if ($user != null) {
                                if ($user->IsAdmin == 1) {
                                    echo "<br><a href='./Admin.php'>Admin</a>";
                                    $_SESSION["login"]=true;
                                    $_SESSION["user"]=( mysqli_fetch_all($r, MYSQLI_ASSOC));
                                }elseif ($user->IsRel != null) {
                                    $r=Database::executeQuery("SELECT IDRel,MailRel FROM `Relatore` WHERE `IdPar` = '".$user->IsRel."';" );
                                    $_SESSION["user"]=( mysqli_fetch_all($r, MYSQLI_ASSOC));
                                    $_SESSION["login"]=true;
                                    echo "<br><a href='./Relatore.php'>Relatore</a>";
                                }elseif ($user->IsPar != null) {
                                    $r=Database::executeQuery("SELECT IdPar,MailPart FROM `Partecipante` WHERE `IdPar` = '".$user->IsPar."';" );
                                    $_SESSION["user"]=( mysqli_fetch_all($r, MYSQLI_ASSOC));
                                    $_SESSION["login"]=true;
                                    echo "<br><a href='./Partecipante.php'>Partecipante</a>";
                                }
                            }
                        }
                    }else{
                        echo "Password errata ritenta";
                        echo "<br><a href='../index.php'>Back</a>";
                    }
                }else{
                    echo "Email non esistente";
                    echo "<br><a href='./Registrazione.php'>Registrazione</a>";
                }
                
            }
        }else{
            echo "non hai inserito password<br>";
        }
    }else{  
        echo "non hai inserito email<br>";
    }
}else{
    echo "non arrivi dal form<br>";
}
?>