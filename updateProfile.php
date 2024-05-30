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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_nama = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $new_foto = $_POST['foto'];

    $koneksi = koneksi_db();

    try {
        if (!empty($new_nama)) {
            $check_query = "SELECT * FROM akun WHERE username = '$new_nama'";
            $check_result = $koneksi->query($check_query);

            if ($check_result->num_rows > 0 && $new_nama != $_SESSION['username']) {
                header("Location: editProfile.php?error=username_exists");
                exit;
            }

            if (!empty($new_email)) {
                $check_query = "SELECT * FROM akun WHERE email = '$new_email'";
                $check_result = $koneksi->query($check_query);
                if ($check_result->num_rows > 0 && $new_email != $_SESSION['email']) {
                    header("Location: editProfile.php?error=email_exists");
                    exit;
                }
            }
            

            if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['foto']['name']);

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
                    $new_foto = basename($_FILES['foto']['name']);
                } else {
                    echo "Failed to upload avatar.\n";
                }
            }

            if ($new_foto) {
                $query = "UPDATE akun SET username='$new_nama', email='$new_email', password='$new_password', foto='$new_foto' WHERE username='" . $_SESSION['username'] . "'";
            } else {
                $query = "UPDATE akun SET username='$new_nama', email='$new_email', password='$new_password' WHERE username='" . $_SESSION['username'] . "'";
            }

            if ($koneksi->query($query) === TRUE) {
                $_SESSION['username'] = $new_nama;
                $_SESSION['email'] = $new_email;
                $_SESSION['password'] = $new_password;
                
                if ($new_foto) {
                    $_SESSION['foto'] = $new_foto;
                }
                header("Location: profile.php");
                exit;
            } else {
                echo "Error: " . $koneksi->error;
            }
        }

        

    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $koneksi->close();
}
?>
