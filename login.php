<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Open the file in read mode
    $file = fopen('data.txt', 'r');
    if ($file) {
        $userFound = false;

        // Read the file line by line
        while (($line = fgets($file)) !== false) {
            list($storedUsername, $storedEmail, $storedPassword) = explode("|", trim($line));

            // Check if the username matches
            if ($username === $storedUsername) {
                // Verify the password
                if (password_verify($password, $storedPassword)) {
                    $_SESSION['username'] = $storedUsername;
                    $_SESSION['email'] = $storedEmail;
                    header("Location: stor_pic.php");
                    $userFound = true;
                    break;
                } else {
                    echo "Invalid password.";
                    $userFound = true;
                    break;
                }
            }
        }

        fclose($file);

        if (!$userFound) {
            echo "User not found.";
        }
    } else {
        echo "Error: Unable to open file.";
    }
}
?>

<form method="POST" action="login.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
