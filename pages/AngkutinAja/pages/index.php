<?php
session_start();
include('../config.php');

// Initialize error and success messages
$loginError = '';
$registerError = '';
$registerSuccess = '';

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Tidak perlu melakukan real_escape_string pada password

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the input password against the hashed password in the database
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $user['email']; // Tambahkan email ke session
            $_SESSION['role'] = $user['role']; // Menyimpan role di session

            // Redirect based on role
            if ($user['role'] == 'pengurus') {
                header("Location: dashboard.php");
            } else {
                header("Location: homepage.php"); // Ganti dengan halaman yang sesuai untuk warga
            }
            exit();
        } else {
            $loginError = "Login gagal! Password salah.";
        }
    } else {
        $loginError = "Login gagal! Username atau password salah.";
    }
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role']; // Ambil nilai role dari dropdown

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        $registerSuccess = "Registrasi berhasil! Silakan login.";
    } else {
        $registerError = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Sampah</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body class="landing-page">
    <header class="landing-header">
        <div class="logo">
            <h1>AngkutinAja</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#" id="loginBtn">Login</a></li>
                <li><a href="#" id="registerBtn" class="btn-primary">Get Started</a></li>
            </ul>
        </nav>
    </header>
    <main class="landing-content">
        <div class="main-message">
            <h2>Solusi Pengelolaan Sampah yang Efisien dan Ramah Lingkungan</h2>
            <p>Tempat untuk mengelola, melacak, dan memahami data sampah dengan mudah dan efektif.</p>
            <a href="#" id="registerBtnMain" class="btn-primary">Mulai Sekarang</a>
        </div>
        <div class="landing-illustration">
            <img src="../assets/images/DaurUang.png" alt="Daur Uang">
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Pengelolaan Sampah. All rights reserved.</p>
        <nav>
            <ul>
                <li><a href="about.php">About</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms</a></li>
            </ul>
        </nav>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeLogin">&times;</span>
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="login" value="1">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
                <?php if ($loginError) : ?>
                    <p class="error"><?php echo $loginError; ?></p>
                <?php endif; ?>
            </form>
            <p>Belum punya akun? <a href="#" id="switchToRegister">Registrasi disini</a></p>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeRegister">&times;</span>
            <h2>Register</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="register" value="1">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="warga">Warga</option>
                    <option value="pengurus">Pengurus</option>
                </select>
                <input type="submit" value="Register">
                <?php if ($registerError) : ?>
                    <p class="error"><?php echo $registerError; ?></p>
                <?php endif; ?>
                <?php if ($registerSuccess) : ?>
                    <p class="success"><?php echo $registerSuccess; ?></p>
                <?php endif; ?>
            </form>
            <p>Sudah punya akun? <a href="#" id="switchToLogin">Login disini</a></p>
        </div>
    </div>

    <script src="../assets/js/index.js"></script>
    <script>
        // Handle showing login modal with success message after registration
        <?php if ($registerSuccess) : ?>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('registerModal').style.display = 'none';
                document.getElementById('loginModal').style.display = 'block';
            });
        <?php endif; ?>
        
         // Check if login error occurred
        <?php if ($loginError) : ?>
            loginModal.style.display = 'block'; // Ensure login modal is open
        <?php endif; ?>
    </script>
</body>
</html>
