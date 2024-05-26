<?php

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

function add($new_username, $new_email, $new_password)
{
    $koneksi = koneksi_db();

    try {
        $stmt = $koneksi->prepare("INSERT INTO akun (username, email, password) VALUES (?, ?, ?)");
        if ($stmt === false) {
            throw new Exception('Statement preparation failed: ' . htmlspecialchars($koneksi->error));
        }
        $stmt->bind_param("sss", $new_username, $new_email, $new_password);
        $stmt->execute();
        $stmt->close();
        $koneksi->close();
        return true;
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry error code
            return "Username atau email sudah ada. Silakan pilih yang lain.";
        } else {
            return "Gagal mendaftar. Silakan coba lagi nanti.";
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

$regist = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["new_username"];
    $new_email = $_POST["new_email"];
    $new_password = $_POST["new_password"];

    if (empty($new_username) || empty($new_email) || empty($new_password)) {
        $regist = "Semua data harus diisi.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $regist = "Format email tidak valid.";
    } else {
        $result = add($new_username, $new_email, $new_password);
        if ($result === true) {
            $regist = "Registrasi berhasil. Anda sekarang dapat login dengan akun baru Anda.";
        } else {
            $regist = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeWizard Register</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="main-container">
        <div class="promo-container">
            <h1 class="promo-title">CodeWizard</h1>
            <p class="promo-subtitle">Elevate Your Code Skills with CodeWizard ✨<br>Empower Your Journey, Transform Your Future</p>
            <img src="rocket.svg" alt="Rocket Image" class="promo-img">
        </div>
        <div class="register-container">
            <h2>Sign In</h2>
            <form class="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="error-message">
                    <?php if (!empty($regist)) {
                        echo $regist;
                    } ?>
                </div>
                <label for="new_username">New Username</label>
                <input type="text" id="new_username" name="new_username" placeholder="Enter new username">
                <label for="new_email">Email</label>
                <input type="email" id="new_email" name="new_email" placeholder="Enter your email">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </div>
    </div>
</body>

</html>
