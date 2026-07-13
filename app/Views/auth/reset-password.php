<section class="auth-page">

    <h1>Reset Password</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/reset-password">

        <input
            type="hidden"
            name="login"
            value="<?= htmlspecialchars($_GET['login'] ?? '') ?>">

        <input
            type="hidden"
            name="key"
            value="<?= htmlspecialchars($_GET['key'] ?? '') ?>">

        <div class="form-group">
            <label>New Password</label>

            <input
                type="password"
                name="password"
                required>
        </div>

        <button type="submit">
            Reset Password
        </button>

    </form>

</section>