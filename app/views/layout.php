<!Doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'Mon site') ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="/">Accueil</a>
            <h1>Bienvenue sur AlloCiné !</h1>
            <a href="/dashboard">Dashboard</a>
        </nav>
    </header>

    <main id="app">
        <?= $content ?? '' ?>
    </main>
</body>

</html>