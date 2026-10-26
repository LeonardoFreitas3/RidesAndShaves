# CLAUDE.md

> Ficheiro de contexto do projeto. Lido no início de cada sessão de trabalho com o Claude.
> Atualizado no fim de cada sessão. Nunca colocar aqui passwords, tokens, chaves de API ou connection strings reais.
>
> **Para um Claude novo:** lê este ficheiro inteiro, depois o `README.md` (instalação e onde editar o quê)
> e o `brand/BRAND.md` (dados reais do negócio). Com os três sabes tudo o que precisas para continuar.

---

## 1. Visão geral

- **Nome:** Rides and Shaves BarberShop® — site + loja online
- **O que é:** Tema WordPress (child theme de Twenty Twenty-Five) com WooCommerce para uma barbearia real
  de Braga com duas lojas (Nogueiró e Lamaçães). O site apresenta serviços, lojas, história e avaliações,
  e vende produtos de grooming (pomadas, bálsamo, pó). **As marcações não são feitas no site** — vão para
  a app da AppBarber.
- **Dono / quem pede:** Leonardo Freitas (GitHub `LeonardoFreitas3`), a fazer o site para o cliente (a barbearia).
  Fala português de Portugal; responder sempre em **PT-PT**.
- **Estado:** em desenvolvimento, já instalado num ambiente de teste. Loja ainda não vende (falta pagamentos/envio/faturação).
- **URL produção:** ainda não existe. O `style.css` declara `Theme URI: https://ridesandshaves.pt` (domínio previsto, não confirmado).
- **URL staging/teste:** https://ridesandshaves-14a9dd6.ingress-earth.ewp.live/
- **Repo:** https://github.com/LeonardoFreitas3/RidesAndShaves (branch `main`, push direto, sem PRs)
- **Versão atual do tema:** `3.10.0` (em `theme/rides-and-shaves/style.css`)
- **Referências de design:**
  - Mockup original enviado pelo Leonardo (imagem) — o site foi construído "linha a linha" a partir dele.
  - Projeto no Claude Design: https://claude.ai/design/p/e7f6ae0f-cc99-4498-befc-1b0de7e82aab
  - Site de referência para a marca de água lateral: https://barbearia26dejunho.pt/

## 2. Stack

| Camada | Tecnologia | Versão |
|---|---|---|
| Frontend | Block theme WordPress (FSE): `theme.json` + templates `.html` + patterns `.php` + `style.css` | WP 6.6+ (testado até 6.8) |
| Tema pai | Twenty Twenty-Five (tem de estar instalado, não precisa de estar ativo) | — |
| Backend | WordPress + PHP (só `functions.php`, sem plugins próprios) | PHP 7.4+ (local: 8.3) |
| Loja | WooCommerce (blocos de carrinho/checkout, mini-cart) | versão recente |
| Base de dados | MySQL do alojamento WordPress (não há BD neste repo) | — |
| Autenticação | Contas do WooCommerce (login/registo em "A minha conta") | — |
| Alojamento / deploy | Alojamento WordPress gerido (`*.ewp.live`); deploy = upload manual do zip | — |
| Armazenamento de ficheiros | Assets dentro do tema + Biblioteca de Media do WP | — |
| Serviços externos | AppBarber (marcações), Google Maps/Reviews (links por Place ID) | — |
| JS | `assets/js/motion.js` (IntersectionObserver, ~30 linhas, sem bibliotecas) | — |
| Fontes | Barlow Condensed 700 auto-alojada (`assets/fonts/`) + system-ui no texto | — |
| Ferramentas locais | PHP CLI (checks + preview), PowerShell 5.1 (build), Python 3 + Pillow (imagens), ffmpeg (vídeo) | Windows 11 |

## 3. Estrutura do repositório

