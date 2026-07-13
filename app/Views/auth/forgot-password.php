<section class="auth-page">

    <h1>Forgot Password</h1>

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

    <form method="post" action="/forgot-password">

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                required>
        </div>

        <button type="submit">
            Send Reset Link
        </button>

    </form>

</section>