<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $post
 */

?>

<article class="blog-card">

    <?php if (!empty($post['featured_image'])): ?>

        <p>

            <a href="/<?= htmlspecialchars($post['slug']) ?>">

                <img
                    src="<?= htmlspecialchars($post['featured_image']['sizes']['medium']['url'] ?? $post['featured_image']['url']) ?>"
                    alt="<?= htmlspecialchars($post['title']) ?>"
                    width="300">

            </a>

        </p>

    <?php endif; ?>

    <h2>

        <a href="/<?= htmlspecialchars($post['slug']) ?>">

            <?= htmlspecialchars($post['title']) ?>

        </a>

    </h2>

    <?php if (!empty($post['category'])): ?>

        <p>

            <strong>Category:</strong>

            <a href="/category/<?= htmlspecialchars($post['category']['slug']) ?>">

                <?= htmlspecialchars($post['category']['name']) ?>

            </a>

        </p>

    <?php endif; ?>

    <?php if (!empty($post['excerpt'])): ?>

        <p>

            <?= $post['excerpt'] ?>

        </p>

    <?php endif; ?>

    <p>

        <strong>Published:</strong>

        <?= htmlspecialchars($post['published']['formatted'] ?? '-') ?>

    </p>

    <p>

        <strong>Reading Time:</strong>

        <?= htmlspecialchars($post['reading_time']['formatted'] ?? '-') ?>

    </p>

    <p>

        <strong>Views:</strong>

        <?= htmlspecialchars($post['views']['formatted'] ?? '-') ?>

    </p>

</article>

<hr>