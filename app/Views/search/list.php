
<?php require __DIR__ . '/../partials/head.php'; ?>

<body>

<div class="site-wrapper">
    <h1>fe-php/app/Views/pages/show.php</h1>
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <h1>

        Search Results

    </h1>

    <?php if (!empty($_GET['q'])): ?>

        <p>

            Keyword:

            <strong>

                <?= htmlspecialchars($_GET['q']) ?>

            </strong>

        </p>

    <?php endif; ?>

    <hr>

    <?php

    require __DIR__ . '/../partials/blog-list.php';

    ?>

    <?php

    require __DIR__ . '/../partials/pagination.php';

    ?>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

<script type="text/javascript">
    console.log('fe-php/app/Views/search/list.php')
</script>
</body>

</html>