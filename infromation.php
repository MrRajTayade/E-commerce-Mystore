<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "welcome " . $_SESSION["username"];
    echo "<br>";
    echo "And your password is -" . $_SESSION["password"];
    echo "<br>";
    echo "And your e-mail is -  " . $_SESSION["email"];
} else {
    echo "Please login again to continiue";
}

?>