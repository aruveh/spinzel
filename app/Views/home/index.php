<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<title>

<?= htmlspecialchars($page['title']) ?>

</title>

</head>

<body>

<h1>

<?= htmlspecialchars($page['title']) ?>

</h1>

<?= $page['content'] ?>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

        <script type="text/javascript">
    console.log('fe-php/app/Views/home/index.php')
</script>
</body>

</html>