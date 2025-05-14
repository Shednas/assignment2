<main class="home">
    <h2>Jobs Closing Soon</h2>
    <?php if (!empty($closingSoonJobs)): ?>
        <ul>
            <?php foreach ($closingSoonJobs as $job): ?>
                <li>
                    <strong><?php echo htmlspecialchars($job['title']); ?></strong>
                    <?php if (!empty($job['category_name'])): ?>
                        (<?php echo htmlspecialchars($job['category_name']); ?>)
                    <?php endif; ?>
                    - Closing Date: <?php echo date('d/m/Y', strtotime($job['closingDate'])); ?>
                    <a href="/apply.php?id=<?php echo $job['id']; ?>">Apply</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No jobs are closing soon.</p>
    <?php endif; ?>

    <p>Welcome to Jo's Jobs, we're a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you'd like to list a job with us.</p>

    <h2>Select the type of job you are looking for:</h2>
    <ul>
        <?php
            $categories = $pdo->query('SELECT * FROM category');
        ?>
        <li><a href="/jobCategory.php">All Jobs</a></li>
        <?php foreach ($categories as $category): ?>
            <li><a href="/jobCategory.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</main>