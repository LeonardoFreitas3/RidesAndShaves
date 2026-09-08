# Como desenhar o site no Claude Design

## Antes de abrir

1. **Mete as fotos do fotógrafo no repo**, em `theme/rides-and-shaves/assets/img/`,
   por cima dos placeholders, com os nomes exatos:

   | Ficheiro | Foto | Tamanho |
   |---|---|---|
   | `hero.jpg` | barbeiro a fazer a barba | 1600×1000 |
   | `loja-nogueiro.jpg` | interior de Nogueiró | 900×560 |
   | `loja-lamacaes.jpg` | montra de Lamaçães | 900×560 |
   | `sobre.jpg` | depósito da mota / ambiente | 900×1000 |
   | `produto-1..4.jpg` | os quatro produtos | 700×700 |

   Se tiveres mais fotos, mete-as em `brand/fotos/` — ele consegue lá chegar na mesma.

2. **Projeto novo.** Não continues a sessão que partilhaste: o contexto dela é
   "documento de prompts", e a primeira coisa que fizeres vai ser contaminada por isso.
   Fecha esse formulário sem responder.

## No Claude Design

1. Botão **+** → **Link local code…** → aponta para `C:\Projetos\RidesAndShaves`.

   É este passo que faz a diferença. Sem ele estás a descrever a marca por palavras;
   com ele, o Claude Design lê o `theme.json` (paleta, tamanhos, espaçamentos), o
   `logo.png`, as fotos reais e o layout que já existe. A alternativa —
   **Attach file** — serve para mandar uma foto solta, mas não te dá o resto.

2. Deixa a pergunta do **design system** por responder, ou escolhe "não tenho".
   A direção visual já vem do `theme.json`; um design system atado por cima passa-lhe à frente.

3. Cola o briefing abaixo.

---

## Briefing — copiar tudo

