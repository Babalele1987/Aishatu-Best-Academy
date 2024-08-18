<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check role and authenticate
    if ($role == 'student') {
        $query = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    } elseif ($role == 'teacher') {
        $query = "SELECT * FROM teachers WHERE email='$email' AND password='$password'";
    } else {
        $query = "SELECT * FROM management WHERE email='$email' AND password='$password'";
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user;
        $_SESSION['role'] = $role;

        // Redirect based on role
        if ($role == 'student') {
            header('Location: student_dashboard.php');
        } elseif ($role == 'teacher') {
            header('Location: teacher_dashboard.php');
        } else {
            header('Location: management_dashboard.php');
        }
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AISHATU BEST ACADEMY KANO</title>
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
                        <h2 class="card-title text-center">Login</h2>
                        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        <form action="index.php" method="post">
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="management">Management</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-0 mt-5">
        <p>&copy; 2024 AISHATU BEST ACADEMY KANO. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
