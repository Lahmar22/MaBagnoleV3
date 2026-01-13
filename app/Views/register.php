<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Poppins', sans-serif; }

        /* Glassmorphism Effect */
        .glass {
            background: rgba(30, 41, 59, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-slide-up {
            animation: slideUp 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center relative overflow-hidden py-10">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1493238792000-8113da705763?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
             alt="Car Driving" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-tl from-gray-900 via-gray-900/85 to-blue-900/50"></div>
    </div>


    <div class="container px-4 z-10 w-full max-w-lg animate-slide-up">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 text-white shadow-lg shadow-blue-500/30 mb-4 text-xl">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Rejoignez MaBagnole</h2>
            <p class="text-gray-400 mt-2 text-sm">Créez votre compte pour réserver votre premier véhicule</p>
        </div>

        <div class="glass rounded-2xl p-8">
            <form action="../Controllers/Inscription.php" method="POST" class="space-y-5">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="nom" class="text-sm font-medium text-gray-300 ml-1">Nom</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-user text-gray-500 group-focus-within:text-blue-400 transition"></i>
                            </div>
                            <input type="text" id="nom" name="nom" placeholder="Dupont" 
                                class="w-full bg-gray-800/50 border border-gray-600 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent block pl-10 p-3 placeholder-gray-500 transition outline-none" required>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <label for="prenom" class="text-sm font-medium text-gray-300 ml-1">Prénom</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-user text-gray-500 group-focus-within:text-blue-400 transition"></i>
                            </div>
                            <input type="text" id="prenom" name="prenom" placeholder="Jean" 
                                class="w-full bg-gray-800/50 border border-gray-600 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent block pl-10 p-3 placeholder-gray-500 transition outline-none" required>
                        </div>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-sm font-medium text-gray-300 ml-1">Adresse Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-gray-500 group-focus-within:text-blue-400 transition"></i>
                        </div>
                        <input type="email" id="email" name="email" placeholder="jean.dupont@exemple.com" 
                            class="w-full bg-gray-800/50 border border-gray-600 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent block pl-11 p-3 placeholder-gray-500 transition outline-none" required>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-sm font-medium text-gray-300 ml-1">Mot de passe</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-500 group-focus-within:text-blue-400 transition"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Minimum 8 caractères" 
                            class="w-full bg-gray-800/50 border border-gray-600 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent block pl-11 pr-10 p-3 placeholder-gray-500 transition outline-none" required>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-white cursor-pointer transition">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    
                </div>

                

                <button type="submit" class="w-full text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 focus:ring-4 focus:ring-blue-800 font-bold rounded-xl text-sm px-5 py-3.5 text-center transition transform hover:scale-[1.02] shadow-lg shadow-blue-500/25 mt-2">
                    Créer mon compte
                </button>

                

            </form>
        </div>

        <p class="text-center mt-6 text-gray-400 text-sm">
            Vous avez déjà un compte ? 
            <a href="login.php" class="text-blue-400 hover:text-blue-300 font-semibold hover:underline transition">Connectez-vous</a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>