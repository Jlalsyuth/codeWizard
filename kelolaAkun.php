<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
// Fungsi koneksi database
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

// Fungsi untuk menambahkan akun baru
function tambah_akun($username, $email, $password)
{
    $koneksi = koneksi_db();
    $query = "INSERT INTO akun (username, email,  password) VALUES ('$username', '$email' '$password')";

    if ($koneksi->query($query) === TRUE) {
        $koneksi->close();
        return true;
    } else {
        $koneksi->close();
        return false;
    }
}

// Fungsi untuk menghapus akun berdasarkan username
function hapus_akun($username)
{
    $koneksi = koneksi_db();
    $query = "DELETE FROM akun WHERE username='$username'";

    if ($koneksi->query($query) === TRUE) {
        $koneksi->close();
        return true;
    } else {
        $koneksi->close();
        return false;
    }
}

// Fungsi untuk memperbarui username dan password akun berdasarkan username
function perbarui_akun($old_username, $new_username, $new_email, $new_password)
{
    $koneksi = koneksi_db();
    $query = "UPDATE akun SET username='$new_username', email ='$new_email', password='$new_password' WHERE username='$old_username'";


    try {
        $check_query = "SELECT * FROM akun WHERE username = '$new_username'";
        $check_result = $koneksi->query($check_query);

        if ($check_result->num_rows > 0 && $new_username != $old_username) {
            throw new Exception("Username sudah digunakan oleh akun lain.");
        }

        // Periksa keunikan email baru
        if (!empty($new_email)) {
            $check_query = "SELECT * FROM akun WHERE email = '$new_email'";
            $check_result = $koneksi->query($check_query);
            if ($check_result->num_rows > 0 && $new_email != $_SESSION['email']) {
                throw new Exception("Email sudah digunakan oleh akun lain.");
            }
        }

        if (!empty($new_email)) {
            $query = "UPDATE akun SET username='$new_username', email='$new_email', password='$new_password' WHERE username='$old_username'";
        } else {
            $query = "UPDATE akun SET username='$new_username', password='$new_password' WHERE username='$old_username'";
        }

        if ($koneksi->query($query) === TRUE) {
            $_SESSION['username'] = $new_username;
            if (!empty($new_email)) {
                $_SESSION['email'] = $new_email;
            }
            $_SESSION['password'] = $new_password;
            $koneksi->close();
            return true;
        } else {
            throw new Exception("Gagal memperbarui akun: " . $koneksi->error);
        }
    } catch (Exception $e) {
        $koneksi->close();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Fungsi untuk membaca akun berdasarkan username
function baca_akun($username)
{
    $koneksi = koneksi_db();
    $query = "SELECT * FROM akun WHERE username='$username'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $koneksi->close();
        return $row;
    } else {
        $koneksi->close();
        return null;
    }
}

// Fungsi untuk menampilkan semua akun
function tampilkan_semua_akun()
{
    $koneksi = koneksi_db();
    $query = "SELECT * FROM akun";
    $result = $koneksi->query($query);

    $akun = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $akun[] = $row;
        }
    }
    $koneksi->close();
    return $akun;
}


// Proses penambahan akun baru
if (isset($_POST['tambah'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    if (tambah_akun($new_username, $new_email, $new_password)) {
        echo "<p>Akun berhasil ditambahkan.</p>";
    } else {
        echo "<p>Gagal menambahkan akun.</p>";
    }
}

// Proses edit akun
if (isset($_POST['edit'])) {
    $old_username = $_POST['old_username'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    if (perbarui_akun($old_username, $new_username, $new_email, $new_password)) {
        echo "<p>Akun berhasil diperbarui.</p>";
    } else {
        echo "<p>Gagal memperbarui akun.</p>";
    }
}

// Proses hapus akun
if (isset($_POST['hapus'])) {
    $username = $_POST['username'];

    if (hapus_akun($username)) {
        echo "<p>Akun berhasil dihapus.</p>";
    } else {
        echo "<p>Gagal menghapus akun.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeWizard - Kelola Akun</title>
    <link rel="stylesheet" href="kelolaAkun.css">
</head>

<body>
    <div class="button-group">
        <form method="post" action="logout.php">
            <input class="btn-logout" type="submit" value="Logout">
        </form>
        <form method="post" action="kelolaMateri.php">
            <input class="btn-kelola" type="submit" value="Kelola Materi">
        </form>
        <form method="post" action="dashboard.php">
            <input class="btn-primary" type="submit" value="Dashboard">
        </form>
    </div>



    <h1>Kelola Akun (Admin)</h1>
    <h3>Tambah Akun Baru</h3>
    <form method="post" action="kelolaAkun.php">
        <label for="new_username">Username:</label>
        <input type="text" id="new_username" name="new_username" required><br>
        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" required>
        <label for="new_password">Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        <input class="btn-primary" type="submit" name="tambah" value="Tambah Akun">
    </form>

    <h3>Daftar Akun</h3>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Tampilkan semua akun dari database
        $daftar_akun = tampilkan_semua_akun();
        foreach ($daftar_akun as $akun) {
            echo "<tr>";
            echo "<td>" . $akun['username'] . "</td>";
            echo "<td>" . $akun['email'] . "</td>";
            echo "<td>" . $akun['password'] . "</td>";
            echo "<td>" . $akun['role'] . "</td>";
            echo "<td>
            <form method='post' action='kelolaAkun.php'>
                <input type='hidden' name='old_username' value='" . $akun['username'] . "'>
                <input type='text' name='new_username' value='" . $akun['username'] . "' required>
                <input type='email' name='new_email' value='" . $akun['email'] . "' required>
                <input type='text' name='new_password' value='" . $akun['password'] . "' required>
                <input class='btn-primary' type='submit' name='edit' value='Edit'>
            </form>
            <form method='post' action='kelolaAkun.php'>
                <input type='hidden' name='username' value='" . $akun['username'] . "'>
                <input class='btn-primary' type='submit' name='hapus' value='Hapus'>
            </form>
        </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>