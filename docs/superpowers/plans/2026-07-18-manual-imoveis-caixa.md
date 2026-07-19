# Manual de Compra dos Imóveis da CAIXA — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Ship a new page at `/manual-imoveis-caixa` with a hero + "Busca de Imóveis" CTA, a reusable image-based floating WhatsApp button, 15 content accordions, an anchor index, a shared lead-capture form, a `HowTo` JSON-LD block, and cross-links with `/venda-imoveis-caixa`.

**Architecture:** Laravel 13 + Blade, following the codebase's existing conventions exactly: closure routes in `routes/web.php`, pages that `@extends('layouts.blog')`, content held in PHP arrays inside `@php` blocks and rendered via `@foreach` into `<details>` accordions (same pattern as `venda-imoveis-caixa.blade.php`). Two small pieces of shared logic (the floating WhatsApp button and the lead-capture form) are extracted into an anonymous Blade component and a partial, respectively, since they'll now be used by 2+ pages. No JS, no new dependencies, no database changes.

**Tech Stack:** PHP 8.4, Laravel 13, Blade, TailwindCSS (no new build step — all classes used already exist in the compiled Tailwind output because they're reused from `venda-imoveis-caixa.blade.php`), PHPUnit (Laravel's default `php artisan test`), SQLite in-memory for tests.

## Global Constraints

