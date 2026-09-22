<div class="auth-page">
	<!-- LEFT PANEL -->
	<div class="auth-left">
        <div class="auth-logo">
			<?php require __DIR__ . '/../partials/logo.php'; ?>
        </div>

		<h1 class="auth-headline">Your opinions<br>deserve to be<br><span class="accent">rewarded.</span></h1>
		<p class="auth-subline">Join 50,000+ members earning money from surveys, reviews, and referrals — on your own schedule.</p>
		<div class="benefits-list">
			<div class="benefit-item">
				<div class="benefit-icon bi-green">💰</div>
				<div class="benefit-text">
					<div class="benefit-title">Earn $3–$10 per survey</div>
					<div class="benefit-sub">Matched to your profile so you rarely get disqualified</div>
				</div>
			</div>
			<div class="benefit-item">
				<div class="benefit-icon bi-amber">⚡</div>
				<div class="benefit-text">
					<div class="benefit-title">Instant payouts</div>
					<div class="benefit-sub">Withdraw via PayPal, bank transfer, or gift cards anytime</div>
				</div>
			</div>
			<div class="benefit-item">
				<div class="benefit-icon bi-blue">👥</div>
				<div class="benefit-text">
					<div class="benefit-title">Referral bonuses</div>
					<div class="benefit-sub">Earn $5 for every friend who joins and completes a survey</div>
				</div>
			</div>
			<div class="benefit-item">
				<div class="benefit-icon bi-purple">🔒</div>
				<div class="benefit-text">
					<div class="benefit-title">100% private & GDPR safe</div>
					<div class="benefit-sub">Your data is never sold. Full control over your privacy.</div>
				</div>
			</div>
		</div>
	</div>
	<!-- RIGHT PANEL -->
	<div class="auth-right">
		<div class="auth-form-wrap">
            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

			<form method="post" action="/reset-password/">
				<div id="login-panel" class="login-panel active">
					<div class="form-title">Reset Password</div>
					<p class="form-sub">Enter your new password and we'll send you a link to reset your password.</p>

                    <input
                        type="hidden"
                        name="login"
                        value="<?= htmlspecialchars($_GET['login'] ?? '') ?>">

                    <input
                        type="hidden"
                        name="key"
                        value="<?= htmlspecialchars($_GET['key'] ?? '') ?>">

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
					<button type="submit" class="btn-submit">Reset Password →</button>
				</div>
    		</form>
		</div>
	</div>
</div>