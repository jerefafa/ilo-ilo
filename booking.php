<?php
/**
 * Created by PhpStorm.
 * User: Jeremiah
 * Date: 04/11/2018
 * Time: 2:55 PM
 */
session_start();
require "connection.php";
$roomId = $_POST["roomId"];
$package = $_POST["package"];
$roomObject;
$stmt = $conn->query("SELECT * FROM `rooms` WHERE `id` = '$roomId'");
while ($row = $stmt->fetch_object()) {
    $roomObject = $row;
}
$numdays = date_diff(date_create($_SESSION["reservationInfo"][1]),date_create($_SESSION["reservationInfo"][0]))->format("%a");

$totalPrice = $roomObject->rate * $numdays;
$stmt = $conn->query("SELECT * FROM `packages` WHERE `id` = '$package' AND `date_deleted` IS NULL ");
while ($row = $stmt->fetch_object()) {
    $totalPrice+=$row->price;
}
echo $totalPrice;

$stmt = $conn->query("INSERT INTO `reservations`(`room_id`,`check_in`,`check_out`,`mode_of_payment`,`total_price`) VALUES ('$roomId','".$_SESSION["reservationInfo"][0]."','".$_SESSION["reservationInfo"][1]."','".$_POST["paymentMethod"]."','$totalPrice')");
$id = $conn->insert_id;
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$stmt = $conn->query("INSERT INTO `reservation_info`(`reservation_id`,`first_name`,`last_name`,`email`,`phone_number`,`num_adult`,`num_child`,`package_id`) VALUES('$id','$fname','$lname','$email','$phone','".$_SESSION["reservationInfo"][2]."','".$_SESSION["reservationInfo"][3]."','$package')");
if($_POST["paymentMethod"] == "cash") {

}else {

}