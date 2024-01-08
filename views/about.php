<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>À propos</title>

</head>
<body>
    <header>
        <nav>
            <div class="infos-nav">
                <a href="<?= $prefixeUrl?>">Accueil</a>
                <a href="<?= $prefixeUrl?>archives">Archives</a>
                <a href="<?= $prefixeUrl?>about">À propos</a>
            </div>
            
            <div class="connexion-nav">
            <?php if(!isset($_SESSION['infos_user']['login'])): ?> 
                <a href="<?= $prefixeUrl?>signup">Inscription</a>
                <a href="<?= $prefixeUrl?>login">Se connecter</a>
            <?php endif; ?>

            <?php if(isset($_SESSION['infos_user']['login']) && $_SESSION['infos_user']['role'] === "admin"): ?> 
                <a href="<?= $prefixeUrl?>create">Créer un article</a>
            <?php endif; ?>

            <?php if(isset($_SESSION['infos_user']['login'])): ?> 
                <a href="<?= $prefixeUrl?>logout">Se déconnecter</a>
            <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <div class="intro">
            <h1>À propos</h1>
        </div>

        <div class="infos-about">
            <h2><span class="highlight">Informations sur l'éditeur</span></h2>
            <p>Je m'appelle Anaïs MICHEL et je suis étudiante en deuxième année de BUT MMI à Champs-sur-Marne.</p>
            <p>J'ai réalisé ce blog en PHP dans le cadre d'un projet de développement back afin d'apprendre et de mettre en pratique le modèle MVC.</p>
        </div>
        
        <div class="infos-about">
            <h2><span class="highlight">Informations sur les articles</span></h2>
            <p>Les articles ont été rédigés par chatgpt, ils ne constituent en aucun cas une vérité absolue. Ces articles donnent simplement des conseils détente et bien-être.</p>
        </div>

        <div class="infos-about">
            <h2><span class="highlight">Informations sur l'administrateur du blog</span></h2>
            <p>Seul l'administrateur peut créer des articles et les supprimer.</p>
            <p>Seuls Renaud EPSTEIN et moi même possédons les accès au compte administrateur.</p>
        </div>
    </main>

</body>
</html>