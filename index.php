<?php
session_start();
require_once 'Controller/MainController.php';

$captainController = new MainController();

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if ($contentType == "application/json") {
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);
    
    if (isset($data['action']) && $data['action'] == 'delete_roster') {
        $captainController->deleteRosterAjax($data['id']);
    }
    exit;
}

$action = 'login_page';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
}

if ($action == 'login_page') { $captainController->loadLogin(); }
else if ($action == 'register_page') { $captainController->loadRegister(); }
else if ($action == 'login') { $captainController->login(); }
else if ($action == 'register') { $captainController->register(); }
else if ($action == 'dashboard') { $captainController->loadDashboard(); }
else if ($action == 'roster') { $captainController->loadRoster(); }
else if ($action == 'add_roster') { $captainController->addRoster(); }
else if ($action == 'edit_roster') { $captainController->editRoster(); }
else if ($action == 'tournaments') { $captainController->loadTournaments(); }
else if ($action == 'enroll_tournament') { $captainController->enrollTournament(); }
else if ($action == 'submit_score') { $captainController->submitScore(); }
else if ($action == 'logout') { $captainController->logout(); }
else { $captainController->loadLogin(); }
?>