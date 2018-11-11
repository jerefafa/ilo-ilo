<?php
session_start();
require "connection.php";

$checkIn = $_GET["checkIn"];
$checkOut = $_GET["checkOut"];
$hotelId = $_GET["hotelId"];
$cout = new DateTime($checkOut);
$cout->modify('-1 day');
$reservationInfo = array();
$reservationInfo['checkIn'] = $checkIn;
$reservationInfo['checkOut'] = $checkOut;
$reservationInfo['numAdult'] = $_GET["numAdult"];
$reservationInfo['numChild'] = $_GET["numChild"];
$roomsArray = array();
$stmt = $conn->query("SELECT * FROM `rooms` WHERE `hotel_id`='$hotelId'");
while ($row = $stmt->fetch_object())
{
    array_push($roomsArray,$row);
}
$i=0;
//removing used rooms
foreach ($roomsArray as $room) {
    if(mysqli_num_rows($conn->query("SELECT * FROM `reservations` WHERE ((`check_in` between '$checkIn' AND '$checkOut') OR (`check_out` between '$checkIn' AND '".$checkOut."')) AND `room_id` = '$room->id' AND `cancelled_by` IS NULL")) > 0) {
        array_splice($roomsArray,$i,1);
        continue;
    }
    $i++;
}

$reservation = array();
array_push($reservation,$roomsArray);
array_push($reservation,$reservationInfo);
$_SESSION["reservation"] = $reservation;
header("location:available-rooms.php");
