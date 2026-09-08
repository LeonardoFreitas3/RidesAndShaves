# Corre os checks e reconstroi dist/rides-and-shaves.zip.
#   powershell -ExecutionPolicy Bypass -File build.ps1
#
# ponytail: Compress-Archive escreve "\" nos nomes das entradas no PowerShell 5.1,
# o que faz o WordPress extrair ficheiros chamados "rides-and-shaves\style.css"
# numa pasta plana em vez da arvore. Por isso o zip e montado a mao com "/".

$ErrorActionPreference = 'Stop'
$root = $PSScriptRoot
$src  = Join-Path $root 'theme\rides-and-shaves'
$zip  = Join-Path $root 'dist\rides-and-shaves.zip'

if (Get-Command php -ErrorAction SilentlyContinue) {
    php (Join-Path $src 'tools\check-blocks.php')
    if ($LASTEXITCODE -ne 0) { throw 'checks falharam - zip nao construido' }
} else {
    Write-Warning 'php nao encontrado, checks saltados'
}

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

New-Item -ItemType Directory -Force -Path (Split-Path $zip) | Out-Null
if (Test-Path $zip) { Remove-Item $zip -Force }

$archive = [System.IO.Compression.ZipFile]::Open($zip, 'Create')
try {
    Get-ChildItem $src -Recurse -File | ForEach-Object {
        $rel = 'rides-and-shaves/' + $_.FullName.Substring($src.Length + 1).Replace('\', '/')
        [void][System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($archive, $_.FullName, $rel, 'Optimal')
    }
} finally {
    $archive.Dispose()
}

Write-Output ("OK - {0} ({1:N0} KB)" -f $zip, ((Get-Item $zip).Length / 1KB))
