<?php
session_start();
require 'config.php';

if ($_SESSION['role'] != 'teacher') {
    header("Location: index.php");
    exit;
}

$teacher_id = $_SESSION['user']['id'];

// Fetch teacher information
$stmt = $pdo->prepare("SELECT * FROM teachers WHERE id = ?");
$stmt->execute([$teacher_id]);
$teacher = $stmt->fetch();

// Fetch assigned students
$stmt = $pdo->prepare("SELECT * FROM students WHERE class = ?");
$stmt->execute([$teacher['subject']]);
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - AISHATU BEST ACADEMY KANO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="AISHATU BEST ACADEMY KANO Logo">
        </div>
    </header>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($teacher['name']); ?></h2>
        <h3>Subject: <?php echo htmlspecialchars($teacher['subject']); ?></h3>
        <h3>Assigned Students:</h3>
        <ul>
            <?php foreach ($students as $student): ?>
                <li><?php echo htmlspecialchars($student['name']); ?> - Class: <?php echo htmlspecialchars($student['class']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
