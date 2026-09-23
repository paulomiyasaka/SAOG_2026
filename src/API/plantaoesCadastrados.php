<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../../vendor/autoload.php';

use Saog\Controller\PlantoesCadastradosController;

$controller = new PlantoesCadastradoController();
$dados = $controller->listarPlantoesCadastrados();

echo json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);