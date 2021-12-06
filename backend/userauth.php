<?php
require_once("conn.php");
require_once("credential.php");
$uname = base64_decode(urldecode($_REQUEST[md5('uname')]));

echo "<pre>";
var_dump($uname);
echo "</pre>";

$user = $conn->query("select * from user where username= '$uname'")->fetch_assoc();

// echo "<pre>";
// var_dump($user);
// echo "</pre>";

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//use PHPMailer\PHPMailer\PHPMailer;

//Import PHPMailer classes into the global namespace
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

//require '../vendor/autoload.php';

require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");

//Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = $host;
// Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = $port;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPSecure = "ssl";

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $email;

//Password to use for SMTP authentication
$mail->Password = $pass;

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('no-reply-ahihistore@ahihistore.masuk.id', 'No Reply Ahihi Store');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses

// $mail->addReplyTo('cs@ahihistore.masuk.id', 'Master Egg reply');

//Set who the message is to be sent to
$mail->addAddress($uname, $user['nama']);

//Set the subject line
$mail->Subject = 'Verification on Ahihi Store';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

//TODO  
$token = $user['token'];
// link bisa disesuaikan masing" directory
$linkonly = "http://localhost/proyekpw/ProyekPW/backend/verification.php?token=$token";
$linkjelek = "<a href='$linkonly'>Click Here!</a>";
$link = "<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <style>
    .wrapper {
      padding: 20px;
      color: #444;
      font-size: 1.3em;
    }
    a {
      background: #592f80;
      text-decoration: none;
      padding: 8px 15px;
      border-radius: 5px;
      color: #fff;
    }
  </style>
</head>

<body>
  <div class='wrapper'>
    <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
    <a href='$linkonly'>Verify Email!</a>
  </div>
</body>

</html>";
$mail->msgHTML($link);

//Replace the plain text body with one created manually
$mail->AltBody = 'Link verifikasi: '.$linkjelek;

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    header("Location: ../index.php");
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}


?>