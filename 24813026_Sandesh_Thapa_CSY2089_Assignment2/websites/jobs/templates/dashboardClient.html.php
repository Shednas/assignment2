<main class="sidebar">
    <h2>Welcome, <?php echo htmlspecialchars($client_username); ?></h2>
    <a href="client.php?action=addJob">Add New Job</a> | <a href="logout.php">Logout (Client)</a>
    <h3>Your Jobs</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Applicants</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?php echo htmlspecialchars($job['title']); ?></td>
                <td><?php echo htmlspecialchars($job['category_name']); ?></td>
                <td><a href="applicantsClient.php?jobId=<?php echo $job['id']; ?>">View Applicants</a></td>
                <td>
                    <a href="client.php?action=editJob&id=<?php echo $job['id']; ?>">Edit Job</a>
                </td>
                <td>
                    <form method="post" action="client.php?action=deleteJob" onsubmit="return confirm('Delete this job?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $job['id']; ?>" />
                        <input type="submit" name="submit" value="Delete" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
