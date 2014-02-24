<?php
//$to      = 'hackerspace_brisbane+subscribe@googlegroups.com';
$to      = 'davidbuzz@gmail.com';
$subject = 'subscribe request';

// etrtrtert

include 'Mail.php';
include 'Mail/mime.php' ;

$text = 'Text version of email';
$html = '<html><body>HTML version of email</body></html>';
$crlf = "\n";
$hdrs = array(
              'From'    => 'nobody@hsbne.org',
              'To'    => $to,
              'Subject' => $subject,
              );

$mime = new Mail_mime(array('eol' => $crlf));

$mime->setTXTBody($text);
$mime->setHTMLBody($html);
#$mime->addAttachment($file, 'text/plain');

$body = $mime->get();
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail');
$mail->send($to, $hdrs, $body);


?>
