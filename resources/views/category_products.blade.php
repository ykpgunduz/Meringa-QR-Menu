<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Ürünleri | Meringa QR Menü</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #f3f6fa; font-family: 'Inter', Arial, sans-serif; margin: 0; }
        .header {
            position: relative;
            width: 100%;
            max-width: 700px;
            margin: 32px auto 0 auto;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(0,0,0,0.10);
            min-height: 220px;
            background: #eee;
        }
        .header-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            filter: brightness(0.7);
        }
        .header-content {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .header-title {
            color: #fff;
            font-size: 2.2rem;
            font-weight: 800;
            text-shadow: 0 2px 16px rgba(0,0,0,0.25);
            margin-bottom: 18px;
            text-align: center;
        }
        .header-btn {
            background: rgba(255,255,255,0.12);
            border: 2px solid #fff;
            color: #fff;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 32px;
            padding: 8px 32px;
            cursor: pointer;
            transition: background 0.18s, color 0.18s;
        }
        .header-btn:hover {
            background: #fff;
            color: #232323;
        }
        .header-lang {
            position: absolute;
            top: 18px;
            left: 18px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(0,0,0,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
            font-size: 1.1rem;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            border: none;
            outline: none;
            transition: background 0.18s, color 0.18s;
        }
        .header-lang.active, .header-lang:hover {
            background: #fff;
            color: #232323;
        }
        .header-search {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(0,0,0,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
            font-size: 1.5rem;
            color: #fff;
            cursor: pointer;
        }
        .main-content {
            max-width: 700px;
            margin: 0 auto 32px auto;
            background: #fff;
            border-radius: 0 0 18px 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.10);
            padding: 0 0 24px 0;
        }
        .product-list {
            padding: 0 24px;
        }
        .product-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            border-bottom: 1px solid #f0f0f0;
            padding: 22px 0 18px 0;
        }
        .product-img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            object-fit: cover;
            background: #f5f5f5;
            flex-shrink: 0;
        }
        .product-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-row {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .product-name {
            font-size: 1.13rem;
            font-weight: 700;
            color: #2563a9;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-family: inherit;
        }
        .product-dots {
            flex: 1;
            border-bottom: 2px dotted #bfc9d1;
            margin: 0 10px 2px 10px;
            height: 0.7em;
            min-width: 10px;
        }
        .product-price {
            font-size: 1.13rem;
            font-weight: 700;
            color: #2563a9;
            white-space: nowrap;
            font-family: inherit;
        }
        .product-desc {
            font-size: 0.98rem;
            color: #3a4a5a;
            margin-top: 2px;
            line-height: 1.45;
        }
        .empty-state {
            text-align: center;
            color: #aaa;
            font-size: 1.2rem;
            margin-top: 60px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        @media (max-width: 800px) {
            .header, .main-content { max-width: 100vw; border-radius: 0; }
            .main-content { margin-bottom: 0; }
        }
        @media (max-width: 600px) {
            .header { margin: 0; min-height: 140px; }
            .header-img { height: 140px; }
            .header-title { font-size: 1.1rem; margin-bottom: 10px; }
            .header-btn { font-size: 0.95rem; padding: 6px 18px; }
            .header-lang, .header-search { width: 36px; height: 36px; top: 8px; }
            .header-lang { font-size: 0.95rem; }
            .header-search { font-size: 1.1rem; }
            .main-content { padding: 0 0 10px 0; }
            .product-list { padding: 0 6px; }
            .product-item { gap: 8px; padding: 12px 0 10px 0; }
            .product-img { width: 44px; height: 44px; border-radius: 7px; }
            .product-name, .product-price { font-size: 0.98rem; }
            .product-desc { font-size: 0.89rem; }
        }
    </style>
</head>
<body>
    <div class="header">
        <img class="header-img" id="headerImg" src="" alt="Kategori Görseli">
        <button class="header-lang" id="lang-toggle"></button>
        <div class="header-search" title="Ara">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <div class="header-content">
            <div class="header-title" id="categoryTitle">Kategori</div>
            <button class="header-btn" onclick="window.location.href='/'">MENÜYE DÖN</button>
        </div>
    </div>
    <div class="main-content">
        <div class="product-list" id="productList"></div>
        <div class="empty-state" id="emptyState" style="display:none;"></div>
    </div>
    <script>
    // Dil seçimi ve localStorage
    let lang = localStorage.getItem('lang') || 'tr';
    function toggleLang() {
        lang = lang === 'tr' ? 'en' : 'tr';
        localStorage.setItem('lang', lang);
        updateLangButton();
        renderPage();
    }
    function updateLangButton() {
        const btn = document.getElementById('lang-toggle');
        btn.textContent = lang.toUpperCase();
        btn.classList.add('active');
    }
    document.getElementById('lang-toggle').onclick = toggleLang;
    updateLangButton();

    // Kategori anahtarı URL'den alınır (ör: /category/ekmekler)
    function getCategoryKey() {
        const path = window.location.pathname;
        const match = path.match(/category\/(.+)$/);
        return match ? match[1] : '';
    }
    let productsData = null;
    async function fetchData() {
        const res = await fetch('/js/products.json');
        productsData = await res.json();
        renderPage();
    }
    function renderPage() {
        if (!productsData) return;
        const catKey = getCategoryKey();
        const category = productsData.categories.find(c => c.key === catKey);
        document.getElementById('categoryTitle').textContent = category ? (lang === 'tr' ? category.name_tr : category.name_en) : '';
        // Kategori görseli
        document.getElementById('headerImg').src = `/img/category/${catKey}.jpg`;
        const productList = document.getElementById('productList');
        const emptyState = document.getElementById('emptyState');
        productList.innerHTML = '';
        emptyState.style.display = 'none';
        const products = productsData.products[catKey] || [];
        if (products.length === 0) {
            emptyState.textContent = lang === 'tr' ? 'Bu kategoride ürün yok.' : 'No products in this category.';
            emptyState.style.display = 'block';
            return;
        }
        for (const p of products) {
            const item = document.createElement('div');
            item.className = 'product-item';
            // Ürün görseli için kategoriye göre örnek bir yol
            const imgPath = `/img/products/${catKey}/${p.id}.jpg`;
            item.innerHTML = `
                <img class='product-img' src='${imgPath}' alt='${lang === 'tr' ? p.name_tr : p.name_en}' onerror="this.onerror=null;this.src='/img/products/default.jpg';">
                <div class='product-info'>
                    <div class='product-row'>
                        <span class='product-name'>${lang === 'tr' ? p.name_tr : p.name_en}</span>
                        <span class='product-dots'></span>
                        <span class='product-price'>${p.price}₺</span>
                    </div>
                    <div class='product-desc'>${(lang === 'tr' ? p.desc_tr : p.desc_en) || ''}</div>
                </div>
            `;
            productList.appendChild(item);
        }
    }
    fetchData();
    </script>
</body>
</html>
