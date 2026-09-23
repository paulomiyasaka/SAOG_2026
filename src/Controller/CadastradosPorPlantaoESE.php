<?php

namespace Saog\Controller;

use Saog\Config\Database;

class CadastradosPorPlantaoESE
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Lista os cadastrados em cada plantão filtrando por SE e/ou id_plantao (se fornecidos)
     */
    public function listarCadastradosPorPlantaoESE(?string $se = null, ?int $idPlantao = null): array
    {
        $conn = $this->db->getConnection();

        $sql = "
            SELECT 
                col.se AS se_colaborador,
                u.nome AS unidade_plantao,
                u.se AS se_unidade,
                p.id_plantao,
                p.turno_inicio,
                p.turno_final,
                p.vagas,
                c.id_cadastrado,
                col.matricula,
                col.nome AS nome_colaborador,
                col.lotacao,
                col.sigla_lotacao,
                col.cargo,
                c.motorista,
                c.presenca AS presenca_confirmada,
                c.data AS data_inscricao
            FROM cadastrados c
            INNER JOIN colaboradores col ON c.matricula = col.matricula
            INNER JOIN plantao p ON c.id_plantao = p.id_plantao
            INNER JOIN unidades u ON p.id_unidade = u.id_unidade
            LEFT JOIN presenca pr ON c.id_cadastrado = pr.id_cadastrado
            WHERE c.status = 1
        ";

        $params = [];

        if (!empty($se)) {
            $sql .= " AND col.se = :se";
            $params[':se'] = $se;
        }

        if (!empty($idPlantao)) {
            $sql .= " AND p.id_plantao = :id_plantao";
            $params[':id_plantao'] = $idPlantao;
        }

        $sql .= " ORDER BY col.se ASC, p.turno_inicio DESC, col.nome ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}