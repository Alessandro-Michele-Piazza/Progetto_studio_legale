<?php

namespace Database\Seeders;

use App\Models\ContactCard;
use Illuminate\Database\Seeder;

class ContactCardSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ContactCard::ensureFixedCards();
    }
}
