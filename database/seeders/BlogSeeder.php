<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Seed de dados de demonstração para o blog de House Flipping.
     */
    public function run(): void
    {
        // ── Usuário autor ──────────────────────────────────────────
        $author = User::firstOrCreate(
            ['email' => 'admin@imoveisdacaixa.com.br'],
            [
                'name'     => 'Equipe Editorial',
                'password' => bcrypt('password'),
            ]
        );

        // ── Categorias ─────────────────────────────────────────────
        $categories = collect([
            ['name' => 'Arrematação',     'slug' => 'arrematacao',     'description' => 'Tudo sobre leilões e arrematação de imóveis da Caixa.'],
            ['name' => 'Venda Direta',    'slug' => 'venda-direta',    'description' => 'Oportunidades de compra direta com condições especiais.'],
            ['name' => 'Licitações',      'slug' => 'licitacoes',      'description' => 'Como participar de licitações de imóveis públicos.'],
            ['name' => 'House Flipping',  'slug' => 'house-flipping',  'description' => 'Estratégias de compra, reforma e revenda lucrativa.'],
            ['name' => 'Financiamento',   'slug' => 'financiamento',   'description' => 'Linhas de crédito e financiamento para imóveis da Caixa.'],
            ['name' => 'Guias Práticos',  'slug' => 'guias-praticos',  'description' => 'Tutoriais passo a passo para investidores.'],
        ])->map(fn ($data) => Category::firstOrCreate(['slug' => $data['slug']], $data));

        // ── Posts de demonstração ──────────────────────────────────
        $posts = [
            [
                'title'          => 'Como Arrematar Imóveis da Caixa: O Guia Definitivo para Iniciantes',
                'slug'           => 'como-arrematar-imoveis-da-caixa-guia-definitivo',
                'hook_excerpt'   => 'Descubra o passo a passo completo para participar de leilões da Caixa Econômica Federal e conseguir imóveis com até 50% de desconto do valor de mercado.',
                'content'        => '<h2>O que é a arrematação de imóveis da Caixa?</h2>
<p>A arrematação é o processo de compra de imóveis retomados pela Caixa Econômica Federal por inadimplência. Esses imóveis são vendidos em leilões públicos com descontos que podem chegar a <strong>50% do valor de avaliação</strong>.</p>

<h2>Passo 1: Entenda os tipos de leilão</h2>
<p>Existem dois tipos principais de leilão da Caixa:</p>
<ul>
<li><strong>Primeiro Leilão:</strong> O imóvel é vendido pelo valor de avaliação. Se não houver lance, vai para o segundo leilão.</li>
<li><strong>Segundo Leilão:</strong> O preço mínimo é reduzido significativamente, gerando as melhores oportunidades.</li>
</ul>

<h2>Passo 2: Faça sua habilitação</h2>
<p>Para participar, você precisa se cadastrar no site da Caixa e no leiloeiro oficial. Documentos necessários: CPF, RG, comprovante de residência e comprovante de renda.</p>

<h2>Passo 3: Analise o imóvel</h2>
<p>Nunca arremate um imóvel sem antes visitar o local (se possível), verificar a matrícula atualizada no cartório e calcular todos os custos envolvidos (ITBI, reforma, condomínio atrasado).</p>

<h2>Passo 4: Defina seu lance máximo</h2>
<p>Calcule o valor máximo que torna o investimento lucrativo. Considere: valor de mercado da região, custos de reforma, impostos e sua margem de lucro desejada.</p>

<h3>Dica de ouro</h3>
<p>Sempre tenha um advogado imobiliário ao seu lado. Os editais dos leilões contêm cláusulas importantes que podem gerar prejuízos se ignoradas.</p>',
                'category_slug'  => 'arrematacao',
                'is_published'   => true,
                'published_at'   => now()->subDays(2),
                'resources'      => [
                    ['title' => 'Checklist de Arrematação — PDF', 'file_path' => 'resources/checklist-arrematacao.pdf', 'type' => 'pdf'],
                    ['title' => 'Planilha de Análise de Viabilidade', 'file_path' => 'resources/planilha-viabilidade.xlsx', 'type' => 'template'],
                ],
            ],
            [
                'title'          => '5 Erros Fatais ao Comprar Imóveis em Venda Direta da Caixa',
                'slug'           => '5-erros-fatais-comprar-imoveis-venda-direta-caixa',
                'hook_excerpt'   => 'Investidores experientes também cometem erros. Conheça os 5 maiores erros que podem transformar uma oportunidade de ouro em um pesadelo financeiro.',
                'content'        => '<h2>Erro #1: Não verificar a ocupação do imóvel</h2>
<p>Muitos imóveis da Caixa estão ocupados. Isso significa que você terá custos e tempo adicionais para a desocupação, que pode levar meses na justiça.</p>

<h2>Erro #2: Ignorar os débitos anteriores</h2>
<p>Condomínio atrasado, IPTU, taxas de água e luz — todos esses débitos podem recair sobre o novo comprador. Faça a conta <strong>antes</strong> de dar o lance.</p>

<h2>Erro #3: Não fazer vistoria presencial</h2>
<p>As fotos do edital nem sempre refletem a realidade. Infiltrações, problemas estruturais e invasões só são detectados com uma visita ao local.</p>

<h2>Erro #4: Subestimar custos de reforma</h2>
<p>A reforma quase sempre custa mais do que você imagina. Adicione pelo menos 20% de margem de segurança ao seu orçamento.</p>

<h2>Erro #5: Não consultar um advogado</h2>
<p>A documentação de imóveis retomados é complexa. Um advogado especializado pode identificar riscos que passam despercebidos para leigos.</p>',
                'category_slug'  => 'venda-direta',
                'is_published'   => true,
                'published_at'   => now()->subDays(5),
                'resources'      => [],
            ],
            [
                'title'          => 'House Flipping: Como Lucrar R$ 100 mil com Imóveis da Caixa',
                'slug'           => 'house-flipping-como-lucrar-100-mil-imoveis-caixa',
                'hook_excerpt'   => 'O modelo de negócio que está transformando investidores comuns em empreendedores imobiliários de sucesso no Brasil.',
                'content'        => '<h2>O que é House Flipping?</h2>
<p>House Flipping é a estratégia de comprar um imóvel abaixo do valor de mercado, reformá-lo e revendê-lo com lucro. No Brasil, os imóveis retomados pela Caixa são a matéria-prima perfeita para essa estratégia.</p>

<h2>Caso Real: Apartamento em São Paulo</h2>
<p>Um investidor comprou um apartamento de 70m² na zona leste de SP por <strong>R$ 150.000</strong> em leilão da Caixa. Investiu R$ 50.000 em reforma completa. Após 4 meses, vendeu por <strong>R$ 320.000</strong>. Lucro líquido: <strong>R$ 95.000</strong>.</p>

<h2>As 3 regras de ouro do House Flipping</h2>
<ul>
<li><strong>Regra dos 70%:</strong> Nunca pague mais que 70% do valor pós-reforma, menos os custos de reforma.</li>
<li><strong>Localização é tudo:</strong> Prefira imóveis em bairros com alta demanda e liquidez.</li>
<li><strong>Reforma inteligente:</strong> Foque em cozinha, banheiro e acabamento. São os itens que mais valorizam o imóvel.</li>
</ul>

<h2>Próximos passos</h2>
<p>Se você quer começar no House Flipping, o primeiro passo é encontrar as oportunidades. Use nossa plataforma de busca para filtrar os melhores imóveis da Caixa na sua região.</p>',
                'category_slug'  => 'house-flipping',
                'is_published'   => true,
                'published_at'   => now()->subDays(1),
                'resources'      => [
                    ['title' => 'Guia Completo de House Flipping — PDF', 'file_path' => 'resources/guia-house-flipping.pdf', 'type' => 'pdf'],
                ],
            ],
            [
                'title'          => 'Financiamento de Imóveis da Caixa: Taxas, Prazos e Requisitos em 2026',
                'slug'           => 'financiamento-imoveis-caixa-taxas-prazos-requisitos-2026',
                'hook_excerpt'   => 'Tudo o que você precisa saber sobre as linhas de crédito da Caixa para imóveis retomados, incluindo as taxas mais baixas do mercado.',
                'content'        => '<h2>Linhas de crédito disponíveis</h2>
<p>A Caixa oferece condições especiais de financiamento para imóveis próprios. As principais modalidades são:</p>
<ul>
<li><strong>SBPE (Poupança):</strong> Taxas a partir de 9,99% ao ano + TR</li>
<li><strong>Pró-Cotista (FGTS):</strong> Taxas a partir de 8,66% ao ano + TR</li>
<li><strong>Casa Verde e Amarela:</strong> Subsídios de até R$ 55.000 para renda até R$ 8.000</li>
</ul>

<h2>Requisitos básicos</h2>
<p>Para financiar um imóvel da Caixa, você precisa ter: renda mínima compatível, nome limpo no SPC/Serasa, e entrada mínima de 20% do valor do imóvel.</p>

<h2>Simulação prática</h2>
<p>Imóvel de R$ 200.000 com 20% de entrada (R$ 40.000). Financiamento de R$ 160.000 em 360 meses. Parcela inicial aproximada: R$ 1.800.</p>',
                'category_slug'  => 'financiamento',
                'is_published'   => true,
                'published_at'   => now()->subDays(7),
                'resources'      => [],
            ],
            [
                'title'          => 'Licitações de Imóveis Públicos: Como Participar e Vencer',
                'slug'           => 'licitacoes-imoveis-publicos-como-participar-e-vencer',
                'hook_excerpt'   => 'Além dos leilões, as licitações de concorrência pública são uma porta de entrada pouco explorada para adquirir imóveis com grandes descontos.',
                'content'        => '<h2>O que são as licitações de imóveis?</h2>
<p>São processos de concorrência pública onde a Caixa coloca à venda imóveis retomados. Diferente do leilão, na licitação você envia uma proposta em envelope fechado.</p>

<h2>Vantagens sobre o leilão</h2>
<ul>
<li>Menos concorrência (muitos investidores desconhecem)</li>
<li>Tempo para análise mais detalhada</li>
<li>Possibilidade de financiamento direto</li>
</ul>

<h2>Como participar</h2>
<p>Acompanhe os editais publicados no site da Caixa e nos diários oficiais. Prepare sua documentação com antecedência e envie sua proposta dentro do prazo.</p>',
                'category_slug'  => 'licitacoes',
                'is_published'   => true,
                'published_at'   => now()->subDays(10),
                'resources'      => [
                    ['title' => 'Modelo de Proposta para Licitação', 'file_path' => 'resources/modelo-proposta-licitacao.docx', 'type' => 'template'],
                ],
            ],
            [
                'title'          => 'Guia Prático: Documentação Necessária para Imóveis da Caixa',
                'slug'           => 'guia-pratico-documentacao-necessaria-imoveis-caixa',
                'hook_excerpt'   => 'Lista completa e organizada de todos os documentos que você vai precisar para comprar imóveis retomados pela Caixa — sem surpresas!',
                'content'        => '<h2>Documentos pessoais</h2>
<ul>
<li>RG e CPF (originais e cópias)</li>
<li>Comprovante de estado civil</li>
<li>Comprovante de residência atualizado (últimos 90 dias)</li>
<li>Comprovante de renda dos últimos 3 meses</li>
</ul>

<h2>Documentos do imóvel</h2>
<ul>
<li>Matrícula atualizada (máximo 30 dias)</li>
<li>Certidão de ônus reais</li>
<li>IPTU (verificar débitos)</li>
<li>Certidão de situação do condomínio</li>
</ul>

<h2>Documentos para financiamento</h2>
<ul>
<li>Declaração de Imposto de Renda</li>
<li>Extrato do FGTS (se for usar)</li>
<li>Carteira de trabalho (CLT) ou contrato social (PJ)</li>
</ul>',
                'category_slug'  => 'guias-praticos',
                'is_published'   => true,
                'published_at'   => now()->subDays(3),
                'resources'      => [
                    ['title' => 'Checklist de Documentação — PDF', 'file_path' => 'resources/checklist-documentacao.pdf', 'type' => 'pdf'],
                ],
            ],
        ];

        foreach ($posts as $postData) {
            $resources = $postData['resources'];
            unset($postData['resources']);

            $category = $categories->firstWhere('slug', $postData['category_slug']);
            unset($postData['category_slug']);

            $post = Post::firstOrCreate(
                ['slug' => $postData['slug']],
                array_merge($postData, [
                    'author_id'   => $author->id,
                    'category_id' => $category?->id,
                ])
            );

            foreach ($resources as $resourceData) {
                Resource::firstOrCreate(
                    ['post_id' => $post->id, 'title' => $resourceData['title']],
                    $resourceData
                );
            }
        }

        $this->command->info('✓ Blog seeded: ' . count($posts) . ' posts, ' . $categories->count() . ' categorias.');
    }
}
