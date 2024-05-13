<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\UrlMapping;

class UrlShortenerDeleteUrlSuccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Caso de éxito al eliminar una URL acortada existente.
     *
     * @return void
     */
    public function testDeleteUrlSuccess()
    {

        // Simular una solicitud HTTP POST con una URL válida
        $response = $this->postJson('/api/shorten', ['long_url' => 'https://hugee.site']);

        // Simular una solicitud HTTP GET para listar todas las URLs
        $response = $this->getJson('/api/urls');

        // Obtener el ID del primer registro
        $id = $response->json()[0]['id']; // Para el primer registro

        // Simular una solicitud HTTP DELETE para eliminar la URL acortada
        $response = $this->deleteJson('/api/urls/'.$id);

        // Verificar que la respuesta sea 200
        $response->assertStatus(200)
            ->assertJson(['message' => 'URL eliminada correctamente']);
    }
}
