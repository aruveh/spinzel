<?php require __DIR__ . '/../partials/head.php'; ?>

<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <?php
        if (isset($post)):

            $startDateString = $post['adaptation']['a9_start_datetime'];
            $endDateString = $post['adaptation']['a9_end_datetime'];

            // Create DateTime objects
            $start = new DateTime($startDateString);
            $end = new DateTime($endDateString);
            $now = new DateTime(); // Current time

            // Convert to Unix timestamps (seconds)
            $startTs = $start->getTimestamp();
            $endTs = $end->getTimestamp();
            $nowTs = $now->getTimestamp();

            // Calculate total timeframe and remaining seconds
            $totalDuration = $endTs - $startTs;
            $timeRemaining = $endTs - $nowTs;

            // Handle edge cases (safeguards)
            if ($nowTs >= $endTs) {
                $percentageLeft = 0; // Event already finished
            } elseif ($nowTs <= $startTs) {
                $percentageLeft = 100; // Event hasn't started yet
            } else {
                // Calculate percentage and round to 2 decimal places
                $percentageLeft = ($timeRemaining / $totalDuration) * 100;
                $percentageLeft = round($percentageLeft, 2);
            }
            if ($nowTs >= $endTs) {
                $daysLeft = 0;
            } else {
                // Diff calculates the exact gap between the two DateTime objects
                $interval = $now->diff($end);
                $daysLeft = $interval->days; 
            }
    ?>

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
                        <?php 
                            $minutes = $post['meta']['reading_time'];
                            if($minutes['minutes'] > 0):
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
                            if(isset ($country)):
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
                            if(isset ($age)):
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
                            if(isset ($time)):
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
                            if($views['count'] > 999):
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
                    <p class="survey-description"><?= $post['excerpt'] ?></p>
                    <div class="progress-section">
                        <div class="prog-header">
                            <span class="prog-title">Survey Progress</span>
                        </div>
                        <div class="big-prog-bar">
                            <div class="big-prog-fill" style="width:<?= $percentageLeft.'%'; ?>"></div>
                        </div>
                        <div class="prog-details">
                            <span><strong>Only <?= $daysLeft; ?> day(s) left</strong></span>
                            <span><?= $percentageLeft.'%'; ?> filled</span>
                        </div>
                    </div>
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