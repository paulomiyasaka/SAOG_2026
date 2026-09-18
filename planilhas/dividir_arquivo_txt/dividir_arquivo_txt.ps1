# Obtém o diretório onde o script está sendo executado
$path = $PSScriptRoot
if (-not $path) { $path = Get-Location }

# Busca todos os arquivos .txt na pasta (ignorando arquivos já divididos que terminam com _numero.txt)
$txtFiles = Get-ChildItem -Path $path -Filter "*.txt" | Where-Object { $_.Name -notmatch '_\d+\.txt$' }

if ($txtFiles.Count -eq 0) {
    Write-Host "Nenhum arquivo .txt original encontrado na pasta." -ForegroundColor Yellow
    Exit
}

# Solicita a informação ao operador
$inputLines = Read-Host "Informe a quantidade máxima de linhas de dados por arquivo (sem contar o cabeçalho)"
if (-not ($inputLines -as [int])) {
    Write-Host "Valor inválido. Execute o script novamente e informe um número inteiro." -ForegroundColor Red
    Exit
}
$linesPerFile = [int]$inputLines

foreach ($file in $txtFiles) {
    $content = Get-Content -Path $file.FullName
    
    if ($content.Count -le 1) {
        Write-Host "O arquivo $($file.Name) possui apenas o cabeçalho ou está vazio. Ignorado." -ForegroundColor Yellow
        Continue
    }

    # Separa o cabeçalho (primeira linha) e os dados
    $header = $content[0]
    $dataLines = $content[1..($content.Count - 1)]
    
    # Calcula a quantidade de partes necessárias
    $totalParts = [Math]::Ceiling($dataLines.Count / $linesPerFile)
    
    for ($i = 0; $i -lt $totalParts; $i++) {
        $startIndex = $i * $linesPerFile
        $count = [Math]::Min($linesPerFile, $dataLines.Count - $startIndex)
        $chunk = $dataLines[$startIndex..($startIndex + $count - 1)]

        $partNumber = $i + 1
        $newName = "$($file.BaseName)_$partNumber$($file.Extension)"
        $newPath = Join-Path $path $newName

        # Escreve o cabeçalho + o bloco de dados no novo arquivo
        @($header) + $chunk | Out-File -FilePath $newPath -Encoding UTF8
    }
    
    Write-Host "Arquivo '$($file.Name)' dividido com sucesso em $totalParts parte(s)." -ForegroundColor Green
}

Write-Host "Processo concluído!" -ForegroundColor Cyan