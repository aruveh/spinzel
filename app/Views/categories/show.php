<?php

declare(strict_types=1);

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title><?= htmlspecialchars($category['name']) ?></title>

</head>

<body>

    <h1>

        <?= htmlspecialchars($category['name']) ?>

    </h1>

    <?php if (!empty($category['image'])): ?>

        <p>

            <img
                src="<?= htmlspecialchars($category['image']['sizes']['medium']['url'] ?? $category['image']['url']) ?>"
                alt="<?= htmlspecialchars($category['name']) ?>"
                width="400">

        </p>

    <?php endif; ?>

    <p>

        <strong>Slug:</strong>

        <?= htmlspecialchars($category['slug']) ?>

    </p>

    <p>

        <strong>Total Posts:</strong>

        <?= htmlspecialchars((string)$category['count']) ?>

    </p>

    <?php if (!empty($category['description'])): ?>

        <p>

            <?= nl2br(htmlspecialchars($category['description'])) ?>

        </p>

    <?php endif; ?>

    <hr>

    <h2>

        Posts

    </h2>

    <?php

    require __DIR__ . '/../partials/blog-list.php';

    ?>

    <?php

    require __DIR__ . '/../partials/pagination.php';

    ?>

</body>

</html>