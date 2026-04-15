<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'                 => 'Diritto Civile',
                'slug'                 => 'diritto-civile',
                'description'          => 'L\'area di Diritto Civile si occupa della gestione di controversie tra privati in materia contrattuale, risarcimento danni, successioni ereditarie, locazioni e tutela del patrimonio familiare. Gli Studi Legali Consorziati offrono assistenza qualificata in ogni fase del procedimento, dalla fase stragiudiziale fino alla definizione in sede giudiziale, garantendo la massima tutela degli interessi del cliente.',
                'lawyer_name'          => 'Avv. Marco Ferretti',
                'lawyer_specialization'=> 'Specialista in Diritto Contrattuale e Patrimoniale',
                'lawyer_bio'           => 'L\'Avvocato Marco Ferretti vanta oltre quindici anni di esperienza nel settore del diritto privato, con particolare riferimento alle controversie patrimoniali e contrattuali. Laureato con lode presso l\'Università degli Studi di Catania, ha conseguito una specializzazione in diritto delle obbligazioni e della famiglia. Ha assistito centinaia di clienti privati e aziende nella tutela dei propri diritti patrimoniali, distinguendosi per il rigore metodologico e la capacità di individuare soluzioni efficaci nel pieno rispetto della legge.',
            ],
            [
                'name'                 => 'Diritto Penale',
                'slug'                 => 'diritto-penale',
                'description'          => 'L\'area di Diritto Penale garantisce una difesa qualificata e puntuale in ogni fase del procedimento penale. Lo studio assiste imputati, indagati e persone offese in procedimenti relativi a reati contro la persona, il patrimonio, l\'economia e la pubblica amministrazione, assicurando il pieno rispetto dei diritti e delle garanzie costituzionali riconosciuti ad ogni individuo.',
                'lawyer_name'          => 'Avv. Giulia Marchetti',
                'lawyer_specialization'=> 'Specialista in Difesa Penale e Diritto Processuale',
                'lawyer_bio'           => 'L\'Avvocato Giulia Marchetti è una penalista di riconosciuta esperienza con una consolidata specializzazione nei procedimenti penali complessi. Dopo la laurea con lode e la specializzazione in scienze penalistiche, ha maturato un\'esperienza decennale nella difesa tecnica in procedimenti di medio e alto profilo. La sua metodologia si fonda su un\'analisi rigorosa degli atti processuali e su una difesa strategica personalizzata per ogni assistito. È iscritta alla Camera Penale di Catania.',
            ],
            [
                'name'                 => 'Diritto Amministrativo',
                'slug'                 => 'diritto-amministrativo',
                'description'          => 'L\'area di Diritto Amministrativo tutela i diritti di privati, professionisti e imprese nei confronti della Pubblica Amministrazione. Lo studio assiste i propri clienti in procedimenti di annullamento di atti illegittimi, risarcimento da illecito amministrativo, appalti pubblici, espropriazioni e autorizzazioni urbanistico-edilizie, operando con competenza avanti il TAR e il Consiglio di Stato.',
                'lawyer_name'          => 'Avv. Roberto Esposito',
                'lawyer_specialization'=> 'Specialista in Diritto Pubblico e Contenzioso Amministrativo',
                'lawyer_bio'           => 'L\'Avvocato Roberto Esposito è un esperto di diritto pubblico con pluriennale esperienza nel contenzioso avanti il TAR Sicilia e il Consiglio di Stato. Formatosi presso la Facoltà di Giurisprudenza di Bologna, ha successivamente conseguito un master in diritto amministrativo europeo. Nel corso della sua carriera ha trattato numerosi procedimenti in materia di appalti pubblici, urbanistica e responsabilità della pubblica amministrazione.',
            ],
            [
                'name'                 => 'Diritto del Lavoro',
                'slug'                 => 'diritto-del-lavoro',
                'description'          => 'L\'area di Diritto del Lavoro fornisce assistenza legale completa a lavoratori dipendenti e aziende in materia di rapporti di lavoro subordinato e parasubordinato. Lo studio si occupa di controversie relative a licenziamenti, discriminazioni, mobbing, infortuni sul lavoro, contrattualistica e relazioni sindacali, con un approccio orientato alla tutela concreta del lavoratore.',
                'lawyer_name'          => 'Avv. Sara Colombo',
                'lawyer_specialization'=> 'Specialista in Diritto del Lavoro e Relazioni Industriali',
                'lawyer_bio'           => 'L\'Avvocato Sara Colombo è una delle più affermate giuslavoriste della Sicilia orientale, con una carriera ventennale dedicata alla tutela dei diritti dei lavoratori e alla consulenza alle imprese in materia di lavoro. Dopo la specializzazione in diritto sindacale, ha sviluppato una profonda competenza nelle controversie di lavoro singole e collettive, nei procedimenti di impugnazione del licenziamento e nella gestione dei rapporti di lavoro in sede stragiudiziale.',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
