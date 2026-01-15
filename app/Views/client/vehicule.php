<?php

session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    require __DIR__ . '/../login.php';
    exit();
}

require_once __DIR__ . '/../../Models/Vehicule.php';
// require_once '../../Models/Categorie.php';

$vehicule = new Vehicule();
$vehicules = $vehicule->getAllVehiculeesDisp();

// $categorie = new Categorie();
// $categories = $categorie->getAllCategorie();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(31, 41, 55, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-gray-950 text-white min-h-screen">

    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-gray-900/90 backdrop-blur-md border-b border-gray-800">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
             <a href="home.php">
                <div class="flex items-center gap-3 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                    MaBagnole
                </span>
            </div>
            </a>

            <div class="hidden md:flex space-x-8 items-center text-sm font-medium text-gray-300">
                <a href="accueil" class="hover:text-blue-400 transition">Accueil</a>
                <a href="vehicule" class="hover:text-blue-400 transition text-blue-400">Véhicules</a>
                
            </div>

            <div class="relative flex items-center">
                <button id="profileDropdownBtn" class="flex items-center gap-3 focus:outline-none group">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-medium text-white"><?= $_SESSION['nom']  ?> <?= $_SESSION['prenom']  ?></p>
                        
                    </div>
                    
                    <i class="fa-solid fa-chevron-down text-xs text-gray-500 group-hover:text-white transition"></i>
                </button>

                <div id="profileDropdownMenu" class="hidden absolute right-0 top-full mt-3 w-48 bg-gray-800 border border-gray-700 rounded-xl shadow-2xl py-2 z-50">
                    
                    <a href="reservation" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition">
                        <i class="fa-solid fa-calendar-check text-blue-400"></i> Mes Réservations
                    </a>
                    <div class="border-t border-gray-700 my-1"></div>
                    <a href="logout" class="flex items-center gap-3 px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-300 transition">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </div>
    </nav>

    <div class="pt-32 pb-10 bg-gradient-to-b from-blue-900/20 to-gray-950">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold mb-2">Trouvez votre <span class="text-blue-500">véhicule idéal</span></h1>
            <p class="text-gray-400">Explorez notre sélection de plus de 50 modèles premium</p>
        </div>
    </div>

    <main class="container mx-auto px-6 pb-20">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-1/4 space-y-8">
                <div class="glass p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-blue-500"></i> Rechercher
                    </h3>
                    <div class="relative">
                        <input type="text" id="carSearch" placeholder="Modèle, marque..." 
                            class="w-full bg-gray-800/50 border border-gray-700 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 p-3 outline-none transition">
                    </div>
                </div>

                <div class="glass p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4">Catégories</h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" checked class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition">Toutes les voitures</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">SUV / 4x4</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">Sport & Luxe</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">Électrique / Hybride</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">Citadine</span>
                        </label>
                    </div>
                </div>

                <div class="glass p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4">Budget (par jour)</h3>
                    <input type="range" min="50" max="500" class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-blue-500">
                    <div class="flex justify-between mt-2 text-xs text-gray-500">
                        <span>50€</span>
                        <span>500€</span>
                    </div>
                </div>
            </aside>

            <div class="w-full lg:w-3/4">
                <div class="flex justify-between items-center mb-8 bg-gray-900/50 p-4 rounded-xl border border-gray-800">
                    <span class="text-sm text-gray-400">Affichage de <span class="text-white font-bold">12</span> véhicules</span>
                    <select class="bg-transparent text-sm text-gray-300 outline-none cursor-pointer focus:text-blue-500">
                        <option class="bg-gray-900">Trier par: Prix croissant</option>
                        <option class="bg-gray-900">Trier par: Prix décroissant</option>
                        <option class="bg-gray-900">Trier par: Nouveautés</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($vehicules as $v) { ?>
                        <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden hover:border-blue-500/40 transition-all duration-300 group flex flex-col h-full shadow-2xl shadow-black/20">
                            
                            <div class="relative h-56 overflow-hidden">
                                <img src="<?= $v->image ?>" alt="<?= $v->modele ?>" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out">
                                
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-lg shadow-lg">
                                        <?= $v->nomCategorie ?>
                                    </span>
                                </div>

                                <div class="absolute bottom-4 right-4 bg-gray-950/80 backdrop-blur-md border border-white/10 px-3 py-1 rounded-xl">
                                    <span class="text-xl font-bold text-white"><?= $v->prixParJour ?>€</span>
                                    <span class="text-[10px] text-gray-400 font-medium">/jour</span>
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="mb-3">
                                    <p class="text-blue-500 text-xs font-bold uppercase tracking-tighter mb-1"><?= $v->marque ?></p>
                                    <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition"><?= $v->modele ?></h3>
                                </div>

                                <p class="text-gray-400 text-sm line-clamp-2 mb-6 italic font-light">
                                    "<?= $v->description ?>"
                                </p>

                                <div class="flex items-center gap-4 mb-6 pt-4 border-t border-gray-800">
                                    <div class="flex items-center gap-1.5 text-gray-500">
                                        <i class="fa-solid fa-layer-group text-blue-500/70 text-xs"></i>
                                        <span class="text-xs"><?= $v->nomCategorie ?></span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-gray-500">
                                        <i class="fa-solid fa-check-double text-green-500/70 text-xs"></i>
                                        <span class="text-xs"><?= $v->statut ?></span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <button onclick="resevationModal(this)"
                                    data-id-vehicule="<?= $v->id_Vehicule ?>"
                                    class="w-full bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-600 hover:to-blue-400 text-white py-3.5 rounded-2xl text-sm font-bold shadow-lg shadow-blue-500/20 transition-all active:scale-95 flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-calendar-days text-xs"></i>
                                        Réserver Maintenant
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </main>
    <footer class="bg-gray-900 border-t border-gray-800 pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <span class="text-xl font-bold text-white">MaBagnole</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Votre partenaire de confiance pour une expérience de conduite inoubliable. Louez la liberté, conduisez le futur.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Liens Rapides</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition">À propos</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Conditions générales</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Carrières</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Newsletter</h4>
                    <p class="text-gray-400 text-sm mb-4">Inscrivez-vous pour recevoir nos offres exclusives.</p>
                    <div class="flex">
                        <input type="email" placeholder="Votre email" class="bg-gray-800 text-white px-4 py-2 rounded-l-lg focus:outline-none focus:ring-1 focus:ring-blue-500 w-full text-sm">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg text-sm font-medium transition">
                            Ok
                        </button>
                    </div>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-pink-600 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-sky-500 hover:text-white transition"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500 text-xs">&copy; 2024 MaBagnole. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    
    <div id="modalReservation" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity">
    
    <div class="bg-slate-900 border border-gray-800 w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden animate-slide-up">
        
        <div class="p-6 border-b border-gray-800 flex justify-between items-center bg-gray-900/50">
            <div>
                <h2 class="text-xl font-bold text-white">Nouvelle Réservation</h2>
               
            </div>
            <button onclick="resevationModal(this)" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-800 text-gray-400 hover:text-white transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="reservationVehicule" method="POST" class="p-6 space-y-5">
            
            <input type="hidden" name="id_user" value="<?= $_SESSION['id_utilisateur'] ?>">
            <input type="hidden" name="id_vehicule" id="vehicule">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-400 uppercase ml-1">Date Début</label>
                    <input type="date" name="dateDebut" class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-400 uppercase ml-1">Date Fin</label>
                    <input type="date" name="dateFin" class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-semibold text-gray-400 uppercase ml-1">Lieu de prise</label>
                <div class="relative">
                    <i class="fa-solid fa-location-dot absolute left-4 top-3.5 text-blue-500 text-xs"></i>
                    <input type="text" name="lieuPrise" placeholder="Ex: Agence Centre" class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl py-3 pl-10 pr-4 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-semibold text-gray-400 uppercase ml-1">Lieu de retour</label>
                <div class="relative">
                    <i class="fa-solid fa-arrow-rotate-left absolute left-4 top-3.5 text-cyan-500 text-xs"></i>
                    <input type="text" name="lieuRetour" placeholder="Ex: Aéroport" class="w-full bg-gray-800 border border-gray-700 text-white rounded-xl py-3 pl-10 pr-4 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="resevationModal(this)" class="flex-1 py-3 bg-gray-800 text-white rounded-xl font-bold hover:bg-gray-700 transition">
                    Annuler
                </button>
                <button type="submit" class="flex-1 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl font-bold hover:shadow-lg hover:shadow-blue-500/30 transition transform active:scale-95">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
    
    <script>
        const btn = document.getElementById('profileDropdownBtn');
    const menu = document.getElementById('profileDropdownMenu');

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });

    // Close menu when clicking outside
    window.addEventListener('click', () => {
        if (!menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    });

    function resevationModal(button) {
        console.log(button.dataset);
        document.getElementById("vehicule").value = button.dataset.idVehicule;

        document.getElementById('modalReservation').classList.toggle('hidden');
        const modal = document.getElementById('catgModal');
    }
    </script>

    </body>
</html>