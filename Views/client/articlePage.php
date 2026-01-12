<?php

session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../login.php');
    exit();
}
require_once '../../Models/Article.php';
require_once '../../Models/Theme.php';

$idTheme = $_GET['id'];
$titre = $_GET['titre'];
$idTm = $_GET['themeId'];
$tags = $_GET['tags'] ?? null;

$_SESSION['idTheme'] = $idTheme;


$article = new Article();
$articles = $article->getArticle($idTheme);
$sercheArticle = $article->sercheBytitre($titre);

$filtre = $article->filtreByTags($tags, $idTm);

$theme = new Theme();
$themes = $theme->getAllTheme();



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

            <!-- Bouton -->
            <div>
                <button onclick="openModalArticle()"class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    Ajouter Article
                </button>
            </div>

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
                        <form action="../../Controllers/sercherArticle.php" method="POST">
                            <input type="text" name="articleSearch" placeholder="Titre ..."
                                class="w-full bg-gray-800/50 border border-gray-700 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 p-3 outline-none transition">
                            <input type="hidden" name="theme" value="<?=$_SESSION['idTheme'] ?>">    
                            <button type="submit">sercher</button>
                        </form>
                        
                    </div>
                </div>

                <div class="glass p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold mb-4">
                        Tags
                    </h3>
                    <div class="space-y-3">
                        
                        <form action="../../Controllers/filterByTags.php" method="POST">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" name="tage" value="voyage" onchange="this.form.submit()" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-400 group-hover:text-white transition font-light">voyage</span>
                                <input type="hidden" name="themeId" value="<?=$_SESSION['idTheme'] ?>">
                            </label>
                        </form>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">destinations</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">aventure</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-400 group-hover:text-white transition font-light">découverte</span>
                        </label>
                    </div>
                </div>

               

                
            </aside>
            <?php print_r($filtre) ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if($sercheArticle){ ?>
                    <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 group flex flex-col h-full shadow-xl hover:shadow-2xl shadow-black/20">
                            
                            <div class="p-6 flex flex-col flex-grow">

                                <!-- Titre -->
                                <h3 class="text-white font-bold text-lg mb-3 line-clamp-2 group-hover:text-blue-400 transition-colors">
                                    <?= htmlspecialchars($sercheArticle->titreArticle) ?>
                                </h3>

                                <!-- Contenu résumé -->
                                <p class="text-gray-400 text-sm line-clamp-3 mb-4">
                                    <?= htmlspecialchars($sercheArticle->contenu) ?>
                                </p>

                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 mt-auto">
                                    <?php 
                                        $tagsArray = explode(',', $sercheArticle->tags);
                                        foreach($tagsArray as $tag) {
                                            $tag = trim($tag); 
                                            echo '<span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded-full">' . htmlspecialchars($tag) . '</span>';
                                        }
                                    ?>
                                </div>

                                <!-- Lien Lire l'article -->
                                <a href="detaitArticle.php?idArticle=<?=$sercheArticle->idArticle?>" 
                                class="mt-4 text-blue-400 hover:underline text-sm font-medium">
                                    Lire l'article
                                </a>

                            </div>

                    </div>    
                    
                <?php }else{
                    foreach ($articles as $a) { ?>
                        <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 group flex flex-col h-full shadow-xl hover:shadow-2xl shadow-black/20">
                            
                            <div class="p-6 flex flex-col flex-grow">

                                <!-- Titre -->
                                <h3 class="text-white font-bold text-lg mb-3 line-clamp-2 group-hover:text-blue-400 transition-colors">
                                    <?= htmlspecialchars($a->titreArticle) ?>
                                </h3>

                                <!-- Contenu résumé -->
                                <p class="text-gray-400 text-sm line-clamp-3 mb-4">
                                    <?= htmlspecialchars($a->contenu) ?>
                                </p>

                                <!-- Tags -->
                                <div class="flex flex-wrap gap-2 mt-auto">
                                    <?php 
                                        $tagsArray = explode(',', $a->tags);
                                        foreach($tagsArray as $tag) {
                                            $tag = trim($tag); 
                                            echo '<span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded-full">' . htmlspecialchars($tag) . '</span>';
                                        }
                                    ?>
                                </div>

                                <!-- Lien Lire l'article -->
                                <a href="detaitArticle.php?idArticle=<?=$a->idArticle?>" 
                                class="mt-4 text-blue-400 hover:underline text-sm font-medium">
                                    Lire l'article
                                </a>

                            </div>

                        </div>
                    <?php } ?>

                <?php } ?>
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

    <div id="articleModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-gray-900 rounded-3xl shadow-2xl w-full max-w-lg mx-4 p-6 relative">
            
            <!-- Close button -->
            <button onclick="closeModalArticle()" class="absolute top-4 right-4 text-gray-400 hover:text-white text-2xl font-bold">&times;</button>

            <h2 class="text-2xl font-bold text-white mb-4">Ajouter un nouvel article</h2>

            <form action="../../Controllers/ajouterArticle.php" method="POST" class="flex flex-col gap-4">  
                
                <input type="text" name="titreArticle" placeholder="Titre de l'article"
                    class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:border-blue-500" required>
                
                <textarea name="contenu" rows="4" placeholder="Contenu de l'article"
                        class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:border-blue-500" required></textarea>
                
                <input type="text" name="tags" placeholder="Tags séparés par des virgules"
                    class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:border-blue-500">

                <select name="idTheme" class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:border-blue-500" required>
                    <option value="">Choisir un thème</option>
                    <?php foreach ($themes as $t) { ?>
                        <option value="<?=$t->idTheme ?>"><?=$t->nomTheme ?></option>
                    <?php } ?>
                </select>

                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    Ajouter Article
                </button>
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

    function openModalArticle() {
        const modalArticle = document.getElementById('articleModal');
        modalArticle.classList.remove('hidden');
    }

    function closeModalArticle() {
        const modalArticle = document.getElementById('articleModal');
        modalArticle.classList.add('hidden');
    }

    
    </script>

    </body>
</html> 