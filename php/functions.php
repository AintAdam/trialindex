<?php
// Start the session at the top of the file to ensure the session is active

function check_login($email, $password) {
    // Check if users are stored in session
    if (isset($_SESSION["users"]) && !empty($_SESSION["users"])) {
        foreach ($_SESSION["users"] as $u) {
            // Check if email exists and password matches (using password_verify for hashed passwords)
            if ($u["email"] === $email && password_verify($password, $u["password"])) {
                $_SESSION["user"] = $u;  // Store the logged-in user data in session
                return $u;  // Return the user data
            }
        }
    }
    return false;  // Return false if no match is found
}

function register_user($name, $email, $password) {
    // Initialize users array in session if not exists
    if (!isset($_SESSION["users"])) {
        $_SESSION["users"] = [];
    }

    // Check if email already exists
    foreach ($_SESSION["users"] as $u) {
        if ($u["email"] === $email) {
            return "Email already registered!";
        }
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Register new user
    $newUser = [
        "id" => count($_SESSION["users"]) + 1,  // Generate user ID
        "name" => $name,
        "email" => $email,
        "password" => $hashedPassword  // Store hashed password
    ];

    // Add the new user to the session
    $_SESSION["users"][] = $newUser;

    return "Registration successful! <a href='login.php'>Login now</a>";
}
?>
