
<?php require __DIR__ . '/../partials/head.php'; ?>
<body>
    <?php        
        if (!empty($pageView) && (!empty($view)) && file_exists($pageView)) {
            require $pageView;
        }
    ?>
    <script src="/assets/js/theme.js"></script>
</body>
</html>