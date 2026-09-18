<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

namespace Saog\API;
require '../../vendor/autoload.php';

use Carta\Database\FuncoesSQL;
$funcoesSQL = new funcoesSQL();

$query = "
    SELECT 
        p.id_plantao,
        u.nome AS nome_unidade,
        u.trabalho,
        u.se,
        p.turno_inicio,
        p.turno_final,
        p.vagas,
        p.motorista,
        COUNT(c.id_cadastrado) AS total_inscritos,
        SUM(CASE WHEN c.confirmar_inscricao = 1 THEN 1 ELSE 0 END) AS total_confirmados,
        SUM(CASE WHEN c.presenca = 1 THEN 1 ELSE 0 END) AS total_presentes,
        p.status
    FROM plantao p
    INNER JOIN unidades u ON p.id_unidade = u.id_unidade
    LEFT JOIN cadastrados c ON p.id_plantao = c.id_plantao AND c.status = 1
    GROUP BY p.id_plantao
    ORDER BY p.turno_inicio DESC
";
$dados = array();
$stmt = $funcoesSQL->SQL($query, $dados);
$stmt->execute();
$data = $stmt->fetchAll();

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);