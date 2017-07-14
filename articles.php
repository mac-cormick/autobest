<?php
	require "include/header.php";
?>


	<div id="content">
		

		<div class="container">
			<div class="row">
				
				<div class="col-md-9 col-md-12">


<?php

	$per_page = 3;
	$page = 1;

	if( isset($_GET['page']) )
	{
		$page = (int) $_GET['page'];
	}

	$total_count_q = mysqli_query($link, "SELECT COUNT(art_id) AS total_count FROM articles");
	$total_count = mysqli_fetch_assoc($total_count_q);
	$total_count = $total_count['total_count'];

	$total_pages = ceil($total_count / $per_page);
	if( $page <= 1 || $page > $total_pages )
	{
		$page = 1;
	}

	$offset = ($per_page * $page) - $per_page;

	$articles = mysqli_query($link, "SELECT * FROM articles ORDER BY art_id LIMIT $offset,$per_page");

	$articles_exist = true;
	if( mysqli_num_rows($articles) <= 0 )
	{
		echo 'Нет статей!';
		$articles_exist = false;
	}

	if( $articles_exist == true )
	{
		echo '<div class="paginator">';
		if( $page > 1 )
		{
			echo '<a href="/articles.php?page='.($page - 1).'">&laquo; Предыдущая  </a>';
		}
		for ($i = 1; $i <= $total_pages; $i++){
	    echo '<a href="/articles.php?page='.$i.'"> ' .$i. ' </a>';
		}
		if( $page < $total_pages )
		{
			echo '<a href="/articles.php?page='.($page + 1).'">  Следующая &raquo;</a>';
		}
		echo '</div>';
	}

	if (mysqli_num_rows($articles) > 0) {
		$row = mysqli_fetch_assoc($articles);
		do {
			?>
				<div class="articles">
						<h3><?php echo $row["art_title"] ?></h3>
						<p><?php echo $row["art_date"] ?></p>
						<div class="img-wrap">
							<a href="/article.php?id=<?php echo $row['art_id']; ?>"><img src="/img/articles/<?php echo $row["art_img"] ?>" alt="<?php echo $row["art_title"] ?>"></a>
						</div>
						<p><?php echo $row["art_mini_descr"] ?></p><a href="/article.php?id=<?php echo $row['art_id']; ?>">Читать полностью...</a>
					</div>
			<?php
		}
		while ($row = mysqli_fetch_assoc($articles));
	}

	if( $articles_exist == true )
	{
		echo '<div class="paginator">';
		if( $page > 1 )
		{
			echo '<a href="/articles.php?page='.($page - 1).'">&laquo; Предыдущая  </a>';
		}
		for ($i = 1; $i <= $total_pages; $i++){
	    echo '<a href="/articles.php?page='.$i.'"> ' .$i. ' </a>';
		}
		if( $page < $total_pages )
		{
			echo '<a href="/articles.php?page='.($page + 1).'">  Следующая &raquo;</a>';
		}
		echo '</div>';
	}

?>

					<a class="link" href="/index.php">На главную</a>

				</div>

<?php
	include "include/sidebar.php";
?>

			</div>
		</div>


	</div>


<?php
	include "include/footer.php";
?>

	
</body>
</html>