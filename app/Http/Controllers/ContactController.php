<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150',
            'email'     => 'required|email|max:150',
            'whatsapp'  => 'required|string|max:20',
            'horario'   => 'nullable|string|max:30',
            'finalidade'=> 'nullable|string|max:60',
            'message'   => 'nullable|string|max:1000',
            'page_name' => 'nullable|string|max:150',
        ]);

        try {
            Mail::send('emails.contact-form', $data, function ($m) use ($data) {
                $subject = "🚀 {$data['name']} - {$data['whatsapp']} - {$data['email']}";
                $m->to(config('app.company_email', 'sac@imoveisdacaixa.com.br'))
                  ->subject($subject)
                  ->replyTo($data['email'], $data['name']);
            });
        } catch (\Throwable $e) {
            Log::error('ContactController: falha ao enviar e-mail', ['error' => $e->getMessage()]);
        }

        // Monta mensagem para o WhatsApp
        $pageName = $data['page_name'] ?? 'Site Imóveis da Caixa';
        $horario  = $data['horario']   ?? 'Não informado';
        $final    = $data['finalidade'] ?? 'Não informado';
        $msg      = $data['message']   ?? '';

        $texto = implode('%0A', [
            "📋 *Novo cadastro — {$pageName}*",
            "",
            "👤 *Nome:* {$data['name']}",
            "📧 *E-mail:* {$data['email']}",
            "📱 *WhatsApp:* {$data['whatsapp']}",
            "🕐 *Horário:* {$horario}",
            "🏠 *Finalidade:* {$final}",
            $msg ? "💬 *Mensagem:* {$msg}" : "",
        ]);

        $whatsapp = preg_replace('/\D/', '', config('app.company_whatsapp', '21997882950'));

        return redirect("https://wa.me/{$whatsapp}?text={$texto}");
    }
}
