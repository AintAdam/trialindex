<?php

// Path to the file where user data will be stored
define('USER_FILE', 'users.json');

// Read users from the JSON file
function get_users() {
    // Check if the file exists and is not empty
    if (file_exists(USER_FILE)) {
        $data = file_get_contents(USER_FILE);
        return json_decode($data, true);
    }
    return [];
}

// Save users to the JSON file
function save_users($users) {
    // Save the users array into the file as JSON
    file_put_contents(USER_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

// Register the user (store user in the file)
function register_user($name, $email, $password) {
    // Read existing users
    $users = get_users();

    // Check if email already exists
    foreach ($users as $u) {
        if ($u["email"] === $email) {
            return "Email already registered!";
        }
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Register new user
    $newUser = [
        "id" => count($users) + 1,  // Generate user ID
        "name" => $name,
        "email" => $email,
        "password" => $hashedPassword  // Store hashed password
    ];

    // Add the new user to the users array
    $users[] = $newUser;

    // Save updated users to the file
    save_users($users);

    return "Registration successful! <a href='login.php'>Login now</a>";
}

// Check login credentials (using file-stored data)
function check_login($email, $password) {
    // Read users from the file
    $users = get_users();

    foreach ($users as $u) {
        // Check if email exists and password matches (using password_verify for hashed passwords)
        if ($u["email"] === $email && password_verify($password, $u["password"])) {
            $_SESSION["user"] = $u;  // Store the logged-in user data in session
            return $u;  // Return the user data
        }
    }
    return false;  // Return false if no match is found
}
?>
