<main class="sidebar">
    <h2>Applicants for <?php echo htmlspecialchars($job['title']); ?></h2>
    <a href="dashboardClient.php">Back to Client Dashboard</a>
    <ul>
        <?php foreach ($applicants as $app): ?>
            <li>
                <strong><?php echo htmlspecialchars($app['name']); ?></strong> (<?php echo htmlspecialchars($app['email']); ?>)<br>
                <?php echo nl2br(htmlspecialchars($app['details'])); ?><br>
                <?php if ($app['cv']): ?>
                    <a href="/cvs/<?php echo htmlspecialchars($app['cv']); ?>" target="_blank">Download CV</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
