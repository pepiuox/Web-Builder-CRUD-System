<?php

if (!isset($_SESSION)) {
    session_start();
}
require '../config/conn.php';
require 'autoload.php';
$level = new AccessLevel();
$login = new UserClass();
if ($login->isLoggedIn() === true) {

    if (isset($_POST['content'])) {
        $idp = $_POST['idp'];
        $content = $_POST['content'];
        $style = $_POST['style'];

        $sql = "UPDATE page SET  content='" . protect($content) . "', style='" . protect($style) . "' WHERE id='$idp'";
        if ($conn->query($sql) === TRUE) {
            echo "The page has been updated";
        } else {
            echo "Failed";
        }
    }
} else {
    header('Location: ../system/login.php');
}
?>
