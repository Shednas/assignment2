<?php foreach($jokes as $joke) { ?>
<blockquote>
<p>
	<?=$joke['joketext']?> 
	<a href="editjoke.php?id=<?=$joke['id']?>">edit</a>

	<form action="deletejoke.php" method="POST">
		<input type="hidden" name="id" value="<?=$joke['id']?>" />
		<input type="submit" value="Delete" />
	</form>

</p>
</blockquote>
<?php } ?>
