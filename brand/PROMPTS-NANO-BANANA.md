# Prompts para Nano Banana 2 — Rides and Shaves

Reescritas de raiz para este modelo. **Não são as mesmas do `PROMPTS.md`** — aquelas
estavam em estilo Midjourney (listas de palavras-chave, bloco de negativo à parte),
e isso funciona mal aqui.

## Três diferenças que mudam a forma de escrever

**1. Prosa, não etiquetas.** Os modelos da família Gemini seguem melhor uma descrição
corrida, como se estivesses a explicar a fotografia a alguém, do que uma enfiada de
termos separados por vírgulas. As prompts abaixo são parágrafos.

**2. Não há campo de negativo.** Em vez de listar o que não queres, afirmas o
contrário: não escrevas *"sem texto no letreiro"* — escreve *"o letreiro está vazio,
sem qualquer lettering"*. Está assim em todas.

**3. É um modelo de edição, e é aí que ganhas.** A força dele é manter coerência a
partir de uma imagem de referência. Usa isso: gera o hero primeiro, e daí em diante
anexa as imagens já feitas e diz *"a mesma barbearia da imagem de referência"*.
É o que resolve o problema de as oito fotos parecerem oito sítios diferentes.

> Se a ferramenta tiver controlo de rácio à parte, define-o lá. Se não tiver, o rácio
> vai escrito no fim de cada prompt.

---

## Ordem — não saltes

1. **Hero.** Define o aspeto da casa: luz, madeiras, verdes, atmosfera.
2. **Interior de Nogueiró**, com o hero anexado como referência.
3. **Montra de Lamaçães**, com as duas anteriores anexadas.
4. **Depósito da mota**, com o interior anexado.
5. **Produto 1**, sozinho. Depois 2, 3 e 4 sempre com o produto 1 anexado.

---

## 1 · `hero.jpg` — 1600×1000

```
Uma fotografia tirada dentro de uma barbearia escura e quente, ao fim do dia. Um
barbeiro de antebraços tatuados e luvas pretas de nitrilo inclina-se sobre um cliente
e faz-lhe a barba ao longo do maxilar com uma navalha. O cliente é um homem nos seus
trinta e poucos anos, de barba cheia escura e cabelo farto penteado para trás; tem a
cabeça pousada para trás na cadeira e os olhos fechados, completamente descontraído.
Veste uma capa de barbeiro preta e lisa, de tecido uniforme e sem qualquer impressão.
Atrás deles a parede é verde-escura, quase preta, e está desfocada: quadros
emoldurados, uma prateleira de frascos de vidro âmbar, e o reflexo suave vermelho e
azul de um poste de barbeiro. A única luz é tungsténio quente, vinda de cima e da
esquerda, a rasar a maçã do rosto do cliente e a cair para sombra profunda no lado
direito do enquadramento. Há pequenos brilhos âmbar no fio da navalha. Objetiva de
50mm a f/1.8: o rosto do cliente e a lâmina estão nítidos, o fundo dissolvido em
manchas suaves. A cor tem sombras verde-petróleo e meios-tons âmbar quentes, com grão
fino de filme 35mm. Todas as superfícies da imagem estão limpas de escrita: as
paredes, a capa e os frascos não têm letras, rótulos nem símbolos. Enquadramento
horizontal 16:10, as duas figuras ao centro com folga dos dois lados.
```

## 2 · `loja-nogueiro.jpg` — 900×560

> Anexa o hero. Começa por: **"A mesma barbearia da imagem de referência, agora vista de longe."**

```
A mesma barbearia da imagem de referência, agora vista de longe e sem ninguém lá
dentro. O espaço partilha o chão com duas motas personalizadas — uma bobber preta
mate e uma cruiser de depósito cromado — estacionadas sobre cimento polido escuro, ao
lado de três cadeiras de barbeiro antigas em pele. As paredes têm painéis
verde-escuros e candeeiros de latão que lançam poças de luz quente; ao fundo, uma
parede de fotografias emolduradas a preto e branco e um espelho comprido que apanha o
âmbar dos candeeiros. É fim de tarde, os candeeiros estão acesos, e entra um único
feixe de luz de dia mais fria por uma janela à esquerda, que separa os planos.
Objetiva de 24mm a f/4, plano largo de ambiente, tudo legível, com a ligeira
profundidade da grande angular. Os quadros, as paredes e as motas estão todos sem
lettering, sem placas e sem marcas visíveis. Enquadramento horizontal 16:10.
```

## 3 · `loja-lamacaes.jpg` — 900×560

> Anexa as duas anteriores.

```
A montra da mesma barbearia das imagens de referência, agora vista da rua, à hora
azul. A fachada é pintada de verde-garrafa escuro, com grandes vidros que brilham
âmbar por dentro; através do vidro veem-se as silhuetas das cadeiras de barbeiro. Por
cima da porta há uma tabuleta escura que está completamente vazia — é uma superfície
lisa e pintada, sem uma única letra ou símbolo. Uma mota personalizada está
estacionada junto ao passeio em primeiro plano, com a luz da montra a bater no
depósito e no escape. As calçadas estão molhadas e refletem o brilho âmbar. O céu é
azul-petróleo profundo, na última luz do dia. Objetiva de 35mm a f/2.8, ligeiro
contrapicado, o edifício a preencher o enquadramento. Enquadramento horizontal 16:10.
```

