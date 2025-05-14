<main class="sidebar">
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
        <h2>Enquiries</h2>
        <?php if (!empty($message)) echo '<p style="color:green;">' . htmlspecialchars($message) . '</p>'; ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Enquiry</th>
                    <th>Status</th>
                    <th>Response</th>
                    <th>Handled By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enquiries as $enquiry): ?>
                <tr>
                    <td><?php echo htmlspecialchars($enquiry['first_name'] . ' ' . $enquiry['surname']); ?></td>
                    <td><?php echo htmlspecialchars($enquiry['email']); ?></td>
                    <td><?php echo htmlspecialchars($enquiry['telephone']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($enquiry['enquiry'])); ?></td>
                    <td><?php echo htmlspecialchars($enquiry['status']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($enquiry['response'] ?? '')); ?></td>
                    <td><?php echo htmlspecialchars($enquiry['staff_username'] ?? ''); ?></td>
                    <td>
                        <?php if ($enquiry['status'] === 'Pending'): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $enquiry['id']; ?>" />
                            <textarea name="response" required placeholder="Response"></textarea>
                            <input type="submit" name="respond" value="Mark Complete" />
                        </form>
                        <?php else: ?>
                            Complete
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
