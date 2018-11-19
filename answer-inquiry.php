<?php
session_start();
require "connection.php";
require "vendor/autoload.php";
$id = $_POST["id"];
$stmt = $conn->query("UPDATE `inquiry` SET `replied_by` = '".$_SESSION["user_id"]."' WHERE `id` = '$id'");

$sendGrid = new \SendGrid('azure_e5fb4814e91f1eab8b428ad61de261b5@azure.com','Pithecus2013');
$mail = new SendGrid\Mail\Mail('Iloilo Science and Technology University','Response to your question', $_POST["email"], $_POST["reply"]);
$sendGrid->client->mail()->send()->post($mail);
header("location:inquiry.php");