<?php
require '../vendor/autoload.php'; // Caminho do autoloader do Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Verificação simples de parâmetro
if (!isset($_GET['p']) || empty($_GET['p'])) {
    die("Plantão não especificado.");
}

$id_plantao = base64_decode($_GET['p']);

// ------------------------------------------------------------------
// 1. CONSULTA AO BANCO DE DADOS (Ajuste para suas tabelas/conexão)
// ------------------------------------------------------------------
// Exemplo com PDO:
// require_once '../conexao.php';
// $stmt = $pdo->prepare("SELECT ... WHERE id_plantao = :id_plantao");
// $stmt->execute([':id_plantao' => $id_plantao]);
// $dados_plantao = $stmt->fetch();
// $inscritos = $stmt_inscritos->fetchAll();

// Dados de exemplo baseados na sua página:
$titulo_unidade = "Plantão no CEE TAGUATINGA";
$data_horario   = "Domingo, 20/09/2026 de 08:00:00 às 16:00:00";
$atividade      = "Atividade De Distribuicao";

// Exemplo de array vindo do BD:
$registros = [
    [
        'matricula' => '81363826',
        'nome'      => 'PAULO RODRIGUES MIYASAKA',
        'lotacao'   => 'CS/DIOPE/SUPLO/DELOG',
        'funcao'    => 'ANALISTA V',
        'telefone'  => '(61) 2141-9604',
        'celular'   => '(61) 98577-1427',
        'escolha'   => 'Distribuição',
        'presenca'  => 'Pendente'
    ]
];

// ------------------------------------------------------------------
// 2. MONTAGEM DA PLANILHA COM PHPSPREADSHEET
// ------------------------------------------------------------------
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Presença Plantão');

// Exibir linhas de grade no Excel
$sheet->setShowGridLines(true);

// Estilos Reutilizáveis
$styleHeaderTitle = [
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 14],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1F4E78']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER]
];

$styleSubtitle = [
    'font' => ['italic' => true, 'color' => ['rgb' => '1F4E78'], 'size' => 11],
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

// Cabeçalho / Título do Relatório
$sheet->mergeCells('A1:I1');
$sheet->setCellValue('A1', 'SAOG - ' . $titulo_unidade);
$sheet->getStyle('A1:I1')->applyFromArray($styleHeaderTitle);
$sheet->getRowDimension(1)->setRowHeight(35);

$sheet->mergeCells('A2:I2');
$sheet->setCellValue('A2', $data_horario . ' | ' . $atividade);
$sheet->getStyle('A2:I2')->applyFromArray($styleSubtitle);
$sheet->getRowDimension(2)->setRowHeight(25);

// Colunas da Tabela
$headers = ['#', 'Escolha', 'Matrícula', 'Nome', 'Lotação', 'Função', 'Telefone', 'Celular', 'Presença'];
$sheet->fromArray($headers, NULL, 'A4');
$sheet->getStyle('A4:I4')->applyFromArray($styleTableHeader);
$sheet->getRowDimension(4)->setRowHeight(26);

// Preenchimento dos dados
$row = 5;
$i = 1;

foreach ($registros as $reg) {
    $sheet->setCellValue('A' . $row, $i);
    $sheet->setCellValue('B' . $row, $reg['escolha']);
    $sheet->setCellValueExplicit('C' . $row, $reg['matricula'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    $sheet->setCellValue('D' . $row, $reg['nome']);
    $sheet->setCellValue('E' . $row, $reg['lotacao']);
    $sheet->setCellValue('F' . $row, $reg['funcao']);
    $sheet->setCellValue('G' . $row, $reg['telefone']);
    $sheet->setCellValue('H' . $row, $reg['celular']);
    $sheet->setCellValue('I' . $row, $reg['presenca']);

    $sheet->getStyle("A{$row}:I{$row}")->applyFromArray($styleDataRow);
    
    // Alinhamentos específicos
    $sheet->getStyle("A{$row}:C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("G{$row}:I{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    
    $sheet->getRowDimension($row)->setRowHeight(22);
    $row++;
    $i++;
}

// Linha de Total
$sheet->setCellValue('A' . $row, 'Total:');
$sheet->setCellValue('B' . $row, count($registros));
$sheet->getStyle("A{$row}:I{$row}")->applyFromArray($styleTotalRow);
$sheet->getStyle("A{$row}:B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(24);

// Auto-ajuste de largura das colunas
foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// ------------------------------------------------------------------
// 3. DOWNLOAD DO ARQUIVO .XLSX
// ------------------------------------------------------------------
$filename = 'Plantao_Presenca_' . date('Y-m-d_H-i') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;