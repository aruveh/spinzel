<?php require __DIR__ . '/../partials/head.php'; ?>
<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <?= \App\Support\Url::cleanContent($page['content']) ?>
    <?php require __DIR__ . '/../partials/footer.php'; ?>

    <script src="https://cdn.cpx-research.com/assets/js/script_tag_v2.0.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>
</html>