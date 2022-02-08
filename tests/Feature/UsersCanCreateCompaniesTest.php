<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersCanCreateCompaniesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_create_companies()
    {
        // $this->withoutExceptionHandling();
        // Given
        $user = User::factory()->create();
        $company = [
            'name' => 'Company One',
            'email' => 'email@email.com',
            'logo' => new UploadedFile(resource_path('test-files/interacpedia-logo.png'), 'interacpedia-logo.png', null, null, true),
        ];

        // When
        $response = $this->actingAs($user)->post(route('companies.store'), $company);

        // then
        $company['logo'] = 'interacpedia-logo.png';
        $response->assertStatus(201);
        $this->assertDatabaseHas('companies', $company);
        $this->assertTrue(Storage::disk('public')->exists($company['logo']));
    }
}
