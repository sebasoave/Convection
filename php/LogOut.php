<?php
include "Conf.php";
session_destroy();
setcookie("user", "", time() - 1200, "/");
setcookie("ruolo", "", time() - 1200, "/");
header("location: ../index.php");
?>