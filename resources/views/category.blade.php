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
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            height: 64px;
        }
        .navbar-logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d2d2d;
            letter-spacing: 1px;
        }
        .navbar-logo img {
            height: 38px;
            margin-right: 10px;
        }
        .lang-switcher {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .lang-btn {
            background: none;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            color: #2d2d2d;
            cursor: pointer;
            padding: 4px 10px;
            border-radius: 6px;
            transition: background 0.15s;
        }
        .lang-btn.active, .lang-btn:hover {
            background: #f0ece6;
        }
        .category-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 24px 8px 24px 8px;
        }
        .category-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 32px;
            color: #2d2d2d;
        }
        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px 20px;
        }
        .category-card {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            aspect-ratio: 1/0.75;
            min-height: 140px;
            background: #eee;
            display: flex;
            align-items: stretch;
            border: none;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .category-card:hover {
            box-shadow: 0 6px 24px rgba(0,0,0,0.10);
            transform: translateY(-4px) scale(1.03);
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
            font-size: 1.45rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            text-shadow: 0 2px 12px rgba(0,0,0,0.38);
            padding: 0 8px;
            letter-spacing: 0.5px;
        }
        @media (max-width: 600px) {
            .navbar {
                padding: 0 6px;
                height: 48px;
            }
            .navbar-logo {
                font-size: 1.1rem;
            }
            .navbar-logo img {
                height: 28px;
                margin-right: 6px;
            }
            .category-container {
                padding: 10px 2px 18px 2px;
            }
            .category-title {
                font-size: 1.1rem;
                margin-bottom: 18px;
            }
            .category-grid {
                gap: 16px 8px;
            }
            .category-card {
                border-radius: 12px;
                min-height: 90px;
            }
            .category-name {
                font-size: 1.05rem;
                padding: 0 2px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-logo">
            <img src="https://placehold.co/48x48?text=L" alt="Logo">
            Meringa
        </div>
        <div class="lang-switcher">
            <button class="lang-btn" id="lang-tr">TR</button>
            <button class="lang-btn" id="lang-en">EN</button>
        </div>
    </nav>
    <div class="category-container">
        <h1 class="category-title">Kategoriler</h1>
        <div class="category-grid" id="categoryGrid">
            <!-- Kategoriler JS ile yüklenecek -->
        </div>
    </div>
    <script>
    // Dil seçimi ve localStorage
    let lang = localStorage.getItem('lang') || 'tr';
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
            const imgPath = `/img/category/${cat.key}.jpg`;
            const name = lang === 'tr' ? cat.name_tr : cat.name_en;
            const card = document.createElement('div');
            card.className = 'category-card';
            card.onclick = () => window.location.href = `/category/${cat.key}`;
            card.innerHTML = `
                <img class="category-bg" src="${imgPath}" alt="${name}">
                <div class="category-overlay"></div>
                <div class="category-content">
                    <div class="category-name">${name}</div>
                </div>
            `;
            grid.appendChild(card);
        });
    }
    fetchCategories();
    </script>
</body>
</html>
