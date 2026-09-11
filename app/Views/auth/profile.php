<div class="profile-page">
    <aside>
        <div class="sidebar mb-32">
            <h2 class="sidebar-title">Dashboard</h2>
            <nav>
                <ul class="filter-group">
                    <li class="cat-item selected"><a href="/profile" class="sidebar-link">My Profile</a></li>
                    <li class="cat-item"><a href="/change-password" class="sidebar-link">Change Password</a></li>
                </ul>
            </nav>
        </div>
        <div class="sidebar-widget newsletter-widget">
            <div class="widget-title">Get earning tips weekly</div>
            <p class="newsletter-desc">New survey alerts, earning guides, and payout tips delivered to your inbox every Tuesday.</p>
            <form id="newsletterForm">
                <input id="newsletterEmail" class="nl-input" name="email" type="email" placeholder="your@email.com" required="">
                <button class="btn-nl-sub" id="newsLetterBtn">Subscribe Free →</button>
            </form>
        </div>
    </aside>
    <main>
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

        <form method="post" action="/profile">
            <div id="login-panel" class="login-panel">
                <div class="w-full">
                    <div class="form-title">My Profile</div>
                    <p class="form-sub">Update your profile information</p>
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
                                placeholder="Enter first name"
                                value="<?= htmlspecialchars($user['first_name'] ?? '') ?>"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input
                                class="form-input"
                                id="last_name"
                                name="last_name"
                                type="text"
                                placeholder="Enter last name"
                                value="<?= htmlspecialchars($user['last_name'] ?? '') ?>"
                                required
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
                                placeholder="Enter name"
                                value="<?= htmlspecialchars($user['display_name'] ?? '') ?>"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-input"
                                placeholder="Enter email"
                                value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description">Bio</label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-input"
                            placeholder="Enter bio"
                            rows="5"><?= htmlspecialchars($user['description'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Save Changes →</button>
                </div>
            </div>
        </form>
    </main>
</div>