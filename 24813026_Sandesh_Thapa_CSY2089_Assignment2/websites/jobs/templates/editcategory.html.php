<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="categories.php">Categories</a></li>
        </ul>
    </section>
    <section class="right">
        <h2>Edit Category</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $currentCategory['id']; ?>" />
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($currentCategory['name']); ?>" required />
            <input type="submit" value="Save Category" />
        </form>
    </section>
</main>