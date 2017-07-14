<?php
require "include/header.php";
?>

<div class="shop">

	<div class="search choose-page">

		<h3>Выбери свой Mercedes в BENZ-auto!</h3>

		<div class="container">				
			<div class="row">

				<form action="#podium" method="post">

					<div class="col-lg-6 col-md-12">

						<div class="type">
							<label for="choose">Тип кузова</label><br>
							<select name="choose" id="choose" size="1">
								<option value=""></option>
								<option value="седан">седан</option>
								<option value="хэтчбек">хэтчбек</option>
								<option value="универсал">универсал</option>
								<option value="купе">купе</option>
								<option value="кабриолет">кабриолет</option>
								<option value="внедорожник">внедорожник</option>
								<option value="минивэн">минивэн</option>
							</select>
						</div>

						<div class="first-price">
							<label for="start-price">Цена, от</label><br>
							<input type="text" id="start-price" name="start_price">
						</div>
						<div class="sec-price">
							<label for="end-price">Цена, до</label><br>
							<input type="text" id="end-price" name="end_price">
						</div>

					</div>

					<div class="col-lg-6 col-md-12">
						<div class="klass">
							<h4>Класс</h4>
							<input type="checkbox" name="clas[0]" id="clas" value="A"> A
							<input type="checkbox" name="clas[1]" id="clas" value="B"> B
							<input type="checkbox" name="clas[2]" id="clas" value="C"> C
							<input type="checkbox" name="clas[3]" id="clas" value="E"> E
							<input type="checkbox" name="clas[4]" id="clas" value="G"> G
							<input type="checkbox" name="clas[5]" id="clas" value="S"> S
							<input type="checkbox" name="clas[6]" id="clas" value="AMG GT"> AMG GT
							<input type="checkbox" name="clas[7]" id="clas" value="V"> V
						</div>

					</div>

				</div>

				<input type="submit" name="do_choose" value="Подобрать">

			</form>

		</div>

	</div>

	<div class="podium" id="podium">
		<div class="container">
			<div class="row">

				<?php
				$type = "`type`='седан' OR `type`='внедорожник' OR `type`='хэтчбек' OR `type`='минивэн' OR `type`='универсал' OR `type`='кабриолет'";
				$start = "`price`>0";
				$end = "`price`<100000000";
				$class = "`class`='A' OR `class`='B' OR `class`='C' OR `class`='E' OR `class`='G' OR `class`='S' OR `class`='AMG GT' OR `class`='V'";

				if( isset($_POST['do_choose']) ) {
					if ( $_POST['choose'] != "" ) {
						$choose = $_POST['choose'];
						$type = "`type`='$choose'";
					}
					if ( $_POST['start_price'] != 0 ) {
						$start_price = (int) $_POST['start_price'];
						$start = "`price`>$start_price";
					}
					if ( $_POST['end_price'] != 0 ) {
						$end_price = (int) $_POST['end_price'];
						$end = "`price`<$end_price";
					}
					$clas_arr = $_POST['clas'];
					$clas_num =  count($clas_arr);
					if( $clas_num >= 1 )
					{
						$array = [];
						foreach( $clas_arr as $key => $value ) {
							$array[] = $value;
						}
						$class = "";
						$class .= "`class`='$array[0]'";
						for ( $i=1; $i<$clas_num; $i++ )
						{
							$class .= " OR `class`='$array[$i]'";
						}
					}
				}

				$result = mysqli_query($link, "SELECT * FROM `cars` WHERE ($type) AND ($start) AND ($end) AND ($class)");

				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					do {
						?>
						<div class="col-md-4 col-xs-6">
							<div class="car-items">
								<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
								<p><?php echo $row['name']; ?></p>
								<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
							</div>
						</div>
						<?php
					}
					while ($row = mysqli_fetch_assoc($result));
				}

				?>

			</div>
		</div>
	</div>

</div>

<div style="clear:both;"></div>




<?php
include "include/footer.php";
?>


</body>
</html>