<?php
    declare(strict_types=1);
?>
<?php if (isset($categories)): ?>
    <div class="categories-bar">
        <div class="cat-tab">All Posts</div>
        <?php
            foreach ($categories as $category):
                if($category['count'] > 0 && $category['slug'] !== 'blogs' && $category['slug'] !== 'uncategorized'):
        ?>
            <a href="/blogs?category=<?= htmlspecialchars($category['slug']) ?>"
                class="cat-tab">
                <?= $category['name'] ?>
            </a>
        <?php endif;endforeach; ?>
    </div>
<?php endif; ?>