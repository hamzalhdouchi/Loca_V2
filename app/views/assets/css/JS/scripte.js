let cont = 1;
function ajouterMult() {
    let container = document.getElementById("formA"); 
    let newForm = document.createElement('div');
    newForm.innerHTML = `
    <input type="hidden" name="id" value="${cont}" />
       <div class="relative">
                                    <label for="floating_model" class="text-xs font-medium text-gray-600">Modèle du véhicule</label>
                                    <input type="text" name="model_${cont}" id="floating_model" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. Toyota Corolla" required />
                                </div>

            

                                <!-- Disponibilité -->
                                <div class="relative">
                                
                                    <label for="disponibilite" class="text-xs font-medium text-gray-600">Disponibilité</label>
                                    <select name="disponibilite_${cont}" id="disponibilite" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" required>
                                        <option value="" disabled selected>Disponibilité</option>
                                        <option value="1">Disponible</option>
                                        <option value="0">Non disponible</option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="relative">
                                    <label for="description" class="text-xs font-medium text-gray-600">Description</label>
                                    <textarea name="description_${cont}" id="description" rows="2" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Description du véhicule" required></textarea>
                                </div>

                                <!-- Prix -->
                                <div class="relative">
                                    <label for="prix" class="text-xs font-medium text-gray-600">Prix (en MAD)</label>
                                    <input type="number" name="prix_${cont}" id="prix" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. 250000" required />
                                </div>

                                <!-- Image -->
                                <div class="relative">
                                    <label for="image" class="text-xs font-medium text-gray-600">Image du véhicule</label>
                                    <input type="file" name="image_${cont}" id="image" accept="image/*" class="block w-full mt-1 text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-100 file:text-blue-600 hover:file:bg-blue-200" required />
                                </div>

    `;

    container.appendChild(newForm); 
    cont ++;
}


let conter = 1;
function MultiCa(){
    let category = document.getElementById("formC"); 
    let newcategory = document.createElement('div');

    newcategory.innerHTML = `
    <input type="hidden" name="id_c" value="${conter}">
    <div class="vehicule-entry">

                    <!-- Nom du véhicule -->
                    <div class="relative">
                        <label for="nom" class="text-xs font-medium text-gray-600">Nom du véhicule</label>
                        <input type="text" name="nom_${conter}" id="nom_0" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Ex. Toyota Corolla" required />
                    </div>

                    <!-- Description -->
                    <div class="relative">
                        <label for="description" class="text-xs font-medium text-gray-600">Description</label>
                        <textarea name="description_${conter}" id="description_0" rows="2" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Description du véhicule" required></textarea>
                    </div>
                </div>
    `
    category.appendChild(newcategory); 
    conter++ ;
}


// const modal = document.getElementById('modal');

// function openModalBtn() {


//     modal.classList.remove('hidden');
//     modal.classList.add('flex');
// };
// modal.addEventListener('click', function(e) {
//     if (e.target === modal) {
//         modal.classList.remove('flex');
//         modal.classList.add('hidden');
//     }

//     function showModal(event) {
// event.preventDefault(); // Prevents the form from reloading the page
// const modal = document.getElementById('modalC');
// modal.classList.remove('hidden');
// modal.classList.add('flex');
// }

// });
const modalS = document.getElementById('modal');

function openModalBtn() {


    modalS.classList.remove('hidden');
    modalS.classList.add('flex');
};
modalS.addEventListener('click', function(e) {
    if (e.target === modalS) {
        modalS.classList.remove('flex');
        modalS.classList.add('hidden');
    }
});
const ModaLModifier = document.getElementById('mood');

function showModal(event) {
    event.preventDefault();
    console.log("showModal function triggered");


    ModaLModifier.classList.toggle('hidden');
    ModaLModifier.classList.add('flex');
};
ModaLModifier.addEventListener('click', function(e) {
    if (e.target === ModaLModifier) {
        ModaLModifier.classList.remove('flex');
        ModaLModifier.classList.add('hidden');
    }
});
let contTheme = 1;
// Initialize contTheme globally

