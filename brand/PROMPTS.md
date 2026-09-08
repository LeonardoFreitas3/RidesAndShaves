# Prompts de imagem — Rides and Shaves

Prompts em **inglês** de propósito: os modelos de imagem seguem instruções em inglês
com muito mais fidelidade, mesmo os que percebem português. As descrições do que é
cada uma ficam em português.

Depois de gerar: gravar em `theme/rides-and-shaves/assets/img/` **com o nome exato**
da tabela e correr `build.ps1`. Mais nada muda no tema.

---

## Regra que muda tudo: nunca peças o logótipo

Modelos de imagem escrevem texto errado — sempre. Vais receber "RIDES ANO SHAVFS"
num letreiro lindo e inutilizável.

**Pede superfícies limpas e compõe o logótipo por cima** no editor, usando
`brand/logo-app-512.png`. Está em todas as prompts abaixo como
`leave a clean unmarked surface`. É por isso que a prompt do depósito da mota pede
uma zona lisa: é ali que o emblema entra depois.

---

## Âncora de estilo — colar no início de TODAS as prompts

Isto é o que mantém as oito imagens a parecer o mesmo sítio no mesmo dia.
Se o Claude Design deixar fixar um seed, fixa o mesmo para todas.

```
Editorial photography for a barbershop brand. Dark bottle-green and near-black
environment (#043A39 / #021A16), warm amber tungsten light (#E8A94E), cream
highlights (#FDF3E5). Deep shadows, high contrast, moody but readable. Fine 35mm
film grain, subtle halation on the highlights. Colour grade: teal-green shadows,
warm amber midtones, no blue cast. Photographic realism, not illustration, not 3D
render. No text, no logos, no signage anywhere in frame.
```

## Negativo — colar em todas

```
text, letters, words, numbers, logos, watermarks, signage, brand names, labels,
distorted hands, extra fingers, malformed ears, waxy plastic skin, HDR, oversaturated,
cool blue tones, flat frontal flash, white studio background, stock-photo grin,
cluttered background, lens dirt, heavy vignette
```

---

## 1. `hero.jpg` — 1600×1000 (16:10)

Barbeiro a fazer a barba, é a primeira coisa que se vê no site.

```
A barber with tattooed forearms in black nitrile gloves leans in to shave the jawline
of a seated client with a straight razor. The client is a man in his early thirties
with a full dark beard and swept-back hair, head tilted back against the chair, eyes
closed, completely relaxed. He wears a plain black barber cape — leave a clean unmarked
surface on the cape, no printing. Background: dark green-black wall, out-of-focus
framed prints, a shelf of amber glass bottles, one soft reflection of a barber pole.
Warm tungsten key light raking from the upper left across the client's cheekbone, deep
falloff into shadow on the right. Small amber speculars on the razor blade and the
barber's knuckles. Shot on a 50mm lens at f/1.8 — client's eye and the blade sharp,
background dissolved. Horizontal 16:10, subject centred with breathing room both sides
so it can crop narrower on mobile.
```

## 2. `loja-nogueiro.jpg` — 900×560 (16:10)

Interior da loja de Nogueiró, com as motas lá dentro.

```
Interior of a barbershop that shares its floor with two custom motorcycles — a matte
black bobber and a chrome-tanked cruiser — parked on dark polished concrete beside
three vintage leather barber chairs. Dark green panelled walls, brass wall lamps
throwing warm pools of light, a wall of framed black-and-white prints, a long mirror
catching the amber lamps. Empty of people. Late afternoon, lamps on, one shaft of
cooler daylight from a window on the left to separate the planes. Shot on a 24mm lens
at f/4, wide establishing view, everything legible, slight wide-angle depth. Leave all
surfaces unmarked — no signage, no printed text.
```

## 3. `loja-lamacaes.jpg` — 900×560 (16:10)

Montra da loja de Lamaçães, vista da rua.

