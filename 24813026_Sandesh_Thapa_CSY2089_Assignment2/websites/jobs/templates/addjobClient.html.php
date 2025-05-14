<main class="sidebar">
    <h2>Add Job</h2>
    <?php if (!empty($message)) echo '<p style="color:green;">' . htmlspecialchars($message) . '</p>'; ?>
    <form method="post">
        <label>Title</label>
        <input type="text" name="title" required />
        <label>Description</label>
        <textarea name="description" required></textarea>
        <label>Salary</label>
        <input type="text" name="salary" required />
        <label>Location</label>
        <input type="text" name="location" required />
        <label>Category</label>
        <select name="categoryId" required>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <label>Closing Date</label>
        <input type="date" name="closingDate" required />
        <input type="submit" name="submit" value="Add" />
    </form>
    <a href="dashboardClient.php">Back to Client Dashboard</a>
</main>
