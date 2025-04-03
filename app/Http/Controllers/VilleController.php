<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;

class VilleController extends Controller
{
    public function getVilles(Request $request)
    {
        $csv = Reader::createFromPath(public_path('communes.csv'), 'r');
        $csv->setHeaderOffset(0); 

        $query = strtolower(trim($request->query('query')));

        if (!$query) {
            return response()->json([]);
        }

        $villes = [];
        dd($villes);

        foreach ($csv as $record) {
            if (isset($record['nom_de_la_commune']) && stripos($record['nom_de_la_commune'], $query) !== false) {
                $villes[] = [
                    'nom_de_la_commune' => $record['nom_de_la_commune'],
                    'code_postal' => $record['code_postal'] ?? '',
                ];
            }
        }

        return response()->json($villes);
    }


}
