<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>

        <?= htmlspecialchars($page['title']) ?>

    </title>

</head>

<body>
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