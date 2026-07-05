<?php

declare(strict_types=1);

/**
 * Optional:
 *
 * $message
 */

$message ??= 'No records found.';

?>

<div class="empty-state">

    <p>

        <?= htmlspecialchars($message) ?>

    </p>

</div>