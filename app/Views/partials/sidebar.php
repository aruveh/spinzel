<aside class="blog-aside">
        <?php if (isset($recentPosts)): ?>
            <div class="sidebar-widget">
                <div class="widget-title">Recent Posts</div>
                <div class="popular-posts">
                    <?php
                        foreach ($recentPosts as $index => $post):
                    ?>
                        <div class="pop-post">
                            <span class="pop-num"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            <div>
                                <div class="pop-title">
                                    <a href="/<?= htmlspecialchars($post['slug']) ?>"><?= $post['title'] ?></a>
                                </div>
                                <div class="pop-meta">⏱ 10 min · 18.2K views</div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="sidebar-widget newsletter-widget">
            <div class="widget-title">Get earning tips weekly</div>
            <p class="newsletter-desc">New survey alerts, earning guides, and payout tips delivered to your inbox every Tuesday.</p>
            <form id="newsletterForm">
                <input id="newsletterEmail" class="nl-input" name="email" type="email" placeholder="your@email.com" required="">
                <button class="btn-nl-sub" id="newsLetterBtn">Subscribe Free →</button>
            </form>
        </div>

        <div class="sidebar-widget earning-tips-widget">
            <div class="widget-title" style="color:var(--green-dark)">⚡ Quick Earning Tips</div>
            <div class="earnings-tip-item">
                <div class="tip-bullet">1</div>Complete your profile 100% to unlock higher-paying surveys
            </div>
            <div class="earnings-tip-item">
                <div class="tip-bullet">2</div>Check for new surveys every morning — best ones fill up fast
            </div>
            <div class="earnings-tip-item">
                <div class="tip-bullet">3</div>Refer 3 friends to earn a $15 instant bonus
            </div>
            <div class="earnings-tip-item">
                <div class="tip-bullet">4</div>Finance & Tech surveys pay 30% more on average
            </div>
        </div>

        <?php if (isset($categories)): ?>
            <div class="sidebar-widget">
                <div class="widget-title">Browse by Topic</div>
                <div class="tag-cloud">
                    <?php
                        foreach ($categories as $category):
                            if($category['count'] > 0 && $category['slug'] !== 'blogs' && $category['slug'] !== 'uncategorized'):
                    ?>
                        <a href="/blogs?category=<?= htmlspecialchars($category['slug']) ?>"
                            class="tag">
                            <?= $category['name'] ?>
                        </a>
                    <?php endif;endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </aside>