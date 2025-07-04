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
        }
        .cafe-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 2px;
            margin-bottom: 2.5rem;
            text-shadow: 0 4px 24px rgba(0,0,0,0.25);
        }
        .action-btn {
            display: block;
            margin: 0 auto;
            padding: 1rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            background: #fff;
            color: #f53003;
            box-shadow: 0 2px 8px rgba(245, 48, 3, 0.08);
            transition: background 0.2s, color 0.2s, transform 0.2s;
            max-width: 180px;
            width: 100%;
        }
        .action-btn:hover {
            background: #f53003;
            color: #fff;
            transform: translateY(-2px) scale(1.03);
        }
        @media (max-width: 480px) {
            .cafe-title { font-size: 1.5rem; }
            .action-btn { padding: 0.8rem 0.5rem; border-radius: 1rem; }
        }
    </style>
</head>
<body>
    <img src="{{ asset('img/bg.jpg') }}" alt="Kafe Arka Plan" class="bg-image">
    <div class="bg-overlay"></div>
    <div class="center-content">
        <img src="{{ asset('img/meringa.png') }}" alt="Meringa Cafe Logo" style="max-width: 300px; margin-bottom: 1.5rem; margin-top: -120px; display: block;">
        <a class="action-btn" href='{{ route('categories') }}'">MENÜ</button>
    </div>
</body>
</html>
