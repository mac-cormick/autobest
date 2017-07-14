<?php
	require "include/header.php";
?>


	<div id="content">
		

		<div class="container">
			<div class="row">
				
				<div class="col-md-9 col-md-12">


<?php
	$result = mysqli_query($link, "SELECT * FROM `articles`");

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		do {
			echo '

				<div class="articles">
						<h3>'.$row["art_title"].'</h3>
						<p>'.$row["art_date"].'</p>
						<div class="img-wrap">
							<a href="#"><img src="img/articles/'.$row["art_img"].'" alt="'.$row["art_title"].'"></a>
						</div>
						<p>'.$row["art_mini_descr"].'</p><a href="#">Читать полностью...</a>
					</div>

			';
		}
		while ($row = mysqli_fetch_assoc($result));
	}

?>

					<a class="link" href="/index.php">Назад</a>

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