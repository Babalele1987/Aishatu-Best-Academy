<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $class = $_POST['class'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($image_tmp, "uploads/$image");

    $query = "INSERT INTO students (name, email, password, class, image) VALUES ('$name', '$email', '$password', '$class', '$image')";
    
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
    <title>Register Student - AISHATU BEST ACADEMY KANO</title>
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
                        <h2 class="card-title text-center">Student Registration</h2>
                        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        <form action="register_student.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="class" class="form-control" placeholder="Class" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control-file" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
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
