<?php

function koneksi_db()
{
    $server = "localhost";
    $username = "root";
    $password = "fiki12345";
    $db_nama = "lk02";

    $koneksi = new mysqli($server, $username, $password, $db_nama);

    if ($koneksi->connect_error) {
        die("Koneksi Error: " . $koneksi->connect_error);
    }

    return $koneksi;
}

function add($new_username, $new_password)
{
    $koneksi = koneksi_db();

    try {
        $stmt = $koneksi->prepare("INSERT INTO akun (username, password) VALUES (?, ?)");
        if ($stmt === false) {
            throw new Exception('Statement preparation failed: ' . htmlspecialchars($koneksi->error));
        }
        $stmt->bind_param("ss", $new_username, $new_password);
        $stmt->execute();
        $stmt->close();
        $koneksi->close();
        return true;
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry error code
            return "Username sudah ada. Silakan pilih yang lain.";
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
    $new_password = $_POST["new_password"];

    $result = add($new_username, $new_password);
    if ($result === true) {
        $regist = "Registrasi berhasil. Anda sekarang dapat login dengan akun baru Anda.";
    } else {
        $regist = $result;
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
            <?php if (!empty($regist)) {
                echo "<p style='color:red;'>$regist</p>";
            } ?>
            <label for="new_username">New Username</label>
            <input type="text" id="new_username" name="new_username" placeholder="Enter new username" required="required">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required="required">
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
    </div>
</body>

</html>
