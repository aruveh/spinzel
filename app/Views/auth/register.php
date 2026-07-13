<section class="auth-page">

    <h1>Create Account</h1>
<?php if (!empty($error)): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>
    <form method="post" action="/register">

        <div class="form-group">
            <label>Username</label>

            <input
                type="text"
                name="username"
                value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Display Name</label>

            <input
                type="text"
                name="display_name"
                value="<?= htmlspecialchars($old['display_name'] ?? '') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($old['email'] ?? '') ?>"
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
            Register
        </button>

    </form>

    <p>
        Already have an account?

        <a href="/login">
            Login
        </a>
    </p>

</section>