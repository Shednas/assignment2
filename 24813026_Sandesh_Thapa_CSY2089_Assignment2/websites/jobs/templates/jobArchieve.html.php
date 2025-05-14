<main>
    <section class="left">
        <ul>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="staffManagement.php">Staff Management</a></li>
            <li><a href="enquiries.php">Enquiries</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </section>
    <h2>Archived Jobs</h2>
    <ul>
    <?php
    $stmt = $pdo->query('SELECT * FROM job_archive');
    foreach ($stmt as $job) {
        echo '<li id="archive-row-' . $job['id'] . '">';
        echo '<strong>' . htmlspecialchars($job['title']) . '</strong> ';
        echo 'Salary: £' . htmlspecialchars($job['salary']) . ' ';
        echo 'Location: ' . htmlspecialchars($job['location']) . ' ';
        // Repost button (AJAX)
        echo '<button class="repost-btn" data-id="' . $job['id'] . '">Repost</button> ';
        // Delete button (AJAX)
        echo '<button class="delete-archive-btn" data-id="' . $job['id'] . '">Delete</button>';
        echo '</li>';
    }
    ?>
    </ul>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Repost
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
                        alert('Repost failed');
                    }
                })
                .catch(() => alert('Repost failed'));
            }
        });
    });
    // Delete
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