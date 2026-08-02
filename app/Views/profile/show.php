<div class="main-layout" style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <div class="profile-card" style="background: var(--card-bg, #fff); border: 1px solid var(--border-color, #e5e7eb); border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        
        <div style="display: flex; align-items: center; gap: 24px; margin-bottom: 32px; flex-wrap: wrap;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #a855f7); color: #fff; font-size: 32px; font-weight: 700; display: flex; align-items: center; justify-content: center; text-transform: uppercase;">
                <?= htmlspecialchars(substr($user['display_name'] ?? $user['username'] ?? 'U', 0, 1)) ?>
            </div>
            <div>
                <h1 style="margin: 0; font-size: 28px; font-weight: 700; line-height: 1.2;">
                    <?= htmlspecialchars($user['display_name'] ?? $user['username']) ?>
                </h1>
                <p style="margin: 4px 0 0 0; color: #6b7280; font-size: 16px;">
                    @<?= htmlspecialchars($user['username']) ?>
                </p>
            </div>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border-color, #e5e7eb); margin: 24px 0;" />

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 24px;">
            <?php if (!empty($user['first_name']) || !empty($user['last_name'])): ?>
                <div>
                    <strong style="display: block; font-size: 13px; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.5px; margin-bottom: 4px;">Full Name</strong>
                    <span style="font-size: 16px; color: var(--text-color, #111827);">
                        <?= htmlspecialchars(trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''))) ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if (!empty($user['registered'])): ?>
                <div>
                    <strong style="display: block; font-size: 13px; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.5px; margin-bottom: 4px;">Member Since</strong>
                    <span style="font-size: 16px; color: var(--text-color, #111827);">
                        <?= htmlspecialchars(date('F j, Y', strtotime($user['registered']))) ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if (!empty($user['roles']) && is_array($user['roles'])): ?>
                <div>
                    <strong style="display: block; font-size: 13px; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.5px; margin-bottom: 4px;">Role</strong>
                    <span style="font-size: 16px; color: var(--text-color, #111827); text-transform: capitalize;">
                        <?= htmlspecialchars(implode(', ', $user['roles'])) ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($user['description'])): ?>
            <div style="margin-top: 24px;">
                <strong style="display: block; font-size: 13px; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.5px; margin-bottom: 8px;">Bio</strong>
                <p style="margin: 0; font-size: 15px; line-height: 1.6; color: var(--text-color, #374151); background: var(--bg-light, #f9fafb); padding: 16px; border-radius: 8px;">
                    <?= nl2br(htmlspecialchars($user['description'])) ?>
                </p>
            </div>
        <?php endif; ?>

    </div>
</div>
