<?php
session_start(); 
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit;
}
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
                    <h2>HTML</h2>
                    <p>The language for building web pages</p>
                    <button>Learn HTML</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <button>Try it yourself</button>
                </div>
            </div>
        </section>

        <section class="course-section">
            <div class="course-container">
                <div class="course">
                    <h2>CSS</h2>
                    <p>The language for styling web pages</p>
                    <button>Learn CSS</button>
                    <button>Video Tutorial</button>
                    <button>Exercise</button>
                </div>
                <div class="example">
                    <h3>Example</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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