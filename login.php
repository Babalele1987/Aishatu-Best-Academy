<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
    $stmt->execute([$username, $role]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        if ($role == 'teacher') {
            header("Location: teacher_dashboard.php");
        } elseif ($role == 'student') {
            header("Location: student_dashboard.php");
        } elseif ($role == 'management') {
            header("Location: management_dashboard.php");
        }
    } else {
        echo "Invalid credentials.";
    }
}
?>
