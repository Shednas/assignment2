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
        <h2>Staff Management</h2>
        <?php if (!empty($message)) echo '<p>' . htmlspecialchars($message) . '</p>'; ?>

        <h3>Add Staff</h3>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required />
            <label>Password:</label>
            <input type="password" name="password" required />
            <label>Role:</label>
            <select name="role">
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="add_staff" value="Add Staff" />
        </form>

        <h3>Current Staff</h3>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <?php if ($user['cannot_delete']): ?>
                            <button disabled>Cannot Delete</button>
                        <?php else: ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
                                <input type="submit" name="delete_staff" value="Delete" onclick="return confirm('Delete this staff member?');" />
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
