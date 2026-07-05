<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $categories
 */

?>

<?php if (empty($categories)): ?>

    <p>

        No categories found.

    </p>

<?php else: ?>

    <?php foreach ($categories as $category): ?>

        <?php require __DIR__ . '/category-card.php'; ?>

    <?php endforeach; ?>

<?php endif; ?>