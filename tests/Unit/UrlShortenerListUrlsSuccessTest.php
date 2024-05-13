<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\UrlMapping;
use Tests\AssertableJson;

class UrlShortenerListUrlsSuccessTest extends TestCase
{
    /**
     * Caso de éxito al listar todas las URLs acortadas.
     *
     * @return void
     */
    public function testListUrlsSuccess()
    {

        // Simular una solicitud HTTP GET para listar todas las URLs
        $response = $this->getJson('/api/urls');

        // Verificar que la respuesta sea un código de estado HTTP 200
        $response->assertStatus(200);

        // Verificar la estructura JSON de la respuesta
        $response->assertJsonStructure([
            '*' => ['id', 'short_code', 'long_url'],
        ]);

    }
}
