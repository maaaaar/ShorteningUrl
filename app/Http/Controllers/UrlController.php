<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UrlController extends Controller
{
    public function acortarUrl(Request $request)
    {
        // Validar y procesar los datos del formulario
        $request->validate([
            'url' => 'required|url',
            'alias' => 'nullable|url',
        ]);

        $urlOriginal = $request->input('url');
        $alias = $request->input('alias');

        // Generar un código único para la URL acortada
        $codigo = substr(md5($urlOriginal), 0, 8);

        // preg_match para coger la url_base
        if (preg_match('/^(.*?.(\w{2,3}))\//is',  $urlOriginal, $dato)) {
            $url_base = $dato[1];

            if (!empty($alias)) {
                $urlAcortada = $alias . '/' . $codigo;
            } else {
                $urlAcortada = $url_base . '/' . $codigo;
            }
        }
        $this->guardarUrlEnJson($codigo, $urlOriginal, $urlAcortada);
        $urls = $this->obtenerUrlsDesdeJson();

        // Mando la url a la pagina index para ver el resultado
        return view('index', ['urlAcortada' => $urlAcortada, 'urls' => $urls]);
    }

    private function guardarUrlEnJson($codigo, $urlOriginal, $urlAcortada)
    {
        $jsonFile = storage_path('urls.json');
        $urls = [];

        if (file_exists($jsonFile)) {
            $jsonContent = file_get_contents($jsonFile);
            if ($jsonContent === false) {
                // Error al leer el archivo JSON
                die("Error al leer el archivo JSON");
            }
            $urls = json_decode($jsonContent, true);
        }

        $urls[] = [
            'codigo' => $codigo,
            'urlOriginal' => $urlOriginal,
            'urlAcortada' => $urlAcortada,
        ];

        file_put_contents($jsonFile, json_encode($urls));
    }

    private function obtenerUrlsDesdeJson()
    {
        $jsonFile = storage_path('urls.json');
        $urls = [];

        if (file_exists($jsonFile)) {
            $jsonContent = file_get_contents($jsonFile);
            if ($jsonContent === false) {
                // Error al leer el archivo JSON
                die("Error al leer el archivo JSON");
            }
            $urls = json_decode($jsonContent, true);
        }

        return $urls;
    }
}
