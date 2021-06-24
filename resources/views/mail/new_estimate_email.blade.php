@include('mail.base_email')

Caro {{ $notifiable->name }}.

<br>

Questo è il tuo preventivo di {{ $estimate->price }} euro:
    <br>
    {{ $estimate->description }}
