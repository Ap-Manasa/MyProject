<?php
include_once "./include/header.php";
include_once "./scripts/DB.php"; // Ensure the correct path to DB.php

if (isset($_GET['provider_id'])) {
    $provider_id = $_GET['provider_id'];

    // Fetch provider details using the DB class
    $stmt = DB::query("SELECT name, profession FROM providers WHERE id = ?", [$provider_id]);
    if ($stmt && $stmt->rowCount() > 0) {
        $provider = $stmt->fetch();
    } else {
        echo "Provider not found.";
        exit;
    }
} else {
    echo "Invalid provider.";
    exit;
}
?>

<div class="container" style="margin-top:20px;">
    <div class="jumbotron text-center">
        <h1 class="display-4">Rate Service Provider</h1>
        <p class="lead">Your feedback helps us improve our services.</p>
        <hr class="my-4">
        <p>Provider: <?= htmlspecialchars($provider['name']) ?> (<?= htmlspecialchars($provider['profession']) ?>)</p>
    </div>

    <form action="scripts/submit_rating.php" method="post">
        <div class="form-group">
            <label for="rating">Rating</label>
            <select class="form-control" name="rating" id="rating" required>
                <option value="">-- Select Rating --</option>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comments">Comments</label>
            <textarea class="form-control" name="comments" id="comments" rows="4" required></textarea>
        </div>
        <input type="hidden" name="provider_id" value="<?= htmlspecialchars($provider_id) ?>">
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </div>
    </form>
</div>

<?php include_once "./include/footer.php"; ?>
