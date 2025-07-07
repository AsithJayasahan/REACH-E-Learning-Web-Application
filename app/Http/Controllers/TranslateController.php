<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TranslateController extends Controller
{
    private $key = 'WeVVlrBpoA3mEPH5pBA2D9tPzsxXduzb1nqSwbsRl30nLuphrlRBJQQJ99BFACYeBjFXJ3w3AAAbACOGfh9b';
    private $endpoint = 'https://api.cognitive.microsofttranslator.com';
    private $location = 'eastus';

    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        $text = $request->input('text');

        // If text is empty or just whitespace, return empty
        if (trim($text) === '') {
            return response()->json(['translated_text' => '']);
        }

        $url = $this->endpoint . '/translate';

        try {
            $response = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => $this->key,
                'Ocp-Apim-Subscription-Region' => $this->location,
                'Content-type' => 'application/json',
                'X-ClientTraceId' => \Illuminate\Support\Str::uuid()->toString(),
            ])
            ->withQueryParameters([
                'api-version' => '3.0',
                'from' => 'en',
                'to' => 'si' // Sinhala
            ])
            ->post($url, [
                [
                    'text' => $text
                ]
            ]);

            $result = $response->json();

            if (isset($result[0]['translations'][0]['text'])) {
                return response()->json([
                    'translated_text' => $result[0]['translations'][0]['text']
                ]);
            }

            return response()->json([
                'translated_text' => $text, // Return original if translation fails
                'error' => 'Invalid response structure',
                'response' => $result
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'translated_text' => $text, // Return original on error
                'error' => $e->getMessage()
            ], 500);
        }
    }

        public function index()
    {
        return view('course1');
    }

    public function index1()
    {
        return view('course2');
    }

        public function index3()
    {
        return view('course3');
    }
}
