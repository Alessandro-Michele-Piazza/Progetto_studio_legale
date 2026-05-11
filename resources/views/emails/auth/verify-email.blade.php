{{-- Personalizza qui colori, testi e layout della mail di verifica. --}}
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conferma registrazione</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Open Sans', Arial, Helvetica, sans-serif; color: #1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8f9fa;">
        <tr>
            <td align="center" style="padding: 32px 16px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                    style="max-width: 640px; background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px; overflow: hidden;">
                    <tr>
                        <td
                            style="padding: 28px 32px; text-align: center; background: linear-gradient(135deg, #1a3c5a 0%, #2b689d 100%);">
                            <p
                                style="margin: 0; font-family: Georgia, 'Times New Roman', serif; font-size: 27px; color: #ffffff; letter-spacing: 0.3px;">
                                Studi Legali Consorziati
                            </p>
                            <p
                                style="margin: 10px 0 0; font-size: 12px; color: #dbeafe; letter-spacing: 1.8px; text-transform: uppercase;">
                                Conferma della registrazione
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 34px 32px 24px;">
                            <p
                                style="margin: 0 0 16px; font-size: 20px; line-height: 1.35; font-family: Georgia, 'Times New Roman', serif; color: #1a3c5a;">
                                Ciao {{ $displayName }},
                            </p>

                            <p style="margin: 0 0 14px; font-size: 15px; line-height: 1.7; color: #374151;">
                                grazie per esserti registrato su <strong>Studi Legali Consorziati</strong>.
                                Per attivare il tuo account, conferma il tuo indirizzo email dal pulsante qui sotto.
                            </p>

                            <div style="text-align: center; margin: 28px 0 26px;">
                                <a href="{{ $verificationUrl }}"
                                    style="display: inline-block; padding: 13px 30px; background-color: #1a3c5a; color: #ffffff; text-decoration: none; font-size: 13px; font-weight: 700; letter-spacing: 1.1px; text-transform: uppercase; border-radius: 7px;">
                                    Conferma la mia email
                                </a>
                            </div>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                style="border: 1px solid #e5e7eb; border-left: 4px solid #c5a059; border-radius: 8px; background-color: #fafafa;">
                                <tr>
                                    <td style="padding: 14px 16px; font-size: 14px; line-height: 1.6; color: #374151;">
                                        Questo link rimane valido per <strong>{{ $expiresInMinutes }} minuti</strong>.
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 22px 0 8px; font-size: 14px; color: #4b5563; line-height: 1.6;">
                                Se il pulsante non funziona, copia e incolla questo link nel browser:
                            </p>
                            <p style="margin: 0 0 18px; font-size: 13px; line-height: 1.7; word-break: break-all;">
                                <a href="{{ $verificationUrl }}"
                                    style="color: #2b689d; text-decoration: underline;">{{ $verificationUrl }}</a>
                            </p>

                            <p style="margin: 0; font-size: 13px; line-height: 1.6; color: #6b7280;">
                                Se non hai creato tu questo account, puoi ignorare questa email in sicurezza.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 32px 24px; background-color: #f8f9fa; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; font-size: 13px; line-height: 1.6; color: #4b5563;">
                                Cordiali saluti,<br>
                                <strong style="color: #1a3c5a;">Team Studi Legali Consorziati</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>