<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: Arial, sans-serif; background:#f5f5f5; margin:0; padding:20px; color:#333; }
  .card { background:#fff; border-radius:8px; max-width:600px; margin:0 auto; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.08); }
  .header { background:#0072C6; padding:24px 28px; }
  .header h1 { color:#fff; margin:0; font-size:20px; }
  .header p { color:rgba(255,255,255,.8); margin:4px 0 0; font-size:13px; }
  .body { padding:28px; }
  .row { margin-bottom:14px; }
  .label { font-size:12px; font-weight:bold; color:#888; text-transform:uppercase; letter-spacing:.05em; margin-bottom:3px; }
  .value { font-size:15px; color:#222; }
  .section-title { font-size:13px; font-weight:bold; color:#0072C6; text-transform:uppercase; letter-spacing:.08em; border-bottom:2px solid #e8f0fe; padding-bottom:6px; margin:22px 0 14px; }
  .message-box { background:#f9fafb; border:1px solid #e5e7eb; border-radius:6px; padding:14px; font-size:14px; color:#444; line-height:1.6; }
  .footer { background:#f0f4f8; padding:16px 28px; font-size:12px; color:#888; text-align:center; }
  a { color:#0072C6; }
</style>
</head>
<body>
<div class="card">

  <div class="header">
    <h1>📋 Novo cadastro recebido</h1>
    <p>O usuário(a) <strong>{{ $name }}</strong> fez um cadastro pelo site <strong>Imóveis da Caixa</strong>
       pelo formulário da página: <strong>{{ $page_name ?? 'Venda de Imóveis da CAIXA' }}</strong></p>
  </div>

  <div class="body">

    <div class="section-title">📌 Informações de contato</div>

    <div class="row">
      <div class="label">Cliente</div>
      <div class="value">{{ $name }}</div>
    </div>
    <div class="row">
      <div class="label">E-mail</div>
      <div class="value"><a href="mailto:{{ $email }}">{{ $email }}</a></div>
    </div>
    <div class="row">
      <div class="label">Telefone / WhatsApp</div>
      <div class="value"><a href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}">{{ $whatsapp }}</a></div>
    </div>
    <div class="row">
      <div class="label">Melhor horário</div>
      <div class="value">{{ $horario ?? '—' }}</div>
    </div>
    <div class="row">
      <div class="label">Finalidade do imóvel</div>
      <div class="value">{{ $finalidade ?? '—' }}</div>
    </div>
    <div class="row">
      <div class="label">Página de origem</div>
      <div class="value">{{ $page_name ?? 'Venda de Imóveis da CAIXA' }}</div>
    </div>

    @if($message)
    <div class="section-title">✉️ Mensagem</div>
    <div class="message-box">{{ $message }}</div>
    @endif

  </div>

  <div class="footer">
    Imóveis da Caixa LTDA — CNPJ 50.563.863/0001-45 — CRECI 10.234/RJ<br>
    <a href="https://imoveisdacaixa.com.br">imoveisdacaixa.com.br</a>
  </div>

</div>
</body>
</html>
