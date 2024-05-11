<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UrlMapping; 
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{

    public function shorten(Request $request)
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'long_url' => 'required|url',
        ]);

        // Si la validación falla, devolver errores de validación
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Buscar si ya existe una entrada con la misma URL larga
        $existingUrlMapping = UrlMapping::where('long_url', $request->input('long_url'))->first();

        // Si ya existe, devolver la URL corta asociada a la URL larga existente
        if ($existingUrlMapping) {
            return response()->json(['short_url' => $existingUrlMapping->short_code,'msj' => "💡 La URL ya existe, es esta:"], 200);
        }

        // Si no existe, generar un nuevo código corto único
        $shortCode = $this->generateShortCode();
        
        // Crear una nueva instancia de UrlMapping con la URL larga y el código corto generado
        $urlMapping = new UrlMapping();
        $urlMapping->long_url = $request->input('long_url');
        $urlMapping->short_code = $shortCode;
        $urlMapping->save();

        // Devolver la URL corta generada como respuesta
        return response()->json(['short_url' => $shortCode], 201);

    }

    private function generateShortCode()
    {
        // Genera un código corto único
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $shortCode = '';
        $length = 8; // Longitud del código corto

        // Genera un código corto aleatorio utilizando caracteres alfanuméricos
        for ($i = 0; $i < $length; $i++) {
            $shortCode .= $characters[rand(0, strlen($characters) - 1)];
        }        

        // Verifica si el código corto generado ya existe en la base de datos
        // Si existe, genera uno nuevo hasta que se encuentre un código corto único
        while (UrlMapping::where('short_code', $shortCode)->exists()) {
            $shortCode = '';
            for ($i = 0; $i < $length; $i++) {
                $shortCode .= $characters[rand(0, strlen($characters) - 1)];
            }
        }

        return $shortCode;
    }
    
    public function listUrls()
    {
        // Consultar todas las URL generadas
        $urls = UrlMapping::all();

        // Preparar los datos para la respuesta JSON
        $data = [];
        foreach ($urls as $url) {
            $data[] = [
                'id' => $url->id,
                'short_code' => $url->short_code,
                'long_url' => $url->long_url,
            ];
        }

        // Devolver los datos como respuesta JSON
        return response()->json($data);
    }

    public function deleteUrl($id)
    {
        // Validar que el ID proporcionado sea un número entero
        if (!is_numeric($id)) {
            return response()->json(['error' => 'ID no válido'], 400);
        }

        // Convertir el ID a un número entero para mayor seguridad
        $id = intval($id);

        // Buscar la URL por su ID
        $url = UrlMapping::find($id);

        // Si la URL no existe, devolver un mensaje de error
        if (!$url) {
            return response()->json(['error' => 'URL no encontrada'], 404);
        }

        // Eliminar la URL
        $url->delete();

        // Devolver un mensaje de éxito
        return response()->json(['message' => 'URL eliminada correctamente'], 200);
    }
     
}
