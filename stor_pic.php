<?php
session_start();
if (!isset($_SESSION['username'],$_SESSION['email'])) {
    header("location:main.php");
}

if (isset($_POST['btn'])) {
    $email = $_POST['email'];
    $file = $_FILES['file'];
    $file_name = $file['name'];  
    $tmp = $file['tmp_name'];    
    $fileSize = $file['size'];   
    $img = "img/";               
    $kb = $fileSize / 1024;      

    $emailPattern = "/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

    
    if (!preg_match($emailPattern, $email)) {
        echo "<br><br><b>Invalid email address.</b><br><br>";
    } else {
        
        if ($kb > 400) {
            echo "<br><br><b>File is too large. Maximum allowed size is 400 KB.</b><br><br>";
        } else {
           
            $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            if (!in_array($fileExtension, $allowedFormats)) {
                echo "<br><br><b>Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.</b><br><br>";
            } else {
                move_uploaded_file($tmp, $img . $file_name);
            }
        }
    }
}


$images = glob("img/*.{jpg,png,gif,jpeg}", GLOB_BRACE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Display Images</title>
</head>
<body>
    <a href="logout.php">Logout</a><br><br>
    <form action="" method="post" enctype="multipart/form-data">
        Email: <input type="text" name="email"><br><br>
        <input type="file" name="file">
        <input type="submit" name="btn" value="Upload">
    </form>

    <h2>Uploaded Images:</h2>
    <?php
    foreach ($images as $image) {
        echo "<img src='$image' alt='Uploaded Image' style='width:200px; height:auto; margin:10px;'>";
    }
    ?>
</body>
</html>
