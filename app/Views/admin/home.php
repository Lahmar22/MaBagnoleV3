<?php
require_once '../../Models/Vehicule.php';
require_once '../../Models/Categorie.php';

$vehicule = new Vehicule();
$vehicules = $vehicule->getAllVehiculees();

$totalVehicule = $vehicule->getContVehicule();

$categorie = new Categorie();
$categories = $categorie->getAllCategorie();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #0f172a; }
        .glass { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="text-gray-200 min-h-screen flex">

    <aside class="w-64 border-r border-gray-800 hidden lg:flex flex-col fixed h-full bg-slate-900 z-50">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center text-white">
                    <i class="fa-solid fa-car"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-white">MaBagnole <span class="text-blue-500">Admin</span></span>
            </div>

            <nav class="space-y-2">
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fa-solid fa-car-side"></i> Gestion Flotte
                </a>
                <a href="reservation.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fa-solid fa-calendar-check"></i> Réservations
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fa-solid fa-users"></i> Utilisateurs
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fa-solid fa-chart-line"></i> Rapports
                </a>
            </nav>
        </div>
        <div class="mt-auto p-6 border-t border-gray-800">
            <a href="../../Controllers/logout.php" class="flex items-center gap-3 text-red-400 hover:text-red-300 transition">
                <i class="fa-solid fa-power-off"></i> Déconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 lg:ml-64 p-8">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white">Gestion de la Flotte</h1>
               
            </div>
            <div class="flex gap-3">
                <button onclick="toggleModal()" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter un Véhicule
            </button>
            <button onclick="toggleModalCatg()" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter un Catégorie
            </button>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="glass p-6 rounded-2xl">
                <p class="text-gray-400 text-sm">Total Véhicules</p>
                <h3 class="text-3xl font-bold mt-1"><?=$totalVehicule?></h3>
                
            </div>
            <div class="glass p-6 rounded-2xl">
                <p class="text-gray-400 text-sm">En Location</p>
                <h3 class="text-3xl font-bold mt-1"><?=$totalVehicule?></h3>
                <span class="text-xs text-blue-400 font-medium"></span>
            </div>
                 
        </div>

        <div class="glass rounded-2xl overflow-hidden border border-gray-800">
            <div class="overflow-x-auto rounded-xl border border-gray-800 bg-gray-900/50 backdrop-blur-sm">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800/80 text-gray-400 text-xs uppercase tracking-widest border-b border-gray-800">
                        <tr>
                            <th class="px-6 py-5 font-bold">Véhicule</th> 
                            <th class="px-6 py-5 font-bold">Catégorie</th>  
                            <th class="px-6 py-5 font-bold">Prix / Jour</th>
                            <th class="px-6 py-5 font-bold max-w-xs">Description</th>
                            <th class="px-6 py-5 font-bold">Statut</th>
                            <th class="px-6 py-5 font-bold text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-800">
                        <?php
                        foreach ($vehicules as $v) {
                            // Logic for Status Colors
                            $statusColor = 'bg-green-500/10 text-green-500 border-green-500/20';
                            if ($v->statut === 'Disponible')
                                $statusColor = 'bg-blue-500/10 text-blue-500 border-blue-500/20';
                            if ($v->statut == 'reserver')
                                $statusColor = 'bg-orange-500/10 text-orange-500 border-orange-500/20';
                            ?>
                            <tr class="group hover:bg-blue-500/5 transition-all duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <img src="<?= $v->image ?>" class="w-12 h-12 rounded-xl object-cover border border-gray-700 group-hover:border-blue-500/50 transition" alt="<?= $v->marque ?>">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-white text-sm leading-none"><?= $v->modele ?></p>
                                            <p class="text-[11px] text-gray-500 mt-1.5 uppercase tracking-tighter"><?= $v->marque ?></p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-gray-300 text-sm bg-gray-800 px-3 py-1 rounded-lg border border-gray-700">
                                        <?= $v->nomCategorie ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-blue-400 font-bold text-lg"><?= $v->prixParJour ?></span>
                                        <span class="text-gray-500 text-[10px] uppercase font-bold">MAD</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 max-w-xs">
                                    <p class="text-gray-400 text-sm truncate hover:text-clip hover:whitespace-normal transition-all cursor-help" title="<?= $v->description ?>">
                                        <?= $v->description ?>
                                    </p>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="<?= $statusColor ?> border text-[10px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                                        <?= $v->statut ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-3">
                                        <button title="Modifier" onclick="toggleModalupdate(this)"
                                            data-id-vehicule="<?= $v->id_Vehicule ?>"
                                            data-modele="<?= $v->modele ?>"
                                            data-marque="<?= $v->marque ?>"
                                            data-id-categorie="<?= $v->id_Categorie ?>"
                                            data-prix-Par-Jour="<?= $v->prixParJour ?>"
                                            data-image="<?= $v->image ?>" 
                                            data-description="<?= $v->description ?>" 
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-all shadow-sm">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>
                                        <form action="../../Controllers/supprimerVehicule.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet Vehicule ?');">
                                            <input type="hidden" name="id_Vehicule" value="<?= $v->id_Vehicule ?>">
                                            <button type="submit" title="Supprimer" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="carModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-slate-900 border border-gray-800 w-full max-w-2xl rounded-3xl p-8 shadow-2xl animate-slide-up">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">Ajoute Véhicule</h2>
                <button onclick="toggleModal()" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <form action="../../Controllers/ajouterVehicule.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Nom du modèle</label>
                    <input type="text" name="modele" placeholder="Ex: Mercedes AMG" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Marque</label>
                    <input type="text" name="marque" placeholder="Ex: Mercedes AMG" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Catégorie</label>
                    <select name="categorie" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <option>---Catégorie---</option>
                       <?php foreach ($categories as $c){ ?>
                            <option value="<?= $c->id_Categorie ?>"><?= $c->nomCategorie ?></option>
                        <?php } ?>
                        
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Prix par jour (€)</label>
                    <input type="text" name="prixParJour" placeholder="120" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm text-gray-400">Image (URL)</label>
                    <input type="text" name="image" placeholder="https://..." class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm text-gray-400">Description</label>
                    <textarea rows="3" name="description" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="md:col-span-2 flex gap-3 mt-4">
                    <button type="button" onclick="toggleModal()" class="flex-1 py-3 bg-gray-800 rounded-xl font-bold hover:bg-gray-700 transition">Annuler</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 rounded-xl font-bold hover:bg-blue-500 shadow-lg shadow-blue-500/20 transition">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <div id="updateModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-slate-900 border border-gray-800 w-full max-w-2xl rounded-3xl p-8 shadow-2xl animate-slide-up">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">Modifier Véhicule</h2>
                <button onclick="toggleModalupdate(this)" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <form action="../../Controllers/modifierVehicule.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" id="id_vehicule" name="id_vehicule">
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Nom du modèle</label>
                    <input type="text" name="modele" id="modele" placeholder="Ex: Mercedes AMG" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Marque</label>
                    <input type="text" name="marque" id="marque" placeholder="Ex: Mercedes AMG" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Catégorie</label>
                    <select name="categorie" id="categorie" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <option>---Catégorie---</option>
                       <?php foreach ($categories as $c){ ?>
                            <option value="<?= $c->id_Categorie ?>"><?= $c->nomCategorie ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm text-gray-400">Prix par jour</label>
                    <input type="text" name="prixParJour" id="prixjour" placeholder="120" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm text-gray-400">Image (URL)</label>
                    <input type="text" name="image" id="image" placeholder="https://..." class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm text-gray-400">Description</label>
                    <textarea rows="3" name="description" id="description" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="md:col-span-2 flex gap-3 mt-4">
                    <button type="button" onclick="toggleModalupdate(this)" class="flex-1 py-3 bg-gray-800 rounded-xl font-bold hover:bg-gray-700 transition">Annuler</button>
                    <button type="submit" class="flex-1 py-3 bg-blue-600 rounded-xl font-bold hover:bg-blue-500 shadow-lg shadow-blue-500/20 transition">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <div id="catgModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-slate-900 border border-gray-800 w-full max-w-2xl rounded-3xl p-8 shadow-2xl animate-slide-up">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">Ajoute Catégorie</h2>
                <button onclick="toggleModalCatg()" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            
            <form action="../../Controllers/ajouterCategorie.php" method="POST" class="flex flex-col gap-6">
                <div class="space-y-2">
                    <label class="text-sm text-gray-400 font-medium ml-1">Nom de la Catégorie</label>
                    <div class="relative">
                        <input type="text" name="categorie" placeholder="Ex: Sport, SUV, Électrique..." 
                            class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3.5 text-sm text-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm text-gray-400 font-medium ml-1">Description de la Catégorie</label>
                    <textarea name="descriptionCategorie" rows="4" placeholder="Décrivez les caractéristiques de cette catégorie..." 
                    class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3.5 text-sm text-white outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-4">
                    <button type="button" onclick="toggleModalCatg()" 
                        class="w-full sm:w-1/2 py-3.5 bg-gray-800 text-gray-300 rounded-xl font-bold hover:bg-gray-700 hover:text-white transition order-2 sm:order-1">
                        Annuler
                    </button>
                    <button type="submit" 
                        class="w-full sm:w-1/2 py-3.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-xl font-bold hover:from-blue-500 hover:to-cyan-500 shadow-lg shadow-blue-500/20 transition transform hover:scale-[1.02] order-1 sm:order-2">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('carModal');
            modal.classList.toggle('hidden');
        }

        function toggleModalupdate(button) {
            document.getElementById("id_vehicule").value = button.dataset.id_Vehicule;
            document.getElementById("modele").value = button.dataset.modele;
            document.getElementById("marque").value = button.dataset.marque;
            document.getElementById("categorie").value = button.dataset.idCategorie;
            document.getElementById("prixjour").value = button.dataset.prixParJour;
            document.getElementById("image").value = button.dataset.image;
            document.getElementById("description").value = button.dataset.description;

            const modal = document.getElementById('updateModal');
            modal.classList.toggle('hidden');
        }
        function toggleModalCatg() {
            const modal = document.getElementById('catgModal');
            modal.classList.toggle('hidden');
        }
    </script>
</body>
</html>