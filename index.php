<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hashing the password

    // Prepare data to write to the file
    $data = $username . "|" . $email . "|" . $password . "\n";

    // Open the file in append mode
    $file = fopen('data.txt', 'a');
    if ($file) {
        // Write the data to the file
        fwrite($file, $data);
        fclose($file);
        echo "Registration successful! You can now <a href='login.php'>login</a>.";
    } else {
        echo "Error: Unable to open file.";
    }
}
?>

<form method="POST" action="index.php">
    <a href='login.php'>login</a><br><br>
    <label>Username:</label><br>
    <input type="text" name="username" required><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>
