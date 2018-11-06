<?php
require "connection.php";
$reservationId = $_GET["reservationId"];
$stmt = $conn->query("SELECT * FROM `reservations` INNER JOIN `reservation_info` WHERE `reservation_info`.`reservation_id` = `reservations`.`id` AND `reservations`.`id` = '".$reservationId."' AND `reservations`.`cancelled_by` IS NULL");
while ($row = $stmt->fetch_object()) {
    echo json_encode($row);
}