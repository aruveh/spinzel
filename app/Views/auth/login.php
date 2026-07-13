<section class="auth-page">

    <h1>Login</h1>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/login">

        <div class="form-group">
            <label>Username</label>

            <input
                type="text"
                name="username"
                required>
        </div>

        <div class="form-group">
            <label>Password</label>

            <input
                type="password"
                name="password"
                required>
        </div>

        <button type="submit">
            Login
        </button>

    </form>

    <p>
        <a href="/forgot-password">
            Forgot Password?
        </a>
    </p>

    <p>
        Don't have an account?

        <a href="/register">
            Register
        </a>
    </p>

</section>