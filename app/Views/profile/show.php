<div class="section-inner my-48">
    <main>
        <div id="login-panel" class="login-panel">
            <div class="w-full">
                <div class="form-title"><?= htmlspecialchars($user['display_name'] ?? $user['username'] ?? 'User Profile') ?></div>
                <p class="form-sub">@<?= htmlspecialchars($user['username'] ?? '') ?></p>
            </div>
            <div class="flex-1">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name</label>
                        <input
                            class="form-input"
                            id="first_name"
                            name="first_name"
                            type="text"
                            placeholder="Not provided"
                            value="<?= htmlspecialchars($user['first_name'] ?? '') ?>"
                            readonly
                            disabled
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input
                            class="form-input"
                            id="last_name"
                            name="last_name"
                            type="text"
                            placeholder="Not provided"
                            value="<?= htmlspecialchars($user['last_name'] ?? '') ?>"
                            readonly
                            disabled
                        />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="display_name">Display Name</label>
                        <input
                            class="form-input"
                            id="display_name"
                            name="display_name"
                            type="text"
                            placeholder="Not provided"
                            value="<?= htmlspecialchars($user['display_name'] ?? '') ?>"
                            readonly
                            disabled
                        />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-input"
                            placeholder="Not provided"
                            value="<?= htmlspecialchars($user['username'] ?? '') ?>"
                            readonly
                            disabled
                        />
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Bio</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-input"
                        placeholder="No bio provided"
                        rows="5"
                        readonly
                        disabled><?= htmlspecialchars($user['description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>
    </main>
</div>
