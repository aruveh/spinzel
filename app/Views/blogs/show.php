<?php require __DIR__ . '/../partials/head.php'; ?>

<body>
    <?php
    require __DIR__ . '/../partials/header.php';
    if (isset($post)):

        $adapt = $post['adaptation'];
        $isBlogPost = isset($post['categories']) && $adapt['a9_survey_link'] === '';
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
                <a href="/blogs/">Blog</a><span class="sep">›</span>
                <span class="current"><?= $post['title'] ?></span>
            </div>
        </div>

        <div class="detail-layout">
            <main>
                <!-- SURVEY HEADER -->
                <?php if(isset($currentCategory) && stripos($currentCategory, 'platform') === false): ?>
                    <?php require __DIR__ . '/../partials/post-header-card.php'; ?>
                    <div class="details-card">
                        <?= \App\Support\Url::cleanContent($post['content']) ?>
                    </div>
                <?php else: ?>
                    <?php require __DIR__ . '/../partials/survey-header-card.php'; ?>
                <?php endif; ?>

                <?php require __DIR__ . '/../partials/similar-posts.php'; ?>
            </main>

            <?php require __DIR__ . '/../partials/sidebar.php'; ?>
        </div>
    <?php endif; ?>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>