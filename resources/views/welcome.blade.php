<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meringa Cafe - Hoş Geldiniz</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            position: relative;
            overflow: hidden;
        }
        .bg-image {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            object-fit: cover;
            z-index: 1;
        }
        .bg-overlay {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.55);
            z-index: 2;
        }
        .center-content {
            position: relative;
            z-index: 3;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: -80px;
        }
        .action-btn {
            display: block;
            margin: 0 auto;
            padding: 1rem 0;
            font-size: 1.5rem;
            font-weight: 600;
            border: 1.5px solid rgba(255, 255, 255, 0.8);
            border-radius: 2.5rem;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.95);
            color: #333;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
            max-width: 200px;
            width: 100%;
            letter-spacing: 1.5px;
            text-align: center;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
            backdrop-filter: blur(10px);
        }
        @media (max-width: 480px) {
            .action-btn { padding: 0.75rem 0rem; border-radius: 2rem; font-size: 1.25rem; }
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
            border-color: rgba(255, 255, 255, 1);
        }

        .action-btn:active {
            transform: scale(0.98) translateY(-1px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 6px 20px rgba(0,0,0,0.18);
        }
    </style>
</head>
<body>
    <img src="{{ asset('img/bg.jpg') }}" alt="Kafe Arka Plan" class="bg-image">
    <div class="bg-overlay"></div>
    <div class="center-content">
        <img src="{{ asset('img/meringa.png') }}" alt="Meringa Cafe Logo" style="max-width: 260px; margin-bottom: 1.5rem; margin-top: -100px; display: block;">
        <a class="action-btn" id="menuBtn" href='{{ route('categories') }}'>MENÜ</a>
    </div>
    <script>
    // Dil seçimini URL parametresi veya localStorage'dan al
    function getLangFromUrl() {
        const params = new URLSearchParams(window.location.search);
        return params.get('lang');
    }
    let lang = getLangFromUrl() || localStorage.getItem('lang') || 'tr';
    localStorage.setItem('lang', lang);
    // Buton metnini dile göre ayarla
    document.getElementById('menuBtn').textContent = lang === 'tr' ? 'MENÜ' : 'MENU';
    // Kategori sayfasına giderken dili URL ile aktar
    document.getElementById('menuBtn').onclick = function(e) {
        e.preventDefault();
        window.location.href = '{{ route('categories') }}' + '?lang=' + lang;
    };
    </script>
</body>
</html>
