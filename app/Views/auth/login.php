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
			<div class="auth-tabs">
				<a href="/register" class="auth-tab">Create Account</a>
				<a href="/login" class="auth-tab active">Log In</a>
			</div>

			<?php if (!empty($success)): ?>
				<div class="alert alert-success">
					<?= htmlspecialchars($success) ?>
				</div>
			<?php endif; ?>

			<form method="post" action="/login">
				<!-- LOGIN PANEL -->
				<div id="login-panel" class="login-panel active">
					<div class="form-title">Welcome back</div>
					<p class="form-sub">New to Spinzel? <a href="/register">Create a free account →</a></p>
					<div class="form-group">
						<label class="form-label" for="username">Username</label>
						<input class="form-input" id="username" name="username" type="text" placeholder="your username" required>
					</div>
					<div class="form-group">
						<label class="form-label" for="password">Password</label>
						<div class="input-icon-wrap">
							<input class="form-input" id="password" name="password" type="password" placeholder="Your password">
							<span class="input-icon" onclick="togglePwd()">👁</span>
						</div>
					</div>
					<div class="form-forgot"><a href="/forgot-password">Forgot password?</a></div>
					<button type="submit" class="btn-submit">Log In →</button>
					<div class="form-footer">Don't have an account? <a href="/register">Sign up free →</a></div>
				</div>
    		</form>
		</div>
	</div>
</div>