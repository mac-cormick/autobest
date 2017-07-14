<?php
	require "include/header.php";
?>

	<div id="content">
		

		<div class="container">
			<div class="row">
				
				<div class="col-md-9 col-md-12">


<?php
	$result = mysqli_query($link, "SELECT * FROM articles LIMIT 2");

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		do {
			?>
				<div class="articles">
						<h3><?php echo $row["art_title"] ?></h3>
						<p><?php echo $row["art_date"] ?></p>
						<div class="img-wrap">
							<a href="/article.php?id=<?php echo $row['art_id']; ?>"><img src="img/articles/<?php echo $row["art_img"] ?>" alt="<?php echo $row["art_title"] ?>"></a>
						</div>
						<p><?php echo $row["art_mini_descr"] ?></p><a href="/article.php?id=<?php echo $row['art_id']; ?>">Читать полностью...</a>
					</div>
			<?php
		}
		while ($row = mysqli_fetch_assoc($result));
	}

?>

					<a class="link" href="/articles.php">Все статьи</a>

				</div>

<?php
	include "include/sidebar.php";
?>

			</div>
		</div>


	</div>


<?php
	include "include/shop.php";
	include "include/footer.php";
?>

	
</body>
</html>