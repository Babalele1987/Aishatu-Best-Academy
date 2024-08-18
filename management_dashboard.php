<?php
session_start();
require 'config.php';

if ($_SESSION['role'] != 'management') {
    header("Location: index.php");
    exit;
}

$management_id = $_SESSION['user']['id'];

// Fetch management information
$stmt = $pdo->prepare("SELECT * FROM management WHERE id = ?");
$stmt->execute([$management_id]);
$management = $stmt->fetch();

// Fetch all students
$stmt = $pdo->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll();

// Fetch all teachers
$stmt = $pdo->prepare("SELECT * FROM teachers");
$stmt->execute();
$teachers = $stmt->fetchAll();

// Fetch all fees information
$stmt = $pdo->prepare("SELECT * FROM fees");
$stmt->execute();
$fees = $stmt->fetchAll();

// Handle adding a new fee
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO fees (student_id, amount, status) VALUES (?, ?, ?)");
    $stmt->execute([$student_id, $amount, $status]);

    // Reload the page to see the new fee added
    header("Location: management_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard - AISHATU BEST ACADEMY KANO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="AISHATU BEST ACADEMY KANO Logo">
        </div>
    </header>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($management['name']); ?></h2>

        <h3>All Students:</h3>
        <ul>
            <?php foreach ($students as $student): ?>
                <li><?php echo htmlspecialchars($student['name']); ?> - Class: <?php echo htmlspecialchars($student['class']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>All Teachers:</h3>
        <ul>
            <?php foreach ($teachers as $teacher): ?>
                <li><?php echo htmlspecialchars($teacher['name']); ?> - Subject: <?php echo htmlspecialchars($teacher['subject']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>School Fees Management:</h3>
        <ul>
            <?php foreach ($fees as $fee): ?>
                <li>
                    Student ID: <?php echo htmlspecialchars($fee['student_id']); ?> 
                    - Amount: <?php echo htmlspecialchars($fee['amount']); ?> 
                    - Status: <?php echo htmlspecialchars($fee['status']); ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <h3>Add New Fee:</h3>
        <form action="management_dashboard.php" method="post">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <select name="student_id" id="student_id" required>
                    <?php foreach ($students as $student): ?>
                        <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['id'] . ' - ' . $student['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
            <button type="submit">Add Fee</button>
        </form>
    </div>
</body>
</html>
