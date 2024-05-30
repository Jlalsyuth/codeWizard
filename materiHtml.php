<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
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

// Ambil data dari tabel materi
$koneksi = koneksi_db();

$query_html = "SELECT isi FROM materi WHERE bahasa = 'HTML' LIMIT 1";
$result_html = $koneksi->query($query_html);

if ($result_html->num_rows > 0) {
    $row_html = $result_html->fetch_assoc();
    $materi_html = $row_html['isi'];
} else {
    $materi_html = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE username='$username'";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $foto = ""; // Gambar default jika tidak ada foto

    if ($row['foto'] != "") {
        $foto = $row['foto'];
    }
} else {
    echo "Data pengguna tidak ditemukan.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeWizard - Unlock The Magic Of Code</title>
    <link rel="stylesheet" href="materiHtml.css">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="container-1">
                <a href="dashboard.php">
                    <div class="logo">CodeWizard</div>
                </a>
                <nav>
                    <ul class="main-nav">
                        <li class="nav-1"><a href="#">Tutorials<img class="panah" src="vector_x2.svg"></a>
                            <ul class="dropdown">
                                <li><a href="#">JavaScript</a></li>
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">Java</a></li>
                                <li><a href="#">Python</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Bootstrap</a></li>
                                <li><a href="#">SQL</a></li>
                            </ul>
                        </li>
                        <li class="nav-1"><a href="#">Examples<img class="panah" src="vector_x2.svg"></a>
                            <ul class="dropdown">
                                <li><a href="#">JavaScript</a></li>
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">Java</a></li>
                                <li><a href="#">Python</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Bootstrap</a></li>
                                <li><a href="#">SQL</a></li>
                            </ul>
                        </li>
                        <li class="nav-1"><a href="#">Exercises<img class="panah" src="vector_x2.svg"></a>
                            <ul class="dropdown">
                                <li><a href="#">JavaScript</a></li>
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">Java</a></li>
                                <li><a href="#">Python</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Bootstrap</a></li>
                                <li><a href="#">SQL</a></li>
                            </ul>
                        </li>
                        <li class="nav-1"><a href="#">Services<img class="panah" src="vector_x2.svg"></a>
                            <ul class="dropdown">
                                <li><a href="#">JavaScript</a></li>
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">Java</a></li>
                                <li><a href="#">Python</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Bootstrap</a></li>
                                <li><a href="#">SQL</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <nav class="language-nav">
            <ul>
                <li><a href="#">JavaScript</a></li>
                <li><a href="#">CSS</a></li>
                <li><a href="#">HTML</a></li>
                <li><a href="#">Java</a></li>
                <li><a href="#">Python</a></li>
                <li><a href="#">PHP</a></li>
                <li><a href="#">Bootstrap</a></li>
                <li><a href="#">SQL</a></li>
            </ul>
        </nav>
    </header>
    <div class="action">

        <div class="profile" onclick="menuToggle();">
            <img src="uploads/<?php echo $foto; ?>" alt="foto" class="avatar">
        </div>
        <div class="menu">
            <h3><span>Hello! </span><?php echo $_SESSION['username']; ?></h3>
            <ul>
                <li><img src="user.png" /><a href="profile.php">My profile</a></li>
                <li><img src="log-out.png" /><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <script>
        function menuToggle() {
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle("active");
        }
    </script>
    <main>
        <aside>
            <ul>
                <li><a href="#">HTML Introduction</a></li>
                <li><a href="#">HTML Elements</a></li>
                <li><a href="#">HTML Attributes</a></li>
                <li><a href="#">HTML Global Attributes</a></li>
                <li><a href="#">HTML Events</a></li>
                <li><a href="#">HTML Colors</a></li>
                <li><a href="#">HTML Forms</a></li>
                <li><a href="#">HTML Audio/Video</a></li>
                <li><a href="#">HTML Character Sets</a></li>
                <li><a href="#">HTML URL Encode</a></li>
                <li><a href="#">HTML Doctypes</a></li>
                <li><a href="#">HTML Lang Codes</a></li>
                <li><a href="#">HTTP Messages</a></li>
                <li><a href="#">HTTP Methods</a></li>
                <li><a href="#">HTTP Status Codes</a></li>
                <li><a href="#">Base64 Converter</a></li>
                <li><a href="#">Keyboard Shortcuts</a></li>
            </ul>
        </aside>
        <section class="content">
            <div class="attribute">
                <h1>HTML Introduction</h1>
                <p><?php echo $materi_html ?></p>
            </div>
            <div class="example">
                <h2>Example</h2>
                <p>Learn about HTML elements, attributes, and more...</p>
                <textarea placeholder="Try it yourself..."></textarea>
            </div>
            <div class="exercise">
                <h2>Exercise</h2>
                <p>Learn about HTML elements, attributes, and more...</p>
                <textarea placeholder="Type your code here..."></textarea>
                <div class="exercise-buttons">
                    <button class="save">Save</button>
                    <button class="show">Show</button>
                    <button class="next">Next</button>
                </div>
            </div>
            <div class="video-tutorial">
                <h2>Video Tutorial</h2>
                <div class="videos">
                    <div class="video">WATCH</div>
                    <div class="video">WATCH</div>
                    <div class="video">WATCH</div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>CodeWizard</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Advertise</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Certificates</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Top Tutorial</h3>
                <ul>
                    <li><a href="#">JavaScript</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">PHP</a></li>
                    <li><a href="#">Java</a></li>
                    <li><a href="#">Python</a></li>
                    <li><a href="#">SQL</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Top Examples</h3>
                <ul>
                    <li><a href="#">JavaScript Examples</a></li>
                    <li><a href="#">CSS Examples</a></li>
                    <li><a href="#">HTML Examples</a></li>
                    <li><a href="#">PHP Examples</a></li>
                    <li><a href="#">Java Examples</a></li>
                    <li><a href="#">Python Examples</a></li>
                    <li><a href="#">SQL Examples</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Top Exercises</h3>
                <ul>
                    <li><a href="#">JavaScript Exercises</a></li>
                    <li><a href="#">CSS Exercises</a></li>
                    <li><a href="#">HTML Exercises</a></li>
                    <li><a href="#">PHP Exercises</a></li>
                    <li><a href="#">Java Exercises</a></li>
                    <li><a href="#">Python Exercises</a></li>
                    <li><a href="#">SQL Exercises</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Top Videos</h3>
                <ul>
                    <li><a href="#">JavaScript Videos</a></li>
                    <li><a href="#">CSS Videos</a></li>
                    <li><a href="#">HTML Videos</a></li>
                    <li><a href="#">PHP Videos</a></li>
                    <li><a href="#">Java Videos</a></li>
                    <li><a href="#">Python Videos</a></li>
                    <li><a href="#">SQL Videos</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Follow us on</p>
            <div class="social-icons">
                <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
                <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
                <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
                <a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a>
                <a href="#"><img src="youtube-icon.png" alt="YouTube"></a>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2023 CodeWizard, All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
