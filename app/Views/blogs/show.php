<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title><?= htmlspecialchars($post['title']) ?></title>

</head>

<body>

    <h1>

        <?= htmlspecialchars($post['title']) ?>

    </h1>

    <?php if (!empty($post['featured_image'])): ?>

        <p>

            <img
                src="<?= htmlspecialchars($post['featured_image']['sizes']['large']['url']) ?>"
                alt="<?= htmlspecialchars($post['featured_image']['title']) ?>"
                width="900">

        </p>

    <?php endif; ?>

    <p>

        <strong>Published:</strong>

        <?= htmlspecialchars($post['meta']['published']['formatted']) ?>

    </p>

    <p>

        <strong>Updated:</strong>

        <?= htmlspecialchars($post['meta']['modified']['formatted']) ?>

    </p>

    <p>

        <strong>Reading Time:</strong>

        <?= htmlspecialchars($post['meta']['reading_time']['formatted']) ?>

    </p>

    <p>

        <strong>Word Count:</strong>

        <?= htmlspecialchars($post['meta']['word_count']['formatted']) ?>

    </p>

    <p>

        <strong>Views:</strong>

        <?= htmlspecialchars($post['meta']['views']['formatted']) ?>

    </p>

    <?php if (!empty($post['categories'])): ?>

        <h2>Categories</h2>

        <ul>

            <?php foreach ($post['categories'] as $category): ?>

                <li>

                    <?= htmlspecialchars($category['name']) ?>

                </li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <?php if (!empty($post['tags'])): ?>

        <h2>Tags</h2>

        <ul>

            <?php foreach ($post['tags'] as $tag): ?>

                <li>

                    <?= htmlspecialchars($tag['name']) ?>

                </li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <hr>

    <?= $post['content'] ?>

</body>

</html>