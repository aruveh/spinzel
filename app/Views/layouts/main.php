
<?php require __DIR__ . '/../partials/head.php'; ?>

<body>

<div class="site-wrapper">
<h1>fe-php/app/Views/layouts/main.php</h1>
    <?php require __DIR__ . '/../partials/header.php'; ?>

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