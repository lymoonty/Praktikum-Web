<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$login_time = isset($_SESSION['login_time']) ? date('d M Y H:i:s', $_SESSION['login_time']) : 'Unknown';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hiro Petshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .header h1::before {
            content: '🐾';
            margin-right: 10px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-name {
            font-weight: 500;
        }
        
        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .welcome-section {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .welcome-section h2 {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .welcome-section p {
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card h3 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 5px;
        }
        
        .stat-card p {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .quick-actions {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .quick-actions h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
        }
        
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .action-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
            display: block;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        .action-btn i {
            margin-right: 8px;
        }
        
        .action-btn.logout-btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .action-btn.logout-btn:hover {
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.4);
        }
        
        .session-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .session-info strong {
            color: #333;
        }
        
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>Dashboard Hiro Petshop</h1>
            <div class="user-info">
                <span class="user-name">👤 <?php echo htmlspecialchars($username); ?></span>
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="welcome-section">
            <h2>Selamat Datang, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>Anda berhasil login ke dashboard Hiro Petshop</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-shopping-cart"></i>
                <h3>156</h3>
                <p>Total Pesanan</p>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-box"></i>
                <h3>48</h3>
                <p>Produk Aktif</p>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3>1,234</h3>
                <p>Total Pelanggan</p>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-chart-line"></i>
                <h3>Rp 12.5M</h3>
                <p>Pendapatan Bulan Ini</p>
            </div>
        </div>
        
        <div class="quick-actions">
            <div class="action-buttons">
                <a href="logout.php" class="action-btn logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
        
        <div class="session-info">
            <strong>Informasi Session:</strong><br>
            Username: <?php echo htmlspecialchars($username); ?><br>
            Waktu Login: <?php echo htmlspecialchars($login_time); ?><br>
            Session ID: <?php echo htmlspecialchars(session_id()); ?>
        </div>
    </div>
</body>
</html>
