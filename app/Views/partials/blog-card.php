<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $post
 */

?>
<?php if (!empty($post)): ?>
<div class="post-card">
    <div class="post-image pi-2">
        <?php if (!empty($post['featured_image'])): ?>
            <a href="/<?= htmlspecialchars($post['slug']) ?>">
                <img
                    src="<?= htmlspecialchars($post['featured_image']['sizes']['medium']['url'] ?? $post['featured_image']['url']) ?>"
                    alt="<?= $post['title'] ?>">
            </a>
        <?php endif;?>
    </div>
    <div class="post-body">
        <?php // <span class="post-cat-pill pc-earn">💰 Earning Tips</span> ?>
        <div class="post-title"><?= $post['title'] ?></div>
        <?= !empty($post['excerpt']) ? '<p class="post-excerpt">' . $post['excerpt'] . '</p>' : '' ?>
        <div class="post-footer">
            <div class="post-author">
                ⏱ <?= $post['reading_time']['formatted'] ?><?= $post['views']['count'] > 999 ? ' · ' . $post['views']['formatted'] . ' views' : '' ?> 
            </div>
            <a href="/<?= htmlspecialchars($post['slug']) ?>" class="post-read-more">Read →</a>
        </div>
    </div>
</div>
<?php endif;?>