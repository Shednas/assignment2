<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css"/>
    <title>Jo's Jobs - Admin Home</title>
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
                <li><a href="/it.php">IT</a></li>
                <li><a href="/hr.php">Human Resources</a></li>
                <li><a href="/sales.php">Sales</a></li>
            </ul>
        </li>
        <li><a href="/about.html">About Us</a></li>
    </ul>
</nav>
<img src="/images/randombanner.php"/>
<main class="sidebar">
<?php if ($loggedIn): ?>
    <section class="left">
        <ul>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="staffManagement.php">Staff Management</a></li>
            <li><a href="enquiries.php">Enquiries</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </section>
    <section class="right">
        <h2>You are now logged in<?php if ($username) echo ', ' . htmlspecialchars($username); ?></h2>
    </section>
<?php else: ?>
    <h2>Log in</h2>
    <?php if (!empty($message)) echo '<p style="color:red;">' . htmlspecialchars($message) . '</p>'; ?>
    <form action="indexAdmin.php" method="post" style="padding: 40px">
        <label>Username</label>
        <input type="text" name="username" required />
        <label>Password</label>
        <input type="password" name="password" required />
        <input type="submit" name="submit" value="Log In" />
    </form>
<?php endif; ?>
</main>
<footer>
    &copy; Jo's Jobs 2025
</footer>
</body>
</html>