## 4 · `sobre.jpg` — 900×1000 (vertical)

> Anexa o interior de Nogueiró. **Esta é a que leva o emblema por cima, depois.**

```
Um grande plano do depósito de combustível de uma das motas das imagens de
referência, em três quartos, a preencher um enquadramento vertical. A tinta é
verde-escura de brilho profundo, quase preta nas sombras, com um único filete dourado
fino a correr pelo ombro do depósito. O flanco central do depósito é uma extensão de
tinta lisa, limpa e uniforme: não tem emblema, não tem distintivo, não tem letras nem
qualquer relevo — é só tinta. O tampão do depósito é de metal escovado e apanha um
único brilho âmbar. Atrás, muito desfocados, os candeeiros quentes da oficina.
Objetiva de 85mm a f/2, luz rasante vinda da direita a revelar a curvatura e a
profundidade do verniz. Enquadramento vertical 9:10.
```

> A zona lisa é de propósito: é onde entra `brand/logo-transparent.png`, no editor,
> à escala e com um leve *multiply* para assentar na tinta.

## 5 · `produto-1.jpg` — 700×700 · Pomada Matte

```
Uma fotografia de produto de um boião baixo e largo de pomada para cabelo, de tampa
de rosca, em preto mate, pousado sobre uma superfície de pedra verde-escura. O boião
está completamente liso: não tem rótulo, nem texto impresso, nem gravação, nem
símbolo nenhum — é só o material. O fundo é verde-preto contínuo, a cair para sombra.
A luz é um difusor grande e suave vindo de cima e da esquerda, mais uma luz âmbar
quente de recorte vinda da direita, que separa a silhueta do fundo; por baixo do
boião há um reflexo suave na pedra. Objetiva macro de 100mm a f/8, produto todo
nítido, câmara ao nível do objeto e de frente. Enquadramento quadrado 1:1, com
margem igual à volta do produto.
```

## 6–8 · `produto-2` a `produto-4`

> **Anexa sempre a `produto-1.jpg`.** É assim que os quatro ficam a parecer da mesma
> marca. Muda só a frase do objeto:

```
Exatamente a mesma superfície, a mesma luz, o mesmo fundo e a mesma câmara da imagem
de referência. Substitui o objeto por: <OBJETO>. O objeto está completamente liso,
sem rótulo, sem texto impresso, sem gravação e sem símbolos. Enquadramento quadrado
1:1, com margem igual à volta do produto.
```

| Ficheiro | `<OBJETO>` |
|---|---|
| `produto-2.jpg` | um frasco alto de vidro âmbar com conta-gotas de tampa preta, para óleo de barba |
| `produto-3.jpg` | um frasco alto de doseador, em preto mate, para champô de barba |
| `produto-4.jpg` | uma caixa pequena de cartão escuro com três frascos miniatura em pé à frente dela |

---

## Quando sair errado

É um modelo de edição: não recomeces do zero, corrige.

| Problema | O que dizer |
|---|---|
| Apareceu texto | *"Mantém tudo exatamente igual, mas essa superfície fica lisa e pintada, sem qualquer letra."* |
| Mãos deformadas no hero | *"Mantém o enquadramento e a luz, refaz só as mãos do barbeiro: cinco dedos, a segurar a navalha de forma natural."* |
| Ficou demasiado claro | *"A mesma imagem, mas com o lado direito a cair para sombra muito mais profunda e só a luz quente da esquerda."* |
| Verde errado | *"Mantém tudo, mas as paredes são verde-garrafa escuro, quase preto, não verde vivo."* |
| Produto de escala diferente | *"O objeto tem de ocupar exatamente a mesma altura no enquadramento que o da imagem de referência."* |

---

## Depois de gerar

1. Exportar nos tamanhos exatos, JPEG qualidade 85, sRGB.
2. Gravar em `theme/rides-and-shaves/assets/img/` com estes nomes:
   `hero.jpg` · `loja-nogueiro.jpg` · `loja-lamacaes.jpg` · `sobre.jpg` ·
   `produto-1.jpg` a `produto-4.jpg`
3. `powershell -ExecutionPolicy Bypass -File build.ps1`
4. `php tools/preview.php` para ver antes do upload.

Se preferires, manda-me as imagens em bruto e trato eu dos cortes, dos tamanhos e de
as pôr no sítio — isso é mecânico.

## Duas que ficam de fora

- **Miniaturas do Journal.** Cortei a secção do blog; se a quiseres de volta, digo.
- **Avatares das reviews.** Não geres rostos para o João Oliveira, o André Silva, o
  Bruno Gomes e o Ruben Pinheiro — são pessoas reais que escreveram aquilo no Google.
  Círculo dourado com a inicial fica melhor e são três linhas de CSS.
