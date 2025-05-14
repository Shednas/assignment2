<main class="sidebar">
    <h2>Client Login</h2>
    <?php if (!empty($message)) echo '<p style="color:red;">' . htmlspecialchars($message) . '</p>'; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required />
        <label>Password</label>
        <input type="password" name="password" required />
        <input type="submit" name="submit" value="Log In" />
        <button type="button" onclick="window.location.href='registerClient.php'">Register as Client</button>
    </form>
</main>
