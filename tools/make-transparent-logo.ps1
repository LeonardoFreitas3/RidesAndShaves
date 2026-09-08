# Tira o fundo verde ao emblema e exporta duas versoes com transparencia:
#   brand/logo-transparent.png  emblema completo
#   brand/mota-transparent.png  so a mota, para animar isolada
#
#   powershell -ExecutionPolicy Bypass -File tools\make-transparent-logo.ps1
#
# ponytail: chroma key por distancia ao verde do fundo, com uma banda de feather
# para a borda nao ficar serrilhada. Sem biblioteca de imagem, so System.Drawing.

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Drawing

$root = Split-Path $PSScriptRoot -Parent
$src  = Join-Path $root 'brand\logo-app-512.png'

# Verde do fundo do emblema, medido no proprio ficheiro.
$bgR, $bgG, $bgB = 4, 58, 57

# Abaixo de $hard e transparente, acima de $soft e opaco, no meio interpola.
$hard = 34
$soft = 74

function Export-Keyed {
    param($srcPath, $destPath, $crop)

    $orig = New-Object System.Drawing.Bitmap $srcPath

    if ($crop) {
        $rect = New-Object System.Drawing.Rectangle $crop[0], $crop[1], $crop[2], $crop[3]
        $cut  = $orig.Clone($rect, [System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
        $orig.Dispose()
        $orig = $cut
    }

    $w = $orig.Width; $h = $orig.Height
    $bmp = New-Object System.Drawing.Bitmap $w, $h, ([System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
    $g = [System.Drawing.Graphics]::FromImage($bmp)
    $g.DrawImage($orig, 0, 0, $w, $h)
    $g.Dispose(); $orig.Dispose()

    $rect = New-Object System.Drawing.Rectangle 0, 0, $w, $h
    $data = $bmp.LockBits($rect, [System.Drawing.Imaging.ImageLockMode]::ReadWrite, $bmp.PixelFormat)
    $len = [Math]::Abs($data.Stride) * $h
    $buf = New-Object byte[] $len
    [System.Runtime.InteropServices.Marshal]::Copy($data.Scan0, $buf, 0, $len)

    # BGRA, 4 bytes por pixel
    for ($i = 0; $i -lt $len; $i += 4) {
        $b = $buf[$i]; $gr = $buf[$i + 1]; $r = $buf[$i + 2]
        $d = [Math]::Sqrt(($r - $bgR) * ($r - $bgR) + ($gr - $bgG) * ($gr - $bgG) + ($b - $bgB) * ($b - $bgB))

        if ($d -lt $hard) {
            $buf[$i + 3] = 0
        } elseif ($d -lt $soft) {
            $buf[$i + 3] = [byte][Math]::Round(255 * ($d - $hard) / ($soft - $hard))
        }
    }

    [System.Runtime.InteropServices.Marshal]::Copy($buf, 0, $data.Scan0, $len)
    $bmp.UnlockBits($data)
    $bmp.Save($destPath, [System.Drawing.Imaging.ImageFormat]::Png)
    $bmp.Dispose()

    Write-Output ("  {0}  {1}x{2}" -f (Split-Path $destPath -Leaf), $w, $h)
}

Export-Keyed $src (Join-Path $root 'brand\logo-transparent.png') $null
# A mota ocupa sensivelmente o meio do quadrado, abaixo do lettering.
Export-Keyed $src (Join-Path $root 'brand\mota-transparent.png') @(128, 172, 256, 250)

Write-Output 'OK'
