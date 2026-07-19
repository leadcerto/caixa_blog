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
         style="width:72px; height:72px; filter: drop-shadow(0 4px 14px rgba(0,0,0,0.35));">
</a>
