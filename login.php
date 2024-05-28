<?php
session_start();
if (isset($_SESSION['username'])) {
    // Jika sudah login, arahkan kembali ke dashboard
    header("Location: dashboard.php");
    exit;
}

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

function validasi($username, $password)
{
    $koneksi = koneksi_db();

    $query = "SELECT role FROM akun WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $role = $data['role'];
        $koneksi->close();
        return $role; // Mengembalikan peran (role) dari pengguna
    } else {
        $koneksi->close();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $login_error = "Username dan password harus diisi.";
    } else {
        $role = validasi($username, $password); // Mendapatkan peran (role) pengguna

        if ($role === false) {
            $login_error = "Invalid username or password";
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role; // Menyimpan peran (role) pengguna dalam sesi

            if ($role === 'user') {
                header("Location: dashboard.php"); // Jika peran (role) adalah admin, arahkan ke dashboard.php
            } elseif ($role === 'admin') {
                header("Location: dashboard.php"); // Jika peran (role) adalah user, arahkan ke dashboard.php
            }
            exit();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeWizard Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="main-container">
        <div class="promo-container">
            <h1 class="promo-title">CodeWizard</h1>
            <p class="promo-subtitle">Elevate Your Code Skills with CodeWizard ✨<br>Empower Your Journey, Transform Your Future</p>
            <img src="rocket.svg" alt="Rocket Image" class="promo-img">
        </div>
        <div class="login-container">
            <h2>Log In</h2>
            <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="error-message">
                    <?php if (isset($login_error)) {
                        echo $login_error;
                    }
                    ?>
                </div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <button type="submit" class="login-btn">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>
