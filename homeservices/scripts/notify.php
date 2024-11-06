<?php
// Include necessary files and perform any checks here
include_once "DB.php"; // Adjust the path if necessary
use Twilio\Rest\Client;


if (isset($_POST['notify'])) {
    $provider_id = $_POST['id'];
    $provider_phone = $_POST['contact'];

    // Example code to send notification
    $message = "You have a new booking. Please log in to the admin panel for details.";
    
    // Code to send SMS using Twilio or any other service
    // Example using Twilio
    require_once 'C:\xamppp\htdocs\Myproject\twilio-php-main\src\Twilio\autoload.php'; 
    
    $twilioSid = 'AC1e0a68eb6e7085600377506008d86e7e';
    $twilioToken = '29d310dbf4b9b3ef936a40f6061c51b5';
    $twilioNumber = '+12138166860';

    try {
        $client = new Client($twilioSid, $twilioToken);
        $client->messages->create(
            $provider_phone,
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        );
        
        // Redirect back to managehall.php with success message
        header("Location: notify_success.php");
        exit();
    } catch (Exception $e) {
        // Handle errors
        echo 'Message could not be sent. Error: ' . $e->getMessage();
    }
}
?>
