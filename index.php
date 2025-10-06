<?php
session_start();


$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$logged_in = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiro Petshop - Toko Online Hewan Peliharaan</title>
    <meta name="description" content="Hiro Petshop adalah toko online yang menyediakan berbagai kebutuhan hewan peliharaan dengan sistem pembelian online yang mudah.">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <h1>Hiro Petshop</h1>
            <input type="checkbox" id="mobile-menu-toggle" class="mobile-menu-toggle">
            <label for="mobile-menu-toggle" class="mobile-menu-label">
                <i class="fas fa-bars"></i>
            </label>
            <ul class="nav-menu">
                <li><a href="index.php?page=home">Beranda</a></li>
                <li><a href="index.php?page=products">Produk</a></li>
                <li><a href="index.php?page=about">Tentang Kami</a></li>
                <li><a href="index.php?page=contact">Kontak</a></li>
                <li><a href="dashboard.php" style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 25px;">Dashboard</a></li>
                <li><a href="login.php" style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 25px;">Login</a></li>
 
            </ul>
        </nav>
    </header>

    <main>
        <section id="home">
            <div class="container">
                <h2>Selamat Datang di Hiro Petshop</h2>
                <p>Toko online hewan peliharaan yang menyediakan kebutuhan untuk hewan kesayangan Anda</p>
                <?php if ($logged_in): ?>
                    <p style="background: rgba(255,255,255,0.2); display: inline-block; padding: 10px 20px; border-radius: 10px; margin: 10px 0;">
                        👋 Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    </p>
                <?php endif; ?>
                <img src="gambar awal petshp.jpg" alt="Pet Shop with Various Animals - Welcome to Hiro Petshop" class="hero-image">
                <p>Berbelanja mudah dari rumah dengan produk berkualitas untuk hewan peliharaan Anda.</p>
                <br>
                <a href="index.php?page=products" class="btn btn-primary">Lihat Produk</a>
                <a href="index.php?page=contact" class="btn btn-secondary">Hubungi Kami</a>
            </div>
        </section>

        <section id="products">
            <div class="container">
                <h2 class="section-title">Produk Kami</h2>
                <p class="section-subtitle">Temukan berbagai produk berkualitas untuk kebutuhan hewan peliharaan kesayangan Anda</p>
                
                <?php if ($category): ?>
                    <div style="text-align: center; margin-bottom: 20px;">
                        <p style="color: #667eea; font-weight: 600;">
                            Menampilkan kategori: <?php echo htmlspecialchars($category); ?>
                        </p>
                        <a href="index.php?page=products" style="color: #764ba2; text-decoration: none;">
                            ← Lihat semua produk
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="products-grid">
                    <article class="card product-card">
                        <img src="gambar untuk makanan hewan.webp" alt="Pet Food Collection - Various Brands" class="product-image">
                        <h3>Makanan Hewan</h3>
                        <p>Berbagai pilihan makanan berkualitas untuk kucing, anjing, burung, dan hewan peliharaan lainnya dari brand ternama seperti Nutro, IAMS, Crave, dan lainnya.</p>
                        <a href="index.php?page=products&category=makanan" class="btn btn-primary" style="margin-top: 10px; display: inline-block;">Lihat Detail</a>
                    </article>

                    <article class="card product-card">
                        <img src="mainan hewan.jpg" alt="Pet Accessories" class="product-image">
                        <h3>Aksesoris & Mainan</h3>
                        <p>Koleksi lengkap aksesoris seperti kalung, tali, kandang, tempat makan, dan mainan edukatif untuk hewan peliharaan.</p>
                        <a href="index.php?page=products&category=aksesoris" class="btn btn-primary" style="margin-top: 10px; display: inline-block;">Lihat Detail</a>
                    </article>

                    <article class="card product-card">
                        <img src="gamabar untuk produk perawatan hewan.jpg" alt="Pet Care Products" class="product-image">
                        <h3>Produk Perawatan</h3>
                        <p>Shampoo, vitamin, obat-obatan, dan produk kesehatan lainnya untuk menjaga kebersihan dan kesehatan hewan peliharaan.</p>
                        <a href="index.php?page=products&category=perawatan" class="btn btn-primary" style="margin-top: 10px; display: inline-block;">Lihat Detail</a>
                    </article>

                    <article class="card product-card">
                        <img src="gambar hewan.jpg" alt="Pets" class="product-image">
                        <h3>Hewan Peliharaan</h3>
                        <p>Kami juga menyediakan berbagai jenis hewan peliharaan yang sehat dan terawat dengan baik.</p>
                        <a href="index.php?page=products&category=hewan" class="btn btn-primary" style="margin-top: 10px; display: inline-block;">Lihat Detail</a>
                    </article>

                    <article class="card card-featured product-card">
                        <h3>Cara Pemesanan</h3>
                        <p>Hubungi kami melalui WhatsApp atau email untuk memesan produk. Kami akan membantu Anda memilih produk yang tepat untuk hewan peliharaan Anda.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="about">
            <div class="container">
                <h2 class="section-title">Tentang Hiro Petshop</h2>
                <div class="about-content">
                    <div class="about-text">
                        <p>Hiro Petshop adalah toko online yang baru memulai usaha pada tahun 2025. Kami fokus menyediakan produk-produk kebutuhan hewan peliharaan dengan sistem pembelian online yang mudah.</p>
                        
                        <p>Sebagai toko online yang baru memulai, kami berkomitmen untuk memberikan produk berkualitas dan kemudahan berbelanja untuk para pemilik hewan peliharaan.</p>
                    </div>
                    
                    <div class="features">
                        <h3>Keunggulan Berbelanja di Hiro Petshop</h3>
                        <ul class="features-list">
                            <li>Berbelanja dari rumah dengan mudah</li>
                            <li>Produk berkualitas untuk hewan peliharaan</li>
                            <li>Harga terjangkau</li>
                            <li>Pelayanan online yang responsif</li>
                            <li>Pengiriman ke seluruh Indonesia</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <h2 class="section-title" style="color: white;">Hubungi Kami</h2>
                <p class="section-subtitle" style="color: rgba(255,255,255,0.9);">Kami siap membantu Anda menemukan produk terbaik untuk hewan peliharaan kesayangan</p>
                
                <div class="contact-content">
                    <address class="contact-info">
                        <h3>Informasi Kontak</h3>
                        <p>
                            <strong>WhatsApp:</strong> <a href="https://wa.me/6285750316170">+62 857-5031-6170</a><br><br>
                            <strong>Email:</strong> <a href="mailto:info@hiropetshop.com">info@hiropetshop.com</a>
                        </p>
                    </address>

                    <div class="schedule-table">
                        <h3>Jam Operasional Online</h3>
                        <table>
                            <tr>
                                <td>Senin - Jumat</td>
                                <td>09:00 - 18:00 WIB</td>
                            </tr>
                            <tr>
                                <td>Sabtu - Minggu</td>
                                <td>09:00 - 17:00 WIB</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div>
                <p>© 2025 Hiro Petshop. Dibuat dengan sepenuh hati untuk para pecinta hewan peliharaan.</p>
                <?php if ($logged_in): ?>
                    <p style="margin-top: 10px; font-size: 0.9rem;">
                        Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                    </p>
                <?php endif; ?>
            </div>
            
            <div>
                <h4>Referensi Desain:</h4>
                <ul>
                    <li><a href="https://www.petsmart.com/" target="_blank" rel="noopener noreferrer">PetSmart - Pet Supplies, Pet Food & Pet Products</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
