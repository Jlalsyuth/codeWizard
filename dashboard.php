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

$query_javascript = "SELECT isi FROM materi WHERE bahasa = 'JAVASCRIPT' LIMIT 1";
$result_javascript = $koneksi->query($query_javascript);

if ($result_javascript->num_rows > 0) {
    $row_javascript = $result_javascript->fetch_assoc();
    $materi_javascript = $row_javascript['isi'];
} else {
    $materi_javascript = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$query_css = "SELECT isi FROM materi WHERE bahasa = 'CSS' LIMIT 1";
$result_css = $koneksi->query($query_css);

if ($result_css->num_rows > 0) {
    $row_css = $result_css->fetch_assoc();
    $materi_css = $row_css['isi'];
} else {
    $materi_css = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$query_html = "SELECT isi FROM materi WHERE bahasa = 'HTML' LIMIT 1";
$result_html = $koneksi->query($query_html);

if ($result_html->num_rows > 0) {
    $row_html = $result_html->fetch_assoc();
    $materi_html = $row_html['isi'];
} else {
    $materi_html = "Learn programming with tutorials, references, and examples for various languages and web tech";
}


$query_java = "SELECT isi FROM materi WHERE bahasa = 'JAVA' LIMIT 1";
$result_java = $koneksi->query($query_java);

if ($result_java->num_rows > 0) {
    $row_java = $result_java->fetch_assoc();
    $materi_java = $row_java['isi'];
} else {
    $materi_java = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$query_phyton = "SELECT isi FROM materi WHERE bahasa = 'PHYTON' LIMIT 1";
$result_phyton = $koneksi->query($query_phyton);

if ($result_phyton->num_rows > 0) {
    $row_phyton = $result_phyton->fetch_assoc();
    $materi_phyton = $row_phyton['isi'];
} else {
    $materi_phyton = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$query_php = "SELECT isi FROM materi WHERE bahasa = 'PHP' LIMIT 1";
$result_php = $koneksi->query($query_php);

if ($result_php->num_rows > 0) {
    $row_php = $result_php->fetch_assoc();
    $materi_php = $row_php['isi'];
} else {
    $materi_php = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$query_bootstrap = "SELECT isi FROM materi WHERE bahasa = 'BOOTSTRAP' LIMIT 1";
$result_bootstrap = $koneksi->query($query_bootstrap);

if ($result_bootstrap->num_rows > 0) {
    $row_bootstrap = $result_bootstrap->fetch_assoc();
    $materi_bootstrap = $row_bootstrap['isi'];
} else {
    $materi_bootstrap = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$query_sql = "SELECT isi FROM materi WHERE bahasa = 'SQL' LIMIT 1";
$result_sql = $koneksi->query($query_sql);

if ($result_sql->num_rows > 0) {
    $row_sql = $result_sql->fetch_assoc();
    $materi_sql = $row_sql['isi'];
} else {
    $materi_sql = "Learn programming with tutorials, references, and examples for various languages and web tech";
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeWizard - Unlock The Magic Of Code</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="container-1">
                <div class="logo">CodeWizard</div>
                <nav>
                    <ul class="main-nav">
                        <li class="nav-1"><a href="#">Tutorials<img class="panah" src="vector_x2.svg"></a>
                            <ul class="dropdown">
                                <li><a href="#">JavaScript</a></li>
                                <li><a href="materiHtml.php">HTML</a></li>
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
                                <li><a href="materiHtml.php">HTML</a></li>
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
                                <li><a href="materiHtml.php">HTML</a></li>
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
                                <li><a href="materiHtml.php">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">Java</a></li>
                                <li><a href="#">Python</a></li>
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Bootstrap</a></li>
                                <li><a href="#">SQL</a></li>
                            </ul>
                        </li>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li><a href="kelolaAkun.php" class="kelola-btn">Kelola <br>Akun</a></li>
                            <li><a href="kelolaMateri.php" class="kelola-btn">Kelola Materi</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
        <nav class="language-nav">
            <ul>
                <li><a href="#">JavaScript</a></li>
                <li><a href="#">CSS</a></li>
                <li><a href="materiHtml.php">HTML</a></li>
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
            <img src="uploads/avatar.jpg" />
        </div>
        <div class="menu">
            <h3><span>Hello! </span><?php echo $_SESSION['username']; ?></h3>
            <ul>
                <li><img src="user.png" /><a href="profile.php">My profile</a></li>
                <li><img src="log-out.png" /><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="hero-section">
        <h1>Unlock The Magic Of Code</h1>
        <p>Learn programming with tutorials, references, and examples for various languages and web tech</p>
        <div class="search-bar">
            <input type="text" placeholder="What do you want to learn?">
        </div>
    </div>

    <main>
        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>JavaScript</h2>
                    <p><?php echo $materi_javascript; ?></p>
                    <button>Learn JavaScript</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>


        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>CSS</h2>
                    <p><?php echo $materi_css; ?></p>
                    <button>Learn CSS</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>HTML</h2>
                    <p><?php echo $materi_html; ?></p>
                    <button>Learn HTML</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>JAVA</h2>
                    <p><?php echo $materi_java; ?></p>
                    <button>Learn JAVA</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>Phyton</h2>
                    <p><?php echo $materi_phyton; ?></p>
                    <button>Learn Phyton</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>PHP</h2>
                    <p><?php echo $materi_php; ?></p>
                    <button>Learn PHP</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>Bootstrap</h2>
                    <p><?php echo $materi_bootstrap; ?></p>
                    <button>Learn Bootstrap</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>SQL</h2>
                    <p><?php echo $materi_sql; ?></p>
                    <button>Learn SQL</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Top Tutorial</h4>
                <ul>
                    <li><a href="#">JavaScript Tutorial</a></li>
                    <li><a href="#">CSS Tutorial</a></li>
                    <li><a href="#">HTML Tutorial</a></li>
                    <li><a href="#">Java Tutorial</a></li>
                    <li><a href="#">Python Tutorial</a></li>
                    <li><a href="#">PHP Tutorial</a></li>
                    <li><a href="#">Bootstrap Tutorial</a></li>
                    <li><a href="#">SQL Tutorial</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Top Examples</h4>
                <ul>
                    <li><a href="#">JavaScript Examples</a></li>
                    <li><a href="#">CSS Examples</a></li>
                    <li><a href="#">HTML Examples</a></li>
                    <li><a href="#">Java Examples</a></li>
                    <li><a href="#">Python Examples</a></li>
                    <li><a href="#">PHP Examples</a></li>
                    <li><a href="#">Bootstrap Examples</a></li>
                    <li><a href="#">SQL Examples</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Top Exercises</h4>
                <ul>
                    <li><a href="#">JavaScript Exercises</a></li>
                    <li><a href="#">CSS Exercises</a></li>
                    <li><a href="#">HTML Exercises</a></li>
                    <li><a href="#">Java Exercises</a></li>
                    <li><a href="#">Python Exercises</a></li>
                    <li><a href="#">PHP Exercises</a></li>
                    <li><a href="#">Bootstrap Exercises</a></li>
                    <li><a href="#">SQL Exercises</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Top Video</h4>
                <ul>
                    <li><a href="#">JavaScript Video</a></li>
                    <li><a href="#">CSS Video</a></li>
                    <li><a href="#">HTML Video</a></li>
                    <li><a href="#">Java Video</a></li>
                    <li><a href="#">Python Video</a></li>
                    <li><a href="#">PHP Video</a></li>
                    <li><a href="#">Bootstrap Video</a></li>
                    <li><a href="#">SQL Video</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Code Wizard Learning Academy. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
        function menuToggle() {
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle("active");
        }
    </script>
</body>

</html>
