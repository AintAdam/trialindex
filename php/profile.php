<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

// Check GET parameter
if (!isset($_GET["user"]) || $_GET["user"] != $_SESSION["user"]["id"]) {
    echo "Invalid user!";
    exit();
}

$user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h3>Welcome, <?= htmlspecialchars($user["name"]) ?>!</h3>
            <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
            <p><strong>User ID:</strong> <?= htmlspecialchars($user["id"]) ?></p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>

</html>