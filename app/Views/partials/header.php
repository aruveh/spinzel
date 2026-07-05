<?php

declare(strict_types=1);
$menu = $navigation['primary'] ?? null;
?>

<header class="site-header">
    <div class="header-inner">
        <?php require __DIR__ . '/logo.php'; ?>

        <div class="main-navigation">
            <button class="mobile-menu-btn">☰</button>
            <?php require __DIR__ . '/navigation.php'; ?>
        </div>
        
        <?php /*<div class="header-actions">
            <button class="btn-ghost">Log In</button>
            <button class="btn-primary">Sign Up Free</button>
        </div> */?>
    </div>
</header>