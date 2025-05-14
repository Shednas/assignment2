<main>
    <div class="sidebar">
        <section class="left">
            <ul>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="jobArchive.php">Archived Jobs</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="staffManagement.php">Staff Management</a></li>
                <li><a href="enquiries.php">Enquiries</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </section>
        <section class="right">
            <h2>Archived Jobs</h2>
            <?php if (empty($jobs)): ?>
                <p>No archived jobs.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Salary</th>
                            <th>Location</th>
                            <th>Closing Date</th>
                            <th>Category ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($jobs as $job): ?>
                        <tr id="archive-row-<?php echo $job['id']; ?>">
                            <td><strong><?php echo htmlspecialchars($job['title']); ?></strong></td>
                            <td><?php echo htmlspecialchars($job['salary']); ?></td>
                            <td><?php echo htmlspecialchars($job['location']); ?></td>
                            <td><?php echo htmlspecialchars($job['closingDate']); ?></td>
                            <td><?php echo htmlspecialchars($job['categoryId']); ?></td>
                            <td>
                                <button class="repost-btn" data-id="<?php echo $job['id']; ?>">Repost</button>
                                <button class="delete-archive-btn" data-id="<?php echo $job['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.repost-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Repost this job?')) {
                var jobId = this.getAttribute('data-id');
                fetch('repostjob.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'id=' + encodeURIComponent(jobId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Repost successful');
                        var row = document.getElementById('archive-row-' + jobId);
                        if (row) row.remove();
                    } else {
                        alert(data.message || 'Repost failed');
                    }
                })
                .catch(() => alert('Repost failed'));
            }
        });
    });
    document.querySelectorAll('.delete-archive-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Delete this archived job?')) {
                var jobId = this.getAttribute('data-id');
                fetch('deletejobarchive.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'id=' + encodeURIComponent(jobId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Delete successful');
                        var row = document.getElementById('archive-row-' + jobId);
                        if (row) row.remove();
                    } else {
                        alert('Delete failed');
                    }
                })
                .catch(() => alert('Delete failed'));
            }
        });
    });
});
</script>