<?php
/* Contact PHP Processing Script by Steve Riches - RichoSoft Squared - (C) 2017 - All Rights Reserved */
/* August 2017 - www.richosoft2.co.uk */

// Set Site Email Addresses Here
/* This email must be one set up on your domain for most hosts and is the email to send mail from */
$siteemailtosend=$_POST['sendto'];
/* This email is your email to receive the contact form details and can be the same as the one above if required */
$siteemailtoreceive=$_POST['sendto'];
// ******************************************************************
// DO NOT EDIT ANYTHING BELOW HERE UNLESS YOU KNOW WHAT YOU ARE DOING
// ******************************************************************
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No Values Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$ipaddress = $_SERVER["REMOTE_ADDR"];   
// Create the email and send the message
$to = $siteemailtoreceive;
$email_subject = "Website Contact From:  $name";
$email_body = "You have received a new message from your website contact form.\n\r\n";
$email_body = $email_body."Here are the details:\n\r\n";
$email_body = $email_body."Name: $name\n\r\n";
$email_body = $email_body."Email: $email_address\n\r\n";
$email_body = $email_body."Phone: $phone\n\r\n";
$email_body = $email_body."Message:\n$message\n\n\r\n";
$email_body = $email_body."Sender's IP Address: $ipaddress\n\r\n";
$email_body = $email_body."Form on page: ".$_SERVER['HTTP_REFERER']."\n\r\n";
$headers = "From: $siteemailtosend\n";
$headers .= "Reply-To: $email_address\n";
$headers .= "Mime-Version: 1.0\n";
$headers .= "Content-type: text/plain; charset=UTF-8\n";
mail($to,$email_subject,$email_body,$headers);
echo $_GET["jsoncall"].'{"response":2}';
return true;       
?>
