<?php
session_start();
require 'config.php';

if ($_SESSION['role'] != 'teacher') {
    header("Location: index.html");
    exit;
}

$student_id = $_GET['student_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $academic_year = $_POST['academic_year'];
    $term = $_POST['term'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];

    $stmt = $pdo->prepare("INSERT INTO results (student_id, academic_year, term, subject, grade) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$student_id, $academic_year, $term, $subject, $grade])) {
        echo "Grades updated successfully!";
    } else {
        echo "Failed to update grades.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Grades</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="update-grades-container">
        <h2>Update Grades for Student ID: <?php echo $student_id; ?></h2>
        <form action="" method="post">
            <input type="text" name="academic_year" placeholder="Academic Year (e.g., 2023/2024)" required>
            <select name="term" required>
                <option value="1">1st Term</option>
                <option value="2">2nd Term</option>
                <option value="3">3rd Term</option>
            </select>
            <input type="text" name="subject" placeholder="Subject" required>
            <input type="text" name="grade" placeholder="Grade" required>
            <button type="submit">Update Grades</button>
        </form>
    </div>
</body>
</html>
