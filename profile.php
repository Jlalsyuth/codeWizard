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
    $foto = ""; // Gambar default jika tidak ada foto

    if ($row['foto'] != "") {
        $foto = $row['foto'];
    }
} else {
    echo "Data pengguna tidak ditemukan.";
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>User Profile</h1>
            <div class="button-container">
                <a href="editProfile.php" class="edit-btn">Edit Profile</a>
                <a href="dashboard.php" class="edit-btn">Kembali</a>
            </div>
            <img src="uploads/<?php echo $foto; ?>" alt="foto" class="avatar">
        </div>
        <div class="profile-info">
            <p><strong>Nama     :</strong> <?php echo $nama; ?></p>
            <p><strong>Email    :</strong> <?php echo $email; ?></p>
            <p><strong>Password :</strong> <span id="password">********</span> <button onclick="togglePassword()">Show</button></p>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordButton = document.querySelector("button");

            if (passwordField.innerHTML === "********") {
                passwordField.innerHTML = "<?php echo htmlspecialchars($password); ?>";
                passwordButton.textContent = "Hide";
                passwordButton.classList.remove("show-button");
                passwordButton.classList.add("hide-button");
            } else {
                passwordField.innerHTML = "********";
                passwordButton.textContent = "Show";
                passwordButton.classList.remove("hide-button");
                passwordButton.classList.add("show-button");
            }
        }
    </script>
</body>

</html>
