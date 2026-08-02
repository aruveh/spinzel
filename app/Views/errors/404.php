<div class="main-layout" style="max-width: 600px; margin: 80px auto; padding: 0 20px; text-align: center;">
    <h1 style="font-size: 72px; font-weight: 800; margin: 0; color: var(--accent-color, #6366f1);">404</h1>
    <h2 style="font-size: 24px; font-weight: 600; margin: 16px 0 8px 0;">Page Not Found</h2>
    <p style="color: #6b7280; font-size: 16px; margin-bottom: 32px;">
        <?= htmlspecialchars($error ?? 'The page or resource you are looking for does not exist.') ?>
    </p>
    <a href="/" style="display: inline-block; background: #6366f1; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 600;">
        Back to Home →
    </a>
</div>
