<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Inscription</title>
   
</head>
<body>
    <main>
        <h1>Inscription</h1>
        <p class="connexion-text">Veuillez créer un compte afin de pouvoir donner votre avis en commentaires</p>

        <?php if(isset($errorMessageLogin)): ?> 
        <h2 class="error-message"><?= $errorMessageLogin ?></h2>
        <?php endif; ?>

        <?php if(isset($errorMessageMdp)): ?> 
        <h2 class="error-message"><?= $errorMessageMdp ?></h2>
        <?php endif; ?>
        
        <form action="signup" method="post">
            <div class="container">
                <div class="nom-prenom">
                    <div class="nom">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" required>
                    </div>

                    <div class="nom">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" id="prenom" required>
                    </div>
                </div>
    
                <label for="login">Login</label>
                <input type="text" name="login" id="login" required><br><br>

                <label for="mdp"> Mot de passe</label>
                <input type="password" name="mdp" id="mdp" required><br><br>

                <label for="confmdp">Confirmation du mot de passe</label>
                <input type="password" name="confmdp" id="confmdp" required>
            </div>

            <input type="submit" name="ajoute" value="Ajouter">
    </form>

    <p class="no-account">Vous avez déjà un compte ? <a href="<?= $prefixeUrl?>login">Se connecter</a></p>
    <p class="no-account"><a href="<?= $prefixeUrl?>">Aller sur le site sans s'inscrire</a></p>

    </main>
    
</body>
</html>