```
/
├── CLAUDE.md                  este ficheiro
├── README.md                  instalação, onde editar o quê, checklist legal PT
├── build.ps1                  corre os checks e monta dist/rides-and-shaves.zip
├── .claude/launch.json        servidor de preview (php -S 127.0.0.1:8321)
├── brand/
│   ├── BRAND.md               dossier do negócio: moradas, telefone, cores, equipa, reviews, tom de voz
│   ├── BRIEF-CLAUDE-DESIGN.md como desenhar no Claude Design
│   ├── PROMPTS.md             prompts de imagem (estilo Midjourney)
│   ├── PROMPTS-NANO-BANANA.md prompts para Nano Banana 2 (as usadas para gerar imagens)
│   └── logo-app-512.png, logo-transparent.png, mota-transparent.png, screenshot-*.png
├── dist/
│   ├── rides-and-shaves.zip   O ENTREGÁVEL: é isto que se carrega no WordPress (versionado no git)
│   └── produtos.csv           os 4 produtos para importar no WooCommerce (Produtos → Importar)
├── fotos-originais/           fotos/vídeos reais do cliente — IGNORADOS no git (pesados); só LEIA-ME.md e prontas/*.jpg entram
│   └── LEIA-ME.md             que original foi usado onde
├── tools/
│   ├── preview.php            renderiza cada template para _preview-*.html, sem WordPress
│   ├── fotos.py               fotos-originais/ → assets/img nos tamanhos certos (Pillow)
│   ├── make-marca.py          gera assets/logo-marca.png (marca de água) a partir de logo.png
│   ├── import-fotos.ps1       (antigo) importa as imagens geradas no Nano Banana a partir de ~/Downloads
│   ├── make-placeholders.ps1  (antigo) placeholders com a marca
│   └── make-transparent-logo.ps1  tira o fundo verde ao emblema → brand/*-transparent.png
└── theme/rides-and-shaves/    O TEMA
    ├── style.css              cabeçalho do tema (Version!) + todo o CSS que o theme.json não cobre (~1400 linhas, por secções)
    ├── theme.json             paleta, tipografia, espaçamentos, estilos de botões/links  ← tokens da marca
    ├── functions.php          enqueue, suporte Woo, criação de páginas, redirects, logo, rotina de fotos dos produtos
    ├── templates/             front-page, archive-product (loja), page-servicos/lojas/sobre/contactos, page-checkout
    ├── parts/                 header (menu + Marcar + mini-cart), footer (newsletter, links, contactos), checkout-header
    ├── patterns/              hero, servicos, lojas, sobre, shop, reviews, loja (catálogo), contactos, testemunho
    ├── assets/img/            hero, sobre, loja-*, produto-1..4, testemunho (poster)
    ├── assets/video/          testemunho.mp4 (16 MB)
    ├── assets/icons/          SVG line art dourados: calendar, cart, google, pin, tel
    ├── assets/fonts/          barlow-condensed-700.woff2
    ├── assets/js/motion.js    animações de entrada por scroll
    ├── assets/logo.png        emblema (vai para logótipo do site na ativação)
    ├── assets/logo-marca.png  emblema pré-multiplicado para a marca de água (mix-blend-mode: screen)
    ├── screenshot.png         cartão do tema em Aparência → Temas
    └── tools/check-blocks.php verificações estáticas do tema
```

Ficheiros `_preview-*.html` na raiz são gerados e estão no `.gitignore`.

### O que cada pattern faz

| Pattern (`rides-and-shaves/…`) | Onde aparece | Notas |
|---|---|---|
| `hero` | homepage | banner a ecrã inteiro, título "Enjoy the ride", menu transparente por cima, foto `hero.jpg` com gradiente |
| `servicos` | homepage, `/servicos` | carta numerada: nome, descrição, preço à direita, **um** botão Marcar. Dados num array no topo |
| `lojas` | homepage, `/lojas` | 2 cartões com foto, morada, "Ver no mapa" (Google Place ID) e Marcar. Dados num array no topo |
| `sobre` | homepage, `/sobre` | "Mais do que uma barbearia", foto `sobre.jpg` |
| `shop` | homepage | faixa com 4 produtos (`wc_get_products`) + adicionar ao carrinho AJAX; montra estática se não houver produtos |
| `reviews` | homepage | nota Google por loja (escrita à mão) + 4 críticas reais + botões para as avaliações no Google |
| `testemunho` | `/sobre` | vídeo do Nuno com play manual; usa o anexo "testemunho" da Media se existir, senão o do tema |
| `loja` | `templates/archive-product.html` (página Shop) | catálogo com o cartão `ras_cartao_produto()` sobre a query principal |
| `contactos` | `/contactos` | telefone, moradas, horário, redes. Sem formulário de propósito |

