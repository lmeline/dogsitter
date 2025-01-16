<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $races = [
            'Labrador Retriever',
            'Berger Allemand',
            'Golden Retriever',
            'Bulldog',
            'Beagle',
            'Caniche',
            'Chihuahua',
            'Shih Tzu',
            'Rottweiler',
            'Bouledogue Français',
            'Cocker Spaniel',
            'Schnauzer',
            'Yorkshire Terrier',
            'Dachshund',
            'Mastin Espagnol',
            'Dalmatien',
            'Border Collie',
            'Bichon Frisé',
            'Akita',
            'Chow Chow',
            'Husky Sibérien',
            'Shiba Inu',
            'Pitbull',
            'Jack Russell Terrier',
            'Pug',
            'Weimaraner',
            'Cavalier King Charles Spaniel',
            'Lhassa Apso',
            'Chesapeake Bay Retriever',
            'Boxer',
            'Great Dane',
            'Saint-Bernard',
            'Bernese Mountain Dog',
            'English Setter',
            'American Staffordshire Terrier',
            'Newfoundland',
            'Scottish Terrier',
            'Whippet',
            'Tibetan Mastiff',
            'Vizsla',
            'Shikoku',
            'Papillon',
            'American Bulldog',
            'Basset Hound',
            'Bloodhound',
            'Saluki',
            'Great Pyrenees',
            'American Foxhound',
            'Basenji',
            'Belgian Malinois',
            'Cairn Terrier',
            'Gordon Setter',
            'Dogo Argentino',
            'Fox Terrier',
            'Irish Setter',
            'Norfolk Terrier',
            'Pekingese',
            'Schipperke',
            'Tenterfield Terrier',
        ];

        foreach ($races as $race) {
            DB::table('races')->insert([
                'nom' => $race,
            ]);
        }
    }
}