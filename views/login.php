<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <main>
    <h1>Connexion</h1>
    <p class="connexion-text">Merci de bien vouloir vous connecter afin de pouvoir publier des commentaires</p>

    <?php if(isset($errorMessageConnexion)): ?> 
    <p class="error-message"><?= $errorMessageConnexion ?></p>
    <?php endif; ?>



    <form action="login" method="post">
        <div class="container">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" required><br><br>

            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" required> <br><br>
        </div>
        <input type="submit" value="Se connecter">
    </form>

    <p class="no-account">Vous n'avez pas de compte ? <a href="<?= $prefixeUrl?>signup">S'inscrire</a></p>
    <p class="no-account"><a href="<?= $prefixeUrl?>">Aller sur le site sans s'inscrire</a></p>
    </main>
</body>
</html>