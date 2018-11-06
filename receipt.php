<?php
require "connection.php";
$reservationId = $_GET["reservationId"];
$stmt = $conn->query("SELECT * FROM `reservations` INNER JOIN `reservation_info` INNER JOIN `rooms` INNER JOIN `hotels` WHERE `reservation_info`.`reservation_id` = `reservations`.`id` AND  `rooms`.`id` = `reservations`.`room_id` AND `hotels`.`id` = `rooms`.`hotel_id` AND `reservations`.`id` = '".$reservationId."' AND `reservations`.`cancelled_by` IS NULL");
$printableObject;
while ($row = $stmt->fetch_object()) {
    $printableObject = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/Style4.css">
    <link rel="stylesheet" type="text/css" href="MaterializeCSS/materialize/css/materialize.min.css">
    <title>Inventory</title>
</head>
<body>


<page size="A4">
    <div style="margin-left: 3%; margin-right: 3%; padding-top: 5%;">
            <h1><?= $printableObject->hotel_name?></h1>
        <h6>Date: 05/06/2018 - 05/07/2018</h6><br>
        <table class="responsive-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Barcode Number</th>
                <th>Remarks</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Library acquisition and policies and procedures</td>
                <td>Elizabeth Futas</td>
                <td>NULIB236458871</td>
                <td>Missing Page</td>
                <td>Not Missing</td>
            </tr>
            <tr>
                <td>Management of library administration</td>
                <td>Goswami, Inder Mohan</td>
                <td>NULIB687349990</td>
                <td>Covering</td>
                <td>Missing</td>
            </tr>
            <tr>
                <td>Provincial library & meseum</td>
                <td>Acierto, Norman E.</td>
                <td>NULIB000006511</td>
                <td>Weed out</td>
                <td>Missing</td>
            </tbody>
        </table>
    </div>
</page>

</body>
</html>