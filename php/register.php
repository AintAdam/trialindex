<?php
session_start();

// Initialize users array in session if not exists
if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = [];
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm"]);

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (strlen($password) < 5) {
        $error = "Password must be at least 5 characters!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        foreach ($_SESSION["users"] as $u) {
            if ($u["email"] === $email) {
                $error = "Email already registered!";
                break;
            }
        }

        // If no error, register user
        if (!$error) {
            $newUser = [
                "id" => count($_SESSION["users"]) + 1,
                "name" => $name,
                "email" => $email,
                "password" => $password // NOTE: plain text for demo
            ];
            $_SESSION["users"][] = $newUser;
            $success = "Registration successful! <a href='login.php'>Login now</a>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-3">Register</h3>

                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if ($success) : ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm" class="form-control" required>
                        </div>
                        <button class="btn btn-success w-100">Register</button>
                    </form>
                    <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>