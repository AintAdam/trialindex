<?php
// login.php
session_start();
require_once('functions.php');

// Initialize the error variable
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check login credentials
    $user = check_login($email, $password);

    if ($user) {
        // Successful login, redirect to profile page
        header("Location: profile.php?user=" . $user["id"]);
        exit();
    } else {
        // Set error message if login fails
        $error = "Invalid email or password!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg p-4 bg-secondary">
                    <h3 class="text-center mb-3">Login</h3>
                    <!-- Display error message if set -->
                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-warning w-100">Login</button>
                    </form>
                    <p class="mt-3 text-center">Don’t have an account? <a href="register.php" class="text-light">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
