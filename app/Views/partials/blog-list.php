<?php

declare(strict_types=1);

/**
 * Required:
 *
 * $posts
 */

?>

<?php if (empty($posts)): ?>
    <p>No posts found.</p>
<?php else: ?>

    <!-- FEATURED POST -->
    <!-- <div class="featured-post">
        <div class="featured-image">💤</div>
        <div class="featured-content">
            <div class="featured-label">⭐ Editor's Pick</div>
            <h2 class="featured-title">How to Make Money While You Sleep: Passive Income Explained</h2>
            <p class="featured-excerpt">Discover the most proven strategies to generate income passively — from surveys and referral programs to dividend investing and content monetization.</p>
            <div class="featured-meta">
                <span>📅 May 2025</span>
                <span>⏱ 8 min read</span>
                <span>👁 12.4K views</span>
            </div>
            <a href="#" class="btn-read-featured">Read Article →</a>
        </div>
    </div> -->

    <!-- POSTS GRID -->
    <div class="posts-grid">
        <?php
            foreach ($posts as $post):
                require __DIR__ . '/blog-card.php';
            endforeach;
        ?>
    </div>

<?php endif; ?>