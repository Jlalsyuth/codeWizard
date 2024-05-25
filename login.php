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

    $query = "SELECT * FROM akun WHERE username = '$username' AND password = '$password'";
    $validasi = $koneksi->query($query);

    if ($validasi->num_rows > 0) {
        $koneksi->close();
        return true;
    } else {
        $koneksi->close();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validasi($username, $password)) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Invalid username or password";
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
    <div class="container">
        <h1 class="title">CodeWizard</h1>
        <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if (isset($login_error)) {
                echo "<p style='color:red;'>$login_error</p>";
            } ?>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required="required">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required="required">
            <button type="submit">Login</button>
        </form>
        <?php if (isset($login_error)) { ?>
            <p><?php echo $login_error; ?></p>
        <?php } ?>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>

</html>