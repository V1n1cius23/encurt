<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_url = $_POST['url'];

    // Gerar um código curto único
    $short_code = substr(md5(uniqid(rand(), true)), 0, 6);

    // Inserir a URL no banco de dados
    $stmt = $pdo->prepare("INSERT INTO urls (original_url, short_code) VALUES (:original_url, :short_code)");
    $stmt->execute(['original_url' => $original_url, 'short_code' => $short_code]);

    $short_url = "ur_shortener/$short_code"; // Substitua pelo seu domínio
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>encurtador</title>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 600;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"] {
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
            transition: background 0.3s ease;
        }

        input[type="text"]:focus {
            background: rgba(255, 255, 255, 1);
            outline: none;
        }

        input[type="submit"] {
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            background: #2575fc;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background: #1b5fd9;
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            animation: fadeIn 0.5s ease;
        }

        .result a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .result a:hover {
            color: #2575fc;
        }

        /* Animação */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsividade */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            input[type="text"], input[type="submit"] {
                padding: 12px;
                font-size: 0.9rem;
            }
        }
    </style>
<div class="container">
        <h1>Encurtador de URL</h1>
        <form method="POST">
            <input type="text" name="url" placeholder="Digite a URL aqui" required>
            <br>
            <input type="submit" value="Encurtar">
        </form>
        <?php if (isset($short_url)): ?>
            <div class="result">
                <p>URL encurtada: <a href="<?php echo $short_url; ?>" target="_blank"><?php echo $short_url; ?></a></p>
            </div>
        <?php endif; ?>
    </div>

    </p>
</body>
</html>