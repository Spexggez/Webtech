<?php
require_once 'Model/CaptainModel.php';
require_once 'Model/TournamentModel.php';

class MainController {

    public function loadLogin() {
        require_once 'View/loginascaptain.php';
    }

    public function loadRegister() {
        require_once 'View/registerascaptain.php';
    }

    public function login() {
        global $conn;
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = getCaptainByEmail($conn, $email);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['captain_id'] = $user['id'];
                $_SESSION['ign'] = $user['ign'];
                
                if (isset($_POST['remember_me'])) {
                    setcookie("remember_email", $email, time() + (86400 * 30), "/"); 
                } else {
                    setcookie("remember_email", "", time() - 3600, "/"); 
                }
                
                header("Location: index.php?action=dashboard");
                exit;
            }
        }
        header("Location: index.php?action=login_page&error=invalid");
    }

    public function register() {
        global $conn;
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $ign = $_POST['ign'];
            $game = $_POST['game'];
            $password = $_POST['password'];

            registerCaptain($conn, $name, $phone, $email, $ign, $game, $password);
            header("Location: index.php?action=login_page&success=registered");
        }
    }

    public function loadDashboard() {
        global $conn;
        if (!isset($_SESSION['captain_id'])) { 
            header("Location: index.php"); 
            exit; 
        }
        $tournaments = getUpcomingTournaments($conn);
        require_once 'View/captaindashboard.php';
    }

    public function loadRoster() {
        global $conn;
        if (!isset($_SESSION['captain_id'])) { 
            header("Location: index.php"); 
            exit; 
        }
        $captain_id = $_SESSION['captain_id'];
        $roster = getTeamRoster($conn, $captain_id);
        require_once 'View/rosterinfo.php';
    }

    public function addRoster() {
        global $conn;
        if (!empty($_POST['ign']) && !empty($_POST['real_name'])) {
            $captain_id = $_SESSION['captain_id'];
            $real_name = $_POST['real_name'];
            $ign = $_POST['ign'];
            $phone = $_POST['phone'];
            
            addRosterMember($conn, $captain_id, $real_name, $ign, $phone);
        }
        header("Location: index.php?action=roster");
    }

    public function editRoster() {
        global $conn;
        if (!empty($_POST['member_id']) && !empty($_POST['ign'])) {
            $member_id = $_POST['member_id'];
            $captain_id = $_SESSION['captain_id'];
            $real_name = $_POST['real_name'];
            $ign = $_POST['ign'];
            $phone = $_POST['phone'];
            
            updateRosterMember($conn, $member_id, $captain_id, $real_name, $ign, $phone);
        }
        header("Location: index.php?action=roster");
    }

    public function deleteRosterAjax($member_id) {
        global $conn;
        header('Content-Type: application/json');
        $captain_id = $_SESSION['captain_id'];
        
        $success = deleteRosterMember($conn, $member_id, $captain_id);
        
        if ($success) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function loadTournaments() {
        global $conn;
        if (!isset($_SESSION['captain_id'])) { 
            header("Location: index.php"); 
            exit; 
        }
        $tournaments = getUpcomingTournaments($conn);
        require_once 'View/tournaments.php';
    }

    public function enrollTournament() {
        global $conn;
        if (!empty($_POST['tournament_id'])) {
            registerForTournament($conn, $_SESSION['captain_id'], $_POST['tournament_id']);
        }
        header("Location: index.php?action=tournaments");
    }

    public function submitScore() {
        global $conn;
        if (!empty($_POST['tournament_id']) && !empty($_POST['score']) && isset($_FILES['screenshot'])) {
            $fileError = $_FILES['screenshot']['error'];
            
            if ($fileError == 0) {
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                $fileName = time() . '_' . basename($_FILES['screenshot']['name']);
                $uploadPath = 'uploads/' . $fileName;
                
                if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadPath)) {
                    submitScoreProof($conn, $_SESSION['captain_id'], $_POST['tournament_id'], $_POST['score'], $uploadPath);
                }
            }
        }
        header("Location: index.php?action=dashboard");
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
?>