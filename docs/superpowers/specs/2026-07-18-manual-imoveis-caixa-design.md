# Design — Página "Manual de Compra dos Imóveis da CAIXA"

**Data:** 2026-07-18
**Rota:** `/manual-imoveis-caixa`

## Objetivo

Criar uma página estática de conteúdo (guia/manual) explicando o processo de compra de
imóveis CAIXA, com CTA de busca de imóveis e um botão flutuante de WhatsApp em imagem
(reutilizável para outras páginas no futuro, com número e mensagem configuráveis).

## Escopo

- Nova rota + view `manual-imoveis-caixa.blade.php`, estendendo `layouts.blog`.
- Novo componente Blade reutilizável para botão flutuante de WhatsApp em imagem.
- Ajuste no layout para permitir que uma página substitua o botão-pílula padrão pelo
  componente de imagem, sem afetar as demais páginas.
- 15 accordions de conteúdo (fornecido pelo usuário) sobre o processo de compra.
- Extração do CSS de accordion (hoje duplicado) para o layout compartilhado.
- Link "Manual de Compra" no rodapé.
- Índice de navegação por âncoras no topo da página, apontando para cada uma das 15 seções.
- Formulário de captação de lead ao final da página, extraído para um partial compartilhado
  e reaproveitado também em `venda-imoveis-caixa.blade.php`.
- JSON-LD `HowTo` na página do Manual, seguindo o padrão seguro (`json_encode` + `array_filter`)
  já usado em `blog/show.blade.php`.
- Link cruzado entre `manual-imoveis-caixa` e `venda-imoveis-caixa` (uma página menciona/linka
  a outra).

Fora de escopo: inclusão de páginas estáticas no `sitemap.xml` (página `venda-imoveis-caixa`
já não está incluída hoje; manter o padrão atual — ajuste futuro separado, se solicitado).

## Rota

```php
Route::get('/manual-imoveis-caixa', fn() => view('manual-imoveis-caixa'))->name('manual.imoveis');
```

Segue o mesmo padrão de closure usado por `/venda-imoveis-caixa` e `/politica-de-privacidade`
em `routes/web.php`.

## Página — `resources/views/manual-imoveis-caixa.blade.php`

- `@extends('layouts.blog')`, com `@section('title', ...)`, `@section('meta_description', ...)`
  e `@section('canonical_url', route('manual.imoveis'))`, seguindo o padrão de
  `venda-imoveis-caixa.blade.php`.
- **Hero:** H1 "Manual de Compra dos Imóveis da CAIXA" + botão "Busca de Imóveis" apontando
  para `https://venda.imoveisdacaixa.com.br/`, `target="_blank" rel="noopener"`.
- **Índice de navegação:** logo após o hero, uma lista/chips com os 15 títulos das seções,
  cada um linkando para o `id` do respectivo `<details>` (ex.: `#manual-1`). Layout simples em
  `flex flex-wrap gap-2`, sem JS — apenas âncoras HTML (`<a href="#manual-1">`).
- **Corpo:** 15 accordions (ver seção "Conteúdo das sanfonas" abaixo), dentro de
  `<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">` como nas outras
  páginas de conteúdo. Cada `<details>` recebe `id="manual-{n}"` para o índice funcionar.
- **Link cruzado:** como uma seção curta logo após as 15 sanfonas e antes do formulário final,
  um bloco de destaque linkando para `route('venda.imoveis')` — "Quer entender por que vale a
  pena comprar um imóvel CAIXA? Veja o Guia Completo de Venda de Imóveis da CAIXA". Em
  `venda-imoveis-caixa.blade.php`, adicionar o link recíproco no mesmo formato, logo antes do
  formulário (seção 8 atual), apontando para `route('manual.imoveis')` — "Já decidiu comprar?
  Veja o Manual de Compra passo a passo".
- **Formulário de captação de lead:** ao final da página (antes do rodapé), reaproveitando o
  partial compartilhado `resources/views/partials/lead-form.blade.php` (ver seção própria
  abaixo).
- **Botão flutuante:** `@section('whatsapp_float')` com `<x-whatsapp-float>` (ver abaixo),
  substituindo o botão-pílula padrão só nesta página.

## Componente reutilizável — `resources/views/components/whatsapp-float.blade.php`

Props: `image`, `phone`, `message`, `alt` (opcional, default `"Atendimento pelo WhatsApp"` caso não informado).

