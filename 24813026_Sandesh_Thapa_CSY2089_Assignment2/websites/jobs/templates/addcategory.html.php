
	<main class="sidebar">

	<section class="left">
		<ul>
			<li><a href="jobs.php">Jobs</a></li>
			<li><a href="categories.php">Categories</a></li>

		</ul>
	</section>

	<section class="right">

	<?php

		if (isset($_POST['submit'])) {

			//$stmt = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');

			$criteria = [
				'name' => $_POST['name']
			];

			$table = 'category';
			$record = $criteria;
			insert($pdo, $table, $record);
			//$stmt->execute($criteria);
			echo 'Category added';
		}
		else {
			?>
				<h2>Add Category</h2>
				<form action="" method="POST">
					<label>Name</label>
					<input type="text" name="name" />
					<input type="submit" name="submit" value="Add Category" />
				</form>
			<?php
		}
	?>

</section>
	</main>