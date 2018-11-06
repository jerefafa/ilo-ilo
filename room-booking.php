<?php
require "connection.php";
session_start();
if(!isset($_SESSION["bookingInfo"])) {
    header("location:index.php");
}
else{
    if(mysqli_num_rows($conn->query("SELECT * FROM `reservations` WHERE ((`check_in` between '".$_SESSION["bookingInfo"][8]."' AND '".$_SESSION["bookingInfo"][8]."') OR (`check_out` between '".$_SESSION["bookingInfo"][8]."' AND '".$_SESSION["bookingInfo"][9]."')) AND `room_id` = '".$_SESSION["bookingInfo"][0]->id."' AND `cancelled_by` IS NULL")) > 0) {
        echo "<script>alert('The room is already taken');</script>";
    }
    else {
        if ($_GET["paymentMode"] === "cash") {
            $stmt = $conn->query("INSERT INTO `reservations`(`room_id`,`check_in`,`check_out`,`mode_of_payment`,`total_price`) VALUES ('" . $_SESSION["bookingInfo"][0]->id . "','" . $_SESSION["bookingInfo"][8] . "','" . $_SESSION["bookingInfo"][9] . "','cash','" . $_SESSION["bookingInfo"][2] . "')");
            $id = $conn->insert_id;
            $stmt = $conn->query("INSERT INTO `reservation_info`(`reservation_id`,`first_name`,`last_name`,`email`,`phone_number`,`num_adult`,`num_child`,`package_id`) VALUES('$id', '" . $_SESSION["bookingInfo"][3] . "','" . $_SESSION["bookingInfo"][4] . "','" . $_SESSION["bookingInfo"][5] . "','" . $_SESSION["bookingInfo"][6] . "','" . $_SESSION["bookingInfo"][10] . "','" . $_SESSION["bookingInfo"][11] . "','" . $_SESSION["bookingInfo"][12] . "')");
            echo "<script>alert('Registered, still gonna integrate the cash and card payment'); </script>";
        } else {
            $stmt = $conn->query("INSERT INTO `reservations`(`room_id`,`check_in`,`check_out`,`mode_of_payment`,`total_price`) VALUES ('" . $_SESSION["bookingInfo"][0]->id . "','" . $_SESSION["bookingInfo"][8] . "','" . $_SESSION["bookingInfo"][9] . "','card','" . $_SESSION["bookingInfo"][2] . "')");
            $id = $conn->insert_id;
            $stmt = $conn->query("INSERT INTO `reservation_info`(`reservation_id`,`first_name`,`last_name`,`email`,`phone_number`,`num_adult`,`num_child`,`package_id`) VALUES('$id', '" . $_SESSION["bookingInfo"][3] . "','" . $_SESSION["bookingInfo"][4] . "','" . $_SESSION["bookingInfo"][5] . "','" . $_SESSION["bookingInfo"][6] . "','" . $_SESSION["bookingInfo"][10] . "','" . $_SESSION["bookingInfo"][11] . "','" . $_SESSION["bookingInfo"][12] . "')");
            $to = $_SESSION["bookingInfo"][5];
            $subject = "Thank you for your reservation";
            $body = "<a href = 'receipt.php?reservationId=$id'>Click here to print your receipt</a>";
            $headers = "From: <iloilo-Hotel@gmail.com>";
            mail($to,$subject,$body,$headers);
            header("location:receipt.php?reservationId=$id");
        }
    }
}