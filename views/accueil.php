<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Accueil MiniBlog</title>


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

        <?php
        $_SESSION['current_page'] = 'accueil';
        ?>

    </header>
    

    <main>
        <div class="intro">
            <h1> <?php if(isset($_SESSION['infos_user']['login'])): ?> 
            Bonjour <?= $_SESSION['infos_user']['prenom'] ?> et
            <?php endif; ?>
            Bienvenue sur mon MiniBlog !</h1>
            <p>Retrouvez chaque semaine des conseils bien-être pour une vie plus sereine. Ici, nous explorons un univers apaisant où le stress s'efface devant des conseils pratiques et des astuces bien-être. N'hésitez pas à laissez des commentaires pour partager vos conseils. </p>
        </div>
    
        <!-- VOIR COMMENT AFFICHER CE MESSAGE -->
        <?php if (isset($_SESSION['message']) && isset($_SESSION['message_expire']) && $_SESSION['message_expire'] > time()): ?> 
        <p class="success-message"> <?= $_SESSION['message'] ?> </p>
        <?php endif; ?>


        <h2><span class="highlight">Les 3 derniers articles</span></h2>

        <div class="all-billets">
        <?php foreach($lastBillets as $row) :?> 
            <div class="billet">
            <?php if(isset($_SESSION['infos_user']['login']) && $_SESSION['infos_user']['role'] === "admin"): ?> 
                <a href="#" class="open-modal" data-id="<?= $row['id_billet'] ?>">Supprimer</a>
                    <!-- Structure de la modale -->
                    <div id="modal-<?= $row['id_billet'] ?>" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                            <form action="<?= $prefixeUrl ?>delete" method="POST">
                                <input type="hidden" name="idBillet" value="<?= $row['id_billet'] ?>">
                                <button name="yes" type="submit">Oui</button>
                                <button name="no" type="button" class="close">Non</button>
                            </form>
                        </div>
                    </div>
            <?php endif ?>
                <h3><?= $row["titre"] ?></h3>
                <h4 data-date="<?= strtotime($row['date_post']) ?>"><?= date('j F Y', strtotime($row['date_post'])) ?></h4>
                <p><?= (strlen($row["contenu"]) > 230) ? substr($row["contenu"], 0, strrpos(substr($row["contenu"], 0, 230), ' ')) . '...' : $row["contenu"]; ?></p>
                <a class="button-link" href="<?= $prefixeUrl?>post/<?= $row["titre"] ?>">Voir l'article</a>
            </div>
        <?php endforeach; ?>

        <a class="btn-archives" href="archives">Voir tous les articles</a>
        </div>

        

    </main>
    <script src="<?= $prefixeUrl ?>js/datesFr.js"></script> 
    <script src="<?= $prefixeUrl ?>js/modale.js"></script> 
</body>
</html>