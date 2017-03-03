<?php

/* Sessionvariabler */
session_start();

$_SESSION["logged_in"] = false;

if(isset($_POST["login"])) {
    if(!empty($_POST["user"]) && !empty($_POST["pass"])) {
        $conn = new mysqli("localhost", "root", "", "blog");
        $un = mysqli_real_escape_string($conn, $_POST["user"]);
        $up = mysqli_real_escape_string($conn, $_POST["pass"]);

        $stmt = $conn->stmt_init();
        if($stmt->prepare("SELECT * FROM users WHERE username = '{$un}' ")) {
            $stmt->execute();
            $stmt->bind_result($id, $un, $password, $uFn, $uLn, $uMail, $uImg, $uDesc, $ads);
            $stmt->fetch();

            if($id !=0 && password_verify($up, $password)) {
                $_SESSION["logged_in"] = true;              
                $_SESSION["id"] = $id;                      //Sessionsvariabler man vill kunna hämta nedan
                $_SESSION["firstname"] = $uFn;
                $_SESSION["lastname"] = $uLn;
                $_SESSION["e-mail"] = $uMail;
                $_SESSION["userimage"] = $uImg;
                $_SESSION["description"] = $uDesc;
                $_SESSION["username"] = $un;
                $_SESSION["admin"] = $ads;
                
                header("Location: dashboard.php");
            } else {
                header ("Location: login.php?wrongpass=true");
            } 
        }
    }
}


?>
