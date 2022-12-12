<!-- Personalised query that actually sends an email to me(the author of project) -->

<?php
if($_POST["submit"]=="query") 
{
    $recipient="zizipholamla27@gmail.com";
    $subject="Query from Funko World";
    $sender=$_POST["sender"];
    $senderEmail=$_POST["senderEmail"];
    $message=$_POST["message"];
    $mailBody="Name: $sender\nEmail: $senderEmail\n\n$message";
    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

    $resSub = "Confirmation of receiving your query";
    $resBody= "Dear ". $sender ."\n\nThanks for reaching out to us.\nWe have received your query and will get back to you shortly.";
    $note="\n\nNote : This is an auto-generated mail do not reply to this.\nFrom: http://localhost/Projects/onlineStore/index.php?Message=Please%20login%20To%20continue!";
    $resBody=$resBody . $note;
    mail($senderEmail , $resSub , $resBody);   
    header("location: index.php?response="."Your Message has been sent! We will respond shortly. Thank you for your patience."); 
}
?>	