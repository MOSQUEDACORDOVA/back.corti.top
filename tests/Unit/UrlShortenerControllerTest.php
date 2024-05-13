<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\UrlMapping;

class UrlShortenerControllerTest extends TestCase
{

    /**
     * Caso de éxito para acortar una URL válida.
     *
     * @return void
    */
   
    public function testShortenUrlSuccess()
    {
        // Simular una solicitud HTTP POST con una URL válida
        $response = $this->postJson('/api/shorten', ['long_url' => 'https://mosquedacordova.com']);

        // Obtener el código de estado de la respuesta
        $statusCode = $response->getStatusCode();

        // Verificar que el código de estado sea 200 o 201
        $this->assertTrue($statusCode === 200 || $statusCode === 201, 'El código de estado debe ser 200 o 201');
        
        // Verificar la estructura JSON de la respuesta
        $response->assertJsonStructure(['short_url']);
        
        // Verificar que se haya guardado en la base de datos
        $this->assertDatabaseHas('url_mappings', ['long_url' => 'https://mosquedacordova.com']);
    }

}
