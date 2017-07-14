<?php
require "include/header.php";
?>

<div id="content">

	<div class="container">
		<div class="row">

			<div class="col-md-9 col-sm-12">

				<?php
				$result = mysqli_query($link, "SELECT * FROM cars WHERE id = " . (int) $_GET['id']);

				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					do {
						?>
						
						<div class="showroom">
							<h2><?php echo $row["name"] ?></h2>
							<img src="/img/cars/<?php echo $row["big_img"] ?>" alt="">
							<p><?php echo $row["text"] ?></p>
							<h3>Характеристики:</h3>
							<ul>
								<li>Тип кузова - <span><?php echo $row["type"] ?></span></li>
								<li>Класс - <span><?php echo $row["class"] ?></span></li>
								<li>Цена - <span><?php echo number_format($row['price'], 0, '.', ' '); ?> руб.</span></li>
							</ul>
						</div>

 
						<?php
					}
					while ($row = mysqli_fetch_assoc($result));
				}
				?>


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