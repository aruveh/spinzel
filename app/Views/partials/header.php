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
        
        <div class="header-actions">
            <?php if (isset($_SESSION['auth'])): ?>
                <a href="/profile" class="btn-primary">Profile</a>
                <form method="post" action="/logout">
                    <button type="submit" class="btn-ghost">Logout</button>
                </form>
            <?php else: ?>
                <a href="/login" class="btn-ghost">Log In</a>
                <a href="/register" class="btn-primary">Sign Up Free</a
            <?php endif; ?>>
        </div>
    </div>
</header>