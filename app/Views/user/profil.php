<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-item {
            color: #666;
            text-decoration: none;
            padding: 5px 10px;
        }

        .nav-item:hover {
            color: #333;
        }

        .cart-btn {
            background-color: #666;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .container {
            max-width: 1210px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            gap: 40px;
        }

        .profile-form {
            flex: 2;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .profile-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            font-weight: normal;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
        }

        .form-group.full-width {
            width: 100%;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #666;
        }

        .form-input::placeholder {
            color: #999;
        }

        .form-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .sidebar {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-primary {
            background-color: #666;
            color: white;
        }

        .btn-primary:hover {
            background-color: #555;
        }

        .btn-secondary {
            background-color: #999;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #777;
        }

        .btn-save {
            background-color: #666;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-save:hover {
            background-color: #555;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-menu {
                display: none;
            }

            .form-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <main>
    <div class="container">
        <div class="profile-form">
            <h1 class="profile-title">Profile Pengguna</h1>
            
            <form method="post" action="<?= base_url('/user/profil/update') ?>">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" class="form-input" placeholder="Nama awal" name="nama" value="<?= $user['nama'] ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <input type="text" class="form-input" placeholder="Alamat" name="alamat" value="<?= $user['alamat'] ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <input type="email" class="form-input" placeholder="Email" name="email" value="<?= $user['email'] ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <input type="tel" class="form-input" placeholder="No HP" name="no_hp" value="<?= $user['no_hp'] ?>">
                    </div>
                </div>

                <div class="form-buttons">
                    <button class="btn-save" type="submit">Simpan</button>
                </div>
            </form>
        </div>

        <div class="sidebar">
            <button class="sidebar-btn btn-primary" type="button" onclick="gantiPassword()">Ganti Password</button>
            <button class="sidebar-btn btn-primary" type="button" onclick="logout()">Logout</button>
        </div>
    </div>
            
    </main>

    <script>
        // Menambahkan interaktivitas sederhana
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#666';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = '#ddd';
            });
        });

        // Event listener untuk tombol
        function gantiPassword() {
            alert('Fitur ganti password akan segera tersedia');
        }

        function logout() {
            if(confirm('Apakah Anda yakin ingin logout?')) {
                // Redirect ke halaman logout
                window.location.href = '<?= base_url('/logout') ?>';
            }
        }
    </script>
</body>
</html>
<?= $this->endSection(); ?>