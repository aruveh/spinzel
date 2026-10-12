<div class="flex gap-32 mb-16 align-items-start">
    <?php if (!empty($post['featured_image'])): ?>
        <div class="tips-card max-w-240">
            <img
                src="<?= htmlspecialchars($post['featured_image']['sizes']['medium_large']['url'] ?? $post['featured_image']['url']) ?>"
                alt="<?= $post['featured_image']['alt'] ?>">
        </div>
    <?php endif; ?>
    <div>
        <h2 class="survey-title"><?= $post['title'] ?></h2>
        <?php
        $age = $post['adaptation']['a9_age_group'];
        if ($age !== ''):
        ?>
            <div class="survey-platform mb-16">
                <a class="a9-age-group" href='<?= $post['adaptation']['a9_survey_link']; ?>' target="_blank">
                    <?= $age; ?>
                </a>
            </div>
        <?php endif; ?>
        <p class="survey-description"><?= $post['excerpt'] ?></p>
    </div>
</div>

<?php if(!empty($post['content'])): ?>
<div class="details-card border-0">
    <?= \App\Support\Url::cleanContent($post['content']) ?>
</div>
<?php endif; ?>