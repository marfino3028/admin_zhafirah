<?php
session_start();
include "3rdparty/engine.php";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $user = $db->query("SELECT * FROM tbl_user WHERE email='$email' AND password='$password' AND status='1'");
    
    if($user) {
        $_SESSION['rg_user'] = $user[0]['userid'];
        $_SESSION['rg_nama'] = $user[0]['nama_user'];
        $_SESSION['rg_nip'] = $user[0]['nip'];
        $_SESSION['rg_status'] = $user[0]['status'];
        $_SESSION['rg_shift'] = '1';
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}

if(isset($_SESSION['rg_user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wisata Haromain</title>
    <link href="vendor/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            background: white;
            padding: 40px 30px 30px;
            text-align: center;
        }
        .login-header img {
            max-width: 200px;
            margin-bottom: 10px;
        }
        .login-header h4 {
            color: #2c3e50;
            margin: 10px 0 5px;
            font-weight: 600;
        }
        .login-header p {
            color: #7f8c8d;
            font-size: 14px;
            margin: 0;
        }
        .login-body {
            padding: 40px 30px;
            background: white;
        }
        .login-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .login-subtitle {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: none;
        }
        .input-group {
            position: relative;
        }
        .input-group-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
            font-size: 18px;
            z-index: 10;
        }
        .form-control {
            height: 50px;
            border: 1px solid #dfe4ea;
            border-radius: 8px;
            padding-left: 45px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-login {
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .alert {
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="images/logo-haromain.png" alt="Wisata Haromain" onerror="this.style.display='none'">
            <h4>DEMO TRAVEL</h4>
            <h4>WISATA HAROMAIN</h4>
            <p style="color: #c4803f; font-weight: 600;">TOUR & TRAVEL</p>
            <p style="color: #34495e;">Travel Management System</p>
        </div>
        <div class="login-body">
            <h2 class="login-title">Login</h2>
            <p class="login-subtitle">Sign In to your account</p>
            
            <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-icon">👤</span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-icon">🔒</span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" name="login" class="btn-login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
