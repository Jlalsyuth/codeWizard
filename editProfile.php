<?php
session_start();

function koneksi_db()
{
    $server = "localhost";
    $username = "admin";
    $password = "codewizard123";
    $db_nama = "lk02";

    $koneksi = new mysqli($server, $username, $password, $db_nama);

    if ($koneksi->connect_error) {
        die("Koneksi Error: " . $koneksi->connect_error);
    }

    return $koneksi;
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$koneksi = koneksi_db();
$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE username='$username'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $foto = $row['foto'];
} else {
    echo "Data pengguna tidak ditemukan.";
}

$koneksi->close();

$error = '';
if (isset($_GET['error']) && $_GET['error'] == 'username_exists') {
    $error = 'Username already exists. Please choose another one.';
}

if (isset($_GET['error']) && $_GET['error'] == 'email_exists') {
    $error = 'email already exists. Please choose another one.';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editProfile.css">
</head>

<body>
    <div class="edit-container">
        <h1>Edit Profile</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="updateProfile.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="username" value="<?php echo $nama ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo $password ?>" required>
            <label for="avatar">Avatar:</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            <div class="button-container">
                <button type="submit" id="simpan">Simpan</button>
                <button class="button-keluar" onclick="window.location.href='profile.php'" id="keluar">Keluar</button>
            </div>
        </form>
    </div>
</body>

</html>
