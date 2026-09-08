# Rides and Shaves — site + loja

Child theme de **Twenty Twenty-Five** (block theme). Os tokens da marca vivem no `theme.json`,
por isso ficam disponíveis no editor, no WooCommerce e como CSS vars, sem plugin nenhum.

```
brand/                    dossier da marca + logo 512px
dist/rides-and-shaves.zip pronto a instalar
theme/rides-and-shaves/   o tema
  theme.json              paleta, tipografia, espaçamentos  <- editar aqui
  style.css               só o que o theme.json não cobre
  functions.php           enqueue, suporte Woo, redirect /marcar
  assets/logo.png         emblema
  assets/icons/*.svg      6 ícones de serviço, dourado, line art
  assets/img/*.jpg        placeholders de fotografia
  screenshot.png          cartão do tema em Aparência → Temas
  parts/                  header (com menu), footer
  patterns/               hero, servicos, lojas, sobre, shop, journal,
                          reviews, contactos, cta
  templates/              front-page + page-servicos/lojas/sobre/journal/contactos
  tools/check-blocks.php  verifica tudo sem WordPress
tools/preview.php         renderiza todas as páginas fora do WordPress
tools/make-placeholders.ps1
```

## Imagens

Os `assets/img/*.jpg` são as fotografias geradas no Nano Banana, já cortadas e
redimensionadas. Para trocar por outras, pôr os originais em `~/Downloads`, ajustar
os caminhos no topo de `tools/import-fotos.ps1` e correr:

```bash
powershell -ExecutionPolicy Bypass -File tools\import-fotos.ps1
```

| Ficheiro | Origem | Tamanho |
|---|---|---|
| `hero.jpg` | barbeiro a fazer a barba | 1600×1000 |
| `loja-nogueiro.jpg` · `loja-lamacaes.jpg` | interior / montra | 900×560 |
| `sobre.jpg` | recorte vertical da sala com a mota cromada | 900×1000 |
| `produto-1.jpg` | boião de pomada, já com o logótipo | 700×700 |
| `produto-2..4.jpg` | recortados da foto dos três produtos | 700×700 |
| `journal-1..4.jpg` | recortes das fotos das secções | 600×400 |

Os ícones dos serviços (`assets/icons/`) são SVG desenhados de raiz, na cor da marca.
O emblema sem fundo sai de `tools/make-transparent-logo.ps1`.

## Ver o design sem instalar o WordPress

```bash
php tools/preview.php
```

Escreve um `_preview-{template}.html` por template — homepage e as quatro páginas
internas — com os patterns corridos e os presets do `theme.json` aplicados. Cada
um leva no topo uma barra para saltar entre eles.

Não é o WordPress e não tenta ser: é um espelho suficiente para apanhar layout
partido antes de fazer upload. Servir com `php -S 127.0.0.1:8321` para as
imagens carregarem.

## Páginas internas

**Criam-se sozinhas.** Ao ativar o tema, o `functions.php` cria as quatro páginas
(`/servicos`, `/lojas`, `/sobre`, `/contactos`) se ainda não existirem. É idempotente
pelo slug: reativar não duplica nem apaga nada.

Cada página é desenhada pelo template `page-{slug}.html`, que puxa o pattern
respetivo mais a faixa de CTA. O conteúdo da página fica vazio de propósito — só
precisa de existir para o WordPress ter onde aplicar o template.

O menu do header já vem preenchido (Início · Serviços · Lojas · Sobre · Shop ·
Contactos); o WordPress cria o menu a partir dele na primeira visita.

**Onde editar o quê:**

| Para mudar | Editar |
|---|---|
| preços e descrições dos serviços | o array no topo de `patterns/servicos.php` |
| moradas, horários, coordenadas | o array no topo de `patterns/lojas.php` |
| texto "Mais do que uma barbearia" | `patterns/sobre.php` |
| telefone e horário | `patterns/contactos.php` |
| ordem das secções da homepage | `templates/front-page.html` |

