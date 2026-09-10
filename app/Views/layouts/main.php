
<?php require __DIR__ . '/../partials/head.php'; ?>
<body>
    <?php
        require __DIR__ . '/../partials/header.php'; 
        
        if (!empty($pageView) && (!empty($view)) && file_exists($pageView)) {
            if($view === 'blogs/list') {
                require __DIR__ . '/../partials/blog-hero-search.php';
            }
            require $pageView;
        } else {
            echo '<h1>View not found.</h1>';
        }
    ?>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
    
    <script src="/assets/js/theme.js"></script>
</body>
</html>