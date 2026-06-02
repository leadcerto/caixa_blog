# Contexto Global do Projeto (Blog House Flipping - Imóveis Caixa)

## 1. Identidade do Sistema

- **Nome do Projeto:** Ecossistema de Captação e Educação - Imóveis Caixa (House Flipping)
- **Framework Principal:** PHP / Laravel (Versão mais recente)
- **Banco de Dados:** MySQL
- **Arquitetura:** Monolito Modular (Focado apenas em Inbound Marketing e Gestão Local)
- **Estilo de Frontend:** Blade Templates com TailwindCSS
- **Design System:** A interface deve seguir estritamente a identidade visual da Caixa Econômica Federal:
  - **Azul Primário:** `#0072C6` (Headers, tipografia base e marca)
  - **Laranja Acento:** `#F7941E` (Botões de CTA, links e destaques)
  - **Cores de Suporte:** Branco e tons de cinza para leitura fluida e contraste.

## 2. Visão de Negócio e Mapa da Arquitetura

Este projeto atua no domínio principal da empresa e tem dois pilares estritos de responsabilidade:

1. **Módulo de Educação (Blog):** Focado em SEO, Marketing de Conteúdo e Educação sobre "House Flipping" — especificamente voltado para arrematação, venda direta e licitações de **Imóveis da Caixa Econômica Federal**. O objetivo é atrair tráfego orgânico, educar o usuário e transferi-lo para a plataforma de vendas.
2. **Módulo Google Meu Negócio:** Focado em SEO Local. Um painel interno administrativo para gerenciar escritórios físicos e avaliações do Google.

**⚠️ LIMITADOR DE ESCOPO - CRÍTICO (O que NÃO fazemos aqui):**
O sistema de busca, listagem, preços e detalhes dos imóveis para venda **JÁ EXISTE** e roda de forma independente no subdomínio `venda.imoveisdacaixa.com.br`. NENHUM código relacionado a catálogo de imóveis, carrinho ou checkout deve ser criado neste projeto. O foco aqui é puramente Blog, captação de leads e Gestão de Locais.

## 3. Diretrizes de Estrutura de Conteúdo (Anatomia do Blog)

A arquitetura da informação deve ser otimizada para "escaneabilidade", retenção de leitura e conversão.

- **Macro (Site):** Deve conter categorias claras, seção sobre o autor/empresa, destaques na home e área para recursos (downloads de cartilhas, editais, templates).
- **Micro (Artigo/Post):** O layout deve prever áreas específicas para: Título magnético (H1), Gancho/Hook inicial em destaque, Corpo de texto formatado para Listicles (H2, H3), blocos de Mídia, caixa de Downloads/Recursos (se houver) e um grande Call-To-Action (CTA) no final.
- **Foco do CTA:** Todos os artigos devem culminar em um botão/ação chamativa que convida o leitor a acessar o subdomínio de busca ("Buscar Imóveis da Caixa Agora").

## 4. Regras de Comportamento para os Worker Agents

Se você é uma IA Desenvolvedora lendo este arquivo, você DEVE obedecer às seguintes diretrizes:

- **Isolamento de Escopo:** Execute APENAS as tarefas descritas no seu prompt. O output do Agente A deve servir de input perfeitamente para o Agente B.
- **No Overengineering:** Use recursos nativos do Laravel (Eloquent, Blade).
- **Consistência Visual:** Respeite a paleta da Caixa. A transição visual do Blog para o subdomínio `venda...` deve parecer contínua e natural para o cérebro do usuário.
