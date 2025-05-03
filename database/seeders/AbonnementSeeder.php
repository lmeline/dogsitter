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
            'description' => '✅ Recevez des demandes de prestation directement des propriétaires
                            ✅ Affichez votre calendrier et vos disponibilités en temps réel
                            ✅ Échangez facilement via la messagerie intégrée
                            🌟 Mise en avant prioritaire dans les résultats de recherche
                            🎖️ Badge de confiance "Dogsitter Certifié" visible sur votre profil
                            📈 Plus de visibilité, plus de réservations !

                            💶 14,90 € / mois, sans engagement
                            🔐 Abonnement résiliable à tout moment depuis votre espace',
            
        ],
        [
            'nom' => 'Abonnement sur l\'année',
            'prix' => 299.9,
            'description'=>'✅ Recevez des demandes de propriétaires sans limitation
            ✅ Affichez votre planning et gérez vos disponibilités facilement
            ✅ Messagerie directe avec les propriétaires
            🌟 Mise en avant prioritaire dans les résultats de recherche
            🎖️ Badge "Dogsitter Certifié" visible sur votre profil
            📈 Boostez votre visibilité et votre taux de réservation
            
            💶 14,90 € / mois après la période d\’essai
            🔐 Sans engagement – annulation possible à tout moment
            
            🎁 Inscrivez-vous maintenant et profitez de vos 2 premiers mois gratuits !',
            
        ],
        [
            'nom' => 'Pas d\'abonnement',
            'prix'=>0,
            'description'=>'Profitez d\'un mois d\'essai gratuit avec toutes les fonctionnalités de notre abonnement : un profil complet avec photo, description Après ce mois d\'essai, vous pourrez choisir de continuer avec notre offre annuelle avantageuse.',
        ],
        ]);
    }
}
