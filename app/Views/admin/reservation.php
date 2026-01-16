<?php

session_start();
if (!isset($_SESSION['id_admin'])) {
    require __DIR__ . '/../login.php';
    exit();
}

require_once __DIR__ . '/../../Models/Reservation.php';

$reserve = new Reservation();
$reservations = $reserve->getAllReservation();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reservation - MaBagnole</title>
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
                
                <a href="homeAdmin" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition">
                    <i class="fa-solid fa-car-side"></i> Gestion Flotte
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition">
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
            <a href="logout" class="flex items-center gap-3 text-red-400 hover:text-red-300 transition">
                <i class="fa-solid fa-power-off"></i> Déconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 lg:ml-64 p-8">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white">Reservarions</h1>
               
            </div>
            
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="glass p-6 rounded-2xl">
                <p class="text-gray-400 text-sm">Total Véhicules</p>
                <h3 class="text-3xl font-bold mt-1">48</h3>
                <span class="text-xs text-green-400 font-medium">+2 ce mois-ci</span>
            </div>
            <div class="glass p-6 rounded-2xl">
                <p class="text-gray-400 text-sm">En Location</p>
                <h3 class="text-3xl font-bold mt-1">12</h3>
                <span class="text-xs text-blue-400 font-medium">25% de la flotte</span>
            </div>
            <div class="glass p-6 rounded-2xl">
                <p class="text-gray-400 text-sm">En Maintenance</p>
                <h3 class="text-3xl font-bold mt-1">3</h3>
                <span class="text-xs text-orange-400 font-medium">Vérification requise</span>
            </div>
        </div>

        <div class="glass rounded-2xl overflow-hidden border border-gray-800">
            <div class="overflow-x-auto rounded-xl border border-gray-800 bg-gray-900/50 backdrop-blur-sm">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-800/80 text-gray-400 text-[10px] uppercase tracking-widest border-b border-gray-800">
                        <tr>
                            <th class="px-6 py-5 font-bold">Réf</th> 
                            <th class="px-6 py-5 font-bold">Client & Véhicule</th>  
                            <th class="px-6 py-5 font-bold">Période</th>
                            <th class="px-6 py-5 font-bold">Logistique (Prise/Retour)</th>
                            <th class="px-6 py-5 font-bold">Statut</th>
                            <th class="px-6 py-5 font-bold text-right">Actions rapides</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-800">
                        <?php foreach ($reservations as $r) { 
                            // Logique de couleur pour le statut
                            $statusClass = "text-gray-400 bg-gray-400/10 border-gray-400/20"; // Par défaut
                            if ($r->statut == 'Confirmer') $statusClass = "text-green-400 bg-green-400/10 border-green-400/20";
                            if ($r->statut == 'Annuler') $statusClass = "text-red-400 bg-red-400/10 border-red-400/20";
                            if ($r->statut == 'En attente') $statusClass = "text-amber-400 bg-amber-400/10 border-amber-400/20";
                        ?>
                            <tr class="group hover:bg-blue-500/5 transition-all duration-200">
                                <td class="px-6 py-4">
                                    <span class="text-xs font-mono text-blue-500">#RES-<?= $r->id_Reservation ?></span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-white"><?= $r->nom ?> <?= $r->prenom ?></span>
                                        <span class="text-[11px] text-gray-500 flex items-center gap-1">
                                            <i class="fa-solid fa-car text-[10px]"></i> <?= $r->modele ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-xs space-y-1">
                                        <div class="flex items-center gap-2 text-gray-300">
                                            <i class="fa-regular fa-calendar-plus text-blue-500 w-3"></i>
                                            <span><?= $r->dateDebut ?></span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-500">
                                            <i class="fa-regular fa-calendar-minus text-red-500 w-3"></i>
                                            <span><?= $r->dateFin ?></span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-[11px] text-gray-400">
                                        <p class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-blue-500"></i> <?= $r->lieuPrise ?></p>
                                        <p class="flex items-center gap-2 mt-1"><i class="fa-solid fa-arrow-rotate-left text-gray-600"></i> <?= $r->lieuRetour ?></p>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-md border text-[10px] font-bold uppercase tracking-wider <?= $statusClass ?>">
                                        <?= $r->statut ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form action="updateStatutReserv" method="POST"
                                        class="flex justify-end items-center gap-3">
                                        <input type="hidden" name="id_reseve" value="<?= $r->id_Reservation ?>">

                                        <button>
                                            <select name="statutsResv"
                                                class="bg-gray-800 text-white text-sm px-4 py-2 rounded-lg
                                                    border border-gray-600
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500
                                                    hover:bg-gray-700 transition">
                                                <option value="Confirmer">✅ Confirmer</option>
                                                <option value="Annuler">❌ Annuler</option>
                                            </select>
                                        </button>
                                    </form>  

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    
    
   

    <script>
        
    </script>
</body>
</html>