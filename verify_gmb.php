<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Agency;
use App\Models\Review;

echo "=== VERIFICAÇÃO DO MÓDULO GMB ===" . PHP_EOL . PHP_EOL;

// Contagem
$total = Agency::count();
echo "Total de agências: {$total}" . PHP_EOL . PHP_EOL;

// Amostra de 5 agências
echo "--- Amostra de Agências ---" . PHP_EOL;
$samples = Agency::take(5)->get();
foreach ($samples as $ag) {
    echo "  Nome: {$ag->name}" . PHP_EOL;
    echo "  Bairro: {$ag->neighborhood}, {$ag->city}/{$ag->state}" . PHP_EOL;
    echo "  Slug: {$ag->slug}" . PHP_EOL;
    echo "  Email (Accessor): {$ag->email}" . PHP_EOL;
    echo "  SEO Title: {$ag->seo_title}" . PHP_EOL;
    echo "  Ag. Número: {$ag->agency_number}" . PHP_EOL;
    echo "  ---" . PHP_EOL;
}

// Verificar slugs duplicados
$duplicates = Agency::select('slug')
    ->selectRaw('COUNT(*) as cnt')
    ->groupBy('slug')
    ->having('cnt', '>', 1)
    ->get();
echo PHP_EOL . "Slugs duplicados: " . ($duplicates->isEmpty() ? '✓ NENHUM' : $duplicates->count() . ' encontrados') . PHP_EOL;

// Verificar bairros únicos
$neighborhoods = Agency::select('neighborhood')->distinct()->count();
echo "Bairros únicos: {$neighborhoods}" . PHP_EOL;

// Verificar SoftDeletes
$hasSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(Agency::class));
echo "SoftDeletes Agency: " . ($hasSoftDeletes ? '✓ SIM' : '✗ NÃO') . PHP_EOL;
$hasSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(Review::class));
echo "SoftDeletes Review: " . ($hasSoftDeletes ? '✓ SIM' : '✗ NÃO') . PHP_EOL;

// Verificar relacionamentos
echo "Agency->reviews(): " . (method_exists(Agency::class, 'reviews') ? '✓ OK' : '✗ FALTANDO') . PHP_EOL;
echo "Review->agency(): " . (method_exists(Review::class, 'agency') ? '✓ OK' : '✗ FALTANDO') . PHP_EOL;

echo PHP_EOL . "=== VERIFICAÇÃO CONCLUÍDA ===" . PHP_EOL;
