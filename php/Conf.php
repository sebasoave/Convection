<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION["login"]=false;
}
function isCookieValide(){
    if (isset($_COOKIE["ruolo"])) {
        return true;
    }else{
        session_destroy();
        return false;
    }
}

?>