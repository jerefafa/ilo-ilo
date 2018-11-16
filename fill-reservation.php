<?php
require "auth-checker.php";
require "connection.php";
$reservationInfo = array();
array_push($reservationInfo, $_POST["checkIn"]); //0
array_push($reservationInfo, $_POST["checkOut"]); //1
array_push($reservationInfo, $_POST["numAdult"]); //2
array_push($reservationInfo, $_POST["numChild"]); //3
array_push($reservationInfo, $_POST["hotel"]); //4
$_SESSION["reservation"] = $reservationInfo;

header("location:finalize-reservation.php");