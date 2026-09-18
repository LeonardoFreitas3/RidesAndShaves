# Fotos originais

Larga aqui as fotos no tamanho e qualidade máximos que tiveres. O nome do
ficheiro é que decide onde entra — a extensão pode ser `.jpg`, `.jpeg`, `.png`
ou `.webp`.

Depois corre:

    python tools/fotos.py

O script recorta ao centro para o formato certo, redimensiona e grava em
`theme/rides-and-shaves/assets/img/`. Os originais ficam aqui intactos.

## Os ficheiros que o site usa

| Nome a dar          | Onde aparece                          | Formato   | Mínimo recomendado |
|---------------------|---------------------------------------|-----------|--------------------|
| `hero`              | Banner da homepage, ecrã inteiro      | 2,4:1     | 2400 × 1000        |
| `sobre`             | "Mais do que uma barbearia"           | 0,9:1     | 900 × 1000         |
| `loja-nogueiro`     | Cartão da loja do Nogueiró            | 1,6:1     | 900 × 560          |
| `loja-lamacaes`     | Cartão da loja das Lamaçães           | 1,6:1     | 900 × 560          |

Não é preciso entregares tudo de uma vez: o script só mexe no que encontrar.

## O que fica bem em cada uma

- **hero** — horizontal, com espaço morto à esquerda. O título "Enjoy the ride"
  assenta em cima do terço esquerdo, por isso uma foto com a acção à direita
  funciona melhor do que uma com o assunto ao centro.
- **sobre** — vertical. Interior, cadeiras, as motas.
- **loja-*** — a fachada ou o interior de cada loja, uma por loja.

## As fotos dos produtos não vêm por aqui

Essas são do WooCommerce, não do tema. Carrega-as em
**Produtos → editar produto → Imagem do produto**. Assim mudam-se sem ter de
enviar o tema outra vez, e o WordPress gera os tamanhos todos sozinho.

Formato: quadrado, mínimo 800 × 800, fundo liso.
