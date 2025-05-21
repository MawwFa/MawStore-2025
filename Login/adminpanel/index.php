<?php
session_start();
require "../koneksi.php";

// Redirect jika belum login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Header no-cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MawStore - E-commerce Modern</title>
    
    <!-- Logo Icon -->
    <link rel="icon" type="image/png" href="logo.png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>
  <script>
    // Mencegah kembali ke halaman sebelumnya dengan tombol back browser
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function() {
        history.pushState(null, null, document.URL);

        window.location.href = "index.php";
    });

    setInterval(function() => {
        fetch('check_session.php')
        .then(response => response.text())
        .then(data => {
            if (data === '0') {
                window.location.href = "login.php";
            }
        });
    }, 2000);
  </script>
  
  <!-- Beli Via Wa -->
  <script>
    function buyViaWhatsApp(productName, price) {
        // Format nomor WhatsApp (ganti dengan nomor toko Anda)
        const phoneNumber = "6283837954025"; // Contoh: 628 untuk Indonesia
        
        // Format pesan
        const message = `Halo, saya ingin membeli produk:\n\n*${productName}* \nHarga: Rp${price.toLocaleString('id-ID')}\n\nApakah masih tersedia?`;
        
        // Encode message untuk URL
        const encodedMessage = encodeURIComponent(message);
        
        // Buka WhatsApp
        window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');
    }
  </script>
  
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="logo-container" data-aos="fade-down">
                <a href="index.php" class="logo">
                    <i class="fas fa-store logo-icon"></i>
                    Maw<span>Store</span>
                </a>
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="header-bottom" data-aos="fade-down">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari produk...">
                </div>
                
<div class="header-icons">
    <?php if(isset($_SESSION['username'])): ?>
    <div class="user-menu">
    <a href="#" class="header-icon" id="userMenuBtn">
        <i class="far fa-user"></i>
    </a>
    <div class="dropdown-overlay" id="dropdownOverlay"></div>
    <div class="dropdown-menu" id="dropdownMenu">
        <div class="dropdown-header">
            <h3>Akun Saya</h3>
            <button class="dropdown-close" id="dropdownClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="username"><?php echo $_SESSION['username']; ?></div>
        </div>
        <button class="logout-btn" id="logoutBtn">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </button>
    </div>
    </div>
    <?php else: ?>
    <a href="login.php" class="header-icon">
        <i class="far fa-user"></i>
    </a>
    <?php endif; ?>
    
    <a href="#" class="header-icon" data-aos="fade-down">
        <i class="far fa-heart"></i>
        <span class="badge">2</span>
    </a>
    <a href="#" class="header-icon" data-aos="fade-down">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge">3</span>
    </a>
</div>
</header>

    <!-- Categories -->
    <div class="categories" data-aos="fade-down" data-aos-delay="200">
        <div class="category-list">
            <div class="category-item">
                <div class="category-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <span class="category-name">HP</span>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <span class="category-name">Laptop</span>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <i class="fas fa-tshirt"></i>
                </div>
                <span class="category-name">Fashion</span>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <span class="category-name">Makanan</span>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <i class="fas fa-book"></i>
                </div>
                <span class="category-name">Buku</span>
            </div>
        </div>
    </div>

    <!-- Banner -->
    <div class="container">
        <div class="banner" data-aos="zoom-in" data-aos-delay="300">
            <img src="../header/banner/b1.png" alt="Promo Banner" >
        </div>
    </div>

    <!-- Flash Sale -->
