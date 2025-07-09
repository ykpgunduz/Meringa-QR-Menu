<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meringa QR Menü</title>
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

        /* Arama Modal Stilleri */
        .search-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 2000;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .search-modal.show {
            display: flex;
            opacity: 1;
        }

                 .search-container {
             background: #fff;
             border-radius: 20px;
             margin: 20px;
             padding: 20px;
             width: 100%;
             max-width: 600px;
             height: calc(100vh - 40px);
             display: flex;
             flex-direction: column;
             transform: translateY(-50px);
             transition: transform 0.3s ease;
         }

        .search-modal.show .search-container {
            transform: translateY(0);
        }

                 .search-header {
             display: flex;
             align-items: center;
             justify-content: space-between;
             margin-bottom: 25px;
             padding-bottom: 18px;
             border-bottom: 2px solid #f0f2f5;
         }

        .search-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d2d2d;
        }

        .search-close {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f0f2f5;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #6c757d;
        }

        .search-close:hover {
            background: #e8eaed;
            color: #2d2d2d;
            transform: scale(1.1);
        }

                 .search-input-container {
             position: relative;
             margin-bottom: 25px;
         }

                 .search-input {
             width: 100%;
             padding: 18px 20px 18px 55px;
             border: 2px solid #f0f2f5;
             border-radius: 15px;
             font-size: 1.1rem;
             background: #fafbfc;
             transition: all 0.3s ease;
             color: #2d2d2d;
         }

        .search-input:focus {
            outline: none;
            border-color: #d4af37;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

                 .search-icon {
             position: absolute;
             left: 18px;
             top: 50%;
             transform: translateY(-50%);
             color: #6c757d;
             pointer-events: none;
         }

                 .search-results {
             flex: 1;
             overflow-y: auto;
             padding-right: 10px;
         }

         .search-results::-webkit-scrollbar {
             width: 6px;
         }

         .search-results::-webkit-scrollbar-track {
             background: #f1f1f1;
             border-radius: 3px;
         }

         .search-results::-webkit-scrollbar-thumb {
             background: #d4af37;
             border-radius: 3px;
         }

         .search-results::-webkit-scrollbar-thumb:hover {
             background: #b8941f;
         }

                 .search-result-item {
             display: flex;
             align-items: center;
             padding: 18px;
             border-radius: 15px;
             margin-bottom: 12px;
             background: #fafbfc;
             border: 1px solid #f0f2f5;
             transition: all 0.3s ease;
             cursor: pointer;
             box-shadow: 0 2px 8px rgba(0,0,0,0.05);
         }

        .search-result-item:hover {
            background: #f0f2f5;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

                 .search-result-img {
             width: 70px;
             height: 70px;
             border-radius: 12px;
             object-fit: cover;
             margin-right: 18px;
             background: #f5f5f5;
             box-shadow: 0 4px 12px rgba(0,0,0,0.1);
         }

        .search-result-info {
            flex: 1;
        }

                 .search-result-name {
             font-size: 1rem;
             font-weight: 600;
             color: #2d2d2d;
             margin-bottom: 4px;
         }

         .search-result-category {
             font-size: 0.8rem;
             font-weight: 500;
             color: #d4af37;
             margin-bottom: 4px;
             text-transform: uppercase;
             letter-spacing: 0.5px;
         }

         .search-result-price {
             font-size: 1rem;
             font-weight: 700;
             color: #d4af37;
         }

        .search-result-desc {
            font-size: 0.85rem;
            color: #718096;
            margin-top: 4px;
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .no-results-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.6;
        }

        .no-results-text {
            font-size: 1rem;
            font-weight: 500;
        }

        /* Footer Styles */
        .footer {
            background: #fff;
            color: #333;
            padding: 0;
            margin-top: 30px;
            border-top: 1px solid #e5e5e5;
        }

        .footer-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px 20px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 25px;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0;
        }

        .footer-logo-img {
            width: auto;
            height: 80px;
            border-radius: 12px;
        }

        .footer-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #d4af37;
            margin: 0;
        }

        .footer-description {
            color: #666;
            line-height: 1.5;
            margin: 0;
            font-size: 0.9rem;
        }

        .footer-heading {
            font-size: 1rem;
            font-weight: 600;
            color: #d4af37;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            margin-bottom: 8px;
            font-size: 0.9rem;
            line-height: 1.4;
            text-align: center;
            max-width: 500px;
        }

        .contact-item svg {
            color: #d4af37;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .footer-hours {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .hours-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .hours-item:last-child {
            border-bottom: none;
        }

        .day {
            color: #666;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .time {
            color: #d4af37;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .footer-social {
            display: flex;
            flex-direction: row;
            gap: 15px;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 300px;
            flex-wrap: nowrap;
        }

        .social-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            width: 130px;
            justify-content: center;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }

        .social-link.instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            color: #fff;
            border: none;
        }

        .social-link.instagram:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 39, 67, 0.4);
        }

        .social-link.maps {
            background: #4285f4;
            color: #fff;
            border: none;
        }

        .social-link.maps:hover {
            background: #3367d6;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(66, 133, 244, 0.4);
        }

        /* Reklam Çubuğu */
        .ad-bar {
            background: #000;
            padding: 10px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ad-bar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(120deg, rgba(255,255,255,0.10) 0%, rgba(200,200,200,0.13) 40%, rgba(255,255,255,0.10) 100%);
            opacity: 0.7;
            pointer-events: none;
            z-index: 1;
            animation: shimmerBar 3.5s linear infinite;
            background-size: 200% 100%;
        }
        @keyframes shimmerBar {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .ad-content.harpy-ad {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            z-index: 2;
        }
        .harpy-logo {
            height: 64px;
            width: auto;
            display: inline-block;
        }
        .harpy-link {
            text-decoration: none;
            display: inline-block;
        }
        .harpy-text {
            color: #f5f5f5;
            font-family: 'Playfair Display', 'Montserrat', 'Poppins', serif, sans-serif;
            font-weight: 600;
            font-size: 1.45rem;
            letter-spacing: 1.3px;
            background: linear-gradient(90deg, #fff 0%, #e0d6c3 40%, #f5f5f5 60%, #fff 100%);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmerTextLux 2.5s linear infinite;
            transition: color 0.2s;
        }
        .harpy-link:hover .harpy-text {
            filter: brightness(1.18) drop-shadow(0 0 8px #fff8);
        }
        @keyframes shimmerTextLux {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        @media (max-width: 480px) {
            .harpy-logo { height: 41px; }
            .harpy-text { font-size: 1.05rem; }
            .ad-content.harpy-ad { gap: 7px; }
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

            .search-container {
                margin: 10px;
                padding: 15px;
                height: calc(100vh - 20px);
            }

            .search-result-item {
                padding: 15px;
                margin-bottom: 10px;
            }

            .search-result-img {
                width: 60px;
                height: 60px;
                margin-right: 15px;
            }

            .search-input {
                padding: 15px 18px 15px 50px;
                font-size: 1rem;
            }

            .footer-content {
                gap: 20px;
                padding: 20px 15px 15px;
            }

            .footer-logo-img {
                width: auto;
                height: 150px;
            }

            .contact-item {
                font-size: 0.8rem;
                margin-bottom: 6px;
                max-width: 100%;
            }

            .footer-social {
                flex-direction: row;
                gap: 10px;
                flex-wrap: nowrap;
            }

            .social-link {
                padding: 10px 16px;
                font-size: 0.8rem;
                width: 110px;
                flex-shrink: 0;
            }

            .ad-content {
                flex-direction: column;
                gap: 3px;
            }

            .ad-text, .ad-link {
                font-size: 0.75rem;
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

        <!-- Footer Section -->
        <footer class="footer">
            <div class="footer-content">
                <!-- Kafe Bilgileri -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="/img/meringa-renkli.png" alt="Meringa Logo" class="footer-logo-img">
                    </div>
                </div>

                <!-- İletişim ve Çalışma Saatleri -->
                <div class="footer-section">
                    <div class="footer-contact">
                        <div class="contact-item">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>Yeşilköy Mahallesi, Şehit Özcan Canik Sokak, No: 3/70B Bakırköy, 34000 Florya/İstanbul</span>
                        </div>
                        <div class="contact-item">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Her Gün 07:30 – 00:00</span>
                        </div>
                    </div>
                </div>

                <!-- Sosyal Medya -->
                <div class="footer-section">
                    <div class="footer-social">
                        <a href="https://www.instagram.com/meringabakeryy/" target="_blank" class="social-link instagram">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span>Instagram</span>
                        </a>
                        <a href="https://maps.app.goo.gl/dfMfdrm7aXaPamyf6" target="_blank" class="social-link maps">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>Haritalar</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reklam Çubuğu -->
            <div class="ad-bar">
                <div class="ad-content harpy-ad">
                    <img src="/img/harpy-logo.png" alt="Harpy Social" class="harpy-logo">
                    <a href="https://harpysocial.com" target="_blank" class="harpy-link"><span class="harpy-text">Harpy Social</span></a>
                </div>
            </div>
        </footer>

        <div class="containers" style="height: 180px">

        </div>

        <div class="search-modal" id="searchModal">
            <div class="search-container">
                <div class="search-header">
                    <h2 class="search-title">Ürün Ara</h2>
                    <button class="search-close" id="closeSearch">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
                <div class="search-input-container">
                    <input type="text" class="search-input" id="searchInput" placeholder="Ürün adını girin...">
                    <span class="search-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </span>
                </div>
                <div class="search-results" id="searchResults">
                    <!-- Arama sonuçları burada görüntülenecek -->
                </div>
            </div>
        </div>

        <script>
            // Dil seçimi
            function getLangFromUrl() {
                const params = new URLSearchParams(window.location.search);
                const langParam = params.get('lang');
                console.log('URL\'den alınan dil:', langParam);
                return langParam;
            }

            let lang = getLangFromUrl() || 'tr';
            console.log('Başlangıç dili:', lang);

                                    function toggleLang() {
                const oldLang = lang;
                lang = lang === 'tr' ? 'en' : 'tr';
                console.log('Dil değiştirildi:', oldLang, '->', lang);

                updateLangButton();

                // URL'yi güncelle
                const currentUrl = new URL(window.location);
                currentUrl.searchParams.set('lang', lang);
                window.history.replaceState({}, '', currentUrl);
                console.log('URL güncellendi:', currentUrl.toString());

                // Sayfayı hemen güncelle
                if (productsData) {
                    console.log('productsData mevcut, renderPage çağrılıyor...');
                    renderPage();

                    // Eğer arama modalı açıksa, arama sonuçlarını da güncelle
                    if (document.getElementById('searchModal').classList.contains('show')) {
                        const query = document.getElementById('searchInput').value.trim().toLowerCase();
                        if (query.length > 0) {
                            performSearch(query);
                        } else {
                            displayAllProducts();
                        }
                    }
                } else {
                    console.log('productsData yok, fetchData çağrılıyor...');
                    fetchData();
                }
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

            // Arama butonuna tıklama olayı
            document.querySelector('.header-search').onclick = showSearchModal;

            // Kategori anahtarı URL'den alınır
            function getCategoryKey() {
                const path = window.location.pathname;
                const match = path.match(/category\/(.+)$/);
                return match ? match[1] : '';
            }

            let productsData = null;

            async function fetchData() {
                console.log('fetchData başladı...');
                try {
                    const res = await fetch('/js/products.json');
                    productsData = await res.json();
                    console.log('JSON verisi yüklendi, renderPage çağrılıyor...');
                    renderPage();
                } catch (error) {
                    console.error('Veri yükleme hatası:', error);
                    document.getElementById('loadingState').textContent = 'Yükleme hatası oluştu';
                }
            }

                        function renderPage() {
                console.log('=== renderPage başladı ===');
                console.log('productsData mevcut mu:', !!productsData);
                console.log('Mevcut dil:', lang);

                if (!productsData) {
                    console.log('productsData yok, renderPage çıkıyor');
                    return;
                }

                const catKey = getCategoryKey();
                console.log('Kategori anahtarı:', catKey);
                const category = productsData.categories.find(c => c.key === catKey);
                console.log('Bulunan kategori:', category);

                // Kategori bilgilerini güncelle
                const categoryTitle = category ? (lang === 'tr' ? category.name_tr : (category.name_en || category.name_tr || 'Kategori')) : 'Kategori';
                console.log('Kategori başlığı:', categoryTitle);
                document.getElementById('categoryTitle').textContent = categoryTitle;

                // Kategori görseli
                document.getElementById('headerImg').src = `/img/category/${catKey}.jpg`;

                // Menüye dön butonunu güncelle
                document.getElementById('backMenuBtn').textContent = lang === 'tr' ? 'Menüye Dön' : 'Back to Menu';
                document.getElementById('backMenuBtn').onclick = function() {
                    window.location.href = '/categories?lang=' + lang;
                };

                // Arama modalını güncelle
                document.querySelector('.search-title').textContent = lang === 'tr' ? 'Ürün Ara' : 'Search Products';
                document.getElementById('searchInput').placeholder = lang === 'tr' ? 'Ürün adını girin...' : 'Enter product name...';

                                const productList = document.getElementById('productList');
                const emptyState = document.getElementById('emptyState');
                const loadingState = document.getElementById('loadingState');

                // Loading state'i gizle (null kontrolü ile)
                if (loadingState) {
                    loadingState.style.display = 'none';
                }

                // Ürün listesini tamamen temizle
                if (productList) {
                    productList.innerHTML = '';
                }
                if (emptyState) {
                    emptyState.style.display = 'none';
                }

                console.log('Ürün listesi temizlendi, yeni ürünler render ediliyor...');

                const products = productsData.products[catKey] || [];
                console.log('Kategori ürünleri:', products.length, 'adet');

                if (products.length === 0) {
                    const emptyMessage = lang === 'tr' ? 'Bu kategoride ürün bulunmuyor' : 'No products in this category';
                    console.log('Boş mesaj:', emptyMessage);
                    if (emptyState) {
                        const emptyText = emptyState.querySelector('.empty-text');
                        if (emptyText) {
                            emptyText.textContent = emptyMessage;
                        }
                        emptyState.style.display = 'block';
                    }
                    return;
                }

                                                // Ürünleri render et
                console.log('Ürünler render ediliyor, toplam:', products.length);
                if (productList) {
                    products.forEach((product, index) => {
                        const item = document.createElement('div');
                        item.className = 'product-item';
                        item.style.animationDelay = `${index * 0.1}s`;

                        const productName = lang === 'tr' ? product.name_tr : (product.name_en || product.name_tr || 'Ürün');
                        const productDesc = lang === 'tr' ? product.desc_tr : (product.desc_en || product.desc_tr || '');

                        console.log(`Ürün ${index + 1}:`, {
                            lang: lang,
                            name_tr: product.name_tr,
                            name_en: product.name_en,
                            selected_name: productName,
                            desc_tr: product.desc_tr,
                            desc_en: product.desc_en,
                            selected_desc: productDesc
                        });

                        // JSON'dan image alanını al, yoksa default kullan
                        const imgPath = product.image ? `/img/products/${product.image}` : '/img/default.jpg';

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

                    console.log('Tüm ürünler render edildi');
                } else {
                    console.error('productList elementi bulunamadı!');
                }

                // Scroll pozisyonunu kontrol et
                checkScrollPosition();
                console.log('=== renderPage tamamlandı ===');
            }

            // Sayfa yüklendiğinde
            document.addEventListener('DOMContentLoaded', function() {
                fetchData();
            });

            // Arama işlemleri
            const searchModal = document.getElementById('searchModal');
            const closeSearch = document.getElementById('closeSearch');
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');

                     function showSearchModal() {
                 searchModal.classList.add('show');
                 document.body.classList.add('no-scroll');

                 // Modal açıldığında input'a focus ol ve tüm ürünleri göster
                 setTimeout(() => {
                     searchInput.focus();
                     displayAllProducts();
                 }, 100);
             }

            function hideSearchModal() {
                searchModal.classList.remove('show');
                document.body.classList.remove('no-scroll');
            }

            closeSearch.addEventListener('click', hideSearchModal);

                     searchInput.addEventListener('input', function() {
                 const query = searchInput.value.trim().toLowerCase();
                 if (query.length > 0) {
                     performSearch(query);
                 } else {
                     // Arama çubuğu boşsa tüm ürünleri göster
                     displayAllProducts();
                 }
             });

                               function displayAllProducts() {
                 // Tüm kategorilerdeki ürünleri topla
                 const allProducts = [];

                 Object.keys(productsData.products).forEach(catKey => {
                     const products = productsData.products[catKey] || [];
                     products.forEach(product => {
                         allProducts.push({
                             ...product,
                             categoryKey: catKey,
                             categoryName: productsData.categories.find(c => c.key === catKey)
                         });
                     });
                 });

                 if (allProducts.length > 0) {
                     displaySearchResults(allProducts);
                 } else {
                     displayNoResults();
                 }
             }

                      function performSearch(query) {
                 // Tüm kategorilerde arama yap
                 const allProducts = [];

                 Object.keys(productsData.products).forEach(catKey => {
                     const products = productsData.products[catKey] || [];
                     products.forEach(product => {
                         allProducts.push({
                             ...product,
                             categoryKey: catKey,
                             categoryName: productsData.categories.find(c => c.key === catKey)
                         });
                     });
                 });

                 const results = allProducts.filter(product => {
                     const name = lang === 'tr' ? product.name_tr : (product.name_en || product.name_tr || '');
                     const desc = lang === 'tr' ? product.desc_tr : (product.desc_en || product.desc_tr || '');

                     return name.toLowerCase().includes(query) ||
                            (desc && desc.toLowerCase().includes(query));
                 });

                 if (results.length > 0) {
                     displaySearchResults(results);
                 } else {
                     displayNoResults();
                 }
             }

                      function displaySearchResults(results) {
                 searchResults.innerHTML = '';

                 results.forEach((product, index) => {
                     const item = document.createElement('div');
                     item.className = 'search-result-item';
                     item.style.animationDelay = `${index * 0.1}s`;

                     item.onclick = function() {
                         hideSearchModal();

                         // Eğer ürün farklı kategorideyse, o kategoriye git
                         if (product.categoryKey !== getCategoryKey()) {
                             window.location.href = `/category/${product.categoryKey}?lang=${lang}`;
                         } else {
                             // Aynı kategorideyse ürünü göster
                             scrollToProduct(product.id);
                         }
                     };

                     const productName = lang === 'tr' ? product.name_tr : (product.name_en || product.name_tr || 'Ürün');
                     const productDesc = lang === 'tr' ? product.desc_tr : (product.desc_en || product.desc_tr || '');
                     const categoryName = lang === 'tr' ? product.categoryName.name_tr : (product.categoryName.name_en || product.categoryName.name_tr || 'Kategori');

                     // JSON'dan image alanını al, yoksa default kullan
                     const imgPath = product.image ? `/img/products/${product.image}` : '/img/default.jpg';

                     item.innerHTML = `
                         <img class='search-result-img' src='${imgPath}' alt='${productName}' onerror="this.onerror=null;this.src='/img/default.jpg';">
                         <div class='search-result-info'>
                             <div class='search-result-name'>${productName}</div>
                             <div class='search-result-category'>${categoryName}</div>
                             <div class='search-result-price'>${product.price}₺</div>
                             <div class='search-result-desc'>${productDesc || ''}</div>
                         </div>
                     `;

                     searchResults.appendChild(item);
                 });
             }

                     function displayNoResults() {
                 const noResultsText = lang === 'tr' ? 'Ürün bulunamadı' : 'No products found';
                 searchResults.innerHTML = `
                     <div class="no-results">
                         <div class="no-results-icon">🔍</div>
                         <div class="no-results-text">${noResultsText}</div>
                     </div>
                 `;
             }

                     function scrollToProduct(productId) {
                 const productElements = document.querySelectorAll('.product-item');
                 for (let element of productElements) {
                     const img = element.querySelector('.product-img');
                     if (img && (img.src.includes(productId) || img.src.includes(`/${productId}.jpg`) || img.src.includes(`/${productId}.jpeg`))) {
                         element.scrollIntoView({
                             behavior: 'smooth',
                             block: 'center'
                         });

                         // Ürünü vurgula
                         element.style.background = 'linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%)';
                         element.style.border = '2px solid #d4af37';

                         setTimeout(() => {
                             element.style.background = '';
                             element.style.border = '';
                         }, 3000);

                         break;
                     }
                 }
             }

             // Modal dışına tıklayınca kapatma
             searchModal.addEventListener('click', function(e) {
                 if (e.target === searchModal) {
                     hideSearchModal();
                 }
             });

             // ESC tuşu ile kapatma
             document.addEventListener('keydown', function(e) {
                 if (e.key === 'Escape' && searchModal.classList.contains('show')) {
                     hideSearchModal();
                 }
             });
        </script>
    </body>
</html>