Ordem da homepage (`templates/front-page.html`): hero → servicos → lojas → sobre → shop → reviews.

## 4. Como correr localmente

Não há WordPress local. Trabalha-se com checks estáticos + preview HTML + o site de staging.

```bash
# dependências (Windows): PHP CLI no PATH, PowerShell 5.1, Python 3 com Pillow, ffmpeg (só para vídeo)
pip install pillow

# variáveis de ambiente necessárias: nenhuma

# verificar o tema (blocos fechados, cores da paleta, PHP em .html, slugs de pattern)
php theme/rides-and-shaves/tools/check-blocks.php

# gerar as pré-visualizações (_preview-front-page.html, _preview-page-*.html ...)
php tools/preview.php
# servir para as imagens carregarem (ou preview_start "preview" no Claude desktop)
php -S 127.0.0.1:8321 -t .
# abrir http://127.0.0.1:8321/_preview-front-page.html

# construir o zip (corre os checks primeiro; falha se algum falhar)
powershell -ExecutionPolicy Bypass -File build.ps1

# fotos reais: largar originais em fotos-originais/ e
python tools/fotos.py
# marca de água, se o logo.png mudar
python tools/make-marca.py
```

O preview **não é o WordPress**: emula presets do `theme.json`, colunas, botões. Não mostra WooCommerce real
(carrinho, checkout, conta) — isso só se vê no staging.

## 5. Deploy

- **Como é feito:** manual. Não há CI/CD.
- **Ciclo de trabalho (o que se fez em todas as sessões):**
  1. Claude edita o tema.
  2. **Sobe a versão** em `theme/rides-and-shaves/style.css` (`Version: x.y.z`). Obrigatório: as URLs das imagens,
     do CSS e do JS levam `?v=<versão>` e sem bump o browser/CDN serve a versão antiga.
  3. `powershell -ExecutionPolicy Bypass -File build.ps1` → `dist/rides-and-shaves.zip`.
  4. Commit (mensagem curta em PT, sem acentos, estilo "Checkout: campo do pais escuro") e `git push` para `main`.
  5. O Leonardo faz upload: *Aparência → Temas → Adicionar → Carregar tema* → escolhe o zip → "Substituir o atual pelo carregado".
  6. Ele diz "já carreguei, vê outra vez" e o Claude abre o staging no browser (pane do Claude desktop) e confirma
     em desktop (1440×900) e telemóvel (390×844), com screenshot.
