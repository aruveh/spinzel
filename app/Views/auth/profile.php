<section class="auth-page">

    <h1>My Profile</h1>

    <form method="post" action="/profile">

        <div class="form-group">
            <label>Display Name</label>

            <input
                type="text"
                name="display_name"
                value="<?= htmlspecialchars($user['display_name']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>First Name</label>

            <input
                type="text"
                name="first_name"
                value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Last Name</label>

            <input
                type="text"
                name="last_name"
                value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($user['email']) ?>"
                required>
        </div>

        <div class="form-group">
            <label>Bio</label>

            <textarea
                name="description"
                rows="5"><?= htmlspecialchars($user['description'] ?? '') ?></textarea>
        </div>

        <button type="submit">
            Save Changes
        </button>

    </form>

    <hr>

    <p>

        <a href="/change-password">
            Change Password
        </a>

    </p>

</section>