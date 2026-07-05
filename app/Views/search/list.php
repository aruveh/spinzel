<?php

declare(strict_types=1);

?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<title>

Search Results

</title>

</head>

<body>

<h1>

Search Results

</h1>

<?php if (!empty($_GET['q'])): ?>

<p>

Keyword:

<strong>

<?= htmlspecialchars($_GET['q']) ?>

</strong>

</p>

<?php endif; ?>

<hr>

<?php

require __DIR__ . '/../partials/blog-list.php';

?>

<?php

require __DIR__ . '/../partials/pagination.php';

?>

</body>

</html>