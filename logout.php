<?php
session_start();
$_SESSION["logged_in"] = false;                 //Sätter logged_in till att vara falskt

unset($_SESSION["id"]);                         
unset($_SESSION["firstname"]);
unset($_SESSION["lastname"]);
unset($_SESSION["e-mail"]);
unset($_SESSION["userimage"]);
unset($_SESSION["description"]);


session_destroy();                              //Sessionsavslut

header("Location: login.php?logout=true");      //Skickas till logginsidan
?>