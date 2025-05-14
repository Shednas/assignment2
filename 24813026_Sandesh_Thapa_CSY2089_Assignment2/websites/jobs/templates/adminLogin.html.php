<main class="sidebar">
    <h2>Admin Login</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="index.php" method="post">
        <label for="password">Enter Password:</label>
        <input type="password" name="password" id="password" required />
        <input type="submit" name="submit" value="Log In" />
    </form>
</main>