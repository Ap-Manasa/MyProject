<?php
require_once 'helpers.php';
require_once 'DB.php';
require_once 'C:\xamppp\htdocs\Myproject\twilio-php-main\src\Twilio\autoload.php'; // Path to Twilio SDK

use Twilio\Rest\Client;

$twilioSid =  'AC43532f72fd5d23e0788ce59b5d17760c';
$twilioToken = '00b1cc8341d04d5e53bddfe56d805eb8';
$twilioNumber =  '+13203773076';
$adminNumber = '+918123327769'; // Replace with your admin's phone number


if (isset($_POST['book'])) {
    $input = clean($_POST);

    $provider = $_POST['provider'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $adder = $_POST['adder'];
    $date = $_POST['date'];
    $queries = $_POST['queries'];
    $payment = $_POST['payment'];

    $sql = "INSERT INTO bookings values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?)";
    $isBooked = DB::query($sql, [
        $provider, $fname, $lname, $contact, $adder, $date, $payment, $queries
    ]);

    if ($isBooked) {
        // Send SMS notification to the admin
        $client = new Client($twilioSid, $twilioToken);
        $message = "New booking from $fname $lname. Contact: $contact. Address: $adder. Date: $date.";

        try {
            $client->messages->create(
                $adminNumber,
                [
                    'from' => $twilioNumber,
                    'body' => $message
                ]
            );
        } catch (Exception $e) {
            // Handle error (log it, show message, etc.)
        }

        header("Location: ../booking.php?provider=$provider&msg=success");
        exit();
    } else {
        header("Location: ../booking.php?provider=$provider&msg=failed");
        exit();
    }
}
?>
