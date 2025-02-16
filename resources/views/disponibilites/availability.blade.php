@extends('layouts.partials.default-layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Mes disponibilités</h2>

        <!-- Sélection des jours et heures -->
        <div>
            <label>Jour :</label>
            <select id="jour_semaine">
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
                <option value="Samedi">Samedi</option>
                <option value="Dimanche">Dimanche</option>
            </select>

            <label>Heure de début :</label>
            <input type="time" id="heure_debut">

            <label>Heure de fin :</label>
            <input type="time" id="heure_fin">

            <button id="ajouter">Ajouter</button>
        </div>

        <!-- Liste des disponibilités -->
        <ul id="disponibilites-list"></ul>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const list = document.getElementById('disponibilites-list');

            function chargerDisponibilites() {
                fetch('{{ route("disponibilites.index") }}')
                    .then(response => response.json())
                    .then(data => {
                        list.innerHTML = '';
                        data.forEach(dispo => {
                            const li = document.createElement('li');
                            li.textContent = `${dispo.jour_semaine} : ${dispo.heure_debut} - ${dispo.heure_fin}`; 
                            const btn = document.createElement('button');
                            btn.textContent = '❌';
                            btn.onclick = function () { supprimerDisponibilite(dispo.id); };
                            li.appendChild(btn);
                            list.appendChild(li);
                        });
                    });
            }

            function ajouterDisponibilite() {
                const jour_semaine = document.getElementById('jour_semaine').value; 
                const heure_debut = document.getElementById('heure_debut').value;
                const heure_fin = document.getElementById('heure_fin').value;

                fetch('{{ route("disponibilites.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ jour_semaine, heure_debut, heure_fin }) 
                }).then(response => response.json()).then(data => {
                    chargerDisponibilites();
                });
            }

            function supprimerDisponibilite(id) {
                fetch(`/disponibilites/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(() => chargerDisponibilites());
            }

            document.getElementById('ajouter').addEventListener('click', ajouterDisponibilite);
            chargerDisponibilites();
        });
    </script>

@endsection
