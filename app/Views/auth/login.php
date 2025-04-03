<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - MyInternship</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/style.css">
</head>
<body>
    <h1>Connexion</h1>
    <?php if(isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="<?= BASE_URL ?>/public/index.php?controller=auth&action=login">
        <label>Email :</label>
        <input type="email" name="email" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
        <p>Pas encore inscrit ? <a href="<?= BASE_URL ?>/public/index.php?controller=auth&action=register">Inscrivez-vous ici</a></p>
    </form>
</body>
</html>
