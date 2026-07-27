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
		<div class="auth-testimonial">
			<div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
			<p class="testimonial-quote">"I've earned over $340 in just 4 months. The surveys are targeted so I actually qualify for most of them. Payout was always quick."</p>
			<div class="testimonial-author">
				<div class="ta-avatar">JT</div>
				<div>
					<div class="ta-name">James T. — New York</div>
					<div class="ta-earned">Earned $340.00 in 4 months</div>
				</div>
			</div>
		</div>
	</div>
	<!-- RIGHT PANEL -->
	<div class="auth-right">
		<div class="auth-form-wrap">
			<div class="auth-tabs">
				<a href="/register" class="auth-tab active">Create Account</a>
				<a href="/login" class="auth-tab">Log In</a>
			</div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

			<form method="post" action="/register">
				<div class="signup-step">
                    <div class="form-title">Create your account</div>
                    <p class="form-sub">Free forever. No credit card needed.</p>

					<div class="form-group">
						<label class="form-label" for="display_name">Display Name</label>
						<input
                            class="form-input"
                            id="display_name"
                            name="display_name"
                            type="text"
                            placeholder="Enter name"
                            value="<?= htmlspecialchars($old['display_name'] ?? '') ?>"
                            required
                        />
					</div>

                    <div class="form-group">
						<label class="form-label" for="username">Username</label>

						<input
                            class="form-input"
                            id="username"
                            name="username"
                            type="text"
                            placeholder="your username"
                            value="<?= htmlspecialchars($old['username'] ?? '') ?>"
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
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            required
                        />
                    </div>

                    <div class="form-group">
						<label class="form-label" for="password">Password</label>
                        <div class="input-icon-wrap">
                            <input
                                class="form-input"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Min. 8 characters"
                                oninput="checkStrength(this.value)"
                                required
                            />
                            <span class="input-icon" onclick="togglePwd()">👁</span>
                        </div>
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill" style="width:0%;background:#EF4444"></div>
                        </div>
                        <div class="password-hints">
                            <span class="hint" id="h-len">✓ 8+ chars</span>
                            <span class="hint" id="h-upper">✓ Uppercase</span>
                            <span class="hint" id="h-num">✓ Number</span>
                            <span class="hint" id="h-special">✓ Special char</span>
                        </div>
                    </div>
					<button type="submit" class="btn-submit">Create Account →</button>
                    <div class="form-footer">Already have an account? <a href="/login">Log in →</a>
				</div>
    		</form>
		</div>
	</div>
</div>