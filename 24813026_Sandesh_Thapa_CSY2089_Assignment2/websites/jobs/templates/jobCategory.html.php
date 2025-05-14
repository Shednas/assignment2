<main class="sidebar">
<section class="left">
		<ul>
			<li><a href="jobs.php">Jobs</a></li>
			<li><a href="categories.php">Categories</a></li>

		</ul>
	</section>

	<section>
        <h2><?php echo htmlspecialchars($category); ?> Jobs</h2>
        <?php if (count($jobs) > 0): ?>
            <ul>
                <?php foreach ($jobs as $job): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($job['title']); ?></strong>
                        <?php if (!empty($job['category_name'])): ?>
                            (<?php echo htmlspecialchars($job['category_name']); ?>)
                        <?php endif; ?><br>
                        <td>
                            <?php
                            if (is_numeric($job['salary'])) {
                                echo '£' . number_format($job['salary']);
                            } else {
                                echo htmlspecialchars($job['salary']);
                            }
                            ?>
                        </td><br>
                        Location: <?php echo htmlspecialchars($job['location']); ?><br>
                        Closing Date: <?php echo date('d/m/Y', strtotime($job['closingDate'])); ?><br>
                        <div>
                            <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                        </div>
                        <a href="/apply.php?id=<?php echo $job['id']; ?>">Apply for this position</a>
                    </li>
                    <hr>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No jobs currently available in this category.</p>
        <?php endif; ?>
    </section>
</main>