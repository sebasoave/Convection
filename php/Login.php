<?php
include "./DB.php";
if ($_POST["inviato"]) {
    if ($_POST["email"]) {

        if ($_POST["password"]) {
            echo "arrivi dal form<br>";
            echo "Email: ".$_POST["email"]."<br>";
            if(Database::connect()){
                $ris=Database::executeQuery("SELECT `IsRel`, `IsPar`, `IsAdmin` FROM `User` WHERE `MailUser` = '".$_POST["email"]."' AND `PasswordUser` = '".$_POST["password"]."'  ;" );
                
                if($ris){
                    $user=$ris->fetch_object();
                    if ($user != null) {
                        if ($user->IsAdmin == 1) {
                            header("Location: ./Admin.php");
                            // echo "SEI UN ADMIN<br>";
                        }elseif ($user->IsRel != null) {
                            //echo "SEI UN RELATORE<br>";
                            header("Location: ./Relatore.php");
                        }elseif ($user->IsPar != null) {
                            header("Location: ./Partecipante.php");
                            //echo "SEI UN PARTECIPANTE<br>";
                        }
                    }else{
                        echo "utente non registarto";
                        header("Location: ./Registrazione.php");
                    }
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