function MultiThemes() {
    // Get the container for themes
    const theme = document.getElementById("formTheme");
    if (!theme) {
        console.error("Element with ID 'formTheme' not found.");
        return;
    }

    // Create a new theme container
    const newtheme = document.createElement("div");
    newtheme.className = "relative space-y-4 mt-4";

    // Add inner HTML for new theme
    newtheme.innerHTML = `
        <!-- Hidden Counter -->
        <input type="hidden" value="${contTheme}" name="cont">

        <!-- Nom -->
        <div class="relative">
            <label for="name_${contTheme}" class="text-xs font-medium text-gray-600">Nom</label>
            <input type="text" name="name_${contTheme}" id="name_${contTheme}" 
                class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" 
                placeholder="Entrez le nom" required />
        </div>

        <!-- Description -->
        <div class="relative">
            <label for="description_${contTheme}" class="text-xs font-medium text-gray-600">Description</label>
            <textarea name="description_${contTheme}" id="description_${contTheme}" rows="3" 
                class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" 
                placeholder="Ajoutez une description" required></textarea>
        </div>

        <!-- Date de Création -->
        <div class="relative">
            <label for="created_date_${contTheme}" class="text-xs font-medium text-gray-600">Date de Création</label>
            <input type="date" name="created_date_${contTheme}" id="created_date_${contTheme}" 
                class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" 
                required />
        </div>
    `;

    // Append the new theme to the container
    theme.appendChild(newtheme);

    // Increment the counter
    contTheme++;
}

let contTage = 1;
function MultiTage(){
    const theme = document.getElementById("formTage");
    if (!theme) {
        console.error("Element with ID 'formTheme' not found.");
        return;
    }

    // Create a new theme container
    const newtheme = document.createElement("div");
    newtheme.className = "relative space-y-4 mt-4";

    // Add inner HTML for new theme
    newtheme.innerHTML = `
          <input type="hidden" name="id" value="${contTage}">
             <div class="relative">
                <label for="tag_name" class="text-xs font-medium text-gray-600">Tag Name</label>
                <input type="text" name="tag_name_${contTage}" id="tag_name" class="block w-full mt-1 px-3 py-1 text-sm bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500" placeholder="Enter tag name" required />
            </div>
    `;

    // Append the new theme to the container
    theme.appendChild(newtheme);

    // Increment the counter
    contTage++;
}


function fetchArticles(tagId) {
    
    console.log(tagId);

    if (!tagId) {
        document.getElementById('Tage_cards').innerHTML = '';
        return;
    }

    fetch(`./felterTag.php?tag=${tagId}`)
        .then(response => {
            console.log(response)
            if (!response.ok) {
                throw new Error('Failed to fetch articles');
            }
            return response.json();
        })
        .then(data => {
            const cardsContainer = document.getElementById('Tage_cards');
            cardsContainer.innerHTML = '';

            if (data && data.length > 0) {
                data.forEach(article => {
                    const card = `
              <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
            <img src="./public/img/gallery/1.jpg" alt="Article Image" class="w-full h-48 object-cover">
            <div class="p-6 flex-1">
                <h2 class="text-2xl font-semibold  text-gray-900 mb-4">${article.title}</h2>
                <p class="text-gray-600 mb-4">${article.content}</p>
                <div class="flex flex-wrap gap-2 mb-4">
                   
                        <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">${article.tags}</span>
                    
                </div>
            </div>
            <!-- Learn More Button pinned at the bottom of the card -->
            <div class="mt-auto p-4 border-t border-gray-200">
                <a href="./articleditels.php?id=<?= $row['id'] ?>" class="bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300 w-full text-center block">
                    Learn More
                </a>
            </div>
        </div>
              `;
                    cardsContainer.innerHTML += card;
                });
            } else {
                cardsContainer.innerHTML = '<p class="text-center">No articles found for this tag.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching articles:', error);
            document.getElementById('Tage_cards').innerHTML = '<p class="text-center text-red-500">Error loading articles.</p>';
        });
};


function searchArticles(query) {
    console.log(query);

    if (!query) {
        document.getElementById('Tage_cards').innerHTML = '';
        return;
    }


    fetch(`./searchArticle.php?query=${encodeURIComponent(query)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch articles');
            }
            return response.json();
        })
        .then(data => {
            const cardsContainer = document.getElementById('Tage_cards');
            cardsContainer.innerHTML = '';

            if (data && data.length > 0) {
                data.forEach(article => {
                    const card = `
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                        <img src="./public/img/gallery/1.jpg" alt="Article Image" class="w-full h-48 object-cover">
                        <div class="p-6 flex-1">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-4">${article.title}</h2>
                            <p class="text-gray-600 mb-4">${article.content}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">${article.tags}</span>
                            </div>
                        </div>
                        <div class="mt-auto p-4 border-t border-gray-200">
                            <a href="./articleditels.php?id=${article.id}" class="bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300 w-full text-center block">
                                Learn More
                            </a>
                        </div>
                    </div>
                `;
                    cardsContainer.innerHTML += card;
                });
            } else {
                cardsContainer.innerHTML = '<p class="text-center">No articles found matching your search.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching articles:', error);
            document.getElementById('Tage_cards').innerHTML = '<p class="text-center text-red-500">Error loading articles.</p>';
        });
}
