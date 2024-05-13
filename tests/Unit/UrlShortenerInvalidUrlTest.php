<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlShortenerInvalidUrlTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testShortenUrlFailureInvalidUrl()
    {
        // Simular una solicitud HTTP POST con una URL inválida
        $response = $this->postJson('/api/shorten', ['long_url' => 'https://moosquedacordova.com']);

        // Verificar que la respuesta sea 400
        $response->assertStatus(400);

        // Verificar la estructura JSON de la respuesta
        $response->assertJson([
            'errors' => [
                'long_url' => ['La URL no es válida.']
            ]
        ]);
    }

}
