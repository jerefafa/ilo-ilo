<script src="js/jquery.min.js"></script>
<script>
    function sendMail(email, subject, message){
        $.ajax({
            url: "http://iloilo.x10host.com/answer-inquiry.php",
            type: "GET",
            data: {email: email,
                subject: subject,
                reply: message},
            dataType: "Text",
            success: function () {
            }
        });
    }
</script>
<?php
require "connection.php";
session_start();
if(isset($_POST['rep_user'])){
        $conn->query("UPDATE `inquiry` SET `replied_by` = '".$_SESSION["user_id"]."' WHERE `id`='".$_POST["id"]."'");
        $message = $_POST["reply"];
        $email = $_POST["email"];
        $subject = "Response to your question";
        $url = "http://iloilo.x10host.com/answer-inquiry.php?email=$email&subject=$subject&reply=$message";
        echo "<script>sendMail('".$email."','".$subject."','".$message."')</script>";
        echo "<script>location.href='inquiry.php'</script>";
}
?>
