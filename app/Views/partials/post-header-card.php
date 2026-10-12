<div class="survey-header-card">
    <div class="survey-header-top">
        <?php if (count($post['tags']) || count($post['categories'])): ?>
            <div class="survey-badges">
                <?php foreach ($post['tags'] as $tag): ?>
                    <a href="/blogs/?search=<?= $tag['name'] ?>" class="s-badge sb-cat"><?= $tag['name'] ?></a>
                <?php endforeach; ?>
                <?php foreach ($post['categories'] as $category): ?>
                    <a href="/blogs/?search=<?= $category['name'] ?>" class="s-badge sb-urgent"><?= $category['name'] ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; /*?>
        <div class="survey-actions">
            <button class="btn-save-survey">🔖 Save</button>
            <button class="btn-share" title="Share">↗</button>
        </div> */ ?>
    </div>
    <h1 class="survey-title"><?= $post['title'] ?></h1>
    <div class="survey-meta-row">
        <?php
        $minutes = $post['meta']['reading_time'];
        if ($minutes['minutes'] > 0):
        ?>
            <div class="meta-item">
                <span class="meta-icon">⏱</span>
                Estimated Time:
                <span class="meta-value">
                    <?= $minutes['formatted']; ?>
                </span>
            </div>
        <?php endif; ?>
        <?php
        $country = $post['adaptation']['a9_country'];
        if ($country !== ''):
        ?>
            <div class="meta-item">
                <span class="meta-icon">🌍</span>
                Region:
                <span class="meta-value">
                    <?= $country; ?>
                </span>
            </div>
        <?php endif; ?>
        <?php
        $age = $post['adaptation']['a9_age_group'];
        if ($age !== ''):
        ?>
            <div class="meta-item">
                <span class="meta-icon">🌍</span>
                Age:
                <span class="meta-value">
                    <?= $age; ?>
                </span>
            </div>
        <?php endif; ?>
        <?php
        $time = $post['adaptation']['a9_end_datetime'];
        if ($time !== ''):
        ?>
            <div class="meta-item">
                <span class="meta-icon">📅</span>
                Closes:
                <span class="meta-value" style="color:#DC2626">
                    <?= date("F j, Y", strtotime($post['adaptation']['a9_end_datetime'])); ?>
                </span>
            </div>
        <?php endif; ?>
        <?php
        $views = $post['meta']['views'];
        if ($views['count'] > 999):
        ?>
            <div class="meta-item">
                <span class="meta-icon">🏆</span>
                Completed by:
                <span class="meta-value">
                    <?= $views['formatted']; ?>
                </span>
            </div>
        <?php endif; ?>
    </div>
    <?php /*<div class="sponsored-by">
        <div class="sponsor-logo">PINE<br>CONE</div>
        <div class="sponsor-info">
            <div class="label">Sponsored by</div>
            <div class="name">PineCone Research Ltd.</div>
            <div class="verified">✓ Verified Research Partner · 4.9★ · 98% payout rate</div>
        </div>
    </div>*/ ?>
    <?php if (!empty($post['featured_image']) && $isBlogPost): ?>
        <div class="mb-32">
            <img
                src="<?= htmlspecialchars($post['featured_image']['sizes']['medium_large']['url'] ?? $post['featured_image']['url']) ?>"
                alt="<?= $post['featured_image']['alt'] ?>">
        </div>
    <?php endif; ?>
    <p class="survey-description"><?= $post['excerpt'] ?></p>
    <?php
    if ($percentageLeft > 0):
    ?>
        <div class="progress-section">
            <div class="prog-header">
                <span class="prog-title">Survey Progress</span>
            </div>
            <div class="big-prog-bar">
                <div class="big-prog-fill" style="width:<?= $percentageLeft . '%'; ?>"></div>
            </div>
            <div class="prog-details">
                <span><strong>Only <?= $daysLeft; ?> day(s) left</strong></span>
                <span><?= $percentageLeft . '%'; ?> filled</span>
            </div>
        </div>
    <?php endif; ?>
</div>