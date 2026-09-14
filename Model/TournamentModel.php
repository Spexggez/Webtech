<?php
require_once __DIR__ . '/../db.php';

function getUpcomingTournaments($conn) {
    if (!$conn) {
        global $conn;
    }
    $query = "SELECT * FROM tournaments ORDER BY event_date ASC";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function registerForTournament($conn, $captain_id, $tournament_id) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "INSERT INTO tournament_registrations (captain_id, tournament_id) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ii", $captain_id, $tournament_id);
    return mysqli_stmt_execute($stmt);
}

function submitScoreProof($conn, $captain_id, $tournament_id, $score, $uploadPath) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "INSERT INTO match_scores (captain_id, tournament_id, score, proof_image) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiss", $captain_id, $tournament_id, $score, $uploadPath);
    return mysqli_stmt_execute($stmt);
}
?>