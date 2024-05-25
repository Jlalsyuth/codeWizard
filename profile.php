<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>User Profile</h1>
            <a href="editProfile.php" class="edit-btn">Edit Profile</a>
            <?php
                $avatar = "avatar.jpg"; // Default avatar
                if (file_exists("uploads/avatar.jpg")) {
                    $avatar = "uploads/avatar.jpg";
                }
            ?>
            <img src="<?php echo $avatar; ?>" alt="Avatar" class="avatar">
        </div>
        <?php
            // Mengambil data dari sesi
            $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : "??";
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : "??";
            $telepon = isset($_SESSION['telepon']) ? $_SESSION['telepon'] : "??";
        ?>
        <div class="profile-info">
            <p><strong>Nama:</strong> <?php echo $nama; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Telepon:</strong> <?php echo $telepon; ?></p>
        </div>
    </div>
</body>
</html>