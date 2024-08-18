<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($image_tmp, "uploads/$image");

    if ($role == 'student') {
        $class = $_POST['class'];
        $query = "INSERT INTO students (name, email, password, class, image) VALUES ('$name', '$email', '$password', '$class', '$image')";
    } elseif ($role == 'teacher') {
        $subject = $_POST['subject'];
        $query = "INSERT INTO teachers (name, email, password, subject, image) VALUES ('$name', '$email', '$password', '$subject', '$image')";
    } else {
        $query = "INSERT INTO management (name, email, password, image) VALUES ('$name', '$email', '$password', '$image')";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        $error = "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - AISHATU BEST ACADEMY KANO</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script>
        function showRoleSpecificFields() {
            var role = document.getElementById('role').value;
            document.getElementById('studentFields').style.display = (role == 'student') ? 'block' : 'none';
            document.getElementById('teacherFields').style.display = (role == 'teacher') ? 'block' : 'none';
        }
    </script>
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
                        <h2 class="card-title text-center">Sign Up</h2>
                        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        <form action="signup.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role" id="role" class="form-control" onchange="showRoleSpecificFields()" required>
                                    <option value="">Select Role</option>
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="management">Management</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div id="studentFields" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="class" class="form-control" placeholder="Class">
                                </div>
                            </div>
                            <div id="teacherFields" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control-file" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="index.php">Sign In</a></p>
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
