<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Serviço de integração com a API do Google Business Profile.
 *
 * Documentação: https://developers.google.com/my-business/reference/rest
 *
 * NOTA: Para funcionar em produção, será necessário:
 * 1. Criar projeto no Google Cloud Console
 * 2. Habilitar a Business Profile API
 * 3. Configurar OAuth 2.0 com escopo: https://www.googleapis.com/auth/business.manage
 * 4. Definir as variáveis de ambiente:
 *    - GOOGLE_BUSINESS_CLIENT_ID
 *    - GOOGLE_BUSINESS_CLIENT_SECRET
 *    - GOOGLE_BUSINESS_REFRESH_TOKEN
 *    - GOOGLE_BUSINESS_ACCOUNT_ID
 */
class GoogleBusinessService
{
    private string $baseUrl = 'https://mybusinessbusinessinformation.googleapis.com/v1';
    private string $reviewsUrl = 'https://mybusiness.googleapis.com/v4';

    /**
     * Busca as avaliações de um local no Google Business Profile.
     *
     * @param string $googleLocationId  ID do local (ex: "accounts/{accountId}/locations/{locationId}")
     * @return array  Lista de reviews com campos: reviewId, reviewer.displayName, starRating, comment, createTime, reviewReply
     */
    public function fetchReviews(string $googleLocationId): array
    {
        // TODO: Implementar autenticação OAuth 2.0 real
        // O fluxo será:
        //
        // 1. Obter access_token via refresh_token:
        //    $tokenResponse = Http::post('https://oauth2.googleapis.com/token', [
        //        'client_id'     => config('services.google_business.client_id'),
        //        'client_secret' => config('services.google_business.client_secret'),
        //        'refresh_token' => config('services.google_business.refresh_token'),
        //        'grant_type'    => 'refresh_token',
        //    ]);
        //
        // 2. Chamar a API de Reviews:
        //    $response = Http::withToken($accessToken)
        //        ->get("{$this->reviewsUrl}/{$googleLocationId}/reviews", [
        //            'pageSize' => 50,
        //            'orderBy'  => 'updateTime desc',
        //        ]);
        //
        // 3. Retornar array de reviews parseados:
        //    return $response->json('reviews', []);

        Log::info("GoogleBusinessService::fetchReviews - Chamada simulada para location: {$googleLocationId}");

        // Retorno mockado para desenvolvimento
        return [];
    }

    /**
     * Envia uma resposta do administrador a uma avaliação do Google.
     *
     * @param string $googleReviewId  ID completo da review (ex: "accounts/.../locations/.../reviews/{reviewId}")
     * @param string $replyText       Texto da resposta do administrador
     * @return bool  Sucesso ou falha
     */
    public function replyToReview(string $googleReviewId, string $replyText): bool
    {
        // TODO: Implementar envio real da resposta
        // O fluxo será:
        //
        // $response = Http::withToken($accessToken)
        //     ->put("{$this->reviewsUrl}/{$googleReviewId}/reply", [
        //         'comment' => $replyText,
        //     ]);
        //
        // return $response->successful();

        Log::info("GoogleBusinessService::replyToReview - Resposta simulada para review: {$googleReviewId}");
        Log::info("Texto da resposta: {$replyText}");

        return true;
    }
}