```
Estou a desenhar o site da Rides and Shaves BarberShop, uma barbearia em Braga com
duas lojas. O código do site está ligado a este projeto — usa-o como fonte de verdade,
não inventes valores.

MARCA
A paleta está em theme/rides-and-shaves/theme.json. Usa exatamente estas:
- #043A39 verde-petróleo — fundo das secções claras
- #021A16 verde quase preto — hero, faixas escuras, header e footer
- #FDF3E5 creme — todo o texto corrido
- #E8A94E dourado — segunda linha dos títulos, preços, botões, filetes
- #C20B08 e #044880 — só o poste de barbeiro, uso mínimo

Alterna as secções entre o verde-petróleo e o quase-preto, para dar ritmo.

TIPOGRAFIA
Títulos: display condensada, pesada, tudo em maiúsculas, entrelinha apertada
(1.0–1.05), tipo Oswald ou Anton. Títulos em duas linhas, a segunda a dourado.
Texto corrido: sans neutra, creme, tamanho confortável.
Nunca texto pequeno a dourado sobre verde — não passa em contraste. Dourado só em
títulos, preços e botões.

EMBLEMA
theme/rides-and-shaves/assets/logo.png. Usa o ficheiro tal como está.
Nunca redesenhes o emblema nem escrevas "Rides and Shaves" à mão em SVG ou texto.

FOTOGRAFIA
As fotos reais estão em theme/rides-and-shaves/assets/img/. Usa-as pelo nome:
hero.jpg, loja-nogueiro.jpg, loja-lamacaes.jpg, sobre.jpg, produto-1..4.jpg.
Não uses placeholders — as imagens existem.

ESTRUTURA DA HOMEPAGE, por esta ordem
1. Header: emblema à esquerda, menu ao centro (Início · Serviços · Lojas · Sobre ·
   Shop · Contactos) em maiúsculas espaçadas, botão "Marcar" delineado a dourado e
   ícone de carrinho à direita.
2. Hero em duas colunas: à esquerda "BARBEARIA, / GROOMING & / LIFESTYLE." com a
   segunda linha a dourado, subtítulo "Corte. Barba. Estilo. Experiência.", botão
   dourado "Marcar" + botão delineado "Shop", e por baixo "— SINCE 1995 —" a dourado
   entre dois filetes finos. À direita, hero.jpg a sangrar até à margem.
3. Serviços: título "OS NOSSOS SERVIÇOS" com um filete dourado a estender-se para a
   direita até à margem. Por baixo UMA caixa com moldura dourada fina, dividida em
   seis colunas por divisórias verticais — não seis cartões separados. Cada coluna:
   ícone dourado em line art, nome, preço a dourado, uma linha de descrição, botão
   pequeno "Marcar". Os botões alinhados todos na mesma linha de base.
   Cabelo 17€ · Cabelo + Barba 25€ · Barba 11€ · Barbaterapia 21€ ·
   Sobrancelha à linha 9€ · Depilação nasal ou ouvidos 5€
4. Lojas: "DUAS LOCALIZAÇÕES. / A MESMA EXPERIÊNCIA." à esquerda, parágrafo à direita.
   Dois cartões grandes com foto em cima e por baixo nome, morada, horário e dois
   botões (Ver no mapa / Marcar).
   Nogueiró — Rua Amândio César, N.º 7, 4715-404 Braga
   Lamaçães — Rua Ambrósio dos Santos, N.º 57, 4715-213 Braga
   Ambas: Seg–Sex 10:00–20:00 · Sáb 09:00–19:00 · Dom fechado
5. Shop: título e descrição à esquerda com botão "Explorar shop", quatro produtos em
   grelha à direita.
6. Sobre, em três colunas: sobre.jpg à esquerda a sangrar, texto ao centro
   ("MAIS DO QUE UMA BARBEARIA."), emblema à direita.
7. Reviews: "QUEM EXPERIMENTA, VOLTA." com filete. À esquerda 5,0 em grande a dourado,
   cinco estrelas, "443 avaliações Google nas duas lojas". À direita quatro cartões
   com estrelas, citação e nome.
8. Fecho: "PRONTO PARA A PRÓXIMA?" centrado com botão "Marcar agora".
9. Footer: emblema e redes à esquerda, três colunas (links, contactos, newsletter),
   filete dourado, linha de copyright.

REGRAS
- Copy em português de Portugal, tratamento por tu. Nada de português do Brasil.
- Dados reais, não inventes: telefone +351 939 929 215, as duas moradas acima,
  5,0 estrelas com 443 avaliações Google.
- As reviews são de pessoas reais (João Oliveira, André Silva, Bruno Gomes,
  Ruben Pinheiro). Não gerar nem colocar fotos de rosto. Usa um círculo dourado
  com a inicial.
- Sem secção de blog ou journal.
- As marcações são feitas numa app externa, não no site: todos os botões "Marcar"
  apontam para /marcar.

ENTREGA
Um artboard por página: homepage primeiro, depois Serviços, Lojas, Sobre e Contactos.
Desktop a 1440px de largura, com o conteúdo limitado a 1280px ao centro.
```

---

## Depois

O Claude Design entrega `.dc.html`. Isso não vai direto para o WordPress — o tema já
existe e é block theme.

O caminho é: usas o Claude Design para **decidir** (espaçamentos, crops das fotos,
tamanhos de título, o que ainda não está bem), e depois digo-me o que mudou que eu
passo para os patterns. As secções batem uma a uma com os ficheiros:

| Secção no Claude Design | Ficheiro no tema |
|---|---|
| Hero | `patterns/hero.php` |
| Serviços | `patterns/servicos.php` |
| Lojas | `patterns/lojas.php` |
| Sobre | `patterns/sobre.php` |
| Reviews e Shop | `templates/front-page.html` |
| Fecho | `patterns/cta.php` |
| Header / Footer | `parts/header.html` · `parts/footer.html` |
| Cores e tamanhos | `theme.json` |