```
Exterior storefront of a barbershop at blue hour, shot from across a narrow European
street. Dark bottle-green painted shopfront with large plate-glass windows glowing warm
amber from inside; silhouettes of barber chairs visible through the glass. A blank dark
sign board above the door — leave it completely empty and unmarked. One custom
motorcycle parked at the kerb in the foreground, catching the window light on its tank
and exhaust. Wet cobblestones reflecting the amber glow. Sky deep teal, last light.
Shot on a 35mm lens at f/2.8, slight low angle, building filling the frame.
```

## 4. `sobre.jpg` — 900×1000 (9:10, vertical)

Depósito da mota. **Esta é a que leva o emblema por cima, depois.**

```
Extreme close-up of the fuel tank of a custom motorcycle, three-quarter view, filling
the vertical frame. Deep gloss dark-green paint, almost black in the shadows, with a
single thin gold pinstripe running along the tank's shoulder. The centre of the tank's
flank is a clean, flat, completely unmarked expanse of paint — no badge, no emblem, no
lettering, nothing. Brushed metal filler cap catching one amber highlight. Behind it,
heavily out of focus, the warm lamps of a workshop. Shot on an 85mm lens at f/2,
raking light from the right revealing the curve and the depth of the clearcoat.
Vertical 9:10.
```

> A zona lisa no flanco do depósito é intencional: é onde entra
> `brand/logo-app-512.png` no editor, à escala e com um leve `multiply` para assentar
> na tinta.

## 5–8. `produto-1..4.jpg` — 700×700 (1:1)

**Gera as quatro numa só imagem.** Pede uma fila de quatro produtos, exporta 4:1 e
corta em quatro quadrados. Assim a luz, a escala e o reflexo são exatamente os mesmos
— gerar uma a uma dá sempre quatro objetos que não parecem da mesma marca.

```
Four men's grooming products lined up side by side on a dark green stone surface,
evenly spaced, all at the same scale and lit identically. Left to right: a squat matte
black screw-top tin of hair pomade; a tall amber glass bottle with a black dropper cap
for beard oil; a tall matte black pump bottle for beard shampoo; a small dark card box
with three miniature bottles standing in front of it. Every product is completely
blank — no labels, no printed text, no embossing, no logos. Background: seamless deep
green-black falling into shadow. Lighting: one large soft key from the upper left, one
warm amber rim light from the right edge separating each silhouette, a soft reflection
under each product on the stone. Shot on a 100mm macro lens at f/8, all four in sharp
focus, straight-on eye-level product view. Wide 4:1 horizontal composition with equal
margin around each product so it can be cut into four squares.
```

Depois: as etiquetas vão por cima no editor, com o logótipo. Se preferires gerar
individualmente, muda só a frase do produto e mantém **tudo** o resto igual, palavra
por palavra.

---

## Avatares das reviews — não gerar

Não faças caras para o João Oliveira, André Silva, Bruno Gomes e Ruben Pinheiro.
São pessoas reais que escreveram aquelas críticas no Google; pôr um rosto inventado
ao lado do nome de alguém real é passar por verdadeiro o que não é, e é o tipo de
coisa que dá problema se alguém reparar.

A alternativa que fica melhor no design: círculo dourado com a inicial. São três
linhas de CSS e nenhuma imagem — digo se queres que o meta.

---

## Depois de gerar

1. Exportar nos tamanhos exatos da tabela, JPEG qualidade 85, sRGB.
2. Gravar em `theme/rides-and-shaves/assets/img/` com os nomes exatos:
   `hero.jpg` · `loja-nogueiro.jpg` · `loja-lamacaes.jpg` · `sobre.jpg` ·
   `produto-1.jpg` … `produto-4.jpg`
3. `powershell -ExecutionPolicy Bypass -File build.ps1`
4. `php tools/preview.php` para ver antes de fazer upload.

Os `produto-*.jpg` não são usados pelo tema — são para carregares como imagem
destacada nos produtos do WooCommerce.
