# Importa as fotos geradas para os tamanhos exatos que o tema espera.
#   powershell -ExecutionPolicy Bypass -File tools\import-fotos.ps1
#
# ponytail: as origens estao mapeadas a mao numa tabela em vez de adivinhadas
# por heuristica. Sao oito ficheiros, uma vez na vida. Se mudarem as fotos,
# muda-se aqui o caminho e corre-se outra vez.

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Drawing

$root = Split-Path $PSScriptRoot -Parent
$dl   = Join-Path $env:USERPROFILE 'Downloads'
$dest = Join-Path $root 'theme\rides-and-shaves\assets\img'
New-Item -ItemType Directory -Force -Path $dest | Out-Null

$HERO     = Join-Path $dl 'Gemini_Generated_Image_6zda086zda086zda.jpg'   # barbeiro a fazer a barba
$INTERIOR = Join-Path $dl 'Gemini_Generated_Image_v8xfqlv8xfqlv8xf.jpg'   # interior com as motas
$MONTRA   = Join-Path $dl 'Gemini_Generated_Image_fma3zwfma3zwfma3.jpg'   # montra ao anoitecer
$SALA     = Join-Path $dl 'Gemini_Generated_Image_obqrtyobqrtyobqr.jpg'   # sala com sofas e motas
$POMADA   = Join-Path $dl 'Gemini_Generated_Image_feb80cfeb80cfeb8.jpg'   # boiao com o logotipo
$TRIO     = Join-Path $dl 'Gemini_Generated_Image_xvcwgnxvcwgnxvcw.jpg'   # tres produtos numa foto

function Save-Region {
    param($src, [int]$x, [int]$y, [int]$w, [int]$h, [int]$outW, [int]$outH, $out)

    $b = New-Object System.Drawing.Bitmap $src
    $canvas = New-Object System.Drawing.Bitmap $outW, $outH
    $g = [System.Drawing.Graphics]::FromImage($canvas)
    $g.InterpolationMode = 'HighQualityBicubic'
    $g.PixelOffsetMode = 'HighQuality'
    $g.DrawImage($b, (New-Object System.Drawing.Rectangle 0, 0, $outW, $outH),
                     $x, $y, $w, $h, 'Pixel')
    $g.Dispose(); $b.Dispose()

    $enc = [System.Drawing.Imaging.ImageCodecInfo]::GetImageEncoders() | Where-Object { $_.MimeType -eq 'image/jpeg' }
    $pars = New-Object System.Drawing.Imaging.EncoderParameters 1
    $pars.Param[0] = New-Object System.Drawing.Imaging.EncoderParameter ([System.Drawing.Imaging.Encoder]::Quality), 88
    $canvas.Save($out, $enc, $pars)
    $canvas.Dispose()
    Write-Output ("  {0}  {1}x{2}" -f (Split-Path $out -Leaf), $outW, $outH)
}

# Recorta um produto da foto dos tres e assenta-o num quadrado. O fundo e uma cor
# lisa colhida no proprio canto do recorte, para nao haver costura entre o fundo do
# produto e o fundo do quadrado.
# ponytail: nada de esticar tiras nem de mascaras. Cor lisa resolve porque o fundo
# original ja e liso.
function Save-Produto {
    param($src, [int]$px, [int]$py, [int]$pw, [int]$ph, $out, [int]$S = 700)

    $b = New-Object System.Drawing.Bitmap $src
    $fundo = $b.GetPixel($px + 5, $py + 5)

    $canvas = New-Object System.Drawing.Bitmap $S, $S
    $g = [System.Drawing.Graphics]::FromImage($canvas)
    $g.InterpolationMode = 'HighQualityBicubic'
    $g.PixelOffsetMode = 'HighQuality'
    $g.Clear($fundo)

    # Contain: cabe inteiro, sem cortar nem distorcer.
    $caixa = [int]($S * 0.88)
    $escala = [Math]::Min($caixa / $pw, $caixa / $ph)
    $lw = [int]($pw * $escala); $lh = [int]($ph * $escala)
    $g.DrawImage($b, (New-Object System.Drawing.Rectangle ([int](($S - $lw) / 2)), ([int](($S - $lh) / 2)), $lw, $lh),
                     $px, $py, $pw, $ph, 'Pixel')
    $g.Dispose(); $b.Dispose()

    $enc = [System.Drawing.Imaging.ImageCodecInfo]::GetImageEncoders() | Where-Object { $_.MimeType -eq 'image/jpeg' }
    $pars = New-Object System.Drawing.Imaging.EncoderParameters 1
    $pars.Param[0] = New-Object System.Drawing.Imaging.EncoderParameter ([System.Drawing.Imaging.Encoder]::Quality), 88
    $canvas.Save($out, $enc, $pars)
    $canvas.Dispose()
    Write-Output ("  {0}  {1}x{2}" -f (Split-Path $out -Leaf), $S, $S)
}

Write-Output 'Secoes:'
# Origens a 2624x1632 (1.607) e o alvo a 1.6 — corte quase nulo.
Save-Region $HERO      0    0 2624 1632 1600 1000 (Join-Path $dest 'hero.jpg')
Save-Region $INTERIOR  0    0 2624 1632  900  560 (Join-Path $dest 'loja-nogueiro.jpg')
Save-Region $MONTRA    0    0 2624 1632  900  560 (Join-Path $dest 'loja-lamacaes.jpg')
# Vertical 9:10 encostado a esquerda, onde esta a mota cromada.
Save-Region $SALA      0    0 1469 1632  900 1000 (Join-Path $dest 'sobre.jpg')

Write-Output 'Produtos:'
Save-Region $POMADA    0    0 2048 2048  700  700 (Join-Path $dest 'produto-1.jpg')
Save-Produto $TRIO  250 430  380 1110 (Join-Path $dest 'produto-2.jpg')   # frasco ambar
Save-Produto $TRIO  740 430  480 1110 (Join-Path $dest 'produto-3.jpg')   # doseador preto
Save-Produto $TRIO 1255 930  650  620 (Join-Path $dest 'produto-4.jpg')   # caixa com miniaturas

Write-Output 'Journal:'
Save-Region $HERO   1350  350  900  600  600  400 (Join-Path $dest 'journal-1.jpg')   # cabelo
Save-Region $SALA    900  400 1200  800  600  400 (Join-Path $dest 'journal-2.jpg')   # ambiente
Save-Region $HERO    750  600 1200  800  600  400 (Join-Path $dest 'journal-3.jpg')   # navalha
Save-Region $POMADA  380  500 1300  867  600  400 (Join-Path $dest 'journal-4.jpg')   # produto

Write-Output 'OK'
