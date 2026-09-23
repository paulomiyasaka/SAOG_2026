<?php

namespace Saog\Controller;

use Saog\Config\Database;

class CancelamentoController
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function listarCancelamentos(): array
    {
        $conn = $this->db->getConnection();

        $query = "
            SELECT 
                ic.id_inscricao_cancelada,
                col.matricula,
                col.nome AS colaborador,
                u.nome AS unidade_plantao,
                p.turno_inicio,
                ic.data_cad AS data_inscricao_original,
                ic.data AS data_cancelamento
            FROM inscricao_cancelada ic
            INNER JOIN colaboradores col ON ic.matricula = col.matricula
            INNER JOIN plantao p ON ic.id_plantao = p.id_plantao
            INNER JOIN unidades u ON p.id_unidade = u.id_unidade
        ";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}