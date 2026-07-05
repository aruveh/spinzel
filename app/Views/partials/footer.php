<?php

declare(strict_types=1);

$currentYear = date('Y');

?>

<footer class="site-footer">

    <div class="container">

        <div class="footer-top">

            <div class="footer-brand">

                <a href="/">

                    <strong>Spinzel</strong>

                </a>

                <p>

                    Earn rewards by sharing your opinions through online surveys.

                </p>

            </div>

            <?php

            if (
                !empty($navigation['footer']) &&
                !empty($navigation['footer']['data']['items'])
            ) {

                $menu = $navigation['footer'];

                require __DIR__ . '/navigation.php';

            }

            ?>

        </div>

        <hr>

        <div class="footer-bottom">

            <p>

                &copy; <?= $currentYear; ?> Spinzel. All rights reserved.

            </p>

        </div>

    </div>

</footer>