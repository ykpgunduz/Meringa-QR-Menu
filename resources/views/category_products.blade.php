<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Ürünleri | Meringa QR Menü</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            line-height: 1.6;
            color: #fff;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .header {
            position: relative;
            height: 350px;
            background: #f5f5f5;
            overflow: hidden;
            border-radius: 0 0 15px 15px;
        }

        .header-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .header-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        .header-title {
            color: #fff;
            font-size: 2.6rem;
            font-weight: 700;
            margin-bottom: 28px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.8), 0 4px 20px rgba(0,0,0,0.6);
            letter-spacing: -0.8px;
        }

        .header-btn {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: #1a1a1a;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: 30px;
            padding: 8px 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        .header-btn:hover {
            background: #fff;
            color: #1a1a1a;
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }

        .header-btn:active {
            transform: translateY(-1px) scale(0.95);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
        }

        .header-controls {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            z-index: 15;
        }

        .header-lang, .header-search {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a1a;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        .header-lang {
            font-size: 0.9rem;
            font-weight: 700;
        }

        .header-lang:hover, .header-search:hover {
            background: #fff;
            color: #1a1a1a;
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(0,0,0,0.3);
        }

        .header-lang:active, .header-search:active {
            transform: scale(0.9);
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 10px rgba(0,0,0,0.25);
        }

        .main-content {
            background: #fff;
            color: #2d2d2d;
        }

        .product-list {
            padding: 0;
            background: #fff;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 24px 20px;
            border-bottom: 1px solid #f0f2f5;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            background: #fff;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        .product-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #d4af37, #ffd700);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .product-item:hover::before {
            transform: scaleY(1);
        }

        .product-item:hover {
            background: linear-gradient(135deg, #fafbfc 0%, #f8f9fa 100%);
            transform: translateX(8px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .product-item:active {
            transform: scale(0.98) translateX(8px);
            background: linear-gradient(135deg, #f0f2f5 0%, #e8eaed 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.12);
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-img {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            object-fit: cover;
            background: #f5f5f5;
            margin-right: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            transition: all 0.3s ease;
            border: 2px solid #f8f9fa;
        }

        .product-item:hover .product-img {
            transform: scale(1.08);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.2);
            border-color: #d4af37;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .product-name {
            font-size: 1.15rem;
            font-weight: 600;
            color: #2d2d2d;
            margin-right: 12px;
            line-height: 1.3;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #d4af37;
            white-space: nowrap;
            text-shadow: 0 1px 3px rgba(212, 175, 55, 0.2);
            position: relative;
        }

        .product-price::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #d4af37, #ffd700);
            border-radius: 1px;
        }

        .product-desc {
            font-size: 0.9rem;
            color: #718096;
            line-height: 1.5;
            margin-top: 6px;
            font-weight: 400;
        }

        .empty-state {
            text-align: center;
            padding: 100px 20px;
            color: #a0aec0;
            background: #fff;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.6;
        }

        .empty-text {
            font-size: 1.2rem;
            font-weight: 500;
            color: #6c757d;
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #d4af37, #ffd700);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a1a;
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(212, 175, 55, 0.4);
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(100px);
            z-index: 1000;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(212, 175, 55, 0.6);
            background: linear-gradient(135deg, #ffd700, #d4af37);
        }

        .back-to-top:active {
            transform: translateY(-4px) scale(0.95);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
        }

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            font-size: 1.1rem;
            color: #6c757d;
            background: #fff;
        }

        .loading::after {
            content: '';
            width: 24px;
            height: 24px;
            border: 3px solid #f3f4f6;
            border-top: 3px solid #d4af37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 12px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .product-item {
            animation: fadeIn 0.6s ease forwards;
        }

        @media (max-width: 768px) {
            .header {
                height: 320px;
                border-radius: 0 0 15px 15px;
            }

            .header-title {
                font-size: 2.2rem;
            }

            .header-controls {
                top: 15px;
                left: 15px;
                right: 15px;
            }

            .header-lang, .header-search {
                width: 40px;
                height: 40px;
            }

            .product-item {
                padding: 18px 16px;
            }

            .product-img {
                width: 70px;
                height: 70px;
                margin-right: 16px;
            }

            .product-name {
                font-size: 1.05rem;
            }

            .product-price {
                font-size: 1.1rem;
            }

            .product-desc {
                font-size: 0.85rem;
            }

            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            .header {
                height: 300px;
                border-radius: 0 0 15px 15px;
            }

            .header-title {
                font-size: 2rem;
            }

            .product-item {
                padding: 16px 14px;
            }

            .product-img {
                width: 65px;
                height: 65px;
                margin-right: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img class="header-img" id="headerImg" src="" alt="Kategori Görseli">
            <div class="header-overlay"></div>
            <div class="header-controls">
                <button class="header-lang" id="lang-toggle"></button>
                <div class="header-search" title="Ara">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
            </div>
            <div class="header-content">
                <div class="header-title" id="categoryTitle">Kategori</div>
                <button class="header-btn" id="backMenuBtn">Menüye Dön</button>
            </div>
        </div>

        <div class="main-content">
            <div class="product-list" id="productList">
                <div class="loading" id="loadingState">Ürünler yükleniyor</div>
            </div>

            <div class="empty-state" id="emptyState" style="display:none;">
                <div class="empty-icon">🍽️</div>
                <div class="empty-text">Bu kategoride ürün bulunmuyor</div>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top" id="backToTop">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <line x1="12" y1="19" x2="12" y2="5"/>
            <polyline points="5,12 12,5 19,12"/>
        </svg>
    </a>

    <div class="containers" style="height: 250px; background-color: gray;">

    </div>

    <script>
        // Dil seçimi
        function getLangFromUrl() {
            const params = new URLSearchParams(window.location.search);
            return params.get('lang');
        }

        let lang = getLangFromUrl() || 'tr';

        function toggleLang() {
            lang = lang === 'tr' ? 'en' : 'tr';
            updateLangButton();
            renderPage();
        }

        function updateLangButton() {
            const btn = document.getElementById('lang-toggle');
            btn.textContent = lang.toUpperCase();
        }

        // Scroll to top functionality
        const backToTop = document.getElementById('backToTop');

        function checkScrollPosition() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        }

        window.addEventListener('scroll', checkScrollPosition);
        window.addEventListener('load', checkScrollPosition);

        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        document.getElementById('lang-toggle').onclick = toggleLang;
        updateLangButton();

        // Kategori anahtarı URL'den alınır
        function getCategoryKey() {
            const path = window.location.pathname;
            const match = path.match(/category\/(.+)$/);
            return match ? match[1] : '';
        }

        let productsData = null;

        async function fetchData() {
            try {
                const res = await fetch('/js/products.json');
                productsData = await res.json();
                renderPage();
            } catch (error) {
                console.error('Veri yükleme hatası:', error);
                document.getElementById('loadingState').textContent = 'Yükleme hatası oluştu';
            }
        }

        function renderPage() {
            if (!productsData) return;

            const catKey = getCategoryKey();
            const category = productsData.categories.find(c => c.key === catKey);

            // Kategori bilgilerini güncelle
            const categoryTitle = category ? (lang === 'tr' ? category.name_tr : category.name_en) : 'Kategori';
            document.getElementById('categoryTitle').textContent = categoryTitle;

            // Kategori görseli
            document.getElementById('headerImg').src = `/img/category/${catKey}.jpg`;

            // Menüye dön butonunu güncelle
            document.getElementById('backMenuBtn').textContent = lang === 'tr' ? 'Menüye Dön' : 'Back to Menu';
            document.getElementById('backMenuBtn').onclick = function() {
                window.location.href = '/?lang=' + lang;
            };

            const productList = document.getElementById('productList');
            const emptyState = document.getElementById('emptyState');
            const loadingState = document.getElementById('loadingState');

            // Loading state'i gizle
            loadingState.style.display = 'none';

            productList.innerHTML = '';
            emptyState.style.display = 'none';

            const products = productsData.products[catKey] || [];

            if (products.length === 0) {
                const emptyMessage = lang === 'tr' ? 'Bu kategoride ürün bulunmuyor' : 'No products in this category';
                emptyState.querySelector('.empty-text').textContent = emptyMessage;
                emptyState.style.display = 'block';
                return;
            }

            // Ürünleri render et
            products.forEach((product, index) => {
                const item = document.createElement('div');
                item.className = 'product-item';
                item.style.animationDelay = `${index * 0.1}s`;

                const imgPath = `/img/products/${catKey}/${product.id}.jpg`;
                const productName = lang === 'tr' ? product.name_tr : product.name_en;
                const productDesc = lang === 'tr' ? product.desc_tr : product.desc_en;

                item.innerHTML = `
                    <img class='product-img' src='${imgPath}' alt='${productName}' onerror="this.onerror=null;this.src='/img/default.jpg';">
                    <div class='product-info'>
                        <div class='product-header'>
                            <div class='product-name'>${productName}</div>
                            <div class='product-price'>${product.price}₺</div>
                        </div>
                        <div class='product-desc'>${productDesc || ''}</div>
                    </div>
                `;

                productList.appendChild(item);
            });

            // Scroll pozisyonunu kontrol et
            checkScrollPosition();
        }

        // Sayfa yüklendiğinde
        document.addEventListener('DOMContentLoaded', function() {
            fetchData();
        });
    </script>
</body>
</html>
