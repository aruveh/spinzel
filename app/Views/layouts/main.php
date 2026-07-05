<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Shared Variables
|--------------------------------------------------------------------------
*/

$pageTitle ??= '';
$pageDescription ??= '';
$pageKeywords ??= '';
$pageView ??= '';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php require __DIR__ . '/../partials/head.php'; ?>

</head>

<body>

<div class="site-wrapper">

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