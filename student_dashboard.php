<?php
session_start();
require 'config.php';

if ($_SESSION['role'] != 'student') {
    header("Location: index.php");
    exit;
}

$student_id = $_SESSION['user']['id'];

// Fetch student information
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

// Fetch student results
$stmt = $pdo->prepare("SELECT DISTINCT year FROM results WHERE student_id = ?");
$stmt->execute([$student_id]);
$years = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - AISHATU BEST ACADEMY KANO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="AISHATU BEST ACADEMY KANO Logo">
        </div>
    </header>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($student['name']); ?></h2>
        <h3>Biodata:</h3>
        <p>Class: <?php echo htmlspecialchars($student['class']); ?></p>
        <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
        <img src="uploads/<?php echo htmlspecialchars($student['image']); ?>" alt="Profile Picture" width="150px" height="150px">
        
        <h3>View Results:</h3>
        <form action="view_results.php" method="post">
            <select name="academic_year" required>
                <option value="">Select Academic Year</option>
                <?php foreach ($years as $year): ?>
                    <option value="<?php echo $year['year']; ?>"><?php echo $year['year']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="term" required>
                <option value="1">1st Term</option>
                <option value="2">2nd Term</option>
                <option value="3">3rd Term</option>
            </select>
            <button type="submit">View Results</button>
        </form>
    </div>
</body>
</html>