- **Pipeline:** `build.ps1` → `check-blocks.php` → zip montado à mão com `/` nos caminhos
  (o `Compress-Archive` do PowerShell 5.1 escreve `\` e o WordPress extrai os ficheiros numa pasta plana).
- **Cuidados:**
  - Se uma alteração a um template não aparecer: o WordPress pode ter uma cópia do template na BD.
    *Aparência → Editor → Templates → (template) → ⋮ → Limpar personalizações*. Aconteceu com "Página: Finalizar compra".
  - `after_switch_theme` (criar páginas, pôr logótipo) só corre ao **ativar** o tema, não ao substituir.
  - A rotina das fotos dos produtos corre uma vez no `admin_init` e grava a option `ras_produtos = 'fotos-3.4'`.
    Para a forçar outra vez, mudar a marca no código.
  - O zip tem ~18 MB por causa do vídeo; se o alojamento recusar o upload, tirar `assets/video/` e carregar o vídeo na Media.

## 6. Modelo de dados

Não há modelo próprio — usa-se o do WordPress/WooCommerce. Os dados "fixos" do negócio vivem em arrays PHP nos patterns.

| Entidade | Campos principais | Relações / onde vive |
|---|---|---|
| Páginas WP | `servicos`, `lojas`, `sobre`, `contactos` (conteúdo vazio) | criadas por `functions.php` na ativação; desenhadas por `page-{slug}.html` |
| Páginas Woo | Loja (shop), Carrinho, Checkout, A minha conta | criadas pelo wizard do WooCommerce; `/loja` redireciona para a página shop, seja qual for o slug |
| Produto (Woo) | SKU, nome, preço, categoria, imagem | 4 produtos importados de `dist/produtos.csv` |
| Serviço | nome, preço (€), descrição | array em `patterns/servicos.php` |
| Loja física | nome, foto, morada, CP, coordenadas, Google Place ID | array em `patterns/lojas.php` |
| Avaliações Google | loja, Place ID, nota, nº de avaliações | array em `patterns/reviews.php` (atualizar à mão) |
| Críticas | autor, texto | array em `patterns/reviews.php` (críticas reais do Google) |
| Vídeo testemunho | anexo com slug `testemunho` | Media do WP, com fallback para `assets/video/testemunho.mp4` |
| Options | `ras_produtos` | marca da rotina de fotos dos produtos |
| Theme mods | `custom_logo` | posto na ativação a partir de `assets/logo.png` |

### Produtos (SKU → foto → nome)

| SKU | Foto | Nome | Preço | Categoria |
|---|---|---|---|---|
| RS-POM-100 | produto-1 | Pomada Matte | 16,90 € | Cabelo |
| RS-OLE-30 | produto-2 | Bálsamo para Barba | 16,90 € | Barba |
| RS-CHA-200 | produto-3 | Pó Texturizador | 14,90 € | Cabelo |
| RS-KIT-01 | produto-4 | Pomada | 16,90 € | Cabelo |

Os SKUs têm prefixos antigos (OLE, CHA, KIT) dos nomes inventados no início; os nomes foram corrigidos para os
rótulos reais dos produtos. **Os SKUs não se mudam** — a rotina em `functions.php` encontra os produtos por eles.
Preços dos produtos: por confirmar com o cliente.

### Serviços (preços vindos do mockup, por confirmar)

Cabelo 17 € · Cabelo + Barba 25 € · Barba 11 € · Barbaterapia 21 € · Sobrancelha à linha 9 € · Depilação nasal ou ouvidos 5 €

### Dados do negócio (públicos)

- Nogueiró: Rua Amândio César, N.º 7, 4715-404 Braga · Place ID `ChIJUYwWsrX9JA0RaWsRVBE0GzA`
- Lamaçães: Rua Ambrósio dos Santos, N.º 57, 4715-213 Braga · Place ID `ChIJN59vt4D_JA0RBFbUwmY0HOk`
- Telefone (ambas): +351 939 929 215 · **Não há email** (o cliente disse que não existe; não pôr nenhum)
- Horário: Seg–Sex 10:00–20:00 · Sáb 09:00–19:00 · Dom fechado
- Marcações: `RAS_BOOKING_URL` em `functions.php` (link de download da app AppBarber)
- Instagram: @ridesandshaves_barbershop
- Google em 2026-10-08: Nogueiró 5,0 (317) · Lamaçães 5,0 (166)

## 7. Convenções e regras

- **Língua:** código, comentários, commits e conversa em português de Portugal. Comentários de código sem acentos
  (`ponytail: ...`, `Nao`, `Pagina`); texto visível ao cliente **com** acentos.
- **Nomes:** prefixo `ras_` para funções/variáveis PHP (`$ras_lojas`, `ras_cartao_produto()`), `ras-` para classes CSS
  (`.ras-servico`, `.ras-place`, `.ras-produto`), `RAS_` para constantes. Patterns com slug `rides-and-shaves/<nome>`
  e categoria `rides-and-shaves`. Variáveis em PT (`$produto`, `$paginas`, `$titulo`).
- **Organização do código:**
  - Tokens (cores, fontes, tamanhos, espaçamentos, botões) → `theme.json`. `style.css` só para o que o theme.json não cobre.
  - `style.css` está dividido em secções `/* --- Nome ---- */`; acrescentar na secção certa ou criar uma nova.
  - Dados repetidos (serviços, lojas, reviews) → array no topo do pattern, markup num `foreach`. Uma fonte de verdade.
  - Patterns são partilhados entre homepage e páginas internas. Templates `.html` não correm PHP — PHP só em patterns.
  - Botões que apontariam para a própria página escondem-se sozinhos.
  - Imagens em patterns levam `?v=$ras_v` (versão do tema) para partir a cache.
- **Estilo / UI:**
  - Paleta (`theme.json`): `green-950 #021A16`, `green-900 #04241E`, `green-800 #073028` (fundo base), `cream #FDF3E5`
    (texto), `gold #E8A94E` (acento, botões, links), `ink #0B0B0B`, `pole-red #C20B08`, `pole-blue #044880`.
    `custom: false` — só estas cores; o check falha se aparecer uma classe de cor fora da paleta.
  - Títulos: Barlow Condensed 700, maiúsculas. Texto: system-ui.
  - Botões: dourado com texto verde, hover cream; variante `is-style-outline`. Ícones por classe `is-icon-cal|cart|pin|google|tel`.
  - Molduras finas douradas (`--ras-line`) em vez de sombras. Secções alternam fundos verdes.
  - Fotografias com `object-fit: contain` e caixas no formato da foto — **o cliente não quer cortes**. Exceção: o banner.
  - Marca de água: emblema fixo, metade à vista pela direita, em todo o site; escondido em telemóvel, carrinho e checkout.
  - Animação: entrada por scroll (`motion.js` põe `is-in`; CSS na secção "Movimento"). Sem JS o site aparece inteiro.
    A lista de seletores em `motion.js` e no CSS tem de ser igual.
  - Campos do WooCommerce (checkout/carrinho) levam `!important` porque a folha do Woo carrega depois da do tema.
- **Filosofia "ponytail":** a solução mais simples que funciona. Sem classes, frameworks, bibliotecas ou plugins
  desnecessários. Atalhos deliberados levam um comentário `ponytail:` a explicar o porquê e o limite. Seguir isto.
- **Regras a respeitar sempre:**
  - Subir `Version` no `style.css` em cada entrega.
  - Correr `build.ps1` (que corre os checks) antes de commitar; o zip em `dist/` vai no commit.
  - Depois do upload, verificar no staging em desktop e telemóvel antes de dizer que está feito.
  - Fotos de produtos e da barbearia são reais: nunca inventar fotos de pessoas reais (reviews usam a inicial num círculo).
  - Críticas e notas do Google têm de ser reais e ligadas à fonte (Place ID).
  - Fontes auto-alojadas (Google Fonts por CDN = risco RGPD).
- **Coisas a NÃO fazer:**
  - Não meter marcações no site nem um plugin de booking — tudo vai para `/marcar` → AppBarber.
  - Não pôr email de contacto (não existe).
  - Não usar `Compress-Archive` para o zip.
  - Não pôr PHP em templates `.html`.
  - Não mudar SKUs dos produtos.
  - Não cortar fotografias (`cover`) fora do banner.
  - Não commitar `fotos-originais/*` (o original do testemunho tem 1,4 GB; o GitHub recusa > 100 MB).
  - Não usar o shortcode `[products]` (em modo "Em breve" saía como texto cru).
  - Não pôr passwords/acessos do WordPress neste repo.

## 8. Decisões tomadas

| Data | Decisão | Motivo |
|---|---|---|
| 2026-09-08 | Child theme de Twenty Twenty-Five, tokens no `theme.json`, sem page builder | tokens disponíveis no editor, no Woo e como CSS vars sem plugins |
| 2026-09-08 | Entrega por zip carregado à mão | o Leonardo só tem acesso pelo painel do WP |
| 2026-09-08 | Marcações ficam na AppBarber; botões → `/marcar` → redirect 302 | o cliente já usa a app; trocar de plataforma é mudar uma constante |
| 2026-09-08 | Páginas internas criadas sozinhas na ativação, idempotente pelo slug | zero passos manuais |
| 2026-09-08 | Sem formulário de contacto | obrigava a plugin, anti-spam e RGPD; telefone resolve |
| 2026-09-08 | Secção Journal/artigos removida | decisão do cliente; não havia artigos |
| 2026-09-08 | Shop subiu na homepage (o README diz "4.ª secção, antes do sobre"; hoje o `front-page.html` tem-no depois do sobre — a ordem atual é a que vale) | é onde o site gera dinheiro |
| 2026-09-08 | Cartão de produto próprio (`ras_cartao_produto`) em vez do loop/shortcode do Woo | o CSS do loop do Woo deu problemas; o shortcode falhava em "Em breve" |
| 2026-09-08 | Verdes menos azulados e tipografia mais quente (Barlow Condensed) | o cliente achou o verde claro feio e as letras "robóticas" |
| 2026-09-08 | Banner a ecrã inteiro com o menu transparente por cima; título "Enjoy the ride" | pedido do cliente (do tom de voz do Instagram) |
| 2026-09-08 | Mobile igual ao desktop no banner/menu; hambúrguer à direita do carrinho; Marcar+carrinho+menu juntos | pedido do cliente |
| 2026-09-08 | Login/registo com o estilo do site | pedido do cliente |
| 2026-09-11 | Emblema como marca de água fixa, metade à vista pela direita, uma só, fora do telemóvel | inspirado em barbearia26dejunho.pt |
| 2026-09-11 | `logo-marca.png` pré-multiplicado (sem alfa) para `mix-blend-mode: screen` | os píxeis transparentes guardavam verde e faziam um retângulo |
| 2026-09-18 | Fotos reais do cliente no banner, "sobre" e produtos; imagens em `contain` | o cliente não quer cortes |
| 2026-09-18 | Sem vídeo no banner; testemunho vai para a página Sobre | o cliente achou que ficava mal no banner |
| 2026-09-18 | Nomes dos produtos corrigidos para os rótulos reais; SKUs mantidos | as fotos reais contradiziam os nomes inventados |
| 2026-10-08 | Serviços passaram de 6 caixas com 6 botões a carta numerada com 1 botão | o cliente achou "infantil"; layout mais profissional |
| 2026-10-08 | Animações de entrada por scroll sem biblioteca | pedido de "motion"; 30 linhas de JS chegam |
| 2026-10-08 | Avaliações ligadas ao Google por Place ID; nota/contagem escritas à mão | credibilidade; não há API gratuita para ler em tempo real |
| 2026-10-08 | Menu "Sobre nós" e página Sobre com o testemunho em vídeo | pedido do cliente |
| 2026-10-08 | Vídeo do testemunho incluído no tema (fallback) além da Media | a secção funciona logo ao instalar |
| 2026-10-08 | Template `page-checkout.html` próprio + `checkout-header` do tema | o template do Woo prende a parte ao tema `woocommerce/woocommerce` |
| 2026-10-08 | Campos do checkout com `!important`; mini-cart fora do cabeçalho do checkout | a folha do Woo ganhava pela ordem; o Woo nunca mostra o mini-cart no checkout |

## 9. Estado atual

- [x] Tema instalado e ativo no staging, WooCommerce instalado, modo "Em breve" desligado, idioma PT e traduções atualizadas
- [x] Homepage completa: hero, serviços, lojas, sobre, shop, reviews, rodapé
- [x] Páginas internas `/servicos`, `/lojas`, `/sobre` (com vídeo testemunho), `/contactos`
- [x] Página Shop (catálogo) com o cartão da marca e adicionar ao carrinho AJAX
- [x] 4 produtos importados do CSV, com as fotos reais e nomes corretos
- [x] Cabeçalho transparente sobre o banner, menu, Marcar, mini-cart, acesso à conta; versão mobile
- [x] Páginas de conta (login/registo) no estilo do site
- [x] Carrinho e checkout na cor da marca, cabeçalho de checkout com emblema, campos escuros legíveis (3.10.0)
- [x] Avaliações com links para o Google; "Ver no mapa" abre a ficha da loja
- [x] Marca de água lateral, animações de scroll
- [x] Checks estáticos e preview sem WordPress; build do zip

## 10. Em curso

- **Tarefa:** afinação do carrinho/checkout (última sessão, 2026-10-08). A versão 3.10.0 foi entregue; falta a
  confirmação do Leonardo de que o campo País/Região ficou escuro depois do upload.
- **Ficheiros envolvidos:** `templates/page-checkout.html`, `parts/checkout-header.html`, secção
  "Carrinho e checkout" no fim de `style.css`.
- **Falta:**
  - Ver o checkout no staging depois do upload da 3.10.0 e corrigir o que sobrar.
  - Configuração no painel do WooCommerce (não é tema, faz o Leonardo — ver Próximos passos 1–3).

## 11. Próximos passos

1. **Pagamentos** (WooCommerce → Definições → Pagamentos): enquanto nenhum estiver ativo o checkout mostra um aviso vermelho.
   Para já: Transferência bancária e/ou "Pagamento na entrega" renomeado "Pagar e levantar na loja".
   Depois: MB Way + Multibanco (Ifthenpay / Easypay / Eupago, com contrato) e cartão (Stripe).
2. **Envio** (WooCommerce → Definições → Envio): zona "Portugal" com Taxa fixa / CTT por peso e Levantamento local.
   Moradas das lojas em Definições → Geral.
3. **Faturação certificada AT** (InvoiceXpress / Vendus / Moloni) — obrigatória para vender em PT.
4. **Newsletter funcional**: o formulário do rodapé (`parts/footer.html`) tem `action="#"` e não grava nada.
   Ligar a um serviço (ex.: MailPoet / Brevo / Mailchimp) mantendo o checkbox RGPD.
5. **Páginas legais**: `/politica-de-privacidade` e `/termos-e-condicoes` estão linkadas no rodapé mas podem não existir.
6. **Versão em inglês** do site — o Leonardo pediu (2026-09-11) e ficou adiado. Avaliar Polylang/TranslatePress vs. multilingue manual.
7. **Fotos reais das lojas** (fachada/interior de Nogueiró e Lamaçães) — os cartões ainda usam imagens geradas por IA.
8. Confirmar com o cliente: **preços dos serviços** e **preços dos produtos**; domínio de produção.
9. Atualizar de vez em quando a nota/contagem do Google em `patterns/reviews.php`.

## 12. Problemas conhecidos / dívida técnica

| Problema | Onde | Prioridade |
|---|---|---|
| Newsletter não funciona (`action="#"`) | `parts/footer.html` | Alta (antes de lançar) |
| Sem método de pagamento nem envio configurados no Woo | painel WP | Alta |
| Links para páginas legais possivelmente inexistentes | rodapé | Alta |
| Montra estática de fallback ainda com os nomes antigos (Óleo para Barba, Champô para Barba, Kit Viagem) | `patterns/shop.php` (`$ras_montra`) | Baixa (só aparece sem produtos) |
| Fotos das lojas ainda geradas por IA | `assets/img/loja-*.jpg` | Média |
| Vídeo de 16 MB dentro do tema e no git → zip de ~18 MB | `assets/video/testemunho.mp4` | Baixa (alternativa: Media do WP) |
| `fotos-originais/LEIA-ME.md` diz que o vídeo não vai no tema — já não é verdade | `fotos-originais/LEIA-ME.md` | Baixa |
| README desatualizado nalguns pontos (menu "Barbearia" é agora "Sobre nós"; produtos 700×700; serviços sem botão por serviço) | `README.md` | Baixa |
| Nota/contagem Google estática | `patterns/reviews.php` | Baixa |
| Altura do cabeçalho fixa em `--ras-header: 134px` | `style.css` | Baixa (mudar se o logo/padding mudar) |
| `tools/import-fotos.ps1` e `make-placeholders.ps1` obsoletos (eram para imagens geradas) | `tools/` | Baixa |
| Preview não mostra WooCommerce real | `tools/preview.php` | Aceite |

## 13. Registo de sessões

| Data | Resumo |
|---|---|
| 2026-09-08 | Recolha de dados públicos da marca (`brand/BRAND.md`), tema inicial a partir do mockup, páginas internas, prompts para Nano Banana, imagens geradas, ícones e rodapé, ligação ao staging, produtos importados, verdes e tipografia revistos, Journal removido, banner a ecrã inteiro com menu transparente ("Enjoy the ride"), mobile, login/registo. |
| 2026-09-11 | Emblema como marca de água lateral fixa (metade à vista, sem retângulo verde, fora do mobile). Versão inglesa pedida e adiada. |
| 2026-09-18 | Fotos e vídeos reais do cliente: banner, "sobre", produtos (`contain`, sem cortes), nomes dos produtos corrigidos, rotina que troca as fotos dos produtos, testemunho em vídeo. |
| 2026-10-08 | Carta de serviços profissional + animações de scroll; avaliações ligadas ao Google; menu e página "Sobre nós" com testemunho; carrinho e checkout na marca (3.8.0 → 3.10.0): template de checkout próprio, campos escuros, país escuro. |
| 2026-10-26 | Criado este `CLAUDE.md` com todo o contexto para continuar noutra conta. |
