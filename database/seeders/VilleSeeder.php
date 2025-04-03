<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(public_path('communes.csv'), 'r');
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();


        foreach ($records as $record) {
            Ville::create([
                'nom_de_la_commune' => $record['nom_de_la_commune'],
                'code_postal' => $record['code_postal'] ?? '',

            ]);
        }
    }
}
