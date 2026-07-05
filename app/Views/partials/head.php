<?php

declare(strict_types=1);

$pageTitle ??= '';
$pageDescription ??= '';
$pageKeywords ??= '';
$pageView ??= '';

?>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($pageTitle) ?></title>

<?php if (!empty($pageDescription)): ?>
<meta
    name="description"
    content="<?= htmlspecialchars($pageDescription) ?>">
<?php endif; ?>

<link
    rel="stylesheet"
    href="/assets/css/style.css">