<?php
if (!isset($pdo)) {
    require_once __DIR__ . '/../database.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/styles.css"/>
        <title><?php echo $title ?></title>
    </head>
    <body>
    <header>
        <section>
            <aside>
                <h3>Office Hours:</h3>
                <p>Mon-Fri: 09:00-17:30</p>
                <p>Sat: 09:00-17:00</p>
                <p>Sun: Closed</p>
            </aside>
            <h1>Jo's Jobs</h1>
        </section>
    </header>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li>Jobs
                <ul>
                    <?php
                        $categories = $pdo->query('SELECT * FROM category');
                    ?>
                    <li><a href="/jobCategory.php">All Jobs</a></li>
                    <?php foreach ($categories as $category): ?>
                        <li><a href="/jobCategory.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a href="/about.php">About Us</a></li>
            <li><a href="careerAdvice.php">Career Advice</a></li>
            <li><a href="/contact.php">Contact Us</a></li>
        </ul>
    </nav>
    <img src="/images/randombanner.php"/>

    <?php echo $content ?>
    
    <footer>
        &copy; Jo's Jobs <?php echo date('Y'); ?>
    </footer>
</body>
</html>