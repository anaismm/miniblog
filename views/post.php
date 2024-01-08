<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $prefixeUrl ?>css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title><?= $post["titre"] ?> - Post </title>
    
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
        <div class="titre-post">
            <h1><?= $post["titre"] ?></h1>
            <h2 data-date="<?= strtotime($post['date_post']) ?>"><?= date('j F Y', strtotime($post["date_post"])) ?></h2>
            <p><?= $post["contenu"] ?></p>
        </div>
       
        <div class="titre-comment">
            <h2><span class="highlight">Les commentaires</span></h2>
            <div class="see-less">
                <span></span>
                <span></span>
            </div>
        </div>
        

        <div class="all-comments">
            <?php foreach($allComments as $row): ?> 
                <div class="comment">
                    <h3><?= $row['auteur']['prenom'] ?></h3>
                    <?php
                    // Convertir le timestamp en objet DateTime
                    $date = new DateTime($row['date_post_commentaire']);
            
                    // Définir le fuseau horaire de la France
                    $date->setTimezone(new DateTimeZone('Europe/Paris'));
                    ?>
                    <h4><?= $date->format('j F Y H:i') ?></h4>
                    <p><?= $row['contenu_commentaire'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>


        <?php if(isset($_SESSION['infos_user']['login'])): ?> 
        <div class="addComment">
            <h2><span class="highlight">Ajouter un commentaire</span></h2>

            <form action="" method="POST">
                <label for="comment">Commentaire</label><br>
                <textarea name="comment" id="comment" rows="10" cols="100" required></textarea><br><br>

                <input type="submit" name="poster" value="Poster">
            </form>
        </div>
        <?php endif; ?>

    </main>

<script src="<?= $prefixeUrl ?>js/less_more_comment.js"></script>  
<script src="<?= $prefixeUrl ?>js/datesFr.js"></script>    

</body>
</html>

