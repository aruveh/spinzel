<div class="profile-page">
    <aside>
        <div class="sidebar mb-32">
            <h2 class="sidebar-title">Dashboard</h2>
            <nav>
                <ul class="filter-group">
                    <li class="cat-item"><a href="/profile" class="sidebar-link">My Profile</a></li>
                    <li class="cat-item selected"><a href="/change-password" class="sidebar-link">Change Password</a></li>
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

		<form method="post" action="/change-password">
			<div id="login-panel" class="login-panel active">
				<div class="form-title">Change Password</div>
				<p class="form-sub">Enter your email address and we'll send you a link to reset your password.</p>

				<div class="form-group">
					<label class="form-label" for="email">Current Password</label>

					<input
						type="password"
						name="current_password"
						id="current_password"
						class="form-input"
						placeholder="Enter current password"
						required
					/>
				</div>

				<div class="form-group">
					<label class="form-label" for="new_password">New Password</label>

					<input
						type="password"
						name="new_password"
						id="new_password"
						class="form-input"
						placeholder="Enter new password"
						required
					/>
				</div>
				<button type="submit" class="btn-submit">Update Password →</button>
			</div>
		</form>
    </main>
</div>