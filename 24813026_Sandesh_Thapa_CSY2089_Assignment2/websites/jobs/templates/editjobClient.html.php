<main class="sidebar">
    <h2>Edit Job</h2>
    <?php if (!empty($message)) echo '<p style="color:green;">' . htmlspecialchars($message) . '</p>'; ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $job['id']; ?>" />
        <label>Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required />

        <label>Description</label>
        <textarea name="description" required><?php echo htmlspecialchars($job['description']); ?></textarea>

        <label>Salary</label>
        <input type="text" name="salary" value="<?php echo htmlspecialchars($job['salary']); ?>" required />

        <label>Location</label>
        <input type="text" name="location" value="<?php echo htmlspecialchars($job['location']); ?>" required />

        <label>Category</label>
        <select name="categoryId" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php if ($job['categoryId'] == $cat['id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($cat['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Closing Date</label>
        <input type="date" name="closingDate" value="<?php echo htmlspecialchars($job['closingDate']); ?>" required />

        <input type="submit" name="submit" value="Save" />
    </form>
    <a href="dashboardClient.php">Back to Dashboard</a>
</main>
