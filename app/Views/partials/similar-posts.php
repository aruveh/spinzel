<?php if(isset($similarPosts)): ?>
<div class="similar-title">More posts you might like</div>
<div class="similar-grid three-cols">
    <?php
        foreach ($similarPosts as $post):
    ?>
        <div class="sim-card">
            <?php if (!empty($post['featured_image'])): ?>
                <a href="/<?= htmlspecialchars($post['slug']) ?>">
                    <img
                        src="<?= htmlspecialchars($post['featured_image']['sizes']['medium']['url'] ?? $post['featured_image']['url']) ?>"
                        alt="<?= $post['title'] ?>">
                </a>
            <?php endif;?>
            <div class="sim-title">
                <a href="/<?= htmlspecialchars($post['slug']) ?>">
                    <?= $post['title'] ?>
                </a>
            </div>
            <div class="sim-meta">⏱ <?= $post['reading_time']['formatted'] ?><?= $post['views']['count'] > 999 ? ' · ' . $post['views']['formatted'] . ' views' : '' ?> </div>
            <a class="btn-sim" href="/<?= htmlspecialchars($post['slug']) ?>">Read</a>
        </div>
    <?php endforeach; ?>
</div>
<?php endif;?>