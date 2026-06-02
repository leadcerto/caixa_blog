<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgencySeeder extends Seeder
{
    /**
     * Importa agências do arquivo de dados TXT.
     *
     * Formato do bloco:
     *   NOME DA AGÊNCIA, UF
     *   LOGRADOURO NUM XXX - BAIRRO
     *   CEP - CIDADE, UF
     *   Tel: (XX) XXXX-XXXX
     *   Ag. Número: XXXX-X
     *   Horário de atendimento: XX:XX às XX:XX (dias úteis)
     */
    public function run(): void
    {
        $filePath = database_path('data/agencias-rj.txt');

        if (! file_exists($filePath)) {
            $this->command->error("Arquivo não encontrado: {$filePath}");
            return;
        }

        $content = file_get_contents($filePath);
        $agencies = $this->parseAgencies($content);

        $created = 0;
        $skipped = 0;
        $slugCounts = []; // Para gerar slugs únicos

        foreach ($agencies as $data) {
            // Gera slug SEO: {bairro}-{cidade}-{estado}
            $baseSlug = Str::slug("{$data['neighborhood']}-{$data['city']}-{$data['state']}");

            // Controla duplicatas de slug (ex: vários em CENTRO-rio-de-janeiro-rj)
            if (isset($slugCounts[$baseSlug])) {
                $slugCounts[$baseSlug]++;
                $slug = "{$baseSlug}-{$slugCounts[$baseSlug]}";
            } else {
                $slugCounts[$baseSlug] = 0;
                $slug = $baseSlug;
            }

            // Evita duplicar se já existir no banco
            if (Agency::where('agency_number', $data['agency_number'])->exists()) {
                $skipped++;
                continue;
            }

            Agency::create(array_merge($data, ['slug' => $slug]));
            $created++;
        }

        $this->command->info("✓ Agências importadas: {$created} criadas, {$skipped} já existiam.");
    }

    /**
     * Faz o parse do arquivo de texto e retorna array de agências.
     */
    private function parseAgencies(string $content): array
    {
        $agencies = [];
        $lines = array_map('trim', explode("\n", $content));

        // Remove linhas vazias do início e cabeçalho
        $lines = array_values(array_filter($lines, fn($l) => $l !== ''));

        // Remove a primeira linha se for o cabeçalho "AGÊNCIAS EM..."
        if (! empty($lines) && Str::startsWith(mb_strtoupper($lines[0]), 'AGÊNCIAS')) {
            array_shift($lines);
        }

        $i = 0;
        $total = count($lines);

        while ($i < $total) {
            // Linha 1: Nome da agência, UF (ex: "14 BIS, RJ")
            $nameLine = $lines[$i] ?? '';
            if (empty($nameLine) || Str::startsWith($nameLine, 'AGÊNCIAS')) {
                $i++;
                continue;
            }

            // Extrai nome (remove ", UF" do final)
            $name = preg_replace('/,\s*[A-Z]{2}\s*$/', '', $nameLine);
            $name = trim($name);

            // Linha 2: Endereço - BAIRRO
            $addressLine = $lines[$i + 1] ?? '';
            $neighborhood = '';
            $address = $addressLine;

            // O bairro é a parte após o último " - " no endereço
            if (preg_match('/^(.+)\s+-\s+(.+)$/', $addressLine, $m)) {
                $address = trim($m[1]);
                $neighborhood = trim($m[2]);

                // Caso especial: "PRACA FLORIANO NUM 31 - LJ A,B,C - CENTRO"
                // O bairro é o último segmento após o último " - "
                $parts = explode(' - ', $addressLine);
                if (count($parts) > 2) {
                    $neighborhood = trim(end($parts));
                    array_pop($parts);
                    $address = trim(implode(' - ', $parts));
                }
            }

            // Capitaliza o bairro: "BARRA DA TIJUCA" -> "Barra da Tijuca"
            $neighborhood = $this->titleCase($neighborhood);

            // Linha 3: CEP - CIDADE, UF
            $cityLine = $lines[$i + 2] ?? '';
            $city = '';
            $state = '';
            $zipCode = '';

            if (preg_match('/^(\d+)\s*-\s*(.+),\s*([A-Z]{2})$/', $cityLine, $m)) {
                $zipCode = $this->formatZipCode($m[1]);
                $city = $this->titleCase(trim($m[2]));
                $state = strtoupper(trim($m[3]));
            }

            // Linha 4: Tel: (XX) XXXX-XXXX
            $phoneLine = $lines[$i + 3] ?? '';
            $phone = '';
            if (preg_match('/Tel:\s*(.+)/', $phoneLine, $m)) {
                $phone = trim($m[1]);
            }

            // Linha 5: Ag. Número: XXXX-X
            $agNumberLine = $lines[$i + 4] ?? '';
            $agencyNumber = '';
            if (preg_match('/Ag\.\s*Número:\s*(.+)/', $agNumberLine, $m)) {
                $agencyNumber = trim($m[1]);
            }

            // Linha 6: Horário de atendimento
            $hoursLine = $lines[$i + 5] ?? '';
            $openingHours = '';
            if (preg_match('/Horário de atendimento:\s*(.+)/', $hoursLine, $m)) {
                $openingHours = trim($m[1]);
            }

            // Só adiciona se tiver dados mínimos válidos
            if ($name && $agencyNumber && $city) {
                $agencies[] = [
                    'name'            => $name,
                    'address'         => $address,
                    'neighborhood'    => $neighborhood,
                    'city'            => $city,
                    'state'           => $state,
                    'zip_code'        => $zipCode,
                    'phone'           => $phone,
                    'agency_number'   => $agencyNumber,
                    'opening_hours'   => $openingHours,
                ];
            }

            $i += 6; // Próximo bloco
        }

        return $agencies;
    }

    /**
     * Converte texto para Title Case inteligente (preserva artigos em minúsculo).
     */
    private function titleCase(string $text): string
    {
        $lower = mb_strtolower($text);
        $words = explode(' ', $lower);
        $smallWords = ['de', 'do', 'da', 'dos', 'das', 'e', 'em', 'a', 'o', 'na', 'no'];

        return implode(' ', array_map(function ($word, $index) use ($smallWords) {
            if ($index > 0 && in_array($word, $smallWords)) {
                return $word;
            }
            return mb_strtoupper(mb_substr($word, 0, 1)) . mb_substr($word, 1);
        }, $words, array_keys($words)));
    }

    /**
     * Formata CEP para o padrão XXXXX-XXX.
     */
    private function formatZipCode(string $raw): string
    {
        $digits = preg_replace('/\D/', '', $raw);

        // Pad com zeros à esquerda se necessário (CEPs antigos com menos de 8 dígitos)
        $digits = str_pad($digits, 8, '0', STR_PAD_LEFT);

        return substr($digits, 0, 5) . '-' . substr($digits, 5, 3);
    }
}
