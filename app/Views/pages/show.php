<?php require __DIR__ . '/../partials/head.php'; ?>

<body>
    <h1>fe-php/app/Views/pages/show.php</h1>
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <h1>

        <?= htmlspecialchars($page['title']) ?>

    </h1>

    <p>

        Published:

        <?= htmlspecialchars($page['date']) ?>

    </p>

    <p>

        Last Updated:

        <?= htmlspecialchars($page['modified']) ?>

    </p>

    <hr>

    <?= $page['content'] ?>

</body>

</html>