Responsabilidades:
- Monta o link `https://wa.me/{phone}?text={urlencode(message)}`.
- Renderiza `<a>` com a imagem, fixo e centralizado horizontalmente na base da tela
  (`position:fixed; bottom:24px; left:50%; transform:translateX(-50%)`), mesma técnica
  usada hoje no botão-pílula (style inline, não depende de CSS compilado — decisão já
  validada em commit anterior do projeto).
- `target="_blank" rel="noopener"`, `aria-label` com o `alt` fornecido.

Uso na página do Manual:

```blade
<x-whatsapp-float
    image="/images/whatsapp/botao-whatsapp.png"
    phone="5521997882950"
    message="Olá! Gostaria de informações sobre o Manual de Compra dos Imóveis da Caixa."
    alt="Atendimento pelo WhatsApp"
/>
```

Reutilização futura: qualquer página inclui o mesmo componente com `phone`/`message`/`image`
diferentes — sem duplicar HTML/CSS.

### Imagem placeholder

Criar `public/images/whatsapp/botao-whatsapp.png` — ícone de WhatsApp em círculo verde,
placeholder simples até o usuário enviar a imagem definitiva. Trocar o arquivo depois não
exige mudança de código.

## Layout — `resources/views/layouts/blog.blade.php`

Botão-pílula padrão (linhas 184-197 hoje) passa a ser condicional:

```blade
@hasSection('whatsapp_float')
    @yield('whatsapp_float')
@else
    {{-- botão-pílula padrão atual, inalterado --}}
@endif
```

Todas as páginas que não definirem `@section('whatsapp_float')` continuam com o
comportamento atual, sem nenhuma mudança visual ou funcional.

**Rodapé:** adicionar link "Manual de Compra" na `<nav>` de links do rodapé (linha ~157-173),
junto de Inicial / Privacidade / Busca de Imóveis, apontando para `route('manual.imoveis')`.

**CSS de accordion:** mover o bloco `<style>` (chevron, `details[open]`) hoje duplicado em
`@push('head')` de `venda-imoveis-caixa.blade.php` para o `<head>` de `layouts/blog.blade.php`
(uma única vez, compartilhado). Remover a duplicata de `venda-imoveis-caixa.blade.php`. Sem
mudança visual.

## Formulário de captação de lead (compartilhado) — `resources/views/partials/lead-form.blade.php`

Hoje o formulário "Cadastro de Interesse de Compra" existe só em `venda-imoveis-caixa.blade.php`
(linhas 505-575), com heading, texto de declaração e `page_name` fixos. Como o Manual também
precisa desse formulário, e o conteúdo (heading/declarações) muda por página, ele vira um
partial parametrizado via `@include`:

```blade
@include('partials.lead-form', [
    'pageName' => 'Manual de Compra dos Imóveis da CAIXA',
    'heading' => 'Cadastro de Interesse de Compra',
    'subheading' => 'Preencha o formulário e um Corretor Credenciado entrará em contato pelo WhatsApp.',
    'declarations' => [
        'Para compra financiada é preciso aprovação antecipada de crédito',
        'Os imóveis da CAIXA são retomados de acordo com a Lei 9.514 (alienação fiduciária)',
        'Os imóveis só podem ser financiados pela CAIXA e não aceitam carta de consórcio',
    ],
])
```

O partial mantém exatamente os mesmos campos e estrutura do formulário atual (nome, e-mail,
WhatsApp, horário, finalidade, mensagem opcional, `action="{{ route('contato.store') }}"`,
`@csrf`, `<input type="hidden" name="page_name">`). `venda-imoveis-caixa.blade.php` passa a
usar o mesmo partial com seus valores atuais — sem mudança visual nessa página.

## JSON-LD (`HowTo`) — Manual de Compra

No `@push('head')` da página do Manual, seguindo o padrão já usado em `blog/show.blade.php`
(sem `@if`/lógica condicional dentro da tag `<script>` — só `json_encode` de um array PHP
montado antes):

