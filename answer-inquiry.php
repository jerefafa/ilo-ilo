<?php
session_start();
require "connection.php";
$id = $_POST["id"];
$stmt = $conn->query("UPDATE `inquiry` SET `replied_by` = '".$_SESSION["user_id"]."' WHERE `id` = '$id'");
$reply = $_POST["reply"];
$email = $_POST["email"];

$data = array('reply' => $reply, 'id' => $id, 'email' => $email);
$url = "http://iloilo.x10host.com/answer-inquiry.php";
$options = array(
    'http' => array(
        'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

//header("location:inquiry.php");