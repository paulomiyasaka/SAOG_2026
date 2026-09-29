<?php
// ATENÇÃO: NENHUM caractere, espaço ou linha em branco pode existir antes desta tag <?php

// Opcional: Para depuração, desative a exibição direta de erros na tela
// e verifique os logs do servidor se necessário
ini_set('display_errors', 0);
error_reporting(E_ALL);

require '../vendor/autoload.php'; // Ajuste o caminho do autoloader se necessário
require_once '../controle/plantao.class.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

// Validar se o parâmetro foi passado
if (!isset($_GET['p']) || empty($_GET['p'])) {
    die("Erro: Parâmetro inválido.");
}

$id_plantao = (int) base64_decode($_GET['p']);

// ------------------------------------------------------------------
// 1. BUSCA DOS DADOS
// ------------------------------------------------------------------
$plantao = new Plantao();
$inscritos = $plantao->inscritosPlantaoExcel($id_plantao);

if (empty($inscritos)) {
    die("Nenhum inscrito encontrado para este plantão.");
}

$primeiroRegistro = $inscritos[0];

$dataInicio = !empty($primeiroRegistro->turno_inicio) 
    ? date('d/m/Y H:i:s', strtotime($primeiroRegistro->turno_inicio)) 
    : 'Data não informada';

$nomeUnidade = isset($primeiroRegistro->unidade_nome) 
    ? $primeiroRegistro->unidade_nome 
    : (isset($primeiroRegistro->nome) ? $primeiroRegistro->nome : 'Unidade não informada');

// ------------------------------------------------------------------
// 2. MONTAGEM DA PLANILHA EXCEL
// ------------------------------------------------------------------
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Inscritos');
$sheet->setShowGridLines(true);

// Estilos
$styleHeaderTitle = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 13],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1F4E78']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
];

$styleSubtitle = [
    'font' => ['italic' => true, 'color' => ['rgb' => '1F4E78'], 'size' => 10],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
];

$styleTableHeader = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2F5597']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D9D9D9']]]
];

$styleDataRow = [
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D9D9D9']]],
    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
];

$styleTotalRow = [
    'font' => ['bold' => true, 'color' => ['rgb' => '276A3C']],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2EFDA']],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D9D9D9']]]
];

// Cabeçalho Principal (Linha 1)
$sheet->mergeCells('A1:H1');
$sheet->setCellValue('A1', 'SAOG - Plantão no ' . mb_strtoupper($nomeUnidade, 'UTF-8'));
$sheet->getStyle('A1:H1')->applyFromArray($styleHeaderTitle);
$sheet->getRowDimension(1)->setRowHeight(32);

// Subtítulo (Linha 2)
$sheet->mergeCells('A2:H2');
$sheet->setCellValue('A2', 'Início do Turno: ' . $dataInicio);
$sheet->getStyle('A2:H2')->applyFromArray($styleSubtitle);
$sheet->getRowDimension(2)->setRowHeight(22);

// Cabeçalhos (Linha 4)
$headers = ['#', 'Matrícula', 'Nome Colaborador', 'Lotação', 'Início do Turno', 'Opção Atividade', 'Telefone', 'Celular'];
$sheet->fromArray($headers, NULL, 'A4');
$sheet->getStyle('A4:H4')->applyFromArray($styleTableHeader);
$sheet->getRowDimension(4)->setRowHeight(25);

// ------------------------------------------------------------------
// 3. LOOP NOS REGISTROS DO SQL
// ------------------------------------------------------------------
$row = 5;
$contador = 1;
$turnoFormatado = '';
foreach ($inscritos as $item) {
    $sheet->setCellValue('A' . $row, $contador);
    $sheet->setCellValueExplicit('B' . $row, (string) $item->matricula, DataType::TYPE_STRING);
    $sheet->setCellValue('C' . $row, mb_strtoupper($item->nome_funcionario, 'UTF-8'));
    $sheet->setCellValue('D' . $row, mb_strtoupper($item->lotacao, 'UTF-8'));
    
    $turnoFormatado = !empty($item->turno_inicio) ? date('d/m/Y H:i:s', strtotime($item->turno_inicio)) : '-';
    $sheet->setCellValue('E' . $row, $turnoFormatado);
    $sheet->setCellValue('F' . $row, mb_strtoupper($item->opcao_atividade, 'UTF-8'));
    $sheet->setCellValueExplicit('G' . $row, (string) $item->telefone, DataType::TYPE_STRING);
    $sheet->setCellValueExplicit('H' . $row, (string) $item->celular, DataType::TYPE_STRING);

    $sheet->getStyle("A{$row}:H{$row}")->applyFromArray($styleDataRow);
    $sheet->getStyle("A{$row}:C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("G{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $sheet->getRowDimension($row)->setRowHeight(20);
    $row++;
    $contador++;
}

// Linha de Total
$sheet->setCellValue('A' . $row, 'Total de Inscritos:');
$sheet->setCellValue('B' . $row, count($inscritos));
$sheet->getStyle("A{$row}:H{$row}")->applyFromArray($styleTotalRow);
$sheet->getStyle("A{$row}:B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(24);

// Auto-dimensionar colunas
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// ------------------------------------------------------------------
// 4. DOWNLOAD SEGURO DO ARQUIVO XLSX (Evita arquivo corrompido)
// ------------------------------------------------------------------

// LIMPEZA CRÍTICA: Descarta qualquer buffer de saída ativo (evita espaços/warnings no arquivo)
if (ob_get_length()) {
    ob_end_clean();
}

$unidadeSanitizada = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nomeUnidade);
$filename = 'Plantao_Inscritos_' . $unidadeSanitizada . '_' . $turnoFormatado . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1'); // Solução para IE/Edge antigos
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Data no passado
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;