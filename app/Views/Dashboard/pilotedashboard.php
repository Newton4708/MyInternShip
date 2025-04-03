<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Étudiant | MyInternship</title>
    <link rel="stylesheet" href="/public/assets/style.css">
</head>
<body>
    <header>
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION['user']['prenom']) ?></h1>
        <nav>
            <a href="<?= BASE_URL ?>/public/index.php?controller=dashboard&action=index">Dashboard</a>
            <a href="<?= BASE_URL ?>/public/index.php?controller=offre&action=list">Offres</a>
            <a href="<?= BASE_URL ?>/public/index.php?controller=candidature&action=list">Mes candidatures</a>
            <a href="<?= BASE_URL ?>/public/index.php?controller=auth&action=logout">Déconnexion</a>
        </nav>
    </header>
    <main>
        <h2>Résumé de vos candidatures</h2>
        <table>
            <thead>
                <tr>
                    <th>Offre</th>
                    <th>Entreprise</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($offres) > 0): ?>
                    <?php foreach ($offres as $offre): ?>
                        <tr>
                            <!--  -->
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">Aucune candidature trouvée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2025 MyInternship. Tous droits réservés.</p>
    </footer>
</body>
</html>
