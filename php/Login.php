<?php
include "./DB.php";
    if ($_POST["inviato"]) {
        if ($_POST["email"]) {
            echo "arrivi dal form<br>";
            echo "Email: ".$_POST["email"]."<br>";
            if(Database::connect()){
                $ris=Database::executeQuery("SELECT `IsRel`, `IsPar`, `IsAdmin` FROM `user` WHERE `MailUser` = '".$_POST["email"]."';");
                if($ris){
                    $user=$ris->fetch_object();
                    if ($user != null) {
                        if ($user->IsAdmin == 1) {
                            // header("Location: ./Admin.php");
                            echo "SEI UN ADMIN<br>";
                        }elseif ($user->IsRel != null) {
                            echo "SEI UN RELATORE<br>";
                        }elseif ($user->IsPar != null) {
                            echo "SEI UN PARTECIPANTE<br>";
                        }else{
                            echo "Registrati<br>";
                        }
                    }else{
                        echo "utente non registarto";
                    }
                }
            }
        }else{  
            echo "non hai inserito email<br>";
        }
    }else{
        echo "non arrivi dal form<br>";
    }
?>