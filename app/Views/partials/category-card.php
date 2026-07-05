<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $category
 */

?>

<article class="category-card">

    <?php if (!empty($category['image'])): ?>

        <p>

            <a href="/category/<?= htmlspecialchars($category['slug']) ?>">

                <img
                    src="<?= htmlspecialchars($category['image']['sizes']['medium']['url'] ?? $category['image']['url']) ?>"
                    alt="<?= htmlspecialchars($category['name']) ?>"
                    width="250">

            </a>

        </p>

    <?php endif; ?>

    <h3>

        <a href="/category/<?= htmlspecialchars($category['slug']) ?>">

            <?= htmlspecialchars($category['name']) ?>

        </a>

    </h3>

    <?php if (!empty($category['description'])): ?>

        <p>

            <?= nl2br(htmlspecialchars($category['description'])) ?>

        </p>

    <?php endif; ?>

    <p>

        <strong>Slug:</strong>

        <?= htmlspecialchars($category['slug']) ?>

    </p>

    <p>

        <strong>Total Posts:</strong>

        <?= htmlspecialchars((string) $category['count']) ?>

    </p>

</article>

<hr>