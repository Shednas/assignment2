<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="staffManagement.php">Staff Management</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </section>

    <section class="right">
        <h2>Categories</h2>
        <a class="new" href="addcategory.php">Add new category</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= htmlspecialchars($category['name']) ?></td>
                        <td><a href="editcategory.php?id=<?= $category['id'] ?>">Edit</a></td>
                        <td>
                            <form method="post" action="deletecategory.php">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>