<?php

require_once 'session.php';
require_once 'DB.php';
require_once 'helpers.php';

if (isset($_POST['register'])) {
    $input = clean($_POST);

    $name = $input['name'];
    $contact = $input['contact'];
    $descr = $input['descr'];
    $adder1 = $input['adder1'];
    $adder2 = $input['adder2'];
    $city = $input['city'];
    $password = password_hash($input['password'], PASSWORD_DEFAULT); // Hash the password
    $profession = $input['profession'];

    $photo = $_FILES['photo'];

    $file1 = upload($photo); // Assuming upload() handles file upload and returns filename or false on failure

    if ($file1 === false) {
        header('Location: ../register.php?msg=file');
        exit();
    }

    // Insert provider data into the database with avg_rating as 0.0 by default
    $isProviderCreated = DB::query("INSERT INTO providers (name, contact, descr, adder1, adder2, city, password, photo, profession, avg_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
        $name, $contact, $descr, $adder1, $adder2, $city, $password, $file1, $profession, 0.0
    ]);

    if ($isProviderCreated) {
        header('Location: ../register.php?msg=success');
        exit();
    } else {
        // Delete the uploaded file on failure
        unlink('../storage/' . $file1);
        header('Location: ../register.php?msg=failed');
        exit();
    }
}
?>
