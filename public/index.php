<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response) {
    $db = new SQLite3(__DIR__ . '/db/musics.db');

    $result = $db->query("SELECT * FROM musics");
    $musics = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $musics[] = $row;
    }

    $html = '<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llista de Músics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            margin: 0;
        }
        h2 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .music {
            background-color: white;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .music img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .music p {
            margin: 10px 0;
        }
        .music strong {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Llista de Músics</h1>';

    foreach ($musics as $music) {
        $html .= '<div class="music">';
        $html .= '<h2>' . htmlspecialchars($music['mus_nom']) . '</h2>';
        $html .= '<p><strong>Data de naixement:</strong> ' . htmlspecialchars($music['mus_naixement']) . '</p>';
        $html .= '<p><strong>Estil:</strong> ' . htmlspecialchars($music['mus_estil']) . '</p>';
        $html .= '<p><strong>Imatge:</strong><br><img src="' . htmlspecialchars($music['mus_imatge']) . '" alt="Imatge de ' . htmlspecialchars($music['mus_nom']) . '" width="200"></p>';
        $html .= '</div>';
    }

    $html .= '</body>
</html>';

    $response->getBody()->write($html);
    $db->close();
    return $response;
});

$app->run();
