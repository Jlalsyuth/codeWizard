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
function tambah_materi($bahasa, $isi)
{
    $koneksi = koneksi_db();
    $query = "INSERT INTO materi (bahasa, isi) VALUES ('$bahasa', '$isi')";

    if ($koneksi->query($query) === TRUE) {
        $koneksi->close();
        return true;
    } else {
        $koneksi->close();
        return false;
    }
}


// Fungsi untuk menghapus materi berdasarkan bahasa
function hapus_materi($bahasa)
{
    $koneksi = koneksi_db();
    $query = "DELETE FROM materi WHERE bahasa='$bahasa'";

    if ($koneksi->query($query) === TRUE) {
        $koneksi->close();
        return true;
    } else {
        $koneksi->close();
        return false;
    }
}

// Fungsi untuk memperbarui materi berdasarkan bahasa
function perbarui_materi($bahasa, $new_isi)
{
    $koneksi = koneksi_db();
    $query = "UPDATE materi SET isi='$new_isi' WHERE bahasa='$bahasa'";

    if ($koneksi->query($query) === TRUE) {
        $koneksi->close();
        return true;
    } else {
        $koneksi->close();
        return false;
    }
}

// Fungsi untuk membaca materi berdasarkan bahasa
function baca_materi($bahasa)
{
    $koneksi = koneksi_db();
    $query = "SELECT * FROM materi WHERE bahasa='$bahasa'";
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

// Fungsi untuk menampilkan semua materi
function tampilkan_semua_materi()
{
    $koneksi = koneksi_db();
    $query = "SELECT * FROM materi";
    $result = $koneksi->query($query);

    $materi = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $materi[] = $row;
        }
    }
    $koneksi->close();
    return $materi;
}

// Proses penambahan akun baru
if (isset($_POST['tambah'])) {
    $new_bahasa = $_POST['new_bahasa'];
    $new_isi = $_POST['new_isi'];

    if (tambah_materi($new_bahasa, $new_isi)) {
        echo "<p>materi berhasil ditambahkan.</p>";
    } else {
        echo "<p>materi menambahkan akun.</p>";
    }
}
// Proses edit materi
if (isset($_POST['edit'])) {
    $bahasa = $_POST['bahasa'];
    $new_isi = $_POST['new_isi'];

    if (perbarui_materi($bahasa, $new_isi)) {
        echo "<p>Materi berhasil diperbarui.</p>";
    } else {
        echo "<p>Gagal memperbarui materi.</p>";
    }
}

// Proses hapus materi
if (isset($_POST['hapus'])) {
    $bahasa = $_POST['bahasa'];

    if (hapus_materi($bahasa)) {
        echo "<p>Materi berhasil dihapus.</p>";
    } else {
        echo "<p>Gagal menghapus materi.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeWizard - Kelola Materi</title>
    <link rel="stylesheet" href="kelolaAkun.css">
</head>

<body>
    <div class="button-group">
        <form method="post" action="logout.php">
            <input class="btn-logout" type="submit" value="Logout">
        </form>
        <form method="post" action="kelolaAkun.php">
            <input class="btn-kelola" type="submit" value="Kelola Akun">
        </form>
        <form method="post" action="dashboard.php">
            <input class="btn-primary" type="submit" value="Dashboard">
        </form>
    </div>

    <h1>Kelola Materi (Admin) </h1>

    <h3>Tambah Materi Baru</h3>
    <form method="post" action="kelolaMateri.php">
        <label for="new_bahasa">Bahasa:</label>
        <input type="text" id="new_bahasa" name="new_bahasa" required><br>
        <label for="new_isi">Isi:</label>
        <input type="text" id="new_isi" name="new_isi" required>
        <input class='btn-primary' type="submit" name="tambah" value="Tambah Materi">
    </form>


    <h3>Daftar Materi</h3>
    <table border="1">
        <tr>
            <th>Bahasa</th>
            <th>Isi</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Tampilkan semua materi dari database
        $daftar_materi = tampilkan_semua_materi();
        foreach ($daftar_materi as $materi) {
            echo "<tr>";
            echo "<td>" . $materi['bahasa'] . "</td>";
            echo "<td>" . $materi['isi'] . "</td>";
            echo "<td>
                <form method='post' action='kelolaMateri.php'>
                    <input type='hidden' name='bahasa' value='" . $materi['bahasa'] . "'>
                    <input type='text' name='new_isi' placeholder='Isi Baru' required>
                    <input class='btn-primary' type='submit' name='edit' value='Edit'>
                </form>
                <form method='post' action='kelolaMateri.php'>
                    <input type='hidden' name='bahasa' value='" . $materi['bahasa'] . "'>
                    <input class='btn-primary' type='submit' name='hapus' value='Hapus'>
                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>