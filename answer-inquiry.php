<?php
session_start();
require "connection.php";
$id = $_POST["id"];
$stmt = $conn->query("UPDATE `inquiry` SET `replied_by` = '".$_SESSION["user_id"]."' WHERE `id` = '$id'");
mail($_POST["email"],"Response to your question",$_POST["reply"]);
header("location:inquiry.php");