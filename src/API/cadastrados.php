<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "
    SELECT 
        c.id_cadastrado,
        col.matricula,
        col.nome AS nome_colaborador,
        col.se,
        col.lotacao,
        col.cargo,
        u.nome AS unidade_plantao,
        p.turno_inicio,
        p.turno_final,
        c.motorista,
        c.confirmar_inscricao,
        c.presenca AS presenca_confirmada,
        pr.entrada1,
        pr.saida1,
        pr.entrada2,
        pr.saida2,
        c.data AS data_inscricao
    FROM cadastrados c
    INNER JOIN colaboradores col ON c.matricula = col.matricula
    INNER JOIN plantao p ON c.id_plantao = p.id_plantao
    INNER JOIN unidades u ON p.id_unidade = u.id_unidade
    LEFT JOIN presenca pr ON c.id_cadastrado = pr.id_cadastrado
    WHERE c.status = 1
";

$stmt = $db->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll();

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);