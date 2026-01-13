<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page non trouvée</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #0f172a, #020617);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 50px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            max-width: 420px;
            width: 100%;
        }

        h1 {
            font-size: 90px;
            margin: 0;
            color: #38bdf8;
        }

        h2 {
            margin-top: 10px;
            font-size: 26px;
            font-weight: 600;
        }

        p {
            opacity: 0.8;
            margin: 15px 0 30px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background: #38bdf8;
            color: #020617;
            padding: 12px 26px;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            background: #0ea5e9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>404</h1>
        <h2>Page non trouvée</h2>
        <p>Désolé, la page que vous recherchez n'existe pas ou a été déplacée.</p>
    </div>

</body>
</html>
