
<?php require __DIR__ . '/../partials/head.php'; ?>
<body>
    <?php        
        if (!empty($pageView) && (!empty($view)) && file_exists($pageView)) {
            require $pageView;
        }
    ?>
</body>
</html>