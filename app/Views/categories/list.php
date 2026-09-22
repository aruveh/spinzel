<?php
declare(strict_types=1);

$pageTitle = 'Categories';
require __DIR__ . '/../partials/head.php';
?>

<body>

<h1>

Categories

</h1>

<?php

require __DIR__ . '/../partials/category-list.php';

?>

<?php

require __DIR__ . '/../partials/pagination.php';

?>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>