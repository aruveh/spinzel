<?php if(isset($similarPosts) && (isset($currentCategory) && stripos($currentCategory, 'platform') === false)): ?>
<div class="similar-title">More posts you might like</div>
<div class="similar-grid three-cols">
    <?php
        foreach ($similarPosts as $simPost):
            $simPostUrl = \App\Support\Url::post($simPost);
    ?>
        <div class="sim-card">
            <?php if (!empty($simPost['featured_image'])): ?>
                <a href="<?= htmlspecialchars($simPostUrl) ?>">
                    <img
                        src="<?= htmlspecialchars($simPost['featured_image']['sizes']['medium']['url'] ?? $simPost['featured_image']['url']) ?>"
                        alt="<?= $simPost['title'] ?>">
                </a>
            <?php endif;?>
            <div class="sim-title">
                <a href="<?= htmlspecialchars($simPostUrl) ?>">
                    <?= $simPost['title'] ?>
                </a>
            </div>
            <div class="sim-meta">⏱ <?= $simPost['reading_time']['formatted'] ?><?= $simPost['views']['count'] > 999 ? ' · ' . $simPost['views']['formatted'] . ' views' : '' ?> </div>
            <a class="btn-sim" href="<?= htmlspecialchars($simPostUrl) ?>">Read</a>
        </div>
    <?php endforeach; ?>
</div>
<?php endif;?>