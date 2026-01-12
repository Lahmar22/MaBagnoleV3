<?php

session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../login.php');
    exit();
}
require_once '../../Models/Article.php';
require_once '../../Models/CommentaireArticle.php';


$idart = $_GET['idArticle'];


$article = new Article();
$articles = $article->getArticleByid($idart);

$commentaireArt = new CommentaireArt();
$commentaires = $commentaireArt->getAllCommentaire($idart);




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
                    <a href="home.php" class="hover:text-blue-400 transition">Accueil</a>
                    <a href="vehicule.php" class="hover:text-blue-400 transition text-blue-400">Véhicules</a>
                    
                </div>

                <div class="relative flex items-center">
                    <button id="profileDropdownBtn" class="flex items-center gap-3 focus:outline-none group">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-medium text-white"><?= $_SESSION['nom']  ?> <?= $_SESSION['prenom']  ?></p>
                            
                        </div>
                        
                        <i class="fa-solid fa-chevron-down text-xs text-gray-500 group-hover:text-white transition"></i>
                    </button>

                    <div id="profileDropdownMenu" class="hidden absolute right-0 top-full mt-3 w-48 bg-gray-800 border border-gray-700 rounded-xl shadow-2xl py-2 z-50">
                        
                        <a href="reservation.php" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            <i class="fa-solid fa-calendar-check text-blue-400"></i> Mes Réservations
                        </a>
                        <div class="border-t border-gray-700 my-1"></div>
                        <a href="../../Controllers/logout.php" class="flex items-center gap-3 px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-300 transition">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-32 pb-10 bg-gradient-to-b from-blue-900/20 to-gray-950">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            
            <!-- Texte principal -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-2 text-white">
                    Découvrez nos <span class="text-blue-500">articles récents</span>
                </h1>
                <p class="text-gray-400 text-lg md:text-xl">
                    Explorez notre sélection d’articles sur Voyage, Business, Vacances, Urbain et Famille
                </p>
            </div>

            

            

        </div>
    </div>  
    <main class="container mx-auto px-6 py-16">

        <div class="max-w-6xl mx-auto bg-gradient-to-br from-gray-900 to-gray-950 rounded-3xl shadow-2xl overflow-hidden border border-gray-800">

            <div class="p-6">

                <!-- Titre Article -->
                <h1 class="text-4xl font-extrabold mb-6 text-white leading-tight tracking-wide">
                    <?= $articles->titreArticle ?>
                </h1>
                

                <!-- Contenu Article -->
                <div class="prose prose-invert max-w-none text-gray-300 text-lg leading-relaxed">
                    <?= nl2br($articles->contenu) ?>
                </div>
                <div class="border-t border-gray-800 my-8"></div>
                <!-- Tags -->
                <div class="flex flex-wrap gap-3 mb-8">
                    <?php foreach(explode(',', $articles->tags) as $tag){ ?>
                        <span class="px-4 py-1.5 text-xs rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 backdrop-blur-md">
                            <?= trim($tag) ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="border-t border-gray-800 my-8"></div>

                <div class="mt-16">

                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        💬 Commentaires
                        
                    </h2>

                    <div class="space-y-6">
                        <?php foreach ($commentaires as $c){ ?>
                            <div class="flex gap-2">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold uppercase">
                                        <?= strtoupper(substr($c->prenom,0,1)) ?>
                                </div>
                                <div class="bg-gray-900/60 w-full border border-gray-800 rounded-2xl p-6 shadow-md hover:shadow-xl transition">
                                    
                                    <div class="flex items-center gap-4 mb-3">
                                        

                                        <div>
                                            <p class="text-white font-semibold">
                                                <?= $c->prenom ?> <?= $c->nom ?>
                                            </p>
                                            
                                        </div>
                                    </div>

                                    <p class="text-gray-300 leading-relaxed">
                                        <?= nl2br($c->contenu) ?>
                                    </p>

                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="mt-12 bg-gray-900/70 rounded-2xl p-8 border border-gray-800 shadow-xl">


                        <form action="../../Controllers/commentaireArticle.php" method="POST" class="flex gap-3 space-y-4">

                            <input type="hidden" name="iduser" value="<?= $_SESSION['id_utilisateur'] ?>">
                            <input type="hidden" name="idarticle" value="<?= $articles->idArticle ?>">

                            <textarea 
                                name="commentaire"
                                rows="2"
                                placeholder="Écrivez votre commentaire ici..."
                                class="w-full bg-gray-800 text-white px-5 py-4 rounded-xl border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500 resize-none"
                                required
                            ></textarea>

                            <div class="flex justify-end">
                                <button 
                                    type="submit"
                                    class="group flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 
                                        hover:from-blue-700 hover:to-blue-600 
                                        px-8 py-3 rounded-xl text-white font-semibold 
                                        transition-all duration-300 
                                        shadow-lg shadow-blue-600/30 
                                        hover:shadow-blue-600/50 hover:scale-105"
                                    >

                                    <img src="../../image/send.png" 
                                        alt="send" 
                                        class="w-12 h-12 transition-transform duration-300 group-hover:translate-x-1">

                                </button>
                            </div>

                        </form>

                    </div>

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