<?php


session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    require __DIR__ . '/../login.php';
    exit();
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole - Location de Véhicules Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        
        body { font-family: 'Poppins', sans-serif; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        /* Glassmorphism utility */
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 overflow-x-hidden">

    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-gray-900/90 backdrop-blur-md border-b border-gray-800">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                    MaBagnole
                </span>
            </div>

            <div class="hidden md:flex space-x-8 items-center text-sm font-medium text-gray-300">
                <a href="#accueil" class="hover:text-blue-400 transition text-blue-400">Accueil</a>
                <a href="vehicule" class="hover:text-blue-400 transition">Véhicules</a>
                <a href="#features" class="hover:text-blue-400 transition">Services</a>
            </div>

            <div class="relative flex items-center">
                <button id="profileDropdownBtn" class="flex items-center gap-3 focus:outline-none group">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-medium text-white"><?= $_SESSION['nom'] ?> <?= $_SESSION['prenom'] ?></p>
                        
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

   
    <section id="accueil" class="relative pt-32 pb-24 min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Car Background" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/50 via-gray-900/80 to-gray-900"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 fade-in">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-blue-400 font-semibold tracking-wider uppercase text-sm mb-4 block">Location Premium</span>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Conduisez Vos <br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-400">Rêves Aujourd'hui</span>
                </h1>
                <p class="text-lg md:text-xl mb-10 text-gray-300 leading-relaxed">
                    Découvrez notre flotte exclusive de véhicules. Des citadines économiques aux sportives de luxe, nous avons la voiture qu'il vous faut.
                </p>

                
                
            </div>
        </div>
    </section>
    

    <section id="vehicules" class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-4xl font-bold mb-4">Notre Flotte </h2>
                    <p class="text-gray-400">Choisissez le véhicule adapté à votre trajet</p>
                </div>
                <a href="vehicule" class="text-blue-400 hover:text-blue-300 font-medium mt-4 md:mt-0 flex items-center gap-2 group">
                    Voir tout les vehicules 
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-blue-900/20 transition-all duration-300 hover:-translate-y-2 group border border-gray-700">
                    <div class="relative overflow-hidden h-56">
                        
                        <img src="https://media.printler.com/media/photo/157504.jpg?rmode=crop&width=900&height=638" alt="Porsche" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Sport</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Porsche 911 Carrera</h3>
                                <p class="text-gray-400 text-sm">Design iconique & performance</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center py-4 border-t border-gray-700 mb-4">
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-gauge-high"></i>
                                <span class="text-xs">3.2s</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-gears"></i>
                                <span class="text-xs">Auto</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-gas-pump"></i>
                                <span class="text-xs">Essence</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-chair"></i>
                                <span class="text-xs">2 Sièges</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-2xl font-bold text-white">250€</span>
                                <span class="text-gray-500 text-sm">/ jour</span>
                            </div>
                            <button class="bg-gray-700 hover:bg-white hover:text-gray-900 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-blue-900/20 transition-all duration-300 hover:-translate-y-2 group border border-gray-700">
                    <div class="relative overflow-hidden h-56">
                         
                        <img src="https://images.unsplash.com/photo-1609521263047-f8f205293f24?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Range Rover" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-gray-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">SUV</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Range Rover Velar</h3>
                                <p class="text-gray-400 text-sm">Confort ultime & Espace</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-4 border-t border-gray-700 mb-4">
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-fan"></i>
                                <span class="text-xs">A/C</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-gears"></i>
                                <span class="text-xs">Auto</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-gas-pump"></i>
                                <span class="text-xs">Diesel</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-chair"></i>
                                <span class="text-xs">5 Sièges</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-2xl font-bold text-white">120€</span>
                                <span class="text-gray-500 text-sm">/ jour</span>
                            </div>
                            <button class="bg-gray-700 hover:bg-white hover:text-gray-900 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-blue-900/20 transition-all duration-300 hover:-translate-y-2 group border border-gray-700">
                    <div class="relative overflow-hidden h-56">
                        
                        <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Mercedes" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Berline</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Mercedes Classe C</h3>
                                <p class="text-gray-400 text-sm">Élégance & Technologie</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-4 border-t border-gray-700 mb-4">
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-wifi"></i>
                                <span class="text-xs">Wifi</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-gears"></i>
                                <span class="text-xs">Auto</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-bolt"></i>
                                <span class="text-xs">Hybride</span>
                            </div>
                            <div class="flex flex-col items-center gap-1 text-gray-400">
                                <i class="fa-solid fa-chair"></i>
                                <span class="text-xs">5 Sièges</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-2xl font-bold text-white">140€</span>
                                <span class="text-gray-500 text-sm">/ jour</span>
                            </div>
                            <button class="bg-gray-700 hover:bg-white hover:text-gray-900 text-white px-4 py-2 rounded-lg transition-colors font-medium text-sm">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    

    <section id="features" class="py-16 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-white">Pourquoi Choisir <span class="text-blue-500">MaBagnole</span> ?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center group p-6 rounded-xl hover:bg-gray-800 transition duration-300">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-tag text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Prix Compétitifs</h3>
                    <p class="text-gray-400 text-sm">Meilleurs tarifs garantis sans frais cachés.</p>
                </div>
                <div class="text-center group p-6 rounded-xl hover:bg-gray-800 transition duration-300">
                    <div class="w-16 h-16 bg-cyan-500/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-car text-2xl text-cyan-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Flotte Récente</h3>
                    <p class="text-gray-400 text-sm">Véhicules de moins de 2 ans, tout équipés.</p>
                </div>
                <div class="text-center group p-6 rounded-xl hover:bg-gray-800 transition duration-300">
                    <div class="w-16 h-16 bg-purple-500/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-screwdriver-wrench text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Sécurité Garantie</h3>
                    <p class="text-gray-400 text-sm">Contrôle technique complet avant chaque location.</p>
                </div>
                <div class="text-center group p-6 rounded-xl hover:bg-gray-800 transition duration-300">
                    <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-headset text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Support 24/7</h3>
                    <p class="text-gray-400 text-sm">Une assistance routière disponible à tout moment.</p>
                </div>
            </div>
        </div>
    </section>

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
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        });

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });

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