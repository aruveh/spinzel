<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $pagination
 */

if (empty($pagination)) {
    return;
}

$currentPage = (int) ($pagination['page'] ?? 1);
$totalPages  = (int) ($pagination['total_pages'] ?? 1);

if ($totalPages <= 1) {
    return;
}

$query = $_GET;

?>

<hr>

<nav class="pagination">

    <?php if ($currentPage > 1): ?>

        <?php
        $query['page'] = $currentPage - 1;
        ?>

        <a href="?<?= htmlspecialchars(http_build_query($query)) ?>">

            ← Previous

        </a>

    <?php endif; ?>

    <?php for ($page = 1; $page <= $totalPages; $page++): ?>

        <?php
        $query['page'] = $page;
        ?>

        <?php if ($page === $currentPage): ?>

            <strong>

                <?= $page ?>

            </strong>

        <?php else: ?>

            <a href="?<?= htmlspecialchars(http_build_query($query)) ?>">

                <?= $page ?>

            </a>

        <?php endif; ?>

    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>

        <?php
        $query['page'] = $currentPage + 1;
        ?>

        <a href="?<?= htmlspecialchars(http_build_query($query)) ?>">

            Next →

        </a>

    <?php endif; ?>

</nav>