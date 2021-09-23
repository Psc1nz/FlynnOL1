<?php
/* Contact XL PHP Processing Script by Steve Riches - RichoSoft Squared - (C) 2017 - All Rights Reserved */
/* August 2017 - www.richosoft2.co.uk */
include 'secret.php';
$sendfrom=explode(',', $_POST['sendto']);
// Set Site Email Addresses Here
/* This email must be one set up on your domain for most hosts and is the email to send mail from */
$siteemailtosend=$sendfrom[0];
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
   echo '{"response":9}';
   return false;
   }
   
$thefiles = strip_tags(htmlspecialchars($_POST['thefiles'])); 
$filenames = explode("|",$thefiles);
$selectdate = strip_tags(htmlspecialchars($_POST['selectdate']));
$selectdatename = strip_tags(htmlspecialchars($_POST['selectdatename']));
$selectdate2 = strip_tags(htmlspecialchars($_POST['selectdate2']));
$selectdatename2 = strip_tags(htmlspecialchars($_POST['selectdatename2']));
$selectpeops = strip_tags(htmlspecialchars($_POST['selectpeops']));
$selectpeopsname = strip_tags(htmlspecialchars($_POST['selectpeopsname']));
$selectrtype = strip_tags(htmlspecialchars($_POST['selectrtype']));
$selectrtypename = strip_tags(htmlspecialchars($_POST['selectrtypename']));
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$address1 = strip_tags(htmlspecialchars($_POST['address1']));
$address2 = strip_tags(htmlspecialchars($_POST['address2']));
$city = strip_tags(htmlspecialchars($_POST['city']));
$county = strip_tags(htmlspecialchars($_POST['county']));
$country = strip_tags(htmlspecialchars($_POST['country']));
$postcode = strip_tags(htmlspecialchars($_POST['postcode']));
$mobile = strip_tags(htmlspecialchars($_POST['mobile']));
$company = strip_tags(htmlspecialchars($_POST['company']));
$gender = strip_tags(htmlspecialchars($_POST['gender']));
$copyto=strip_tags(htmlspecialchars($_POST['copyto']));
$websiteurl=strip_tags(htmlspecialchars($_POST['websiteurl']));
$linkedinurl=strip_tags(htmlspecialchars($_POST['linkedinurl']));
$facebookurl=strip_tags(htmlspecialchars($_POST['facebookurl']));
$ipaddress = $_SERVER["REMOTE_ADDR"];   
$response=$_POST["captcha"];
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
		echo '{"response":5}';
		exit();
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
$verify=url_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
$captcha_success=json_decode($verify);
if ($captcha_success->success==false) {
echo '{"response":8}';
return false;
}
else if ($captcha_success->success==true) {
// Create the email and send the message
$to = $siteemailtoreceive;
$eol = PHP_EOL;
$email_subject = "Website Contact From:  $name";;
if($address1=="|na|"){$address1s="";}else{$address1s=$address1;}
if($address2=="|na|"){$address2s="";}else{$address2s=$address2;}
if($city=="|na|"){$citys="";}else{$citys=$city;}
if($county=="|na|"){$countys="";}else{$countys=$county;}
if($country=="|na|"){$countrys="";}else{$countrys=$country;}
if($postcode=="|na|"){$postcodes="";}else{$postcodes=$postcode;}
			$email_body= '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Website Contact Form</title></head><body style="font-family:Verdana,sans-serif;font-size:12px;width:800px;">'.$eol;
			$email_body= $email_body.'<div style="width:800px;font-family:Verdana,sans-serif;font-size:12px;text-align:center;">'.$eol;
			$email_body= $email_body.'<center><h2 style="text-align:center;"<strong>You have received a submission from your Website Contact form, here are the details:</strong></h2></center><br><br></div>'.$eol;
			$email_body= $email_body.'<div style="width:790px;font-family:Verdana,sans-serif;font-size:12px;text-align:left;">'.$eol;
			$email_body= $email_body.'<table style="width:100%;"><tr><td style="width:50%;"><strong>Date:</strong> '.date("l jS \of F Y").'</td><td style="width:50%;text-align:right;"><strong>From Name:</strong> '.$name.'</td></tr>'.$eol;
			$email_body= $email_body.'<tr><td colspan="2"><strong>Email:</strong> '.$email_address.'</td></tr>'.$eol;
if($subject!="|na|"){
			$email_body= $email_body.'<tr><td colspan="2"><strong>Subject:</strong> '.$subject.'</td></tr>'.$eol;
}			
			$email_body= $email_body.'<tr><td colspan="2"><strong>Message:</strong> '.$message.'</td></tr>'.$eol;
			$email_body= $email_body.'<tr><td><strong>Phone:</strong></td><td>'.$phone.'</td></tr>'.$eol;
if($mobile!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Mobile:</strong> </td><td>'.$mobile.'</td></tr>'.$eol;
}
if($address1!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Address Line 1:</strong> </td><td>'.$address1s.'</td></tr>'.$eol;
}
if($address2!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Address Line 2:</strong> </td><td>'.$address2s.'</td></tr>'.$eol;
}
if($city!="|na|"){
			$email_body= $email_body.'<tr><td><strong>City/Town:</strong> </td><td>'.$citys.'</td></tr>'.$eol;
}
if($county!="|na|"){
			$email_body= $email_body.'<tr><td><strong>County/State/Province:</strong> </td><td>'.$countys.'</td></tr>'.$eol;
}
if($country!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Country:</strong> </td><td>'.$countrys.'</td></tr>'.$eol;
}
if($postcode!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Postcode/Zip:</strong> </td><td>'.$postcodes.'</td></tr>'.$eol;
}
if($company!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Company:</strong> </td><td>'.$company.'</td></tr>'.$eol;
}
if($selectdate!="|na|"){
			$email_body= $email_body.'<tr><td><strong>'.$selectdatename.':</strong> </td><td>'.$selectdate.'</td></tr>'.$eol;
}
if($selectdate2!="|na|"){
			$email_body= $email_body.'<tr><td><strong>'.$selectdatename2.':</strong> </td><td>'.$selectdate2.'</td></tr>'.$eol;
}
if($selectpeops!="|na|"){
			$email_body= $email_body.'<tr><td><strong>'.$selectpeopsname.':</strong> </td><td>'.$selectpeops.'</td></tr>'.$eol;
}
if($selectrtype!="|na|"){
			$email_body= $email_body.'<tr><td><strong>'.$selectrtypename.':</strong> </td><td>'.$selectrtype.'</td></tr>'.$eol;
}
if($gender!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Gender:</strong> </td><td>'.$gender.'</td></tr>'.$eol;
}
if($websiteurl!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Web Site URL:</strong> </td><td>'.$websiteurl.'</td></tr>'.$eol;
}
if($facebookurl!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Facebook URL:</strong> </td><td>'.$facebookurl.'</td></tr>'.$eol;
}
if($linkedinurl!="|na|"){
			$email_body= $email_body.'<tr><td><strong>Linked In URL:</strong> </td><td>'.$linkedinurl.'</td></tr>'.$eol;
}
if(count($filenames)>0 && $filenames[0]!="na" && $filenames[1]!="na"){
for($i=0;$i<count($filenames);$i++){
if($filenames[$i]!="" && $filenames[$i]!==null){
			$email_body= $email_body.'<tr><td><strong>Attached File:</strong> </td><td>'.$filenames[$i].'</td></tr>'.$eol;
}
}
}
else
{
			$email_body= $email_body.'<tr><td><strong>Attached Files:</strong> </td><td>NONE</td></tr>'.$eol;
}
			$email_body= $email_body.'<tr><td colspan="2"><strong>Sender&#39;s IP Address:</strong> '.$ipaddress.'</td></tr>'.$eol;
			$email_body= $email_body.'<tr><td colspan="2"><strong>Form on page:</strong> '.$_SERVER["HTTP_REFERER"].'</td></tr>'.$eol;
			$email_body = $email_body.'</table></div></body></html>'.$eol;
$headerss = "From: $siteemailtosend\n";
$headerss .= "Reply-To: $email_address\n";
$headerss .= "X-Mailer: PHP/".phpversion();
$content = chunk_split(base64_encode($content));
// boundary 
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // headers for attachment 
    $headerss .= "MIME-Version: 1.0\r\n" . "Content-Type: multipart/mixed;" . " boundary=\"{$mime_boundary}\""; 

    // multipart boundary 
    $mmessage = "--{$mime_boundary}".$eol . "Content-Type: text/html; charset=\"utf-8\"".$eol . "Content-Transfer-Encoding: 7bit".$eol.$eol . $email_body .$eol; 
if(count($filenames)>0 && $filenames[0]!="na" && $filenames[1]!="na"){
for($i=0;$i<count($filenames);$i++){
if($filenames[$i]!="" && $filenames[$i]!==null){
$file = "../php/uploads/".$filenames[$i];
$file_size = filesize($file);
$handle = fopen($file, "r");
$content = fread($handle, $file_size);
fclose($handle);
$content = chunk_split(base64_encode($content));
$mmessage .= "--{$mime_boundary}".$eol;
$mmessage .= "Content-Type: application/octet-stream; name=\"".$filenames[$i]."\"".$eol;
$mmessage .= "Content-Transfer-Encoding: base64".$eol;
$mmessage .= "Content-Disposition: attachment; filename=\"".$filenames[$i]."\"".$eol.$eol;
$mmessage .= $content.$eol;

}
}
}
$mmessage .= "--{$mime_boundary}--".$eol;

if(!mail($to,$email_subject,$mmessage,$headerss)){
echo '{"response":7}';
exit();
}
else
{
if($copyto!="|na|"){
$email_subject = "Copy of your Submission to $copyto on the Website Contact Form";
$email_body = "You submitted data to $copyto on the web site contact form.\n\r\n";
$email_body = $email_body."These are the details you submitted:\n\r\n";
$email_body = $email_body."Name: $name\n\r\n";
$email_body = $email_body."Email: $email_address\n\r\n";
if($subject!="|na|"){$email_body = $email_body."Subject: $subject\n\r\n";}
$email_body = $email_body."Message:\n$message\n\n\r\n";
$email_body = $email_body."Phone: $phone\n\r\n";
if($mobile!="|na|"){$email_body = $email_body."Mobile/Cell: $mobile\n\r\n";}
if($address1!="|na|"){$email_body = $email_body."Address 1: $address1\r\n";}
if($address2!="|na|"){$email_body = $email_body."Address 2: $address2\r\n";}
if($city!="|na|"){$email_body = $email_body."City/Town: $city\r\n";}
if($county!="|na|"){$email_body = $email_body."County/State/Province: $county\r\n";}
if($country!="|na|"){$email_body = $email_body."Country: $country\r\n";}
if($postcode!="|na|"){$email_body = $email_body."Post Code/Zip: $postcode\n\r\n";}
if($company!="|na|"){$email_body = $email_body."Company: $company\n\r\n";}
if($selectdate!="|na|"){$email_body = $email_body.$selectdatename.": $selectdate\n\r\n";}
if($selectdate2!="|na|"){$email_body = $email_body.$selectdatename2.": $selectdate2\n\r\n";}
if($selectpeops!="|na|"){$email_body = $email_body.$selectpeopsname.": $selectpeops\n\r\n";}
if($selectrtype!="|na|"){$email_body = $email_body.$selectrtypename.": $selectrtype\n\r\n";}
if($gender!="|na|"){$email_body = $email_body."Gender: $gender\n\r\n";}
if($websiteurl!="|na|"){$email_body = $email_body."Web Site: $websiteurl\r\n";}
if($facebookurl!="|na|"){$email_body = $email_body."Facebook Page: $facebookurl\r\n";}
if($linkedinurl!="|na|"){$email_body = $email_body."Linked In Page: $linkedinurl\n\r\n";}
if(count($filenames)>0 && $filenames[0]!="na" && $filenames[1]!="na"){
for($i=0;$i<count($filenames);$i++){
if($filenames[$i]!="" && $filenames[$i]!==null){
$email_body = $email_body."You attached file : $filenames[$i]\n\r\n";
}
}
}
$email_body = $email_body."Thank you for your submission.\n\r\n";
$email_body = $email_body."The Team at $copyto\n\r\n";
$email_body = $email_body."Your IP Address: $ipaddress\n\r\n";
$email_body = $email_body."Sent from the Form on page: ".$_SERVER['HTTP_REFERER']."\n\r\n";
$headers = "From: $siteemailtosend\n";
$headers .= "Reply-To: $siteemailtosend\n";
$headers .= "Mime-Version: 1.0\n";
$headers .= "Content-type: text/plain; charset=UTF-8\n";	
$headers .= "X-Mailer: PHP/".phpversion();
mail($email_address,$email_subject,$email_body,$headers);
}
	echo '{"response":2}';
return true;       
}
}
?>
