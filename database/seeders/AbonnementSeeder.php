<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abonnements_types')->insert([
        [
            'nom' => 'Abonnement par mois ',
            'prix' => 29.99,
            'description' => 'Avec cet abonnement, profitez d\'un profil complet avec photo, description, et avis clients. Vous pouvez publier jusqu\'à 10 annonces actives pour vos services (garde, promenade) et bénéficier d\'une meilleure visibilité dans les résultats de recherche. Accédez également aux statistiques de base et recevez des avis clients.',
            
        ],
        [
            'nom' => 'Abonnement sur l\'année',
            'prix' => 299.9,
            'description'=>'Optez pour cet abonnement et bénéficiez d\'un profil complet avec photo, description et avis clients, ainsi que la possibilité de publier jusqu\'à 10 annonces actives pour vos services (garde, promenade). Profitez d\'une meilleure visibilité dans les résultats de recherche et accédez aux statistiques de base. De plus, en choisissant l\'abonnement annuel, vous obtenez 2 mois offerts sur le prix total !',
            
        ],
        [
            'nom' => 'Pas d\'abonnement',
            'prix'=>0,
            'description'=>'Profitez d\'un mois d\'essai gratuit avec toutes les fonctionnalités de notre abonnement : un profil complet avec photo, description, et avis clients, la possibilité de publier jusqu\'à 10 annonces actives, ainsi qu\'un accès aux statistiques détaillées. Après ce mois d\'essai, vous pourrez choisir de continuer avec notre offre annuelle avantageuse.',
        ],
        ]);
    }
}