```blade
@php
$howToSteps = collect($manual)->map(fn($item) => [
    '@type' => 'HowToStep',
    'name'  => $item['titulo'],
    'url'   => route('manual.imoveis') . '#manual-' . $item['id'],
])->all();
@endphp
<script type="application/ld+json">
{!! json_encode(array_filter([
    '@context'    => 'https://schema.org',
    '@type'       => 'HowTo',
    'name'        => 'Manual de Compra dos Imóveis da CAIXA',
    'description' => 'Passo a passo completo para comprar um imóvel da CAIXA: portal, modalidades de venda, proposta, pagamento e desocupação.',
    'step'        => $howToSteps,
]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush
```

## Conteúdo das sanfonas

Fonte: texto completo fornecido pelo usuário ("Manual de Compra de Imóveis CAIXA — Estrutura
para Sanfonas"), 15 seções numeradas. Cada seção vira um `<details id="manual-{id}">` no
estilo já usado no bloco "Guia Completo" de `venda-imoveis-caixa.blade.php` (badge numerado
`01`...`15` + título + chevron), com conteúdo em um array PHP associativo, para servir tanto
o `@foreach` de renderização quanto o índice de âncoras e o JSON-LD `HowTo`:

```php
$manual = [
    ['id' => 1, 'titulo' => 'O Portal de Venda de Imóveis CAIXA', 'html' => '...'],
    // ... até id 15
];
```

Regras de formatação por seção:

1. **Seção 2 (Modalidades de Venda)** — as 5 sub-modalidades (1º Leilão SFI, 2º Leilão SFI,
   Licitação Aberta, Venda Online, Compra Direta) são renderizadas como grade de
   rótulo:valor (Lei / Valor de venda / Comissão / Onde comprar / Prazo, quando aplicável),
   reaproveitando o padrão visual já usado na seção "Modalidades de Venda" de
   `venda-imoveis-caixa.blade.php` — porém todas dentro de **um único** accordion (não 5
   accordions separados), para não fragmentar demais a navegação.
2. **Seções com subtópicos nomeados** (ex.: seção 4 "Cadastro e Envio da Proposta" com
   "Antes de começar", "Login/Cadastro no ambiente CAIXA", "Passos da proposta"; seção 7
   "Próximos Passos Após a Compra" com "À vista"/"Financiamento e uso de FGTS"; seção 10
   "Formas de Pagamento Aceitas" com 3 subtópicos) — cada subtópico vira um `<h4>` dentro do
   corpo do accordion, seguido de lista (`<ul>`/`<ol>`) ou parágrafo. Sem aninhar
   accordion dentro de accordion.
3. **Avisos de atenção (⚠️) e confirmações (✅/⏰)** mantêm o estilo de caixinha colorida já
   usado no restante do site (ex.: `bg-yellow-50 border-yellow-200` para atenção,
   `bg-green-50` para confirmações), consistente com `venda-imoveis-caixa.blade.php`.
4. Demais seções (1, 3, 5, 6, 8, 9, 11, 12, 13, 14, 15) são accordions simples com listas e
   parágrafos, seguindo o conteúdo exatamente como fornecido pelo usuário, sem resumir ou
   reescrever o texto.

Lista das 15 seções (`id` / título de cada accordion — mesmo `id` usado no `<details id="manual-{id}">`, no índice de âncoras `#manual-{id}` e no `url` de cada `HowToStep`):

1. O Portal de Venda de Imóveis CAIXA
2. Modalidades de Venda
3. Como Encontrar Seu Imóvel
4. Cadastro e Envio da Proposta
5. Consultando Suas Propostas
6. Alterando Sua Proposta
7. Próximos Passos Após a Compra
8. Visita e Situação do Imóvel
9. Desocupação do Imóvel
10. Formas de Pagamento Aceitas
11. Financiamento Imobiliário — Requisitos e Documentos
12. Despesas de Compra
13. Regras de Despesas de Condomínio
14. Despesas de Tributos e IPTU
15. Prazos Importantes (Resumo)

## Fora de escopo / decisões explícitas

- Não inclui a página no `sitemap.xml` (padrão atual não inclui páginas estáticas como
  `venda-imoveis-caixa`).
- Não adiciona a página ao menu principal do header (só ao rodapé) — pode ser revisitado
  depois se o usuário quiser mais destaque.
- Não cria um sistema de configuração central (`config/whatsapp.php`) para múltiplos números
  de WhatsApp — cada uso do componente recebe `phone`/`message` diretamente via props. Se o
  número de páginas usando o componente crescer muito, uma camada de config pode ser
  adicionada depois (YAGNI por ora).
