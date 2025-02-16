  document.addEventListener('DOMContentLoaded',function(){
                const villeInput = document.getElementById('villeInput');
                const villeInput2 = document.getElementById('villeInput2');

                const villeContainer = document.getElementById('villeContainer');
                const villeContainer2 = document.getElementById('villeContainer2');

                const codePostalInput = document.getElementById('codePostalInput');
                const codePostalInput2 = document.getElementById('codePostalInput2');

                const searchVilleURL = "{{ route('search.ville') }}";
                let timeout = null;

                function handleVilleClick(event) {
                    const selectedVille = event.target.textContent;
                    const selectedVilleId = event.target.getAttribute('data-id');
                    const selectedCodePostal = event.target.getAttribute('data-code_postal');

                    villeInput.value = selectedVille;
                    villeInput2.value = selectedVille;

                    document.getElementById('villeId').value = selectedVilleId;
                    document.getElementById('villeId2').value = selectedVilleId;

                    codePostalInput.value = selectedCodePostal;
                    codePostalInput2.value = selectedCodePostal;

                    villeContainer.classList.add('hidden');
                    villeContainer2.classList.add('hidden');

                    villeInput.setAttribute('name', 'ville_id');
                    villeInput2.setAttribute('name', 'ville_id');
                }
                
                function fetchville(){
                    const ville = encodeURIComponent(villeInput.value.trim());
                    const URL = `${searchVilleURL}?ville=${ville}`;

                    fetch(URL,{
                        method:'GET',
                        headers:{
                            'Content-Type':'application/json',
                        }
                    })
                    .then(response=> response.json())
                    .then(data=>{
                        console.log(data)
                        villeContainer.innerHTML = '';
                        if(data.length === 0){
                            villeContainer.innerHTML = '<p class="text-gray-500"> Aucun résultat trouvé </p>';
                            return;
                        }
                        villeContainer.classList.remove('hidden');
                        
                        data.forEach(ville => {
                            let li = document.createElement('li');
                            li.textContent = `${ville.nom_de_la_commune } (${ville.code_postal})`;
                            li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                            li.setAttribute('data-id',ville.id);
                            li.setAttribute('data-code_postal', ville.code_postal)
                            console.log(ville.code_postal);
                            li.addEventListener('click', handleVilleClick); 
                            
                            villeContainer.appendChild(li);
                        });

                    })
                    .catch(error=>console.error('Erreur:',error));
                };
                
                function fetchville2() {
                    const ville = encodeURIComponent(villeInput2.value.trim());
                    console.log("cc");
                    const URL = `${searchVilleURL}?ville=${ville}`;

                    fetch(URL, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        villeContainer2.innerHTML = '';
                        if (data.length === 0) {
                            villeContainer2.innerHTML = '<p class="text-gray-500"> Aucun résultat trouvé </p>';
                            return;
                        }
                        villeContainer2.classList.remove('hidden');
                        data.forEach(ville => {
                            let li = document.createElement('li');
                            li.textContent = `${ville.nom_de_la_commune} (${ville.code_postal})`;
                            li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                            li.setAttribute('data-id',ville.id);
                            li.setAttribute('data-code_postal', ville.code_postal)

                            li.addEventListener('click',handleVilleClick);
                            

                            villeContainer2.appendChild(li);
                        });
                    })
                    .catch(error => console.error('Erreur:', error));
                };

                villeInput2.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(fetchville2,500);
                });


                villeInput.addEventListener('input',function(){
                    clearTimeout(timeout);
                    timeout = setTimeout(fetchville,500);
                })

            });



             <div class="flex w-full gap-2 mt-4">
                        <div class="relative">
                            <x-input-label for="ville" :value="__('City')" />
                            <input id="villeInput2" type="text" 
                                    class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500">
                            <ul id="villeContainer2" class="hidden absolute mt-1 w-full max-h-[18.8rem] top-[2.3rem] rounded bg-white dark:bg-zinc-600 ring-1 ring-zinc-300 dark:ring-zinc-400 overflow-y-auto z-10 shadow-lg"></ul>
                            <input type="hidden" id="villeId2" name="ville_id">
                        </div>
                    
                        <!-- Champ du code postal -->
                        <div class="relative">
                            <x-input-label for="code_postal" :value="__('Postal code')" />
                            <input id="codePostalInput2" name="code_postal" 
                                    class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" readonly>
                        </div>
                    </div>