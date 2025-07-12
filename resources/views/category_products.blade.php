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
            margin-bottom: 0;
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
            padding: 0;
            margin-top: 0;
        }

        .footer-content {
            max-width: 420px;
            margin: 0 auto;
            padding: 36px 28px 28px 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 28px;
            background: #fff;
            border-radius: 0;
            box-shadow: none;
            position: relative;
            z-index: 2;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            border: none;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0;
        }

        .footer-logo-img {
            width: 110px;
            height: auto;
            border-radius: 16px;
            margin-bottom: 12px;
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
            gap: 10px;
            align-items: flex-start;
            width: 100%;
            margin: 0 auto 8px auto;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1a1a1a;
            margin-bottom: 0;
            font-size: 1rem;
            line-height: 1.5;
            text-align: left;
            font-weight: 500;
            width: 100%;
            background: rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 7px 12px;
            margin-bottom: 6px;
            box-shadow: 0 1.5px 8px rgba(212,175,55,0.07);
        }

        .contact-item svg {
            color: #d4af37;
            flex-shrink: 0;
            margin-top: 2px;
            margin-right: 2px;
            background: #fffbe6;
            border-radius: 50%;
            padding: 3px;
            box-shadow: 0 1.5px 8px rgba(212,175,55,0.13);
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
            gap: 14px;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 320px;
            flex-wrap: nowrap;
            margin-top: 10px;
        }

        .social-link {
            display: flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 22px;
            transition: all 0.2s cubic-bezier(.4,0,.2,1);
            font-size: 1rem;
            width: auto;
            min-width: 110px;
            justify-content: center;
            font-weight: 600;
            box-shadow: 0 1.5px 8px rgba(212,175,55,0.10);
            flex-shrink: 0;
            border: 1.5px solid #d4af37;
            background: #fffbe6;
            color: #1a1a1a;
        }

        .social-link.instagram {
            background: linear-gradient(90deg, #fffbe6 0%, #f8e7b3 100%);
            color: #b88900;
            border: 1.5px solid #d4af37;
        }

        .social-link.instagram:hover {
            transform: scale(1.08) translateY(-2px);
            box-shadow: 0 4px 24px rgba(212,175,55,0.18);
            background: linear-gradient(90deg, #fffbe6 0%, #ffe066 100%);
            color: #a67c00;
        }

        .social-link.maps {
            background: #181818;
            color: #fff;
            border: 1.5px solid #181818;
        }

        .social-link.maps:hover {
            background: #000;
            transform: scale(1.08) translateY(-2px);
            box-shadow: 0 4px 24px rgba(0,0,0,0.18);
            color: #ffd700;
        }

        /* Harpy Social Footer */
        .ad-bar {
            background: #054ba1;
            text-align: center;
            padding: 5px;
            position: relative;
            overflow: hidden;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ad-bar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(120deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.08) 40%, rgba(255,255,255,0.15) 100%);
            opacity: 0.8;
            pointer-events: none;
            z-index: 1;
            animation: shimmerBar 4s linear infinite;
            background-size: 200% 100%;
        }

        @keyframes shimmerBar {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

                        .ad-content.harpy-ad {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .ad-content.harpy-ad:hover {
            transform: translateY(-1px);
        }

        .harpy-credit {
            height: 70px;
            width: auto;
            display: inline-block;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.2));
            transition: all 0.3s ease;
        }

        .ad-content.harpy-ad:hover .harpy-credit {
            transform: scale(1.03);
            filter: drop-shadow(0 3px 10px rgba(0, 0, 0, 0.3));
        }

        .harpy-link {
            text-decoration: none;
            display: inline-block;
        }

                        @media (max-width: 480px) {
            .harpy-credit { height: 75px; }
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
                padding: 20px 15px 40px;
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
        .footer-contact-box {
            background: transparent;
            border: 2.5px solid #d4af37;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(212,175,55,0.10);
            padding: 18px 18px 10px 18px;
            margin-bottom: 10px;
            margin-top: 5px;
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }
        .footer-contact-box .contact-item svg {
            width: 28px !important;
            height: 28px !important;
            margin-right: 8px;
            margin-top: 0;
            padding: 2px;
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

    <!-- WhatsApp Sabit İkonu -->
    <a href="https://wa.me/905384088034" target="_blank" class="whatsapp-fixed" title="WhatsApp'tan Mesaj Gönder">
        <svg fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
        </svg>
    </a>

    <!-- Footer Section -->
        <footer class="footer">
            <div class="footer-content">
                <!-- Kafe Bilgileri -->

                <!-- İletişim ve Çalışma Saatleri -->
                <div class="footer-section">
                    <div class="footer-contact footer-contact-box">
                        <div class="footer-logo" style="margin-bottom: 0;">
                            <img src="/img/meringa-renkli.png" alt="Meringa Logo" class="footer-logo-img">
                        </div>
                        <div class="footer-social" style="margin-bottom: 8px;">
                            <a href="https://www.instagram.com/meringabakeryy/" target="_blank" class="social-link instagram">
                                <!-- Font Awesome CDN -->
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
                                <i class="fa-brands fa-instagram" style="font-size: 1.3em; color: #b88900;"></i>
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
                        <div class="contact-item">
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>Yeşilköy Mahallesi, Şehit Özcan Canik Sokak, No: 3/70B Bakırköy, Florya/İstanbul</span>
                        </div>
                        <div class="contact-item">
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Her Gün 07:30 – 00:00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reklam Çubuğu -->
            <div class="ad-bar">
                <div class="ad-content harpy-ad">
                    <a href="https://harpysocial.com" target="_blank" class="harpy-link">
                        <img src="/img/harpy-credit.png" alt="Harpy Social" class="harpy-credit">
                    </a>
                </div>
            </div>
        </footer>

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
