<aside class="blog-aside">
        <?php
            require_once __DIR__ . '../../../Support/CountryDetector.php';
            
            if(isset($post)):
                $adapt = $post['adaptation'];
                $meta = isset($post['meta']) ? $post['meta'] : [];
                $surveyCountry = $adapt['a9_country'];
                $usersCountry = getVisitorCountryCode();
                $surveylink = $adapt['a9_survey_link'];
                $isSurveyPost = isset($post['categories']) && $adapt['a9_survey_link'] !== '';

                if ($isSurveyPost):
        ?>
        <div class="take-survey-cta">
            <?php if(isset($adapt['a9_price']) && $adapt['a9_price'] > 0): ?>
            <div class="reward-display">
                <div class="reward-label">Survey Reward</div>
                <div class="reward-amount"><sup>$</sup><?= $adapt['a9_price'] ?></div>
                <div class="reward-sub">Paid within 24hrs of completion</div>
            </div>

            <?php endif; ?>
            
            <?php if(isset($daysLeft) && $daysLeft > 0): ?>
            <div class="urgency-row">
                <span class="urg-icon">⏰</span>
                Closes in <strong style="margin-left:4px"><?= $daysLeft; ?> days(s)</strong>
            </div>
            <?php else: ?>
            <div class="urgency-row">
                <span class="urg-icon">⏰</span>
                Survey has expired.
            </div>
            <?php endif; ?>
            
            <?php if(isset($surveylink) && ($surveyCountry === $usersCountry)): ?>
            <a class="btn-take-big" href='<?= $surveylink; ?>' target="_blank">Start Survey Now →</a>
            <p class="cta-note">You must be <a href="#">logged in</a> to take surveys. By starting, you agree to our <a href="#">survey terms</a>. Reward credited within 24 hours.</p>
            <?php else: ?>
            <div class="not-eligible">
                <div class="not-elig-title">You may not be eligible</div>
                <div class="not-elig-sub">This survey targets <strong><?= $adapt['a9_age_group'] ?></strong> age groups in the <strong><?= $surveyCountry; ?></strong>. Try other surveys that match your profile.</div>
                <button class="btn-browse" onclick="location.href='/browse-surveys'">Browse All Surveys →</button>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; endif; ?>
        <?php if (isset($recentPosts) && !$isSurveyPost): ?>
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
                        <a href="/blogs?category=<?= htmlspecialchars($category['slug']) ?>" target='_blank'
                            class="tag">
                            <?= $category['name'] ?>
                        </a>
                    <?php endif;endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </aside>