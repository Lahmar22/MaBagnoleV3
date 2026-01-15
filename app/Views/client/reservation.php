<?php

session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    require __DIR__ . '/../login.php';
    exit();
}

require_once __DIR__ . '/../../Models/Reservation.php';

$reserve = new Reservation();
$reservations = $reserve->getReservation($_SESSION['id_utilisateur']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(31, 41, 55, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="bg-gray-950 text-white min-h-screen">

    <nav class="fixed w-full top-0 z-50 bg-gray-900/90 backdrop-blur-md border-b border-gray-800">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
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
                <a href="vehicule" class="hover:text-blue-400 transition">Véhicules</a>
                
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
    </nav>

    <main class="container mx-auto px-6 pt-32 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10">
            <div>
                <h1 class="text-3xl font-bold mb-2">Mes <span class="text-blue-500">Réservations</span></h1>
                <p class="text-gray-400 text-sm">Gérez vos locations actuelles et consultez votre historique.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="vehicule" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Nouvelle Réservation
                </a>
            </div>
        </div>

        <div class="space-y-6">

            <?php foreach ($reservations as $r){ ?>
                <div class="glass rounded-3xl overflow-hidden p-2 border border-blue-500/30">
                    <div class="flex flex-col lg:flex-row items-center gap-6 p-4">
                        <div class="w-full lg:w-64 h-40 rounded-2xl overflow-hidden shrink-0">
                            <img src="<?=$r->image ?>" alt="<?=$r->marque ?>" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="flex-grow grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-widest text-blue-500 mb-1 block"><?=$r->statut ?></span>
                                <h3 class="text-xl font-bold text-white"><?=$r->modele ?></h3>
                                <p class="text-gray-500 text-sm mt-1"><?=$r->marque ?></p>
                            </div>
                            
                            <div class="flex flex-col justify-center">
                                <div class="flex items-center gap-3 mb-2">
                                    <i class="fa-regular fa-calendar text-gray-400"></i>
                                    <span class="text-sm text-gray-300"><?=$r->dateDebut ?> - <?=$r->dateFin ?></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-location-dot text-gray-400"></i>
                                    <span class="text-sm text-gray-300"><?=$r->lieuPrise ?></span>
                                </div>
                            </div>
                            
                            
                            <div class="flex flex-col justify-center md:items-end">
                                <span class="text-2xl font-bold text-white"><?=$r->prixParJour ?> MAD</span>
                                
                            </div>
                        </div>

                        <div class="flex flex-row lg:flex-col gap-2 w-full lg:w-auto">
                            
                            <form action="anuulerReservation" method="POST">
                                <input type="hidden" name="id_Reservation" value="<?=$r->id_Reservation ?>">
                                <button type="submit" class="flex-1 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white px-4 py-3 rounded-xl text-xs font-bold transition">
                                    Annuler
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

            

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
    </script>

</body>
</html>