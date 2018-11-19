<?php
session_start();
require "connection.php";
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$id = $_POST["id"];
$stmt = $conn->query("UPDATE `inquiry` SET `replied_by` = '".$_SESSION["user_id"]."' WHERE `id` = '$id'");

//Server settings
$mail->SMTPDebug = 1;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'jmalicdem45@gmail.com';                 // SMTP username
$mail->Password = 'Pithecus2013';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

//Recipients
$mail->setFrom('isatu@gmail.com', 'ILOILO SCIENCE AND TECHNOLOGY UNIVERSITY');
$mail->addAddress($_POST["email"]);     // Add a recipient
//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Your Suffrage Account';
$message = $_POST["reply"];
$mail->Body    = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
//header("location:inquiry.php");