<section class="auth-page">

    <h1>Change Password</h1>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/change-password">

        <div class="form-group">
            <label>Current Password</label>

            <input
                type="password"
                name="current_password"
                required>
        </div>

        <div class="form-group">
            <label>New Password</label>

            <input
                type="password"
                name="new_password"
                required>
        </div>

        <button type="submit">
            Change Password
        </button>

    </form>

</section>