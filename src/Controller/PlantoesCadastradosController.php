<?php

namespace Saog\Controller;

use Saog\Config\Database;

class PlantoesCadastradosController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function listarPlantoesCadastrados(): array
    {
        $conn = $this->db->getConnection();

        $query = "
            SELECT 
                p.id_plantao,
                u.nome AS nome_unidade,
                u.trabalho,
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

        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}