<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuova Richiesta di Consulenza</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

    <!-- Wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:40px 0;">
        <tr>
            <td align="center">

                <!-- Container -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px; width:100%; background-color:#ffffff;">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1a3c5a; padding:32px 40px; text-align:center;">
                            <h1 style="margin:0; font-family:Georgia, 'Times New Roman', serif; font-size:22px; font-weight:700; color:#ffffff; letter-spacing:2px; text-transform:uppercase;">
                                Studi Legali Consorziati
                            </h1>
                            <p style="margin:8px 0 0; font-size:12px; color:#c5a059; letter-spacing:3px; text-transform:uppercase;">
                                Nuova Richiesta di Consulenza
                            </p>
                        </td>
                    </tr>

                    <!-- Gold accent line -->
                    <tr>
                        <td style="height:4px; background:linear-gradient(90deg, #c5a059, #dbc08b, #c5a059);"></td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:36px 40px 28px;">

                            <p style="margin:0 0 24px; font-size:15px; color:#333333; line-height:1.7;">
                                È stata ricevuta una nuova richiesta di consulenza dal modulo di contatto del sito web. Di seguito i dettagli:
                            </p>

                            <!-- Data table -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; margin-bottom:28px;">
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e9ecef; font-size:11px; font-weight:700; color:#c5a059; text-transform:uppercase; letter-spacing:2px; width:140px; vertical-align:top;">
                                        Nome
                                    </td>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e9ecef; font-size:14px; color:#333333; line-height:1.5;">
                                        {{ $contact['nome'] }} {{ $contact['cognome'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e9ecef; font-size:11px; font-weight:700; color:#c5a059; text-transform:uppercase; letter-spacing:2px; width:140px; vertical-align:top;">
                                        Email
                                    </td>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e9ecef; font-size:14px; color:#333333; line-height:1.5;">
                                        <a href="mailto:{{ $contact['email'] }}" style="color:#1a3c5a; text-decoration:none;">{{ $contact['email'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e9ecef; font-size:11px; font-weight:700; color:#c5a059; text-transform:uppercase; letter-spacing:2px; width:140px; vertical-align:top;">
                                        Telefono
                                    </td>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e9ecef; font-size:14px; color:#333333; line-height:1.5;">
                                        {{ $contact['telefono'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e9ecef; font-size:11px; font-weight:700; color:#c5a059; text-transform:uppercase; letter-spacing:2px; width:140px; vertical-align:top;">
                                        Area Legale
                                    </td>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e9ecef; font-size:14px; color:#333333; line-height:1.5;">
                                        <strong>{{ $contact['area_label'] }}</strong>
                                    </td>
                                </tr>
                            </table>

                            <!-- Message -->
                            <p style="margin:0 0 8px; font-size:11px; font-weight:700; color:#c5a059; text-transform:uppercase; letter-spacing:2px;">
                                Messaggio
                            </p>
                            <div style="background-color:#f8f9fa; border-left:3px solid #c5a059; padding:16px 20px; margin-bottom:28px;">
                                <p style="margin:0; font-size:14px; color:#333333; line-height:1.75; white-space:pre-line;">{{ $contact['messaggio'] }}</p>
                            </div>

                            <p style="margin:0; font-size:13px; color:#999999; line-height:1.6;">
                                Questa email è stata generata automaticamente dal modulo di contatto del sito web.
                                Per rispondere direttamente al mittente, è sufficiente utilizzare la funzione "Rispondi".
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#10283c; padding:24px 40px; text-align:center;">
                            <p style="margin:0 0 4px; font-size:12px; color:rgba(255,255,255,0.5); line-height:1.5;">
                                &copy; {{ date('Y') }} Studi Legali Consorziati — Via Giuseppe Simili, 14 — 95129 Catania
                            </p>
                            <p style="margin:0; font-size:11px; color:rgba(255,255,255,0.35);">
                                Questa comunicazione è riservata e destinata esclusivamente al destinatario.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
