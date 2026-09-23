<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../vendor/autoload.php';

use Saog\Controller\CadastradosPorPlantaoESE;

// Captura os parâmetros via query string (opcionais)
$se = isset($_GET['se']) ? trim($_GET['se']) : null;
$idPlantao = isset($_GET['id_plantao']) ? (int)$_GET['id_plantao'] : null;

$controller = new CadastradosPorPlantaoESE();
$dados = $controller->listarCadastradosPorPlantaoESE($se, $idPlantao);

echo json_encode([
    "total_registros" => count($dados),
    "filtros_aplicados" => [
        "se" => $se,
        "id_plantao" => $idPlantao
    ],
    "dados" => $dados
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);