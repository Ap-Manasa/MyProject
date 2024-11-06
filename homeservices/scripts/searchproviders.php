<?php
require_once 'helpers.php';
require_once 'DB.php';

if (isset($_POST['city']) && isset($_POST['profession'])) {
    $input = clean($_POST);
    $city = $input['city'];
    $profession = $input['profession'];

    // SQL query to fetch providers and their average ratings
    $sql = "SELECT p.*, COALESCE(AVG(r.rating), 0) AS avg_rating
            FROM providers p
            LEFT JOIN ratings r ON p.id = r.provider_id
            WHERE p.city = ? AND p.profession = ?
            GROUP BY p.id";

    $stmt = DB::query($sql, [$city, $profession]);
    $providers = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($providers) {
        echo json_encode($providers);
    } else {
        echo '{"failed": true}';
    }
}
?>
