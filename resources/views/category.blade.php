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

        /* WhatsApp Sabit İkonu */
        .whatsapp-fixed {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25d366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        .whatsapp-fixed:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.6);
            background: #20ba5a;
        }

        .whatsapp-fixed:active {
            transform: scale(0.95);
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.5);
        }

        .whatsapp-fixed svg {
            width: 32px;
            height: 32px;
        }

        @media (max-width: 768px) {
            .whatsapp-fixed {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
            }

            .whatsapp-fixed svg {
                width: 28px;
                height: 28px;
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

    <!-- WhatsApp Sabit İkonu -->
    <a href="https://wa.me/905384088034" target="_blank" class="whatsapp-fixed" title="WhatsApp'tan Mesaj Gönder">
        <svg fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
        </svg>
    </a>

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
