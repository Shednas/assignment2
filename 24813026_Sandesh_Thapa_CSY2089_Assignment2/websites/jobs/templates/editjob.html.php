<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="jobArchieve.php">Archived Jobs</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="staffManagement.php">Staff Management</a></li>
            <li><a href="enquiries.php">Enquiries</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </section>
    <section class="right">
        <h2>Edit Job</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $job['id']; ?>" />
            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required />

            <label>Description</label>
            <textarea name="description" required><?php echo htmlspecialchars($job['description']); ?></textarea>

            <label>Location</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($job['location']); ?>" required />

            <label>Salary</label>
            <input type="text" name="salary" value="<?php echo htmlspecialchars($job['salary']); ?>" required />

            <label>Category</label>
            <select name="categoryId" required>
                <?php foreach ($categories as $row): ?>
                    <option value="<?php echo $row['id']; ?>" <?php if ($job['categoryId'] == $row['id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Closing Date</label>
            <input type="date" name="closingDate" value="<?php echo htmlspecialchars($job['closingDate']); ?>" required />

            <input type="submit" value="Save" />
        </form>
    </section>
</main>