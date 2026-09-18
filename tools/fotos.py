"""Leva as fotos de fotos-originais/ para os tamanhos que o tema espera.

    python tools/fotos.py

Recorta ao centro para o formato de destino e redimensiona. So mexe no que
encontrar — entregar as fotos aos poucos funciona.

ponytail: recorte ao centro e nao deteccao de assunto. Sao quatro fotos; se
alguma ficar mal enquadrada, corta-se a mao antes de a largar na pasta.
"""

from pathlib import Path

from PIL import Image, ImageOps

RAIZ = Path(__file__).resolve().parent.parent
ORIGEM = RAIZ / "fotos-originais"
DESTINO = RAIZ / "theme" / "rides-and-shaves" / "assets" / "img"

# nome -> (largura, altura) do ficheiro que o tema carrega
ALVOS = {
    "hero": (2400, 1000),
    "sobre": (900, 1000),
    "loja-nogueiro": (900, 560),
    "loja-lamacaes": (900, 560),
}

EXTENSOES = (".jpg", ".jpeg", ".png", ".webp", ".JPG", ".JPEG", ".PNG", ".WEBP")


def encontrar(nome: str) -> Path | None:
    for ext in EXTENSOES:
        caminho = ORIGEM / f"{nome}{ext}"
        if caminho.exists():
            return caminho
    return None


def main() -> None:
    DESTINO.mkdir(parents=True, exist_ok=True)
    feitos = 0

    for nome, (largura, altura) in ALVOS.items():
        origem = encontrar(nome)
        if origem is None:
            print(f"  -- {nome}: sem ficheiro, mantem a foto atual")
            continue

        # exif_transpose: fotos de telemovel vem deitadas se a rotacao so
        # estiver nos metadados.
        im = ImageOps.exif_transpose(Image.open(origem)).convert("RGB")
        if im.width < largura or im.height < altura:
            print(f"  !! {nome}: {im.width}x{im.height} e menor que {largura}x{altura} — vai ficar esticada")

        recorte = ImageOps.fit(im, (largura, altura), Image.LANCZOS, centering=(0.5, 0.5))
        saida = DESTINO / f"{nome}.jpg"
        recorte.save(saida, quality=88, optimize=True, progressive=True)
        print(f"  OK {saida.name}  {largura}x{altura}  {saida.stat().st_size // 1024} KB  <- {origem.name}")
        feitos += 1

    print(f"\n{feitos} de {len(ALVOS)} fotos atualizadas.")
    if feitos:
        print("Agora: build.ps1, e a versao do tema tem de subir para o browser")
        print("largar a imagem antiga em cache (o src leva ?v=<versao>).")


if __name__ == "__main__":
    main()
