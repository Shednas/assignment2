<main class="sidebar">
    <h2>Welcome, <?php echo htmlspecialchars($client_username); ?></h2>
    <a href="addjobClient.php">Add New Job</a> | <a href="logout.php">Logout (Client)</a>
    <h3>Your Jobs</h3>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Applicants</th>
            <th>Edit</th>
        </tr>
        <?php foreach ($jobs as $job): ?>
        <tr>
            <td><?php echo htmlspecialchars($job['title']); ?></td>
            <td><?php echo htmlspecialchars($job['category_name']); ?></td>
            <td><a href="applicantsClient.php?jobId=<?php echo $job['id']; ?>">View Applicants</a></td>
            <td><a href="editjob.php?id=<?php echo $job['id']; ?>">Edit Job</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
