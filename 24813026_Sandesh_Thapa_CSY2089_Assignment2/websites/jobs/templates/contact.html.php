<main class="home">
    <h2>Contact Us</h2>
    <?php if (!empty($message)) echo '<p style="color:green;">' . htmlspecialchars($message) . '</p>'; ?>
    <form method="post">
        <label>First Name</label>
        <input type="text" name="first_name" required />
        <label>Surname</label>
        <input type="text" name="surname" required />
        <label>Email Address</label>
        <input type="email" name="email" required />
        <label>Telephone</label>
        <input type="text" name="telephone" required />
        <label>Enquiry</label>
        <textarea name="enquiry" required></textarea>
        <input type="submit" name="submit" value="Send Enquiry" />
    </form>
</main>
