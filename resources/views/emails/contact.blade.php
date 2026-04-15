<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo messaggio di contatto</title>
    <style>
        body { font-family: 'Open Sans', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 2rem auto; background: #fff; border-top: 4px solid #c5a059; }
        .header { background: #1a3c5a; padding: 1.5rem 2rem; }
        .header h1 { color: #c5a059; font-size: 1.2rem; margin: 0; letter-spacing: 1px; }
        .body { padding: 2rem; }
        .field { margin-bottom: 1.25rem; }
        .field-label { font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #1a3c5a; margin-bottom: 0.35rem; }
        .field-value { font-size: 0.95rem; color: #333; line-height: 1.65; }
        .message-box { background: #f8f6f2; border-left: 3px solid #c5a059; padding: 1rem 1.25rem; }
        .footer { background: #f4f4f4; padding: 1rem 2rem; font-size: 0.8rem; color: #888; text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Nuovo messaggio — Studi Legali Consorziati</h1>
        </div>
        <div class="body">
            <div class="field">
                <div class="field-label">Nome</div>
                <div class="field-value">{{ $contact['name'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email</div>
                <div class="field-value">
                    <a href="mailto:{{ $contact['email'] }}" style="color: #1a3c5a;">{{ $contact['email'] }}</a>
                </div>
            </div>
            <div class="field">
                <div class="field-label">Messaggio</div>
                <div class="field-value message-box">{{ $contact['message'] }}</div>
            </div>
        </div>
        <div class="footer">
            Studi Legali Consorziati &mdash; Via Giuseppe Simili 14, 95129 Catania
        </div>
    </div>
</body>
</html>
