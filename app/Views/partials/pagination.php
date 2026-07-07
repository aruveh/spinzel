<?php
    declare(strict_types=1);

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

<div class="load-more-wrap">
    <?php
        if ($currentPage > 1): 
        $query['page'] = $currentPage - 1;
    ?>
        <a class="btn-load-more"href="?<?= htmlspecialchars(http_build_query($query)) ?>">&larr; Previous Page</a>
    <?php
        endif; 
        if ($currentPage < $totalPages):
        $query['page'] = $currentPage + 1;
    ?>

        <a class="btn-load-more" href="?<?= htmlspecialchars(http_build_query($query)) ?>">Next Page &rarr;</a>
    <?php endif; ?>
</div>