<?php
session_start();
require 'config.php';

if ($_SESSION['role'] != 'student') {
    header("Location: index.html");
    exit;
}

$student_id = $_SESSION['user_id'];
$academic_year = $_POST['academic_year'];
$term = $_POST['term'];

$stmt = $pdo->prepare("SELECT * FROM results WHERE student_id = ? AND academic_year = ? AND term = ?");
$stmt->execute([$student_id, $academic_year, $term]);
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="results-container">
        <h2>Results for Academic Year: <?php echo $academic_year; ?>, Term: <?php echo $term; ?></h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
            </tr>
            <?php foreach ($results as $result): ?>
            <tr>
                <td><?php echo $result['subject']; ?></td>
                <td><?php echo $result['grade']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button onclick="window.print()">Print Results</button>
    </div>
</body>
</html>
