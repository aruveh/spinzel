<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $posts
 */

?>

<?php if (empty($posts)): ?>

    <p>

        No posts found.

    </p>

<?php else: ?>

    <?php foreach ($posts as $post): ?>

        <?php

        require __DIR__ . '/blog-card.php';

        ?>

    <?php endforeach; ?>

<?php endif; ?>