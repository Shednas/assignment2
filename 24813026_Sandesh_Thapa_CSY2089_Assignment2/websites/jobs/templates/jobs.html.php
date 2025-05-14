<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="jobArchive.php">Archived Jobs</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="staffManagement.php">Staff Management</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </section>

    <section class="right">
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        // Filter form
        echo '<form method="get" action="jobs.php" style="margin-bottom: 1em;">';
        echo '<label for="category">Filter by category: </label>';
        echo '<select name="category" id="category" onchange="this.form.submit()">';
        echo '<option value="">All</option>';
        foreach ($categories as $cat) {
            $selected = ($categoryFilter == $cat['id']) ? 'selected' : '';
            echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . htmlspecialchars($cat['name']) . '</option>';
        }
        echo '</select>';
        echo '</form>';

        echo '<h2>Jobs</h2>';
        echo '<a class="new" href="addjob.php">Add new job</a>';

        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Title</th>';
        echo '<th>Category</th>';
        echo '<th style="width: 15%">Salary</th>';
        echo '<th style="width: 15%">Received Date</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '<th style="width: 15%">&nbsp;</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '<th style="width: 5%">&nbsp;</th>';
        echo '</tr>';
        echo '</thead>';

        foreach ($jobs as $job) {
            $applicants = $pdo->prepare('SELECT count(*) as count FROM applicants WHERE jobId = :jobId');
            $applicants->execute(['jobId' => $job['id']]);
            $applicantCount = $applicants->fetch();

            // Check if job is archived
            $archivedStmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM job_archive WHERE id = :id');
            $archivedStmt->execute(['id' => $job['id']]);
            $archived = $archivedStmt->fetch()['cnt'] > 0;

            echo '<tr id="job-row-' . $job['id'] . '">';
            echo '<td>' . htmlspecialchars($job['title']) . '</td>';
            echo '<td>' . htmlspecialchars($job['category_name']) . '</td>';
            echo '<td>' . htmlspecialchars($job['salary']) . '</td>';
            // Show receivedDate if available, otherwise closingDate
            echo '<td>' . (isset($job['receivedDate']) && $job['receivedDate'] ? htmlspecialchars(date('d/m/Y', strtotime($job['receivedDate']))) : htmlspecialchars(date('d/m/Y', strtotime($job['closingDate'])))) . '</td>';
            echo '<td><a style="float: right" href="editjob.php?id=' . $job['id'] . '">Edit</a></td>';
            echo '<td><a style="float: right" href="applicants.php?id=' . $job['id'] . '">View applicants (' . $applicantCount['count'] . ')</a></td>';
            // Archive button or status
            echo '<td>';
            if ($archived) {
                echo '<span style="color: green; font-weight: bold;">Archived</span>';
            } else {
                echo '<button class="archive-btn" data-id="' . $job['id'] . '">Archive</button>';
            }
            echo '</td>';
            // Delete button
            echo '<td>
                <form method="post" action="deletejob.php" style="display:inline;">
                    <input type="hidden" name="id" value="' . $job['id'] . '" />
                    <input type="submit" name="submit" value="Delete" onclick="return confirm(\'Delete this job?\');" />
                </form>
            </td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        ?>
        <h2>Log in</h2>
        <form action="index.php" method="post">
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="submit" value="Log In" />
        </form>
        <?php
    }
    ?>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.archive-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Archive this job?')) {
                var jobId = this.getAttribute('data-id');
                fetch('archievejob.php', { // <-- make sure this matches your PHP filename
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'id=' + encodeURIComponent(jobId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Archive successful');
                        // Change the button to "Archived"
                        btn.outerHTML = '<span style="color: green; font-weight: bold;">Archived</span>';
                    } else if (data.message) {
                        alert(data.message);
                    } else {
                        alert('Archive failed');
                    }
                })
                .catch(() => alert('Archive failed'));
            }
        });
    });
});
</script>