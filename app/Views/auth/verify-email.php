<section class="auth-page">

    <h1>Email Verification</h1>

    <?php if ($success): ?>

        <div class="alert alert-success">

            Your email has been verified successfully.

        </div>

        <p>

            <a href="/login">
                Continue to Login
            </a>

        </p>

    <?php else: ?>

        <div class="alert alert-error">

            Invalid or expired verification link.

        </div>

    <?php endif; ?>

</section>