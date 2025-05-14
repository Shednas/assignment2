<main class="sidebar">
    <h2>Client Registration</h2>
    <?php if (!empty($message)) echo '<p>' . $message . '</p>'; ?>
    <form method="post">
        <label>Company Name</label>
        <input type="text" name="company" required />
        <label>Username</label>
        <input type="text" name="username" required />
        <label>Password</label>
        <input type="password" name="password" required />
        <input type="submit" name="submit" value="Register" />
    </form>
    <a href="indexClient.php">Back to Client Login</a>
</main>
