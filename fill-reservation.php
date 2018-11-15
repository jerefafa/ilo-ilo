<?php
require "auth-checker.php";
require "connection.php";
$reservationInfo = array();
array_push($reservationInfo, $_POST["checkIn"]);
array_push($reservationInfo, $_POST["checkOut"]);
array_push($reservationInfo, $_POST["numAdult"]);
array_push($reservationInfo, $_POST["numChild"]);
array_push($reservationInfo, $_POST["hotel"]);
$_SESSION["reservationInfo"] = $reservationInfo;

header("location:finalize-reservation.php");