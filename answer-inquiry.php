<?php
require "connection.php";
if(isset($_POST['rep_user'])){
        $conn->query("UPDATE `inquiry` SET `replied_by` = '".$_POST["id"]."' WHERE `id`='".$_POST["id"]."'");
        $message = $_POST["reply"];
        $email = $_POST["email"];
        $subject = "Response to your question";
        $url = "http://iloilo.x10host.com/answer-inquiry.php?email=$email&subject=$subject&reply=$message";
        echo "<script>window.open('$url','_blank')</script>";
//         echo "<script>location.href='inquiry.php'</script>";
}
