<?php
require_once __DIR__ . '/../db.php';

function getCaptainByEmail($conn, $email) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "SELECT * FROM captains WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function registerCaptain($conn, $name, $phone, $email, $ign, $game, $password) {
    if (!$conn) {
        global $conn;
    }
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO captains (real_name, phone, email, ign, game, password) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $phone, $email, $ign, $game, $hashed);
    return mysqli_stmt_execute($stmt);
}

function getTeamRoster($conn, $captain_id) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "SELECT * FROM rosters WHERE captain_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $captain_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addRosterMember($conn, $captain_id, $real_name, $ign, $phone) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "INSERT INTO rosters (captain_id, real_name, ign, phone) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isss", $captain_id, $real_name, $ign, $phone);
    return mysqli_stmt_execute($stmt);
}

function updateRosterMember($conn, $member_id, $captain_id, $real_name, $ign, $phone) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "UPDATE rosters SET real_name = ?, ign = ?, phone = ? WHERE id = ? AND captain_id = ?");
    mysqli_stmt_bind_param($stmt, "sssii", $real_name, $ign, $phone, $member_id, $captain_id);
    return mysqli_stmt_execute($stmt);
}

function deleteRosterMember($conn, $member_id, $captain_id) {
    if (!$conn) {
        global $conn;
    }
    $stmt = mysqli_prepare($conn, "DELETE FROM rosters WHERE id = ? AND captain_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $member_id, $captain_id);
    return mysqli_stmt_execute($stmt);
}
?>