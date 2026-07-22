<?php
    declare(strict_types=1);

    $currentCategory = $_GET['category'] ?? 0;
?>
<?php if (isset($categories)): ?>
    <div class="categories-bar">
        <a href="/blogs" class="cat-tab <?= !$currentCategory ? 'active' : '' ?>">All Posts</a>
        <?php
            foreach ($categories as $category):
                if($category['count'] > 0 && $category['slug'] !== 'surveys' && $category['slug'] !== 'blogs' && $category['slug'] !== 'uncategorized'):
                    // echo $category;
        ?>
            <a href="/blogs?category=<?= htmlspecialchars($category['slug']) ?>"
                class="cat-tab <?= $currentCategory === $category['slug'] ? 'active' : ''; ?>">
                <?= $category['name'] ?>
            </a>
        <?php endif;endforeach; ?>
    </div>
<?php endif; ?>