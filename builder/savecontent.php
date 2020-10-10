<?php

if (!isset($_SESSION)) {
    session_start();
}
require '../config/conn.php';
require 'autoload.php';
$level = new AccessLevel();
$login = new UserClass();
if ($login->isLoggedIn() === true) {

    function protect($str) {
        global $conn;
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlentities($str, ENT_QUOTES);
        $str = mysqli_real_escape_string($conn, $str);
        return $str;
    }

    if (isset($_POST['title'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $sql = "INSERT INTO page (title, content) VALUES ('" . protect($title) . "', '" . protect($content) . "')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $sqlm = "INSERT INTO menu (page_id, title_page) VALUES ('" . $last_id . "', '" . protect($title) . "')";
            if ($conn->query($sqlm) === TRUE) {
                echo "Page " . $title . " : Created ";
            } else {
                echo "Failed";
            }
            $_SESSION["title"] = $title;
            $_SESSION["page"] = $last_id;
        } else {
            echo "Failed";
        }
    }
} else {
    header('Location: ../system/login.php');
}
?>

