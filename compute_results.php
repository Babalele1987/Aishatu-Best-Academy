<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $maths = $_POST['maths'];
    $english = $_POST['english'];
    $science = $_POST['science'];
    $social_studies = $_POST['social_studies'];

    $total = $maths + $english + $science + $social_studies;
    $average = $total / 4;

    $query = "INSERT INTO results (student_id, maths, english, science, social_studies, total, average) VALUES ('$student_id', '$maths', '$english', '$science', '$social_studies', '$total', '$average')";

    if (mysqli_query($conn, $query)) {
        $success = "Results computed successfully!";
    } else {
        $error = "Failed to compute results!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compute Results - AISHATU BEST ACADEMY KANO</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <div class="container">
            <img src="images/logo.png" alt="AISHATU BEST ACADEMY KANO Logo" class="logo-img mb-2">
            <div class="animated-text">
                <p>AISHATU BEST ACADEMY KANO</p>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center">Compute Student Results</h2>
                        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        <form action="compute_results.php" method="post">
                            <div class="form-group">
                                <input type="text" name="student_id" class="form-control" placeholder="Student ID" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="maths" class="form-control" placeholder="Mathematics Score" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="english" class="form-control" placeholder="English Score" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="science" class="form-control" placeholder="Science Score" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="social_studies" class="form-control" placeholder="Social Studies Score" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Compute Results</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 AISHATU BEST ACADEMY KANO. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
