<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – Warung Mbah Darmo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --md-primary: #800000; --md-primary-dark: #6B1D1D;
            --md-gold: #A18A43; --md-gold-light: #C8AA68;
            --md-charcoal: #2C2215; --md-bg: #FDFBF7;
            --md-border: #E8DDD0; --md-text: #3D2B1F;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--md-charcoal) 0%, #1a0a0a 60%, #2d1505 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 2rem;
        }
        .login-card {
            background: #fff; border-radius: 24px;
            padding: 3rem 2.5rem; width: 100%; max-width: 440px;
            box-shadow: 0 20px 80px rgba(0,0,0,0.4);
        }
        .brand { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; color: var(--md-primary); }
        .brand span { color: var(--md-gold); }
        .form-label { font-size: 0.78rem; font-weight: 600; color: #7A6555; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control {
            border: 1px solid var(--md-border); border-radius: 10px;
            padding: 0.75rem 1rem; font-size: 0.9rem; background: #FDFBF7;
        }
        .form-control:focus { border-color: var(--md-primary); box-shadow: 0 0 0 3px rgba(128,0,0,0.1); background: #fff; }
        .btn-login {
            background: var(--md-primary); color: #fff; border: none;
            border-radius: 50px; padding: 0.8rem; font-weight: 600; font-size: 0.9rem;
            width: 100%; transition: all 0.3s ease; letter-spacing: 0.3px;
        }
        .btn-login:hover { background: var(--md-primary-dark); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(128,0,0,0.3); }
        .alert-error { background: rgba(128,0,0,0.06); border: 1px solid rgba(128,0,0,0.15); color: #6B1D1D; border-radius: 10px; font-size: 0.875rem; padding: 0.75rem 1rem; }
        .alert-success { background: rgba(25,135,84,0.08); border: 1px solid rgba(25,135,84,0.2); color: #0f6d43; border-radius: 10px; font-size: 0.875rem; padding: 0.75rem 1rem; }
        .divider-text { text-align:center; color:#aaa; font-size:0.75rem; position:relative; margin:1.5rem 0; }
        .divider-text::before, .divider-text::after { content:''; position:absolute; top:50%; width:42%; height:1px; background:var(--md-border); }
        .divider-text::before { left:0; } .divider-text::after { right:0; }
        .back-link { color:rgba(255,255,255,0.5); font-size:0.8rem; text-decoration:none; transition:all 0.3s; }
        .back-link:hover { color:var(--md-gold-light); }
        .password-wrap { position:relative; }
        .toggle-pass { position:absolute; right:0.85rem; top:50%; transform:translateY(-50%); background:none; border:none; color:#aaa; cursor:pointer; padding:0.2rem; }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="login-card">
            <!-- Brand -->
            <div class="text-center mb-4">
                <div class="brand mb-1">Warung <span>Mbah Darmo</span></div>
                <p style="font-size:0.8rem; color:#aaa; margin:0;">Panel Admin — Masuk untuk melanjutkan</p>
            </div>

            <!-- Alerts -->
            @if(session('success'))
            <div class="alert-success mb-3"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert-error mb-3"><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</div>
            @endif
            @if($errors->any())
            <div class="alert-error mb-3">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="Email"
                           value="{{ old('email') }}" required autocomplete="email">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrap">
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Password" required autocomplete="current-password">
                        <button type="button" class="toggle-pass" onclick="togglePass()">
                            <i class="bi bi-eye" id="passIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember" style="font-size:0.8rem; color:#7A6555;">Ingat saya</label>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
                </button>
            </form>

            
        </div>

        <div class="mt-4">
            <a href="{{ route('home') }}" class="back-link">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <script>
    function togglePass() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('passIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
    </script>
</body>
</html>
