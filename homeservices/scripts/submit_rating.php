<?php
include_once "../scripts/DB.php"; // Ensure the correct path to DB.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $provider_id = $_POST['provider_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    // Validate inputs
    if (!empty($provider_id) && !empty($rating) && !empty($comments)) {
        // Insert rating into the database
        $sql = "INSERT INTO ratings (provider_id, rating, comments) VALUES (?, ?, ?)";
        $result = DB::query($sql, [$provider_id, $rating, $comments]);

        if ($result) {
            echo "Thank you for your feedback!";
        } else {
            echo "Failed to submit rating.";
        }
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request.";
}
?>