<div class="flash-sale">
    <div class="flash-sale-header" data-aos="zoom-in">
        <h2>FLASH SALE</h2>
        <div class="countdown">
            <span>Berakhir dalam:</span>
            <div class="timer">
                <span id="hours">00</span>:
                <span id="minutes">00</span>:
                <span id="seconds">00</span>
            </div>
        </div>
        <script src="../js/countdown.js"></script>
    </div>
    
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <div class="product-badge">50%</div>
                <img src="../header/product/p1.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">POT HIASAN MINIMALIS</h3>
                    <div class="product-price">
                        <span class="product-original-price">Rp100.000</span>
                        <span class="product-discount">40%</span>
                        <div>Rp60.000</div>
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="product-rating-count">(120)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                      <button class="whatsapp-btn" onclick="buyViaWhatsApp('POT HIASAN MINIMALIS', 60000)">
                        <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                      </button>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <div class="product-badge">30%</div>
                <img src="../header/product/p2.jpg" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">RAK BUKU - MINIMALIS</h3>
                    <div class="product-price">
                        <span class="product-original-price">Rp30.000</span>
                        <span class="product-discount">50%</span>
                        <div>Rp15.000</div>
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="product-rating-count">(85)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('RAK BUKU - MINIMALIS', 15000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
              <div class="product-badge">30%</div>
                <img src="../header/product/p3.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">OPEN & CLOSE - JEWELS BOX</h3>
                    <div class="product-price">
                        <span class="product-original-price">Rp70.000</span>
                        <span class="product-discount">21%</span>
                        <div>Rp45.000</div>
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="product-rating-count">(210)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('OPEN & CLOSE - JEWELS BOX', 45000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <div class="product-badge">20%</div>
                <img src="../header/product/p4.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">KACAKU - CERMIN HIAS <br> Kerajinan Tangan</h3>
                    <div class="product-price">
                        <span class="product-original-price">Rp110.000</span>
                        <span class="product-discount">69%</span>
                        <div>Rp35.000</div>
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="product-rating-count">(2008)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('KACAKU - CERMIN HIAS  Kerajinan Tangan', 35000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
        </div>
</div>


    <!-- Recommended Products -->
    <div class="container">
        <h2 class="section-title">
            Rekomendasi Untuk Anda
            <a href="#">Lihat Semua</a>
        </h2>
        
        <div class="product-grid">
            <!-- Product 5 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <img src="../header/product/p5.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">JEPITAN RAMBUT ANAK<br>Cantik & Imut</h3>
                    <div class="product-price">Rp3.000</div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="product-rating-count">(42)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('JEPITAN RAMBUT ANAK Cantik & Imut', 3000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
            
            <!-- Product 6 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <div class="product-badge">15%</div>
                <img src="../header/product/p6.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">BINGKAI FOTO TALI RAMI A.S</h3>
                    <div class="product-price">Rp20.000
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="product-rating-count">(310)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('BINGKAI FOTO TALI RAMI A.S', 20000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
            
            <!-- Product 7 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <img src="../header/product/p7.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">KEKARDUS<br>KERAJINAN - TABUNGAN DARI KARDUS</h3>
                    <div class="product-price">Rp15.000</div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="product-rating-count">(78)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('KEKARDUS  KERAJINAN - TABUNGAN DARI KARDUS', 15000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
            
            <!-- Product 8 -->
            <div class="product-card" data-aos="fade-up" data-delay="400">
                <div class="product-badge">10%</div>
                <img src="../header/product/p8.png" alt="Product" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">RAK DINDING SEGI ENAM - Stik Kayu</h3>
                    <div class="product-price">Rp12.000
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="product-rating-count">(95)</span>
                    </div>
                    <div class="product-location">Indramayu</div>
                    <button class="whatsapp-btn" onclick="buyViaWhatsApp('RAK DINDING SEGI ENAM - Stik Kayu', 12000)">
                      <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
    
<?php
    require"../footer/footer.html";
?>

    <!-- Login/Logout Script -->
    <script>
        // Handle logout
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.querySelector('.dropdown-menu a[href="logout.php"]');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Perform logout via AJAX
                    fetch('logout.php')
                        .then(response => response.text())
                        .then(() => {
                            window.location.href = 'login.php';
                        });
                });
            }
        });
        
        
    
    
    // Handle dropdown menu
    const userMenuBtn = document.getElementById('userMenuBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownOverlay = document.getElementById('dropdownOverlay');
    const dropdownClose = document.getElementById('dropdownClose');
    const logoutBtn = document.getElementById('logoutBtn');
    
    // Buka menu
    userMenuBtn.addEventListener('click', function(e) {
        e.preventDefault();
        dropdownMenu.classList.add('active');
        dropdownOverlay.classList.add('active');
    });
    
    // Tutup menu
    function closeDropdown() {
        dropdownMenu.classList.remove('active');
        dropdownOverlay.classList.remove('active');
    }
    
    dropdownClose.addEventListener('click', closeDropdown);
    dropdownOverlay.addEventListener('click', closeDropdown);
    
    // Logout
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fetch('logout.php')
            .then(() => window.location.href = 'login.php');
    });
    
</script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script> <script> AOS.init(); </script>
</body>
</html>