- Route path: `/manual-imoveis-caixa`, route name: `manual.imoveis`.
- Page title/H1: "Manual de Compra dos Imóveis da CAIXA".
- "Busca de Imóveis" button links to `https://venda.imoveisdacaixa.com.br/` (note trailing slash — copy exactly), `target="_blank" rel="noopener"`.
- WhatsApp number for the floating button on this page: `5521997882950`.
- WhatsApp message for the floating button on this page: `Olá! Gostaria de informações sobre o Manual de Compra dos Imóveis da Caixa.`
- Brand colors already defined in Tailwind config: `caixa-blue` `#0072C6`, `caixa-blue-dark` `#005BA0`, `caixa-orange` `#F7941E`. Reuse these tokens, never hardcode new hex values in new markup.
- Do not modify `resources/css/app.css` or run `npm run build` — every Tailwind class used in this plan already exists in the project's compiled output because it's copied from `venda-imoveis-caixa.blade.php`.
- All 15 accordion sections must use the content exactly as specified below — do not summarize, shorten, or paraphrase.
- Every task that touches a page extending `layouts.blog` needs `RefreshDatabase` in its test (the layout's view composer queries the `categories` table).

---

### Task 1: Route + minimal page (hero only)

**Files:**
- Modify: `routes/web.php`
- Create: `resources/views/manual-imoveis-caixa.blade.php`
- Create: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Produces: route `manual.imoveis` → `/manual-imoveis-caixa`; view file with `@section('content')` block that later tasks will extend in place.

- [ ] **Step 1: Write the failing test**

Create `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManualImoveisCaixaPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_manual_page_loads_successfully(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertStatus(200);
        $response->assertSee('Manual de Compra dos Imóveis da CAIXA');
    }

    public function test_manual_route_name_resolves_to_expected_path(): void
    {
        $this->assertSame('/manual-imoveis-caixa', route('manual.imoveis', [], false));
    }

    public function test_manual_page_has_busca_de_imoveis_button(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('https://venda.imoveisdacaixa.com.br/', false);
        $response->assertSee('Busca de Imóveis');
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL — route `/manual-imoveis-caixa` does not exist (404), so `assertStatus(200)` fails. `route('manual.imoveis', ...)` throws `RouteNotFoundException`.

- [ ] **Step 3: Add the route**

In `routes/web.php`, modify:

```php
Route::get('/venda-imoveis-caixa', fn() => view('venda-imoveis-caixa'))->name('venda.imoveis');
Route::get('/politica-de-privacidade', fn() => view('politica-de-privacidade'))->name('privacidade');
```

to:

```php
Route::get('/venda-imoveis-caixa', fn() => view('venda-imoveis-caixa'))->name('venda.imoveis');
Route::get('/manual-imoveis-caixa', fn() => view('manual-imoveis-caixa'))->name('manual.imoveis');
Route::get('/politica-de-privacidade', fn() => view('politica-de-privacidade'))->name('privacidade');
```

- [ ] **Step 4: Create the minimal page**

Create `resources/views/manual-imoveis-caixa.blade.php`:

```blade
@extends('layouts.blog')

@section('title', 'Manual de Compra dos Imóveis da CAIXA | Imóveis da Caixa')
@section('meta_description', 'Manual completo e passo a passo para comprar um imóvel da CAIXA: portal, modalidades de venda, proposta, pagamento, desocupação e prazos.')
@section('canonical_url', route('manual.imoveis'))

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-caixa-blue via-caixa-blue-dark to-blue-900 py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-xs font-bold uppercase tracking-widest text-amber-300 mb-4">Guia Oficial</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight mb-6">
            Manual de Compra dos Imóveis da <span class="text-caixa-orange">CAIXA</span>
        </h1>
        <a href="https://venda.imoveisdacaixa.com.br/"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 bg-caixa-orange hover:bg-orange-600 text-white font-bold text-lg px-8 py-4 rounded-xl transition-colors">
            Busca de Imóveis →
        </a>
    </div>
</section>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">

</div>

@endsection
```

- [ ] **Step 5: Run test to verify it passes**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (3 tests, 3 assertions or more)

- [ ] **Step 6: Commit**

```bash
git add routes/web.php resources/views/manual-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona rota e página inicial do Manual de Compra dos Imóveis da CAIXA"
```

---

### Task 2: Reusable WhatsApp floating image button

**Files:**
- Create: `resources/views/components/whatsapp-float.blade.php`
- Create: `public/images/whatsapp/botao-whatsapp.svg`
- Modify: `resources/views/layouts/blog.blade.php:184-197`
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Create: `tests/Feature/VendaImoveisCaixaPageTest.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Produces: Blade component `<x-whatsapp-float :image :phone :message :alt="'...'" />` — `alt` optional, defaults to `"Atendimento pelo WhatsApp"`. Renders an `<a href="https://wa.me/{phone}?text={urlencoded message}">` containing an `<img>`, fixed and centered at the bottom of the viewport.
- Produces: `@section('whatsapp_float')` override point in `layouts.blog` — any page defining this section replaces the default pill button; pages that don't define it keep current behavior unchanged.
- Consumes: nothing new.

- [ ] **Step 1: Write the failing tests**

Create `tests/Feature/VendaImoveisCaixaPageTest.php` (this page had no test coverage before — this test locks in its current behavior as a regression guard for the refactors in this and later tasks):

```php
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendaImoveisCaixaPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_venda_imoveis_page_loads_successfully(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertStatus(200);
    }

    public function test_venda_imoveis_page_keeps_default_whatsapp_pill_button(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('Atendimento Rápido');
        $response->assertSee('wa.me/5521997882950', false);
    }
}
```

Append to `tests/Feature/ManualImoveisCaixaPageTest.php` (inside the class, after the existing methods):

```php
    public function test_manual_page_uses_image_whatsapp_button_not_default_pill(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertDontSee('Atendimento Rápido');
        $response->assertSee('botao-whatsapp.svg', false);
        $response->assertSee('wa.me/5521997882950', false);
    }
```

- [ ] **Step 2: Run tests to verify they fail**

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (this one should already pass — it's the regression baseline, confirming current behavior before you touch anything)

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_uses_image_whatsapp_button_not_default_pill` — the manual page currently shows the default pill ("Atendimento Rápido" is present, `botao-whatsapp.svg` is not).

- [ ] **Step 3: Create the placeholder image**

Create `public/images/whatsapp/botao-whatsapp.svg`:

```svg
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64" role="img" aria-label="Ícone do WhatsApp">
    <circle cx="32" cy="32" r="32" fill="#25D366"/>
    <path fill="#ffffff" transform="translate(15,15) scale(0.72)" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
</svg>
```

> This is a placeholder (WhatsApp glyph on a green circle, reusing the exact icon path already used by the pill button in `layouts/blog.blade.php`) so the page never renders a broken image. Swap this file for the final artwork later — the component and its usages don't need to change, only the file content (keep the same filename, or update the `image` prop if the final file uses a different name/extension).

- [ ] **Step 4: Create the whatsapp-float component**

Create `resources/views/components/whatsapp-float.blade.php`:

```blade
@props([
    'image',
    'phone',
    'message',
    'alt' => 'Atendimento pelo WhatsApp',
])

<a href="https://wa.me/{{ $phone }}?text={{ urlencode($message) }}"
   target="_blank"
   rel="noopener"
   aria-label="{{ $alt }}"
   class="z-50"
   style="position:fixed; bottom:24px; left:50%; transform:translateX(-50%);">
    <img src="{{ asset($image) }}"
         alt="{{ $alt }}"
         width="72" height="72"
         class="w-16 h-16 sm:w-[72px] sm:h-[72px]"
         style="filter: drop-shadow(0 4px 14px rgba(0,0,0,0.35));">
</a>
```

- [ ] **Step 5: Make the layout's floating button overridable**

In `resources/views/layouts/blog.blade.php`, modify (lines 184-197):

```blade
    {{-- Botão flutuante WhatsApp --}}
    <a href="https://wa.me/5521997882950?text=Ol%C3%A1%2C%20vim%20pelo%20site%20Im%C3%B3veis%20da%20Caixa%20e%20gostaria%20de%20atendimento."
       target="_blank" rel="noopener"
       aria-label="Atendimento pelo WhatsApp"
       class="z-50 flex items-center gap-3 text-white font-bold px-6 py-3 rounded-full transition-all duration-300"
       style="position:fixed; bottom:24px; left:50%; transform:translateX(-50%); background:#25D366; box-shadow:0 4px 24px rgba(37,211,102,0.5); white-space:nowrap;">
        <svg class="w-7 h-7 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        <div class="leading-tight">
            <div class="text-sm font-extrabold tracking-wide">Atendimento Rápido</div>
            <div class="text-xs font-semibold opacity-90">Clique Aqui</div>
        </div>
    </a>
```

to:

```blade
    {{-- Botão flutuante WhatsApp --}}
    @hasSection('whatsapp_float')
        @yield('whatsapp_float')
    @else
    <a href="https://wa.me/5521997882950?text=Ol%C3%A1%2C%20vim%20pelo%20site%20Im%C3%B3veis%20da%20Caixa%20e%20gostaria%20de%20atendimento."
       target="_blank" rel="noopener"
       aria-label="Atendimento pelo WhatsApp"
       class="z-50 flex items-center gap-3 text-white font-bold px-6 py-3 rounded-full transition-all duration-300"
       style="position:fixed; bottom:24px; left:50%; transform:translateX(-50%); background:#25D366; box-shadow:0 4px 24px rgba(37,211,102,0.5); white-space:nowrap;">
        <svg class="w-7 h-7 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        <div class="leading-tight">
            <div class="text-sm font-extrabold tracking-wide">Atendimento Rápido</div>
            <div class="text-xs font-semibold opacity-90">Clique Aqui</div>
        </div>
    </a>
    @endif
```

- [ ] **Step 6: Use the component on the manual page**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
@section('canonical_url', route('manual.imoveis'))

@section('content')
```

to:

```blade
@section('canonical_url', route('manual.imoveis'))

@section('whatsapp_float')
<x-whatsapp-float
    image="images/whatsapp/botao-whatsapp.svg"
    phone="5521997882950"
    message="Olá! Gostaria de informações sobre o Manual de Compra dos Imóveis da Caixa."
/>
@endsection

@section('content')
```

- [ ] **Step 7: Run tests to verify they pass**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (4 tests)

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (2 tests — confirms the layout change didn't break the default pill button on other pages)

- [ ] **Step 8: Commit**

```bash
git add resources/views/components/whatsapp-float.blade.php public/images/whatsapp/botao-whatsapp.svg resources/views/layouts/blog.blade.php resources/views/manual-imoveis-caixa.blade.php tests/Feature/VendaImoveisCaixaPageTest.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona componente reutilizável de botão flutuante de WhatsApp em imagem"
```

---

### Task 3: Shared accordion CSS

**Files:**
- Modify: `resources/views/layouts/blog.blade.php`
- Modify: `resources/views/venda-imoveis-caixa.blade.php:7-15`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`
- Modify: `tests/Feature/VendaImoveisCaixaPageTest.php`

**Interfaces:** none (pure CSS relocation, no new names).

- [ ] **Step 1: Write the failing test**

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_has_accordion_chevron_css(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('details[open] .chevron', false);
    }
```

Append to `tests/Feature/VendaImoveisCaixaPageTest.php`:

```php
    public function test_venda_imoveis_page_has_accordion_css_exactly_once(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $this->assertSame(1, substr_count($response->getContent(), 'details[open] .chevron'));
    }
```

- [ ] **Step 2: Run tests to verify the new one fails**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_has_accordion_chevron_css` — the manual page doesn't define or inherit this CSS yet.

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (the CSS is already present exactly once, just not shared yet)

- [ ] **Step 3: Move the CSS into the shared layout**

In `resources/views/layouts/blog.blade.php`, modify:

```blade
    @stack('head')

    {{-- Google Fonts: Inter (async — não bloqueia renderização) --}}
```

to:

```blade
    @stack('head')

    {{-- Estilos compartilhados de sanfonas (accordions) --}}
    <style>
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .chevron { transform: rotate(180deg); }
        .chevron { transition: transform .25s ease; }
        details[open] summary .summary-icon { background-color: #0072C6; color: #fff; }
    </style>

    {{-- Google Fonts: Inter (async — não bloqueia renderização) --}}
```

- [ ] **Step 4: Remove the duplicate from venda-imoveis-caixa.blade.php**

In `resources/views/venda-imoveis-caixa.blade.php`, modify:

```blade
@section('canonical_url', route('venda.imoveis'))

@push('head')
<style>
    details > summary { list-style: none; }
    details > summary::-webkit-details-marker { display: none; }
    details[open] .chevron { transform: rotate(180deg); }
    .chevron { transition: transform .25s ease; }
    details[open] summary .summary-icon { background-color: #0072C6; color: #fff; }
</style>
@endpush

@section('content')
```

to:

```blade
@section('canonical_url', route('venda.imoveis'))

@section('content')
```

- [ ] **Step 5: Run tests to verify they pass**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (5 tests)

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (3 tests — still exactly once, now sourced from the layout)

- [ ] **Step 6: Commit**

```bash
git add resources/views/layouts/blog.blade.php resources/views/venda-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php tests/Feature/VendaImoveisCaixaPageTest.php
git commit -m "refactor: compartilha CSS de sanfonas entre venda-imoveis-caixa e o layout"
```

---

### Task 4: Content — sections 1 to 5

**Files:**
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Produces: `$manual` array (list of `['id' => int, 'titulo' => string, 'html' => string]`), used by this and later tasks (index nav, remaining sections, JSON-LD). At the end of this task it has 5 entries (id 1-5).

- [ ] **Step 1: Write the failing test**

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_renders_first_five_sections(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $response->assertSee('id="manual-1"', false);
        $response->assertSee('O Portal de Venda de Imóveis CAIXA');
        $response->assertSee('Modalidades de Venda');
        $response->assertSee('Como Encontrar Seu Imóvel');
        $response->assertSee('Cadastro e Envio da Proposta');
        $response->assertSee('Consultando Suas Propostas');
        $this->assertSame(5, substr_count($content, '<details id="manual-'));
        $this->assertSame(5, substr_count($content, 'href="#manual-'));
    }
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_renders_first_five_sections` — no accordions exist yet.

- [ ] **Step 3: Add the index nav placeholder and the first 5 sections**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">

</div>
```

to:

```blade
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-14">

    @php
    $manual = [
        [
            'id' => 1,
            'titulo' => 'O Portal de Venda de Imóveis CAIXA',
            'html' => '
                <p>Acesse em <a href="https://www.caixa.gov.br/imoveiscaixa" target="_blank" rel="noopener" class="text-caixa-blue underline">www.caixa.gov.br/imoveiscaixa</a>. Pelo portal você pode:</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li><strong>Encontrar seu imóvel</strong> — busca por UF, cidade, bairro e características.</li>
                    <li><strong>Efetuar cadastro</strong> — reunir propostas e imóveis favoritos.</li>
                    <li><strong>Fazer uma proposta</strong> — nas modalidades disponíveis.</li>
                    <li><strong>Acessar Editais de Leilão</strong> — para imóveis em Licitação Aberta e/ou 1º e 2º Leilão.</li>
                    <li><strong>Efetuar o pagamento</strong> — conforme condições vigentes.</li>
                </ul>
            ',
        ],
        [
            'id' => 2,
            'titulo' => 'Modalidades de Venda',
            'html' => '
                <div class="space-y-4">
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">1º Leilão SFI</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 9.514/97, art. 27</div>
                            <div><strong>Valor de venda:</strong> valor da garantia atualizada ou avaliação da prefeitura (o maior)</div>
                            <div><strong>Comissão:</strong> 5%, paga pelo arrematante diretamente ao leiloeiro (não compõe o lance)</div>
                            <div><strong>Onde comprar:</strong> site do leiloeiro (conforme edital)</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">2º Leilão SFI</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 9.514/97, art. 27</div>
                            <div><strong>Valor de venda:</strong> total da dívida do contrato + despesas de consolidação</div>
                            <div><strong>Comissão:</strong> 5%, paga ao leiloeiro (não compõe o lance)</div>
                            <div><strong>Onde comprar:</strong> site do leiloeiro</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">Licitação Aberta</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 13.303/2017, art. 28, §3º</div>
                            <div><strong>Valor de venda:</strong> desconto sobre o valor de avaliação atual</div>
                            <div><strong>Comissão:</strong> 5%, paga ao leiloeiro (não compõe o lance)</div>
                            <div><strong>Onde comprar:</strong> site do leiloeiro</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">Venda Online (com cronômetro)</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 13.303/2017, art. 28, §3º</div>
                            <div><strong>Valor de venda:</strong> desconto sobre a avaliação atual</div>
                            <div><strong>Prazo:</strong> verificar no anúncio — vence a maior proposta quando o cronômetro chega a zero</div>
                            <div><strong>Onde comprar:</strong> site da CAIXA</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> intermediação/assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                    <div class="border border-border rounded-lg p-4">
                        <p class="font-semibold text-text-primary mb-2">Compra Direta (sem cronômetro)</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><strong>Lei:</strong> 13.303/2017, art. 28, §3º</div>
                            <div><strong>Valor de venda:</strong> desconto sobre a avaliação atual</div>
                            <div><strong>Prazo:</strong> D+0 — vence a primeira proposta igual ou maior que o valor mínimo</div>
                            <div><strong>Onde comprar:</strong> site da CAIXA</div>
                            <div class="sm:col-span-2"><strong>Comodidade:</strong> intermediação/assessoramento de imobiliária pago pela CAIXA</div>
                        </div>
                    </div>
                </div>
            ',
        ],
        [
            'id' => 3,
            'titulo' => 'Como Encontrar Seu Imóvel',
            'html' => '
                <ol class="list-decimal list-inside space-y-2">
                    <li>Clique em "Busque seu imóvel".</li>
                    <li>Selecione estado e cidade (e, se quiser, bairro e modalidade).</li>
                    <li>Os campos de características não são obrigatórios — use-os para refinar a busca.</li>
                    <li>Nos resultados você verá as modalidades: 1º Leilão SFI, 2º Leilão SFI, Compra Direta, Venda Online e Licitação Aberta.</li>
                </ol>
            ',
        ],
        [
            'id' => 4,
            'titulo' => 'Cadastro e Envio da Proposta',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Antes de começar</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Clique em "Fazer uma proposta" para iniciar o cadastro (pessoa física ou jurídica).</li>
                    <li>Após finalizar o cadastro, você volta automaticamente para a proposta do imóvel selecionado.</li>
                    <li>Formas de pagamento possíveis: à vista, financiamento e uso de FGTS (a depender do imóvel).</li>
                </ul>
                <p class="mt-3 text-sm bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-2 rounded-lg">⚠️ <strong>Atenção:</strong> no financiamento, o crédito imobiliário deve estar aprovado antes do registro da proposta. Para usar FGTS, consulte previamente uma agência CAIXA ou correspondente autorizado.</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Login / Cadastro no ambiente CAIXA</h4>
                <p>Faça login ou crie um novo cadastro. Isso garante:</p>
                <ul class="list-disc list-inside space-y-1 mt-2">
                    <li>Praticidade e segurança</li>
                    <li>Proteção de dados</li>
                    <li>Acompanhamento de disputas</li>
                </ul>
                <p class="mt-2">Nesta etapa, só são obrigatórios os campos marcados com asterisco (*).</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Passos da proposta</h4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Dados do proponente ou representante.</li>
                    <li>Agência de relacionamento e corretor credenciado que intermediou a venda. A intermediação da imobiliária é custeada pela CAIXA. Os corretores ajudam na obtenção de documentos, guias de pagamento, contato com síndico, apoio na desocupação e registro em cartório.</li>
                    <li>Forma de pagamento — campos habilitados conforme as condições do imóvel. O CCA só é liberado se houver valor de financiamento.</li>
                    <li>Dados bancários — para eventual ressarcimento de valores pela CAIXA.</li>
                    <li>Assessoramento da venda (CRECI) — obrigatório se não informado antes. Escolha entre:
                        <ul class="list-disc list-inside mt-1 ml-4 space-y-1">
                            <li><strong>Digital:</strong> escrituração e registro totalmente eletrônicos, sem documentos físicos.</li>
                            <li><strong>Convencional:</strong> todas as imobiliárias habilitadas, independente da forma de escrituração.</li>
                        </ul>
                    </li>
                    <li>Declarações — aceite as condições e clique em "Gravar proposta".</li>
                </ol>
            ',
        ],
        [
            'id' => 5,
            'titulo' => 'Consultando Suas Propostas',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Venda Online (cronômetro ativo):</strong> consulte em "Minhas disputas".</li>
                    <li><strong>Compra Direta e propostas homologadas:</strong> aparecem em "Meus Resultados" → aba "Em andamento".</li>
                    <li><strong>Imóveis pagos e registrados:</strong> ficam em "Meus Imóveis".</li>
                    <li>É possível cancelar a proposta após homologação e antes do pagamento do boleto — ação irreversível.</li>
                    <li>Nesses menus também dá para imprimir a proposta e a matrícula do imóvel.</li>
                </ul>
                <p class="mt-3 text-sm bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded-lg">⏰ <strong>Prazo do boleto:</strong> validade de 2 dias úteis — deve ser impresso e pago para iniciar a contratação.</p>
            ',
        ],
    ];
    @endphp

    {{-- ── ÍNDICE DE NAVEGAÇÃO ──────────────────────────────── --}}
    <nav class="flex flex-wrap gap-2" aria-label="Índice do manual">
        @foreach($manual as $item)
        <a href="#manual-{{ $item['id'] }}" class="text-xs sm:text-sm font-medium text-caixa-blue bg-caixa-blue/5 border border-caixa-blue/20 rounded-full px-3 py-1.5 hover:bg-caixa-blue/10 transition-colors">
            {{ $item['id'] }}. {{ $item['titulo'] }}
        </a>
        @endforeach
    </nav>

    {{-- ── SANFONAS DO MANUAL ───────────────────────────────── --}}
    <div class="space-y-3">
        @foreach($manual as $item)
        <details id="manual-{{ $item['id'] }}" class="bg-surface border border-border rounded-xl overflow-hidden">
            <summary class="flex items-center gap-4 px-5 py-4 cursor-pointer select-none hover:bg-surface-muted transition-colors">
                <span class="summary-icon w-9 h-9 rounded-lg bg-caixa-blue/10 text-caixa-blue font-black text-sm flex items-center justify-center flex-shrink-0 transition-colors">{{ str_pad($item['id'], 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-semibold text-text-primary flex-1">{{ $item['titulo'] }}</span>
                <svg class="chevron w-5 h-5 text-caixa-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </summary>
            <div class="px-5 pb-5 pt-1 text-text-secondary leading-relaxed prose prose-sm max-w-none">
                {!! $item['html'] !!}
            </div>
        </details>
        @endforeach
    </div>

</div>
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (6 tests)

- [ ] **Step 5: Commit**

```bash
git add resources/views/manual-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona índice de navegação e seções 1-5 do Manual de Compra"
```

---

### Task 5: Content — sections 6 to 10

**Files:**
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Consumes: `$manual` array from Task 4.
- Produces: `$manual` extended to 10 entries (id 1-10).

- [ ] **Step 1: Write the failing test**

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_renders_sections_six_to_ten(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $response->assertSee('id="manual-10"', false);
        $response->assertSee('Alterando Sua Proposta');
        $response->assertSee('Próximos Passos Após a Compra');
        $response->assertSee('Visita e Situação do Imóvel');
        $response->assertSee('Desocupação do Imóvel');
        $response->assertSee('Formas de Pagamento Aceitas');
        $this->assertSame(10, substr_count($content, '<details id="manual-'));
        $this->assertSame(10, substr_count($content, 'href="#manual-'));
    }
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_renders_sections_six_to_ten` — only 5 sections exist so far.

- [ ] **Step 3: Append sections 6-10 to the `$manual` array**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
        [
            'id' => 5,
            'titulo' => 'Consultando Suas Propostas',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Venda Online (cronômetro ativo):</strong> consulte em "Minhas disputas".</li>
                    <li><strong>Compra Direta e propostas homologadas:</strong> aparecem em "Meus Resultados" → aba "Em andamento".</li>
                    <li><strong>Imóveis pagos e registrados:</strong> ficam em "Meus Imóveis".</li>
                    <li>É possível cancelar a proposta após homologação e antes do pagamento do boleto — ação irreversível.</li>
                    <li>Nesses menus também dá para imprimir a proposta e a matrícula do imóvel.</li>
                </ul>
                <p class="mt-3 text-sm bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded-lg">⏰ <strong>Prazo do boleto:</strong> validade de 2 dias úteis — deve ser impresso e pago para iniciar a contratação.</p>
            ',
        ],
    ];
    @endphp
```

to:

```blade
        [
            'id' => 5,
            'titulo' => 'Consultando Suas Propostas',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Venda Online (cronômetro ativo):</strong> consulte em "Minhas disputas".</li>
                    <li><strong>Compra Direta e propostas homologadas:</strong> aparecem em "Meus Resultados" → aba "Em andamento".</li>
                    <li><strong>Imóveis pagos e registrados:</strong> ficam em "Meus Imóveis".</li>
                    <li>É possível cancelar a proposta após homologação e antes do pagamento do boleto — ação irreversível.</li>
                    <li>Nesses menus também dá para imprimir a proposta e a matrícula do imóvel.</li>
                </ul>
                <p class="mt-3 text-sm bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded-lg">⏰ <strong>Prazo do boleto:</strong> validade de 2 dias úteis — deve ser impresso e pago para iniciar a contratação.</p>
            ',
        ],
        [
            'id' => 6,
            'titulo' => 'Alterando Sua Proposta',
            'html' => '
                <p>Em "Meus Resultados" é possível alterar composição de valores, participantes e agência de contratação.</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li>Campos de Financiamento/FGTS só são liberados se o imóvel aceitar.</li>
                    <li><strong>Passo 2 — Proponentes:</strong> incluir/excluir participantes (só cadastrados no ambiente CAIXA). Pode-se mudar para Pessoa Jurídica se a empresa estiver cadastrada e o proponente constar como sócio na Receita Federal. O proponente principal não pode ser excluído.</li>
                    <li><strong>Passo 4 — Valores:</strong> a composição pode mudar, mas não o valor global da proposta.</li>
                    <li>Pode-se alterar a agência de contratação.</li>
                </ul>
                <div class="mt-3 text-sm bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                    <strong>⚠️ Atenção:</strong>
                    <ul class="list-disc list-inside mt-1 space-y-1">
                        <li>Em Leilão, não é possível alterar, incluir ou excluir proponentes — todos devem ser informados no ato da arrematação.</li>
                        <li>A alteração da proposta não prorroga o prazo de pagamento. Fique atento à validade do boleto.</li>
                    </ul>
                </div>
            ',
        ],
        [
            'id' => 7,
            'titulo' => 'Próximos Passos Após a Compra',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">À vista</h4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Pagar o boleto em até 2 dias úteis.</li>
                    <li>Ir à agência CAIXA escolhida para retirar documentos da Escritura.</li>
                    <li>Registrar a transferência em Cartório e trocar a titularidade junto à Prefeitura.</li>
                </ol>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Financiamento e uso de FGTS</h4>
                <ol class="list-decimal list-inside space-y-2">
                    <li>Pagar o boleto em até 2 dias úteis.</li>
                    <li>Levar ao Correspondente CAIXA (CCA) ou agência os documentos:
                        <ul class="list-disc list-inside mt-1 ml-4 space-y-1">
                            <li>Proposta e boleto impressos + comprovante de pagamento</li>
                            <li>Documento de identificação</li>
                            <li>Comprovante de residência</li>
                            <li>Comprovante de estado civil e regime de bens</li>
                            <li>Comprovante de renda atualizado (últimos 2 meses)</li>
                            <li>Declaração de Imposto de Renda</li>
                            <li>Simulação da operação</li>
                            <li>Documentos complementares solicitados</li>
                        </ul>
                    </li>
                    <li>Com o crédito aprovado e/ou FGTS liberado, assina-se o contrato.</li>
                    <li>Registrar o contrato em Cartório e trocar a titularidade junto à Prefeitura.</li>
                </ol>
            ',
        ],
        [
            'id' => 8,
            'titulo' => 'Visita e Situação do Imóvel',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li>Não há como saber previamente se o imóvel está ocupado. Na maioria dos casos, o ocupante desocupa sem problemas após notificação.</li>
                    <li>Você pode ir ao local sondar a situação, mas a CAIXA não autoriza a entrada no imóvel antes da compra.</li>
                    <li>Vale conhecer a região — uma alternativa prática é usar o Google Maps para uma visão ampla.</li>
                    <li>A desocupação só pode começar após o registro do imóvel e a baixa da compra, seguindo as regras da lei.</li>
                </ul>
            ',
        ],
        [
            'id' => 9,
            'titulo' => 'Desocupação do Imóvel',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li>Estar ocupado não é impedimento — há muitos casos de desocupação amigável.</li>
                    <li>Em leilão extrajudicial, o processo comum é:
                        <ol class="list-decimal list-inside mt-1 ml-4 space-y-1">
                            <li>Tentar acordo amigável via notificação extrajudicial.</li>
                            <li>Se não houver saída, ingressar com ação de imissão na posse.</li>
                        </ol>
                    </li>
                    <li>A lei garante ao arrematante o direito à imissão judicial, com possível liminar de desocupação em 60 dias, desde que a consolidação da propriedade esteja comprovada e o imóvel registrado em nome do arrematante.</li>
                </ul>
            ',
        ],
        [
            'id' => 10,
            'titulo' => 'Formas de Pagamento Aceitas',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Recursos próprios</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Boleto gerado automaticamente, a pagar em até 3 dias.</li>
                    <li>Disponível para download no sistema da CAIXA (também enviamos pelo WhatsApp).</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Uso de FGTS</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Faça análise prévia do valor disponível para saque e informe o valor na proposta.</li>
                    <li>É preciso já saber seu enquadramento e o valor liberado para compra.</li>
                    <li>Mesmo com FGTS maior que o preço, é obrigatório pagar no mínimo 5% em dinheiro (boleto); até 95% pode ser FGTS.</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Financiamento SBPE</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Só aparece na ficha se o imóvel aceitar financiamento.</li>
                    <li>Só faça proposta se não tiver pendências de crédito.</li>
                    <li>Faça análise prévia de aprovação de crédito antes da proposta (orientação da CAIXA).</li>
                    <li>Informe o valor de entrada (mínimo 5%) + saldo financiado.</li>
                    <li>Se financiamento + 5% não atingir o valor de compra, aumente a entrada até igualar o valor de venda.</li>
                    <li>Se a opção não aparece na ficha, o imóvel não permite financiamento — não há filtro de busca para isso, então continue procurando outro que informe aceitar financiamento.</li>
                </ul>
            ',
        ],
    ];
    @endphp
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (7 tests)

- [ ] **Step 5: Commit**

```bash
git add resources/views/manual-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona seções 6-10 do Manual de Compra"
```

---

### Task 6: Content — sections 11 to 15

**Files:**
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Consumes: `$manual` array from Task 5.
- Produces: `$manual` complete with all 15 entries (id 1-15) — this is the final shape later tasks (JSON-LD) rely on.

- [ ] **Step 1: Write the failing test**

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_renders_all_fifteen_sections(): void
    {
        $response = $this->get('/manual-imoveis-caixa');
        $content = $response->getContent();

        $response->assertSee('id="manual-15"', false);
        $response->assertSee('Financiamento Imobiliário — Requisitos e Documentos');
        $response->assertSee('Despesas de Compra');
        $response->assertSee('Regras de Despesas de Condomínio');
        $response->assertSee('Despesas de Tributos e IPTU');
        $response->assertSee('Prazos Importantes (Resumo)');
        $response->assertSee('Liminar de desocupação judicial: possibilidade de 60 dias.');
        $this->assertSame(15, substr_count($content, '<details id="manual-'));
        $this->assertSame(15, substr_count($content, 'href="#manual-'));
    }
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_renders_all_fifteen_sections` — only 10 sections exist so far.

- [ ] **Step 3: Append sections 11-15 to the `$manual` array**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
                    <li>Se a opção não aparece na ficha, o imóvel não permite financiamento — não há filtro de busca para isso, então continue procurando outro que informe aceitar financiamento.</li>
                </ul>
            ',
        ],
    ];
    @endphp
```

to:

```blade
                    <li>Se a opção não aparece na ficha, o imóvel não permite financiamento — não há filtro de busca para isso, então continue procurando outro que informe aceitar financiamento.</li>
                </ul>
            ',
        ],
        [
            'id' => 11,
            'titulo' => 'Financiamento Imobiliário — Requisitos e Documentos',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Requisitos</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Sem restrição de crédito</li>
                    <li>Renda comprovada</li>
                    <li>Valor em dinheiro para entrada + valor para pagar a documentação do imóvel</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Documentação</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Documentação pessoal</li>
                    <li>Comprovantes de renda</li>
                    <li>Extrato bancário das contas</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Observações importantes</h4>
                <p>Precisamos saber o valor disponível em dinheiro para definir o teto do imóvel. Quanto menor o percentual financiado, maior o desconto na taxa de juros.</p>
                <p class="mt-2">O FGTS não serve como entrada — ele abate o saldo devedor e diminui o valor financiado.</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Pré-aprovação obrigatória</h4>
                <p>A CAIXA exige pré-aprovação de crédito antes da proposta. Tratamos disso pelo WhatsApp; após a aprovação, você recebe um código para preencher no formulário de proposta.</p>
            ',
        ],
        [
            'id' => 12,
            'titulo' => 'Despesas de Compra',
            'html' => '
                <p>Há dois tipos: condomínio e tributos + registro do imóvel.</p>
                <ul class="list-disc list-inside space-y-2 mt-3">
                    <li><strong>Leilão:</strong> comprador paga a comissão do leiloeiro e todas as despesas de condomínio e tributos (confira o edital).</li>
                    <li><strong>Licitação Aberta:</strong> comprador paga parte das despesas de condomínio e o total de tributos (confira a ficha).</li>
                    <li><strong>Venda Direta:</strong> conforme a ficha do imóvel — geralmente a CAIXA paga parte ou toda a dívida de condomínio/tributos (confira a ficha).</li>
                    <li><strong>Em todas as modalidades:</strong> o registro do imóvel é do comprador, que deve enviar cópia de RGI e IPTU em até 60 dias para a baixa de compra.</li>
                </ul>
            ',
        ],
        [
            'id' => 13,
            'titulo' => 'Regras de Despesas de Condomínio',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li>Responsabilidade do comprador até 10% do valor de avaliação do imóvel.</li>
                    <li>A CAIXA paga apenas o que exceder esse limite de 10%.</li>
                    <li>Não temos o valor exato das dívidas — solicite à administradora.</li>
                    <li>Investidores costumam reservar 10% do débito nas custas do investimento.</li>
                    <li>Na prática, o comprador pode negociar com a administradora; o que passar de 10% a CAIXA paga integralmente após envio do RGI e IPTU em nome do comprador.</li>
                </ul>
                <p class="mt-3 text-sm bg-caixa-blue/5 border border-caixa-blue/20 px-4 py-3 rounded-lg">
                    <strong>Exemplo:</strong> imóvel avaliado em R$ 253.000,00 → despesa máxima de condomínio para o comprador é R$ 25.300,00 (o excedente a CAIXA paga). A dívida de IPTU de R$ 4.535,00 é de responsabilidade do comprador.
                </p>
            ',
        ],
        [
            'id' => 14,
            'titulo' => 'Despesas de Tributos e IPTU',
            'html' => '
                <h4 class="font-bold text-text-primary mt-2 mb-2">Regra geral</h4>
                <ul class="list-disc list-inside space-y-2">
                    <li>Todas as despesas de tributos são do comprador (confira sempre na proposta).</li>
                    <li>Abrange IPTU, taxa de incêndio, laudêmio e outros — o foco principal é o IPTU.</li>
                    <li>Todas as dívidas de IPTU são de responsabilidade do comprador em todas as modalidades.</li>
                </ul>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Inscrição imobiliária</h4>
                <p>Com esse número, consulte no site da prefeitura eventuais dívidas de IPTU e valores.</p>
                <p class="mt-2">Se não constar na ficha, o comprador deve buscar diretamente na prefeitura para saber dívidas, imprimir documentação e alterar a titularidade do IPTU.</p>

                <h4 class="font-bold text-text-primary mt-5 mb-2">Quando a inscrição imobiliária não é informada — Rio de Janeiro</h4>
                <p>Buscar na Secretaria de Fazenda nos pontos:</p>
                <ul class="list-disc list-inside space-y-1 mt-2">
                    <li><strong>Centro:</strong> Rua Afonso Cavalcanti, 455 – prédio anexo – térreo</li>
                    <li><strong>Barra Shopping:</strong> Av. das Américas, 4.666 – Entrada A, lojas 215/216</li>
                    <li><strong>West Shopping:</strong> Estrada do Mendanha, 555 – Campo Grande – Loja 282</li>
                    <li><strong>Norte Shopping:</strong> Av. Dom Helder Câmara, 5474 – Loja 3021 – Cachambi</li>
                </ul>
            ',
        ],
        [
            'id' => 15,
            'titulo' => 'Prazos Importantes (Resumo)',
            'html' => '
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Boleto (recursos próprios):</strong> pagar em até 3 dias.</li>
                    <li><strong>Boleto (validade portal):</strong> 2 dias úteis.</li>
                    <li><strong>Envio de RGI e IPTU em nome do comprador:</strong> até 60 dias após a compra.</li>
                    <li><strong>Liminar de desocupação judicial: possibilidade de 60 dias.</strong></li>
                </ul>
            ',
        ],
    ];
    @endphp
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (8 tests)

- [ ] **Step 5: Commit**

```bash
git add resources/views/manual-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona seções 11-15 do Manual de Compra (conteúdo completo)"
```

---

### Task 7: Shared lead-capture form partial

**Files:**
- Create: `resources/views/partials/lead-form.blade.php`
- Modify: `resources/views/venda-imoveis-caixa.blade.php:505-575`
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Modify: `tests/Feature/VendaImoveisCaixaPageTest.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Produces: `partials.lead-form`, included via `@include('partials.lead-form', ['pageName' => string, 'heading' => string, 'subheading' => string, 'declarations' => string[]])`. Renders a `<section id="cadastro">` with the CAIXA lead form posting to `route('contato.store')`.

- [ ] **Step 1: Write the failing tests**

Append to `tests/Feature/VendaImoveisCaixaPageTest.php`:

```php
    public function test_venda_imoveis_page_still_has_lead_form_with_correct_page_name(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('Cadastro de Interesse de Compra');
        $response->assertSee('name="page_name" value="Venda de Imóveis da CAIXA"', false);
        $response->assertSee('action="' . route('contato.store') . '"', false);
    }
```

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_has_lead_form_with_correct_page_name(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('Cadastro de Interesse de Compra');
        $response->assertSee('name="page_name" value="Manual de Compra dos Imóveis da CAIXA"', false);
        $response->assertSee('action="' . route('contato.store') . '"', false);
    }
```

- [ ] **Step 2: Run tests to verify they fail**

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (this locks in existing behavior — should already pass)

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_has_lead_form_with_correct_page_name` — the manual page has no form yet.

- [ ] **Step 3: Create the shared partial**

Create `resources/views/partials/lead-form.blade.php`:

```blade
<section id="cadastro">
    <h2 class="text-2xl font-extrabold text-text-primary mb-2 pb-3 border-b-2 border-caixa-blue">
        {{ $heading }}
    </h2>
    <p class="text-text-secondary text-sm mb-6">
        {{ $subheading }}
    </p>

    <div class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-xl p-4 mb-6 text-sm text-text-secondary">
        <strong class="text-text-primary">Ao enviar este formulário, você declara estar ciente de que:</strong>
        <ul class="list-disc list-inside mt-2 space-y-1">
            @foreach($declarations as $declaration)
            <li>{{ $declaration }}</li>
            @endforeach
        </ul>
    </div>

    <form action="{{ route('contato.store') }}" method="POST" class="bg-surface border border-border rounded-2xl p-6 sm:p-8 space-y-5">
        @csrf
        <input type="hidden" name="page_name" value="{{ $pageName }}">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="contact-name" class="block text-sm font-semibold text-text-primary mb-1">Nome completo</label>
                <input id="contact-name" type="text" name="name" required placeholder="Seu nome"
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>
            <div>
                <label for="contact-email" class="block text-sm font-semibold text-text-primary mb-1">E-mail</label>
                <input id="contact-email" type="email" name="email" required placeholder="seu@email.com"
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>
            <div>
                <label for="contact-whatsapp" class="block text-sm font-semibold text-text-primary mb-1">WhatsApp</label>
                <input id="contact-whatsapp" type="tel" name="whatsapp" required placeholder="(21) 99999-9999"
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
            </div>
            <div>
                <label for="horario" class="block text-sm font-semibold text-text-primary mb-1">Melhor horário</label>
                <select id="horario" name="horario" class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue">
                    <option value="">Selecione</option>
                    <option>08h às 12h</option>
                    <option>12h às 16h</option>
                    <option>16h às 20h</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-text-primary mb-1">Finalidade do imóvel</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['Comprar para morar', 'Comprar e vender', 'Comprar para alugar'] as $finalidade)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="finalidade" value="{{ $finalidade }}" class="accent-caixa-blue">
                        <span class="text-sm text-text-secondary">{{ $finalidade }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="contact-message" class="block text-sm font-semibold text-text-primary mb-1">Mensagem (opcional)</label>
                <textarea id="contact-message" name="message" rows="3" placeholder="Descreva o imóvel que você está procurando..."
                    class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue resize-none"></textarea>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-caixa-blue hover:bg-caixa-blue-dark text-white font-bold text-lg py-4 rounded-xl transition-colors">
            Quero ser atendido gratuitamente →
        </button>
        <p class="text-xs text-text-muted text-center">Atendimento 100% gratuito — nenhuma comissão será cobrada</p>
    </form>
</section>
```

- [ ] **Step 4: Use the partial in venda-imoveis-caixa.blade.php**

In `resources/views/venda-imoveis-caixa.blade.php`, modify (the entire section 8 block, lines 505-575):

```blade
    {{-- ── 8. FORMULÁRIO DE CADASTRO ──────────────────────────── --}}
    <section id="cadastro">
        <h2 class="text-2xl font-extrabold text-text-primary mb-2 pb-3 border-b-2 border-caixa-blue">
            Cadastro de Interesse de Compra
        </h2>
        <p class="text-text-secondary text-sm mb-6">
            Preencha o formulário e um Corretor Credenciado entrará em contato pelo WhatsApp.
        </p>

        <div class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-xl p-4 mb-6 text-sm text-text-secondary">
            <strong class="text-text-primary">Ao enviar este formulário, você declara estar ciente de que:</strong>
            <ul class="list-disc list-inside mt-2 space-y-1">
                <li>Para compra financiada é preciso aprovação antecipada de crédito</li>
                <li>Os imóveis da CAIXA são retomados de acordo com a Lei 9.514 (alienação fiduciária)</li>
                <li>Os imóveis só podem ser financiados pela CAIXA e não aceitam carta de consórcio</li>
            </ul>
        </div>

        <form action="{{ route('contato.store') }}" method="POST" class="bg-surface border border-border rounded-2xl p-6 sm:p-8 space-y-5">
            @csrf
            <input type="hidden" name="page_name" value="Venda de Imóveis da CAIXA">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="contact-name" class="block text-sm font-semibold text-text-primary mb-1">Nome completo</label>
                    <input id="contact-name" type="text" name="name" required placeholder="Seu nome"
                        class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                </div>
                <div>
                    <label for="contact-email" class="block text-sm font-semibold text-text-primary mb-1">E-mail</label>
                    <input id="contact-email" type="email" name="email" required placeholder="seu@email.com"
                        class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                </div>
                <div>
                    <label for="contact-whatsapp" class="block text-sm font-semibold text-text-primary mb-1">WhatsApp</label>
                    <input id="contact-whatsapp" type="tel" name="whatsapp" required placeholder="(21) 99999-9999"
                        class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue focus:border-transparent">
                </div>
                <div>
                    <label for="horario" class="block text-sm font-semibold text-text-primary mb-1">Melhor horário</label>
                    <select id="horario" name="horario" class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue">
                        <option value="">Selecione</option>
                        <option>08h às 12h</option>
                        <option>12h às 16h</option>
                        <option>16h às 20h</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-text-primary mb-1">Finalidade do imóvel</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Comprar para morar', 'Comprar e vender', 'Comprar para alugar'] as $finalidade)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="finalidade" value="{{ $finalidade }}" class="accent-caixa-blue">
                            <span class="text-sm text-text-secondary">{{ $finalidade }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="contact-message" class="block text-sm font-semibold text-text-primary mb-1">Mensagem (opcional)</label>
                    <textarea id="contact-message" name="message" rows="3" placeholder="Descreva o imóvel que você está procurando..."
                        class="w-full border border-border rounded-xl px-4 py-3 text-sm bg-surface focus:outline-none focus:ring-2 focus:ring-caixa-blue resize-none"></textarea>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-caixa-blue hover:bg-caixa-blue-dark text-white font-bold text-lg py-4 rounded-xl transition-colors">
                Quero ser atendido gratuitamente →
            </button>
            <p class="text-xs text-text-muted text-center">Atendimento 100% gratuito — nenhuma comissão será cobrada</p>
        </form>
    </section>
```

to:

```blade
    {{-- ── 8. FORMULÁRIO DE CADASTRO ──────────────────────────── --}}
    @include('partials.lead-form', [
        'pageName' => 'Venda de Imóveis da CAIXA',
        'heading' => 'Cadastro de Interesse de Compra',
        'subheading' => 'Preencha o formulário e um Corretor Credenciado entrará em contato pelo WhatsApp.',
        'declarations' => [
            'Para compra financiada é preciso aprovação antecipada de crédito',
            'Os imóveis da CAIXA são retomados de acordo com a Lei 9.514 (alienação fiduciária)',
            'Os imóveis só podem ser financiados pela CAIXA e não aceitam carta de consórcio',
        ],
    ])
```

- [ ] **Step 5: Add the form to manual-imoveis-caixa.blade.php**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
        @endforeach
    </div>

</div>

@endsection
```

to:

```blade
        @endforeach
    </div>

    @include('partials.lead-form', [
        'pageName' => 'Manual de Compra dos Imóveis da CAIXA',
        'heading' => 'Cadastro de Interesse de Compra',
        'subheading' => 'Preencha o formulário e um Corretor Credenciado entrará em contato pelo WhatsApp.',
        'declarations' => [
            'Este manual tem caráter informativo e não substitui a leitura do edital ou da ficha do imóvel',
            'Para compra financiada é preciso aprovação antecipada de crédito',
            'Os imóveis da CAIXA só podem ser financiados pela CAIXA e não aceitam carta de consórcio',
        ],
    ])

</div>

@endsection
```

- [ ] **Step 6: Run tests to verify they pass**

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (4 tests)

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (9 tests)

- [ ] **Step 7: Commit**

```bash
git add resources/views/partials/lead-form.blade.php resources/views/venda-imoveis-caixa.blade.php resources/views/manual-imoveis-caixa.blade.php tests/Feature/VendaImoveisCaixaPageTest.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "refactor: extrai formulário de captação de lead para partial compartilhado"
```

---

### Task 8: Cross-links between the two guide pages

**Files:**
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Modify: `resources/views/venda-imoveis-caixa.blade.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`
- Modify: `tests/Feature/VendaImoveisCaixaPageTest.php`

**Interfaces:** none new (uses existing `route('venda.imoveis')` and `route('manual.imoveis')`).

- [ ] **Step 1: Write the failing tests**

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_links_to_venda_imoveis_guide(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('href="' . route('venda.imoveis') . '"', false);
    }
```

Append to `tests/Feature/VendaImoveisCaixaPageTest.php`:

```php
    public function test_venda_imoveis_page_links_to_manual_guide(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('href="' . route('manual.imoveis') . '"', false);
    }
```

- [ ] **Step 2: Run tests to verify they fail**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_links_to_venda_imoveis_guide`

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: FAIL on `test_venda_imoveis_page_links_to_manual_guide`

- [ ] **Step 3: Add the cross-link on the manual page**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
        @endforeach
    </div>

    @include('partials.lead-form', [
        'pageName' => 'Manual de Compra dos Imóveis da CAIXA',
```

to:

```blade
        @endforeach
    </div>

    <section class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-2xl p-6 sm:p-8 text-center">
        <h2 class="text-xl font-bold text-text-primary mb-2">Quer entender por que vale a pena comprar um imóvel CAIXA?</h2>
        <p class="text-text-secondary mb-4">Veja o Guia Completo de Venda de Imóveis da CAIXA, com descontos, vantagens e perguntas frequentes.</p>
        <a href="{{ route('venda.imoveis') }}" class="inline-flex items-center gap-2 bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold px-6 py-3 rounded-xl transition-colors">
            Ver o Guia Completo de Venda →
        </a>
    </section>

    @include('partials.lead-form', [
        'pageName' => 'Manual de Compra dos Imóveis da CAIXA',
```

- [ ] **Step 4: Add the reciprocal cross-link on venda-imoveis-caixa.blade.php**

In `resources/views/venda-imoveis-caixa.blade.php`, modify:

```blade
    {{-- ── 8. FORMULÁRIO DE CADASTRO ──────────────────────────── --}}
    @include('partials.lead-form', [
        'pageName' => 'Venda de Imóveis da CAIXA',
```

to:

```blade
    {{-- ── LINK CRUZADO: MANUAL DE COMPRA ───────────────────────── --}}
    <section class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-2xl p-6 sm:p-8 text-center">
        <h2 class="text-xl font-bold text-text-primary mb-2">Já decidiu comprar?</h2>
        <p class="text-text-secondary mb-4">Veja o Manual de Compra passo a passo: portal, modalidades, proposta, pagamento e desocupação.</p>
        <a href="{{ route('manual.imoveis') }}" class="inline-flex items-center gap-2 bg-caixa-blue hover:bg-caixa-blue-dark text-white font-semibold px-6 py-3 rounded-xl transition-colors">
            Ver o Manual de Compra →
        </a>
    </section>

    {{-- ── 8. FORMULÁRIO DE CADASTRO ──────────────────────────── --}}
    @include('partials.lead-form', [
        'pageName' => 'Venda de Imóveis da CAIXA',
```

- [ ] **Step 5: Run tests to verify they pass**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (10 tests)

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (5 tests)

- [ ] **Step 6: Commit**

```bash
git add resources/views/manual-imoveis-caixa.blade.php resources/views/venda-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php tests/Feature/VendaImoveisCaixaPageTest.php
git commit -m "feat: adiciona links cruzados entre Manual de Compra e Guia de Venda"
```

---

### Task 9: JSON-LD (`HowTo`) on the manual page

**Files:**
- Modify: `resources/views/manual-imoveis-caixa.blade.php`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`

**Interfaces:**
- Consumes: `$manual` array (15 entries, from Task 6).

- [ ] **Step 1: Write the failing test**

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_has_howto_json_ld(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $response->getContent(), $matches);
        $this->assertNotEmpty($matches, 'JSON-LD script tag not found on manual page');

        $json = json_decode($matches[1], true);

        $this->assertSame('HowTo', $json['@type']);
        $this->assertSame('Manual de Compra dos Imóveis da CAIXA', $json['name']);
        $this->assertCount(15, $json['step']);
        $this->assertSame('HowToStep', $json['step'][0]['@type']);
        $this->assertSame('O Portal de Venda de Imóveis CAIXA', $json['step'][0]['name']);
    }
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: FAIL on `test_manual_page_has_howto_json_ld` — no JSON-LD script tag exists yet.

- [ ] **Step 3: Add the JSON-LD block**

In `resources/views/manual-imoveis-caixa.blade.php`, modify:

```blade
    </div>

    <section class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-2xl p-6 sm:p-8 text-center">
        <h2 class="text-xl font-bold text-text-primary mb-2">Quer entender por que vale a pena comprar um imóvel CAIXA?</h2>
```

to:

```blade
    </div>

    @php
    $howToSteps = collect($manual)->map(fn($item) => [
        '@type' => 'HowToStep',
        'name'  => $item['titulo'],
        'url'   => route('manual.imoveis') . '#manual-' . $item['id'],
    ])->all();
    @endphp
    @push('head')
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

    <section class="bg-caixa-blue/5 border border-caixa-blue/20 rounded-2xl p-6 sm:p-8 text-center">
        <h2 class="text-xl font-bold text-text-primary mb-2">Quer entender por que vale a pena comprar um imóvel CAIXA?</h2>
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (11 tests)

- [ ] **Step 5: Commit**

```bash
git add resources/views/manual-imoveis-caixa.blade.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona JSON-LD HowTo ao Manual de Compra"
```

---

### Task 10: Footer link

**Files:**
- Modify: `resources/views/layouts/blog.blade.php:157-173`
- Modify: `tests/Feature/ManualImoveisCaixaPageTest.php`
- Modify: `tests/Feature/VendaImoveisCaixaPageTest.php`

**Interfaces:** none new.

- [ ] **Step 1: Write the failing tests**

Append to `tests/Feature/VendaImoveisCaixaPageTest.php`:

```php
    public function test_footer_has_manual_de_compra_link(): void
    {
        $response = $this->get('/venda-imoveis-caixa');

        $response->assertSee('Manual de Compra');
        $response->assertSee('href="' . route('manual.imoveis') . '"', false);
    }
```

Append to `tests/Feature/ManualImoveisCaixaPageTest.php`:

```php
    public function test_manual_page_footer_has_manual_de_compra_link(): void
    {
        $response = $this->get('/manual-imoveis-caixa');

        $response->assertSee('Manual de Compra');
    }
```

- [ ] **Step 2: Run tests to verify they fail**

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: FAIL on `test_footer_has_manual_de_compra_link`

- [ ] **Step 3: Add the footer link**

In `resources/views/layouts/blog.blade.php`, modify:

```blade
            <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-6">
                <a href="{{ route('home') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Inicial
                </a>
                <span class="text-gray-700">–</span>
                <a href="{{ route('privacidade') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Privacidade
                </a>
                <span class="text-gray-700">–</span>
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank" rel="noopener"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Busca de Imóveis
                </a>
            </nav>
```

to:

```blade
            <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-6">
                <a href="{{ route('home') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Inicial
                </a>
                <span class="text-gray-700">–</span>
                <a href="{{ route('manual.imoveis') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Manual de Compra
                </a>
                <span class="text-gray-700">–</span>
                <a href="{{ route('privacidade') }}"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Privacidade
                </a>
                <span class="text-gray-700">–</span>
                <a href="https://venda.imoveisdacaixa.com.br"
                   target="_blank" rel="noopener"
                   class="text-gray-400 hover:text-white text-sm transition-colors">
                    Busca de Imóveis
                </a>
            </nav>
```

- [ ] **Step 4: Run tests to verify they pass**

Run: `php artisan test --filter=VendaImoveisCaixaPageTest`
Expected: PASS (6 tests)

Run: `php artisan test --filter=ManualImoveisCaixaPageTest`
Expected: PASS (12 tests)

- [ ] **Step 5: Run the full test suite**

Run: `php artisan test`
Expected: PASS (all tests, no regressions elsewhere)

- [ ] **Step 6: Commit**

```bash
git add resources/views/layouts/blog.blade.php tests/Feature/VendaImoveisCaixaPageTest.php tests/Feature/ManualImoveisCaixaPageTest.php
git commit -m "feat: adiciona link do Manual de Compra ao rodapé"
```
