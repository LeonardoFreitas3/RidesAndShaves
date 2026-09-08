# Gera os placeholders de imagem do tema em theme/rides-and-shaves/assets/img/.
#   powershell -ExecutionPolicy Bypass -File tools\make-placeholders.ps1
#
# ponytail: placeholders com a marca em vez de cinzentos genericos. Ficam
# apresentaveis desde o primeiro dia e continua obvio o que falta substituir.
# Trocar por fotografia real: mesmo nome de ficheiro, o tema nao muda.

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Drawing

$root = Split-Path $PSScriptRoot -Parent
$dest = Join-Path $root 'theme\rides-and-shaves\assets\img'
$logoPath = Join-Path $root 'theme\rides-and-shaves\assets\logo.png'
New-Item -ItemType Directory -Force -Path $dest | Out-Null

$bg   = [System.Drawing.ColorTranslator]::FromHtml('#021A16')
$gold = [System.Drawing.ColorTranslator]::FromHtml('#E8A94E')

# nome, largura, altura, legenda
$shots = @(
    @('hero',            1600, 1000, 'FOTO — barbeiro a fazer a barba, luz quente'),
    @('loja-nogueiro',    900,  560, 'FOTO — interior da loja de Nogueiró'),
    @('loja-lamacaes',    900,  560, 'FOTO — montra da loja de Lamaçães'),
    @('sobre',            900, 1000, 'FOTO — depósito da mota com o emblema'),
    @('produto-1',        700,  700, 'PRODUTO — Pomada Matte'),
    @('produto-2',        700,  700, 'PRODUTO — Óleo para Barba'),
    @('produto-3',        700,  700, 'PRODUTO — Champô para Barba'),
    @('produto-4',        700,  700, 'PRODUTO — Kit Viagem')
)

foreach ($s in $shots) {
    $name, $w, $h, $label = $s

    $bmp = New-Object System.Drawing.Bitmap $w, $h
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.SmoothingMode = 'AntiAlias'
    $g.InterpolationMode = 'HighQualityBicubic'
    $g.TextRenderingHint = 'ClearTypeGridFit'
    $g.Clear($bg)

    # Emblema esbatido ao centro.
    $logo = New-Object System.Drawing.Bitmap $logoPath
    $side = [Math]::Min($w, $h) * 0.55
    $matrix = New-Object System.Drawing.Imaging.ColorMatrix
    $matrix.Matrix33 = 0.14
    $attrs = New-Object System.Drawing.Imaging.ImageAttributes
    $attrs.SetColorMatrix($matrix)
    $rect = New-Object System.Drawing.Rectangle (($w - $side) / 2), (($h - $side) / 2 - $h * 0.04), $side, $side
    $g.DrawImage($logo, $rect, 0, 0, $logo.Width, $logo.Height, 'Pixel', $attrs)
    $logo.Dispose()

    # Moldura fina dourada, recuada da margem.
    $pen = New-Object System.Drawing.Pen $gold, 2
    $pen.Color = [System.Drawing.Color]::FromArgb(70, $gold)
    $inset = [Math]::Round([Math]::Min($w, $h) * 0.035)
    $g.DrawRectangle($pen, $inset, $inset, $w - 2 * $inset, $h - 2 * $inset)

    # Legenda em baixo, a dizer que foto vai ali.
    $size = [Math]::Max(13, [Math]::Round($w / 52))
    $font = New-Object System.Drawing.Font 'Segoe UI', $size, ([System.Drawing.FontStyle]::Bold)
    $brush = New-Object System.Drawing.SolidBrush ([System.Drawing.Color]::FromArgb(200, $gold))
    $fmt = New-Object System.Drawing.StringFormat
    $fmt.Alignment = 'Center'
    $g.DrawString($label, $font, $brush, ($w / 2), ($h - $inset - $size * 3), $fmt)

    $g.Dispose()
    $bmp.Save((Join-Path $dest "$name.jpg"), [System.Drawing.Imaging.ImageFormat]::Jpeg)
    $bmp.Dispose()

    Write-Output ("  {0}.jpg  {1}x{2}" -f $name, $w, $h)
}

Write-Output ("OK - {0} placeholders em {1}" -f $shots.Count, $dest)
