<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Création post</title>
</head>

<body>
    <header>
        <nav>
            <div class="infos-nav">
                <a href="<?= $prefixeUrl?>">Accueil</a>
                <a href="<?= $prefixeUrl?>archives">Archives</a>
                <a href="">A propos</a>
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
            <h1>Quelle histoire captivante souhaitez-vous partager aujourd'hui ?</h1>
        </div>
        
        <h2><span class="highlight">Créez votre nouveau post</span></h2>

        <form action="create" method="post">

            <label for="titre">Titre</label> <br>
            <input type="text" name="titre" id="titre" required><br><br>

            <label for="contenu">Contenu de l'article</label><br>
            <textarea name="contenu" id="contenu" rows="10" cols="33" required></textarea><br><br>

            <input type="submit" name="create" value="Créer">
        </form>
    </main>

</body>
</html>