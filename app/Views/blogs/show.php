<?php require __DIR__ . '/../partials/head.php'; ?>

<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <?php if (isset($post)): ?>

        <div class="breadcrumb-bar">
            <div class="breadcrumb-inner">
                <a href="/">Home</a><span class="sep">›</span>
                <a href="/blogs">Blog</a><span class="sep">›</span>
                <span class="current"><?= $post['title'] ?></span>
            </div>
        </div>

        <div class="detail-layout">
            <main>
                <!-- SURVEY HEADER -->
                <div class="survey-header-card">
                    <div class="survey-header-top">
                        <?php if (count($post['tags']) || count($post['categories'])): ?>
                            <div class="survey-badges">
                                <?php foreach ($post['tags'] as $tag): ?>
                                    <a href="/blogs?search=<?= $tag['name'] ?>" class="s-badge sb-cat"><?= $tag['name'] ?></a>
                                <?php endforeach; ?>
                                <?php foreach ($post['categories'] as $category): ?>
                                    <a href="/blogs?search=<?= $category['name'] ?>" class="s-badge sb-urgent"><?= $category['name'] ?></a>
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
                        <div class="meta-item"><span class="meta-icon">⏱</span>Estimated Time: <span class="meta-value"><?= $post['meta']['reading_time']['formatted']; ?></span></div>
                        <?php /*<div class="meta-item"><span class="meta-icon">🌍</span>Region: <span class="meta-value">United Kingdom</span></div>
                        <div class="meta-item"><span class="meta-icon">👥</span>Age: <span class="meta-value">18–34 yrs</span></div>
                        <div class="meta-item"><span class="meta-icon">📅</span>Closes: <span class="meta-value" style="color:#DC2626">May 30, 2025</span></div>
                        <div class="meta-item"><span class="meta-icon">🏆</span>Completed by: <span class="meta-value">1,964</span></div> */ ?>
                    </div>
                    <?php /*<div class="sponsored-by">
                        <div class="sponsor-logo">PINE<br>CONE</div>
                        <div class="sponsor-info">
                            <div class="label">Sponsored by</div>
                            <div class="name">PineCone Research Ltd.</div>
                            <div class="verified">✓ Verified Research Partner · 4.9★ · 98% payout rate</div>
                        </div>
                    </div>*/ ?>
                    <p class="survey-description"><?= $post['excerpt'] ?></p>
                    <?php /*<div class="progress-section">
                        <div class="prog-header">
                            <span class="prog-title">Survey Progress</span>
                            <span class="prog-stats">1,964 of 2,000 completed</span>
                        </div>
                        <div class="big-prog-bar">
                            <div class="big-prog-fill" style="width:88%"></div>
                        </div>
                        <div class="prog-details"><span><strong>Only 36 spots remaining</strong></span><span>88% filled</span></div>
                    </div> */ ?>
                </div>

                <div class="details-card">
                    <?= $post['content'] ?>
                </div>

                <?php require __DIR__ . '/../partials/similar-posts.php'; ?>
            </main>

            <?php require __DIR__ . '/../partials/sidebar.php'; ?>
        </div>
    <?php endif; ?>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

    <script type="text/javascript">
        console.log('fe-php/app/Views/blogs/show.php')
    </script>
    <script src="/assets/js/theme.js" type="text/javascript"></script>
</body>

</html>