<?php

/* Settings
---------------------*/
include('settings.php');

/* Get Data
---------------------*/
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($url);
parse_str($parts['query'], $query);

foreach ($query as $name => $value) {
	$content .= ucfirst($name) . ': ' . $value . '<br />';
}


/* Form Functions
---------------------*/
$subject = ucwords($site_title) . ' ' . ucwords($form_type);

$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head></head><body bgcolor="#FFFFFF">


		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<base target="_blank">



		<div class="background" style="width: 100%;background: 100%;margin: 0;background-color: #f4f4f4;padding-bottom: 40px;">
			<div class="logo no-margin" style="background-color: ' . $headerbar_color . ' ;height: 44px;width: 100%;margin-bottom: 0;overflow: hidden;">
					<p style="color: white;line-height: 1.4em;font-family:Arial;font-size: 15px; font-weight:800; margin-left:20px; margin-top:10px;">' . $site_title . ' - '. ucwords($form_type) . '</p>
				</div><!--end .logo-->
			<div class="container" style="margin: 0 auto;padding-bottom: 20px;width: 95%;max-width: 680px;background-color: #fff;border: 1px solid #dfdfdf;border-top: none;">

				<div class="header" style="padding-top:20px; margin: 0 20px 20px;overflow: hidden;">
					<h1 mc:edit="header" style="font-family:Arial;font-size: 20px;line-height: 1.2em;margin: 0 0 5px;color: #222;">Hi ' . $webmaster_name . ',</h1>
					<p mc:edit="main" class="intension" style="color: #555;line-height: 1.4em;font-family:Arial;font-size: 15px;margin: 0;"> We received ' . $form_type . ' from your website.</b></p><br />
					<p mc:edit="main" class="intension" style="color: #555;line-height: 1.4em;font-family:Arial;font-size: 15px;margin: 0;">'. $content .'</b></p>
					<br />
					<p mc:edit="main" class="intension" style="color: #555;line-height: 1.4em;font-family:Arial;font-size: 15px;margin: 0;"><b>Email sent by yoongfook CMS

				</div><!--end .header-->


			</div><!--end .container-->

		<!-- end .background-->

</body></html>';
//echo $body;

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: ' . $site_title . ' <no-reply@email.com>' . "\r\n";

if(mail($email_to, $subject, $body, $headers)) {
	if(isset($success_redirect)) {
		header("Location: $success_redirect");
	} else {
		echo 'success';
	}
}

?>