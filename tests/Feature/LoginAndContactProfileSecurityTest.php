<?php

use App\Models\ContactCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

test('login requires recaptcha response', function () {
    config()->set('services.recaptcha.site_key', 'test-site-key');
    config()->set('services.recaptcha.secret_key', 'test-secret-key');

    User::query()->create([
        'name' => 'Mario Rossi',
        'first_name' => 'Mario',
        'last_name' => 'Rossi',
        'intervention_area' => 'Diritto Civile',
        'sede' => 'Catania',
        'email' => 'mario@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'mario@example.com',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors('g-recaptcha-response');
    $this->assertGuest();
});

test('login succeeds only with valid recaptcha response', function () {
    config()->set('services.recaptcha.site_key', 'test-site-key');
    config()->set('services.recaptcha.secret_key', 'test-secret-key');

    $user = User::query()->create([
        'name' => 'Mario Rossi',
        'first_name' => 'Mario',
        'last_name' => 'Rossi',
        'intervention_area' => 'Diritto Civile',
        'sede' => 'Catania',
        'email' => 'mario@example.com',
        'password' => Hash::make('password123'),
    ]);

    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true], 200),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'mario@example.com',
        'password' => 'password123',
        'g-recaptcha-response' => 'valid-token',
        'login_company_name' => '',
    ]);

    $response->assertRedirect('/');
    $this->assertAuthenticatedAs($user);
});

test('guest cannot access contact cards management dashboard', function () {
    $response = $this->get(route('contact-cards.index'));

    $response->assertRedirect(route('login'));
});

test('authenticated user can update one fixed contact card and data persists', function () {
    $user = User::factory()->create([
        'name' => 'Anna Bianchi',
        'first_name' => 'Anna',
        'last_name' => 'Bianchi',
        'intervention_area' => 'Diritto Penale',
        'sede' => 'Messina',
    ]);

    ContactCard::ensureFixedCards();

    $card = ContactCard::query()->where('area_name', 'Diritto Civile')->firstOrFail();

    $response = $this->actingAs($user)->put(route('contact-cards.update', $card), [
        'description' => 'Assistenza completa in diritto civile e contrattualistica.',
        'professionals' => [
            [
                'professional_name' => 'Avv. Anna Maria Bianchi',
                'phone' => '+39 095 111222',
                'email' => 'anna.bianchi@studiolegale.it',
                'sede' => 'Catania',
            ],
            [
                'professional_name' => 'Avv. Luca Verdi',
                'phone' => '+39 095 333444',
                'email' => 'luca.verdi@studiolegale.it',
                'sede' => 'Acireale',
            ],
            [
                'professional_name' => 'Avv. Sara Neri',
                'phone' => '+39 095 777888',
                'email' => 'sara.neri@studiolegale.it',
                'sede' => 'Siracusa',
            ],
        ],
    ]);

    $response->assertRedirect(route('contact-cards.index'));

    $this->assertDatabaseHas('contact_cards', [
        'id' => $card->id,
        'area_name' => 'Diritto Civile',
        'description' => 'Assistenza completa in diritto civile e contrattualistica.',
        'updated_by' => $user->id,
    ]);

    expect($card->professionals()->count())->toBe(3);

    $this->assertDatabaseHas('contact_card_professionals', [
        'contact_card_id' => $card->id,
        'professional_name' => 'Avv. Anna Maria Bianchi',
        'phone' => '+39 095 111222',
        'email' => 'anna.bianchi@studiolegale.it',
        'sede' => 'Catania',
    ]);

    $this->assertDatabaseHas('contact_card_professionals', [
        'contact_card_id' => $card->id,
        'professional_name' => 'Avv. Luca Verdi',
        'phone' => '+39 095 333444',
        'email' => 'luca.verdi@studiolegale.it',
        'sede' => 'Acireale',
    ]);

    ContactCard::ensureFixedCards();

    expect(ContactCard::query()->count())->toBe(4);

    $this->get(route('contatti'))
        ->assertSee('Diritto Civile')
        ->assertSee('Avv. Anna Maria Bianchi')
        ->assertSee('anna.bianchi@studiolegale.it')
        ->assertSee('Avv. Luca Verdi')
        ->assertSee('luca.verdi@studiolegale.it')
        ->assertSee('Avv. Sara Neri')
        ->assertSee('Siracusa');
});
