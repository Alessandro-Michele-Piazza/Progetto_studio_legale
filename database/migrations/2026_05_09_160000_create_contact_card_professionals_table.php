<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_card_professionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_card_id')->constrained('contact_cards')->cascadeOnDelete();
            $table->string('professional_name', 150);
            $table->string('phone', 50);
            $table->string('email', 255);
            $table->string('sede', 255);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $cards = DB::table('contact_cards')->get();

        foreach ($cards as $card) {
            if (! empty($card->professional_name) && ! empty($card->phone) && ! empty($card->email)) {
                DB::table('contact_card_professionals')->insert([
                    'contact_card_id' => $card->id,
                    'professional_name' => $card->professional_name,
                    'phone' => $card->phone,
                    'email' => $card->email,
                    'sede' => 'Sede principale',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if (! empty($card->secondary_professional_name) && ! empty($card->secondary_phone) && ! empty($card->secondary_email)) {
                DB::table('contact_card_professionals')->insert([
                    'contact_card_id' => $card->id,
                    'professional_name' => $card->secondary_professional_name,
                    'phone' => $card->secondary_phone,
                    'email' => $card->secondary_email,
                    'sede' => 'Sede secondaria',
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_card_professionals');
    }
};
