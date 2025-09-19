<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (isset($_SESSION["users"]) && !empty($_SESSION["users"])) {
        $found = false;
        foreach ($_SESSION["users"] as $u) {
            if ($u["email"] === $email && $u["password"] === $password) {
                $_SESSION["user"] = $u;
                header("Location: profile.php?user=" . $u["id"]);
                exit();
            }
        }
        $error = "Invalid email or password!";
    } else {
        $error = "No registered users yet!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-3">Login</h3>
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
                        <button class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="mt-3 text-center">Don’t have an account? <a href="register.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>