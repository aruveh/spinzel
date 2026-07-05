
<?php require __DIR__ . '/../partials/head.php'; ?>
<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>
<div class="site-wrapper">

    <main class="site-main">

        <?php

        if (!empty($pageView) && file_exists($pageView)) {

            require $pageView;

        } else {

            echo '<h1>View not found.</h1>';

        }

        ?>

    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

</div>

</body>

</html>