<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    // Save the data into session variables
    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['telepon'] = $telepon;

    // Handle avatar upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . 'avatar.jpg';

        // Create the uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the destination
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
            echo "Avatar uploaded successfully.\n";
        } else {
            echo "Failed to upload avatar.\n";
        }
    }

    header('Location: profile.php');
    exit;
}
