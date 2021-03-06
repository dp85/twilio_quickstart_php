<?php
/*
 * Creates an endpoint that can be used in your TwiML App as the Voice Request Url.
 *
 * In order to make an outgoing call using Twilio Voice SDK, you need to provide a
 * TwiML App SID in the Access Token. You can run your server, make it publicly
 * accessible and use `/makeCall` endpoint as the Voice Request Url in your TwiML App.
 */
include('./vendor/autoload.php');
include('./config.php');

$callerId = 'client:quick_start';
$to = isset($_POST["to"]) ? $_POST["to"] : "";
if (!isset($to) || empty($to)) {
  $to = isset($_GET["to"]) ? $_GET["to"] : "";
}

/*
 * Use a valid Twilio number by adding to your account via https://www.twilio.com/console/phone-numbers/verified
 */
$callerNumber = '1234567890';

$response = new Twilio\Twiml();
if (!isset($to) || empty($to)) {
  $response->say('Congratulations! You have just made your first call! Good bye.');
    // Default Twilio hold music
    $response->play("http://com.twilio.sounds.music.s3.amazonaws.com/ClockworkWaltz.mp3");
    $response->play("http://com.twilio.sounds.music.s3.amazonaws.com/BusyStrings.mp3");
    $response->play("http://com.twilio.sounds.music.s3.amazonaws.com/Mellotroniac_-_Flight_Of_Young_Hearts_Flute.mp3");
    $response->play("http://com.twilio.sounds.music.s3.amazonaws.com/MARKOVICHAMP-Borghestral.mp3");
} else if (is_numeric($to)) {
  $dial = $response->dial(
    array(
  	  'callerId' => $callerNumber
  	));
  $dial->number($to);
} else {
  $dial = $response->dial(
    array(
       'callerId' => $callerId
    ));
  $dial->client($to);
}

print $response;
