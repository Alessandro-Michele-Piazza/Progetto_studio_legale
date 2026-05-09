<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

function validRegistrationPayload(array $overrides = []): array
{
    return array_merge([
        'first_name' => 'Mario',
        'last_name' => 'Rossi',
        'intervention_area' => 'Diritto Civile',
        'sede' => 'Catania',
        'email' => 'mario@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'company_name' => '',
    ], $overrides);
}

test('registration requires recaptcha response when configured', function () {
    config()->set('services.recaptcha.site_key', 'test-site-key');
    config()->set('services.recaptcha.secret_key', 'test-secret-key');

    $response = $this->post(route('register'), validRegistrationPayload());

    $response->assertSessionHasErrors('g-recaptcha-response');
    $this->assertDatabaseMissing('users', ['email' => 'mario@example.com']);
});

test('registration succeeds with valid recaptcha response', function () {
    config()->set('services.recaptcha.site_key', 'test-site-key');
    config()->set('services.recaptcha.secret_key', 'test-secret-key');

    Http::fake([
        'https://www.google.com/recaptcha/api/siteverify' => Http::response(['success' => true], 200),
    ]);

    $response = $this->post(route('register'), validRegistrationPayload([
        'g-recaptcha-response' => 'valid-token',
    ]));

    $response->assertRedirect('/');
    $this->assertDatabaseHas('users', [
        'email' => 'mario@example.com',
        'first_name' => 'Mario',
        'last_name' => 'Rossi',
        'intervention_area' => 'Diritto Civile',
        'sede' => 'Catania',
        'name' => 'Mario Rossi',
    ]);
});

test('registration honeypot blocks suspicious submissions', function () {
    config()->set('services.recaptcha.site_key', null);
    config()->set('services.recaptcha.secret_key', null);

    $response = $this->post(route('register'), validRegistrationPayload([
        'company_name' => 'Spam Bot SRL',
    ]));

    $response->assertSessionHasErrors('company_name');
    expect(User::count())->toBe(0);
});