Os patterns são partilhados entre a homepage e as páginas internas: os preços
existem uma vez só e aparecem nos dois sítios. Os botões que apontariam para a
própria página (o "Ver todos os serviços" em `/servicos`, o "Conhecer a nossa
história" em `/sobre`) escondem-se sozinhos.

## Instalar

1. WordPress 6.6+ com o tema **Twenty Twenty-Five** instalado (não precisa de estar ativo).
   Se faltar, o WordPress recusa o child theme com "The parent theme is missing".
2. *Aparência → Temas → Adicionar → Carregar tema* → `dist/rides-and-shaves.zip` → ativar.
3. Instalar WooCommerce. Criar as páginas Loja/Carrinho/Checkout no wizard.
4. As páginas internas e o menu aparecem sozinhos na ativação — nada a fazer.
5. Carregar o logo em *Aparência → Editor → Estilos → Logótipo* (`brand/logo-app-512.png`).

## Reconstruir o zip depois de editar

```bash
powershell -ExecutionPolicy Bypass -File build.ps1
```

Corre os checks e só depois monta o zip. Verifica quatro coisas que o WordPress não
reporta — o bloco simplesmente desaparece e ninguém percebe porquê:

1. blocos por fechar ou mal fechados
2. classes de cor que não existem na paleta do `theme.json`
3. `<?php` dentro de templates `.html` (não são parseados como PHP — só os patterns)
4. `wp:pattern` a apontar para um slug inexistente

Só os checks, sem construir o zip:

```bash
php theme/rides-and-shaves/tools/check-blocks.php
```

## Obrigatório antes de vender (Portugal)

| O quê | Porquê |
|---|---|
| Faturação certificada AT (InvoiceXpress / Vendus / Moloni) | WooCommerce sozinho não emite fatura válida em PT |
| MB Way + Multibanco (Ifthenpay / Eupago) | só cartão perde uma fatia grande das vendas |
| Envios CTT com custo por peso | produtos de grooming vão em correio normal |
| Checkbox de consentimento RGPD na newsletter | o campo de email sozinho não chega |

## Por confirmar com o cliente

- **Preços dos serviços** (17€ / 25€ / 11€ / 21€ / 9€ / 5€) vieram do mockup, não são públicos
  em lado nenhum. Confirmar antes de publicar.
- **Fonte display.** O `theme.json` usa `"Rides Display"` com fallback condensado do sistema.
  Quando escolherem a fonte, auto-alojar em `assets/fonts/` e declarar em `fontFace` —
  Google Fonts por CDN é risco RGPD.
- **Fotografia.** Os `assets/img/*.jpg` são placeholders da marca. Ver a secção *Imagens*.

## Decisões

- **Marcações não vivem aqui.** Estão na AppBarber. Todos os botões apontam para `/marcar`,
  que o `functions.php` redireciona. Se um dia quiserem marcação no próprio site, morre o
  redirect e nasce uma página — o resto do site não muda.
- **Journal cortado.** 4 artigos no mockup é um compromisso de conteúdo que morre ao terceiro
  mês. Se quiserem SEO, uma página só ("Como cuidar da barba em casa") a apontar para os
  produtos vende mais.
- **Shop subiu** para a 4.ª secção, antes do "sobre nós". É onde o site gera dinheiro.
- **Grelha de serviços é uma caixa com moldura**, com divisórias verticais entre serviços,
  como no mockup — não seis cartões soltos.
- **Botões "Marcar" por serviço mantidos** por fidelidade ao mockup. A minha reserva
  continua de pé: são 6 CTAs que levam todos para fora do site (a app da AppBarber).
  Se quiseres reduzir para um, é apagar o bloco `wp:buttons` dentro do `foreach`
  em `patterns/servicos.php` — uma vez, aplica-se aos seis.
