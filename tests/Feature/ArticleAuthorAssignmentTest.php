<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the available authors in the article creation form', function () {
    $creator = User::factory()->create(['name' => 'Utente Creatore']);
    $author = User::factory()->create(['name' => 'Autore Disponibile']);

    Category::create([
        'name' => 'Diritto Civile',
        'slug' => 'diritto-civile',
        'description' => 'Descrizione di test per la categoria.',
        'lawyer_name' => 'Avv. Test',
        'lawyer_specialization' => 'Diritto Civile',
        'lawyer_bio' => 'Biografia di test per l\'avvocato.',
    ]);

    $this->actingAs($creator)
        ->get(route('articoli.create'))
        ->assertOk()
        ->assertSee('Autore')
        ->assertSee('Autore Disponibile');
});

it('requires an author when storing an article', function () {
    $creator = User::factory()->create();
    $category = Category::create([
        'name' => 'Diritto Penale',
        'slug' => 'diritto-penale',
        'description' => 'Descrizione di test per la categoria.',
        'lawyer_name' => 'Avv. Test',
        'lawyer_specialization' => 'Diritto Penale',
        'lawyer_bio' => 'Biografia di test per l\'avvocato.',
    ]);

    $response = $this->actingAs($creator)
        ->from(route('articoli.create'))
        ->post(route('articoli.store'), [
            'title' => 'Articolo senza autore',
            'body' => '<p>' . str_repeat('Contenuto valido ', 4) . '</p>',
            'category_id' => $category->id,
        ]);

    $response
        ->assertRedirect(route('articoli.create'))
        ->assertSessionHasErrors('author_id');

    expect(Article::count())->toBe(0);
});

it('stores the selected author and exposes the article to the existing author filter', function () {
    $creator = User::factory()->create(['name' => 'Editor']);
    $selectedAuthor = User::factory()->create(['name' => 'Autore Selezionato']);
    $otherAuthor = User::factory()->create(['name' => 'Altro Autore']);
    $category = Category::create([
        'name' => 'Diritto del Lavoro',
        'slug' => 'diritto-del-lavoro',
        'description' => 'Descrizione di test per la categoria.',
        'lawyer_name' => 'Avv. Test',
        'lawyer_specialization' => 'Diritto del Lavoro',
        'lawyer_bio' => 'Biografia di test per l\'avvocato.',
    ]);

    Article::create([
        'user_id' => $otherAuthor->id,
        'category_id' => $category->id,
        'title' => 'Articolo altro autore',
        'slug' => 'articolo-altro-autore',
        'body' => '<p>Contenuto di test per altro autore.</p>',
        'reading_time' => 1,
        'published_at' => now(),
    ]);

    $response = $this->actingAs($creator)
        ->post(route('articoli.store'), [
            'title' => 'Articolo con autore assegnato',
            'body' => '<p>' . str_repeat('Contenuto valido ', 6) . '</p>',
            'category_id' => $category->id,
            'author_id' => $selectedAuthor->id,
        ]);

    $article = Article::query()
        ->where('title', 'Articolo con autore assegnato')
        ->firstOrFail();

    $response->assertRedirect(route('articoli.show', $article));

    expect($article->user_id)->toBe($selectedAuthor->id);

    $this->get(route('articoli.index', ['author_id' => $selectedAuthor->id]))
        ->assertOk()
        ->assertSee('Articolo con autore assegnato')
        ->assertDontSee('Articolo altro autore');
});