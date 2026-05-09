<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contact_cards', function (Blueprint $table) {
            $table->string('secondary_professional_name', 150)->nullable()->after('email');
            $table->string('secondary_phone', 50)->nullable()->after('secondary_professional_name');
            $table->string('secondary_email', 255)->nullable()->after('secondary_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_cards', function (Blueprint $table) {
            $table->dropColumn([
                'secondary_professional_name',
                'secondary_phone',
                'secondary_email',
            ]);
        });
    }
};
