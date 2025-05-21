<?php
session_start();
require "../koneksi.php";

// Redirect jika sudah login
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Handle dark mode preference
if (isset($_POST['toggleDarkMode'])) {
    $_SESSION['darkMode'] = !isset($_SESSION['darkMode']) ? true : !$_SESSION['darkMode'];
    exit(); // Just for the AJAX request
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['toggleDarkMode'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password']; // Tanpa hash sesuai permintaan
    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        // Login sukses
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
  <meta http-equiv="Pragma" content="no-Cache">
  <meta http-equiv="Expires" content="0">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Login Page</title>
    <link rel="icon" type="image/png" href="logo.png">
    
  <!-- Tambahkan link material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- Load CSS berdasarkan mode -->
  <?php if (isset($_SESSION['darkMode']) && $_SESSION['darkMode']): ?>
    <link rel="stylesheet" href="../css/gelap.css" id="theme-style" />
  <?php else: ?>
    <link rel="stylesheet" href="../css/terang.css" id="theme-style" />
  <?php endif; ?>
</head>
<body class="<?php echo isset($_SESSION['darkMode']) && $_SESSION['darkMode'] ? 'dark-mode' : 'light-mode'; ?>">
  <!-- Tambahkan tombol toggle di sini -->
  <button class="dark-mode-toggle" id="darkModeToggle">
    <?php echo isset($_SESSION['darkMode']) && $_SESSION['darkMode'] ? '☀️' : '🌙'; ?>
  </button>
  
  <div class="container">
        <div class="login-box">
          <div class="logo">
            <img src="../foto/rpl.png" class="rpl" alt="RPL Logo">
            <img src="../foto/smkn.png" class="smk" alt="SMK Logo">
          </div>
          
          <h1>Login</h1>
          <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
          <form method="POST" action="">
            <div class="textbox">
              <input type="text" name="username" id="username" placeholder="Username" required />
              <span class="material-symbols-rounded">person</span>
            </div>
            <div class="textbox">
              <input type="password" name="password" id="Password" placeholder="Password" required/>
              <span class="material-symbols-rounded">lock</span>
            </div>
            <div class="remember-me">
              <input type="checkbox" id="remember" name="remember" value="1" />
              <label for="remember">Remember me</label>
              <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
          </form>
          <p>Don't have an account? <a href="#">Sign up</a></p>
        </div>
      </div>
      
  <script>
document.getElementById('darkModeToggle').addEventListener('click', function() {
  // Tambahkan class transition untuk animasi
  document.body.classList.add('theme-transition');
  document.querySelector('.login-box').classList.add('theme-transition');
  document.querySelector('h1').classList.add('theme-transition');
  
  fetch('login.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'toggleDarkMode=1'
  })
  .then(() => {
    const themeStyle = document.getElementById('theme-style');
    const isDark = themeStyle.getAttribute('href').includes('gelap.css');
    
    if (isDark) {
      // Switch to light mode
      themeStyle.setAttribute('href', '../css/terang.css');
      this.textContent = '🌙';
      document.body.classList.remove('dark-mode');
      document.body.classList.add('light-mode');
    } else {
      // Switch to dark mode
      themeStyle.setAttribute('href', '../css/gelap.css');
      this.textContent = '☀️';
      document.body.classList.remove('light-mode');
      document.body.classList.add('dark-mode');
    }
    
    // Hapus class transition setelah animasi selesai
    setTimeout(() => {
      document.body.classList.remove('theme-transition');
      document.querySelector('.login-box').classList.remove('theme-transition');
      document.querySelector('h1').classList.remove('theme-transition');
    }, 500);
  });
});
</script>
</body>
</html>