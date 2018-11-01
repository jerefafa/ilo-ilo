<?php
require "connection.php";
session_start();
$username = $_POST["username"];
$password = md5($_POST["password"]);
$stmt = $conn->query("SELECT * FROM `users` WHERE BINARY `username` = '$username' AND BINARY `password` = '$password'");
if(mysqli_num_rows($stmt) > 0) {
    while ($row = $stmt->fetch_object()) {
        $_SESSION["user_id"] = $row->id;
    }
    echo $_SESSION["user_id"];
} else {
    $_SESSION["invalid"] = true;
    header("location:login.php");
}