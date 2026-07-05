<?php

declare(strict_types=1);

$menu = $navigation['primary'] ?? null;

?>

<header class="site-header">

    <div class="container">

        <div class="site-logo">

            <a href="/">

                Spinzel

            </a>

        </div>

        <div class="site-navigation">

            <?php

            require __DIR__ . '/navigation.php';

            ?>

        </div>

    </div>

</header>