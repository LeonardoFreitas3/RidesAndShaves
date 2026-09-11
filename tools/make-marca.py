"""Gera assets/logo-marca.png a partir de assets/logo.png.

A marca de agua do site usa mix-blend-mode: screen. Com screen o browser usa o
RGB da imagem, e os pixels transparentes do logo.png guardam o verde do fundo
que foi recortado (RGB 4,57,56 com alfa 0) — o resultado era um retangulo verde
claro do tamanho da caixa, a volta do emblema.

A saida tem o RGB pre-multiplicado pelo alfa e nenhum canal alfa: onde nao ha
desenho fica preto, e preto sob screen nao pinta nada.

ponytail: um script de 15 linhas em vez de pedir a arte outra vez. Se o
logo.png mudar, corre isto de novo.

    python tools/make-marca.py
"""

from pathlib import Path

from PIL import Image, ImageChops

RAIZ = Path(__file__).resolve().parent.parent / "theme" / "rides-and-shaves" / "assets"


def main() -> None:
    origem = Image.open(RAIZ / "logo.png").convert("RGBA")
    r, g, b, a = origem.split()
    marca = Image.merge("RGB", [ImageChops.multiply(c, a) for c in (r, g, b)])
    destino = RAIZ / "logo-marca.png"
    marca.save(destino, optimize=True)

    canto = marca.getpixel((5, 5))
    assert canto == (0, 0, 0), f"canto devia ser preto, esta {canto}"
    print(f"OK - {destino} ({destino.stat().st_size // 1024} KB)")


if __name__ == "__main__":
    main()
