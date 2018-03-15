<?php
/**
 * Email Builder
 * Send Email
 *
 * Product Homepage: http://getemailbuilder.com
 * Author: DigitalWheat
 * Author URI: http://digitalwheat.com
 *
 */

date_default_timezone_set('Etc/UTC');

// Prevent direct access to this file
define('IS_AJAX',
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}

// Include PHPMailer
require_once 'vendor/PHPMailer/PHPMailerAutoload.php';

// Include config
require_once '_config.php';

if (!isset($_POST['action'])) {
    die('Missed action');
}

if ($_POST['action'] !== 'send-test-emails') {
    die('Wrong action');
}


$statusMsg = '';
$statusType = ''; //success  or danger
$hasError = false;
// Escape string
$email = trim($_POST['emails']);
$templateHTML = base64_decode($_POST['templateHTML']);
/*
 * Check form data for errors
 */
if ($email == '') {
    $statusMsg = "Please enter email address";
    $statusType = "danger"; //success  or danger
    $hasError = true;
}

if (!$hasError) {
        if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]/i", $email)) {
            $statusMsg = "Please enter a valid email address";
            $statusType = "danger"; //success  or danger
            $hasError = true;
        }
}

// Exit if there is an error
if ($hasError) {
    $response = array(
        'message' => $statusMsg,
        'type' => $statusType
    );
    print json_encode($response);
    exit;
}

// Otherwise send emails


/*
 * Send emails
 */

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $CONFIG['smtp']['host'];  // Specify main and backup SMTP servers
$mail->SMTPAuth = $CONFIG['smtp']['auth'];                               // Enable SMTP authentication
$mail->Username = $CONFIG['smtp']['username'];                 // SMTP username
$mail->Password = $CONFIG['smtp']['password'];                           // SMTP password
$mail->SMTPSecure = $CONFIG['smtp']['secure'];                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $CONFIG['smtp']['port'];                                    // TCP port to connect to

$mail->setFrom($CONFIG['mail']['from_email'], $CONFIG['mail']['from_name']);

$mail->addAddress($email); // Name is optional

$mail->isHTML(true); // Set email format to HTML

$mail->Subject = $CONFIG['mail']['subject'];
$mail->Body    = $templateHTML;
$mail->AltBody = $CONFIG['mail']['alt_body'];

if(!$mail->send()) {
    $statusMsg = "Message could not be sent. Error: " . $mail->ErrorInfo;
    $statusType = "danger";
} else {
    $statusMsg = "Thank you! Email has been sent successfully!";
    $statusType = "success";
}

//unset vars
unset($_SERVER['REQUEST_METHOD']);
unset($_POST);
$_POST = null;


/*
 * Return AJAX response
 */
$response = array(
    'message' => $statusMsg,
    'type' => $statusType
);
print json_encode($response);
exit;






