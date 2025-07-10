<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meringa QR Menü</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>

        body {
            background: #f3f6fa;
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
        }
        .navbar {
            width: 100%;
            background: #222;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: relative;
            height: 100px;
        }
        .navbar-logo {
            position: absolute;
            left: 0; right: 0;
            top: 0; bottom: 0;
            margin: auto;
            height: 100px;
            width: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }
        .navbar-logo img {
            height: 90px;
            margin-right: 10px;
        }
        .lang-switcher {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .lang-btn {
            background: #222;
            border: none;
            font-size: 0.9rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            padding: 4px 10px;
            border-radius: 8px;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            outline: none;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }
        .lang-btn.active, .lang-btn:focus {
            background: #fff;
            color: #111;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }

        .lang-btn:active {
            transform: scale(0.95);
            box-shadow: 0 1px 4px rgba(0,0,0,0.15);
        }
        .category-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 16px 8px 24px 8px;
        }
        .category-title {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 18px;
            color: #2d2d2d;
        }
        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        .category-card {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            min-height: 200px;
            background: #eee;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            border: none;
            width: 100%;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
            transition: all 0.3s ease;
        }
        .category-bg {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        .category-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.32);
            z-index: 2;
        }
        .category-content {
            position: relative;
            z-index: 3;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .category-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            text-shadow: 0 2px 12px rgba(0,0,0,0.38);
            padding: 0 8px;
            letter-spacing: 0.5px;
        }

        .category-card:active {
            transform: scale(0.96);
            box-shadow: 0 1px 8px rgba(0,0,0,0.12);
        }
        @media (min-width: 600px) {
            .category-container {
                max-width: 480px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-logo">
            <img src="/img/meringa.png" alt="Logo">
        </div>
        <div class="lang-switcher">
            <button class="lang-btn" id="lang-tr">TR</button>
            <button class="lang-btn" id="lang-en">EN</button>
        </div>
    </nav>
    <div class="category-container">
        <div class="category-grid" id="categoryGrid">
            <!-- Kategoriler JS ile yüklenecek -->
        </div>
    </div>
    <script>
    // Dil seçimi ve localStorage
    function getLangFromUrl() {
        const params = new URLSearchParams(window.location.search);
        return params.get('lang');
    }
    let lang = getLangFromUrl() || 'tr';
    function setLang(newLang) {
        lang = newLang;
        localStorage.setItem('lang', lang);
        updateLangButtons();
        renderCategories();
    }
    function updateLangButtons() {
        document.getElementById('lang-tr').classList.toggle('active', lang === 'tr');
        document.getElementById('lang-en').classList.toggle('active', lang === 'en');
    }
    document.getElementById('lang-tr').onclick = () => setLang('tr');
    document.getElementById('lang-en').onclick = () => setLang('en');
    updateLangButtons();

    // Kategorileri products.json'dan çek ve göster
    let categories = [];
    async function fetchCategories() {
        const res = await fetch('/js/products.json');
        const data = await res.json();
        categories = data.categories;
        renderCategories();
    }
    function renderCategories() {
        const grid = document.getElementById('categoryGrid');
        grid.innerHTML = '';
        categories.forEach(cat => {
            // Görsel yolu kategori anahtarına göre
            let imgPath = `/img/category/${cat.key}.jpg`;
            const name = lang === 'tr' ? cat.name_tr : cat.name_en;
            const card = document.createElement('div');
            card.className = 'category-card';
            card.onclick = () => window.location.href = `/category/${cat.key}?lang=${lang}`;
            // Resmin olup olmadığını kontrol et
            const img = new Image();
            img.onload = function() {
                card.innerHTML = `
                    <img class="category-bg" src="${imgPath}" alt="${name}">
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <div class="category-name">${name}</div>
                    </div>
                `;
            };
            img.onerror = function() {
                card.innerHTML = `
                    <img class="category-bg" src="/img/default.jpg" alt="${name}">
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <div class="category-name">${name}</div>
                    </div>
                `;
            };
            img.src = imgPath;
            grid.appendChild(card);
        });
    }
    fetchCategories();
    </script>
</body>
</html>
