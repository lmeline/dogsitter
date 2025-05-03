<x-app-layout>
    <div class="container">
        <h2>Créer une prestation</h2>
    
        <form action="{{ route('prestations.store') }}" method="POST">
            @csrf
    
            <!-- Champ de sélection de la prestation -->
            <div class="form-group">
                <label for="prestation_type">Type de prestation</label>
                <select id="ddlPrestation" name="prestation" class="mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                    <option value="" data-duree="60">Sélectionner une prestation</option>
                    @foreach ($dogsitter->prestationtypes as $prestationType)
                        @php
                            $heures = floor($prestationType->pivot->duree / 60);
                            $minutes = $prestationType->pivot->duree % 60;
                        @endphp
                        <option 
                            data-duree="{{ $prestationType->pivot->duree }}" 
                            data-prix="{{ $prestationType->pivot->prix }}" 
                            value="{{ $prestationType->id }}">
                            {{ $prestationType->nom }} - {{ sprintf('%0d', $heures) }}h{{ sprintf('%02d', $minutes) }}, {{ number_format($prestationType->pivot->prix, 2) }}€
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Champ de sélection du chien -->
            <div class="form-group">
                <label for="dog">Choisir le chien</label>
                <select id="ddlDog" name="dog" class="block mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                    <option value="">Sélectionner un chien</option>
                    @foreach(Auth::user()->dogs as $dog)
                        <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Champ de sélection de la date avec Flatpickr -->
            <div class="form-group">
                <label for="date">Date de prestation</label>
                <input type="text" id="datepicker" name="date" class="form-control" placeholder="Sélectionner une date" required>
            </div>
        
            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Créer la prestation</button>
        </form>
    </div>
    
    <!-- Initialisation de Flatpickr pour le champ de date -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const disponibilites = @json($disponibilitesFormatees); 

            console.log(disponibilites); 

            const datesDisponibles = disponibilites.map(d => d.date);

            console.log(datesDisponibles); 

            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",   
                minDate: "today",           
                altInput: true,        
                altFormat: "F j, Y",  
                disableMobile: true,   
                "locale": {
                    "firstDayOfWeek": 1,
                },
                "disable": [
                    function (date) {
                        const localDate = date.getFullYear() + "-" +
                                        String(date.getMonth() + 1).padStart(2, '0') + "-" +
                                        String(date.getDate()).padStart(2, '0');
                        return !datesDisponibles.includes(localDate);
                    }
                ],
            });
        });
      

    </script>
    </x-app-layout>
    