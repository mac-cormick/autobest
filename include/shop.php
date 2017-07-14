<div class="shop">
		
		<div class="search">

			<h3>Выбери свой Mercedes в BENZ-auto!</h3>

				<div class="container">				
					<div class="row">

					<form action="/choosen.php" method="post">
						
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
					<div class="col-sm-12">
						<h3>Седаны</h3>
						<div class="carousel-cars">

						<?php
						$result = mysqli_query($link, "SELECT * FROM `cars` WHERE `type` = 'седан'");

						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							do {
								?>
								<div class="car-items">
									<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
									<p><?php echo $row['name']; ?></p>
									<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
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

			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Внедорожники</h3>
						<div class="carousel-cars">

						<?php
						$result = mysqli_query($link, "SELECT * FROM `cars` WHERE `type` = 'внедорожник'");

						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							do {
								?>
								<div class="car-items">
									<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
									<p><?php echo $row['name']; ?></p>
									<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
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

			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Универсалы</h3>
						<div class="carousel-cars">

						<?php
						$result = mysqli_query($link, "SELECT * FROM `cars` WHERE `type` = 'универсал'");

						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							do {
								?>
								<div class="car-items">
									<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
									<p><?php echo $row['name']; ?></p>
									<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
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

			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Хэтчбеки</h3>
						<div class="carousel-cars">

						<?php
						$result = mysqli_query($link, "SELECT * FROM `cars` WHERE `type` = 'Хэтчбек'");

						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							do {
								?>
								<div class="car-items">
									<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
									<p><?php echo $row['name']; ?></p>
									<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
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

			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Кабриолеты и родстеры</h3>
						<div class="carousel-cars">

						<?php
						$result = mysqli_query($link, "SELECT * FROM `cars` WHERE `type` = 'Кабриолет'");

						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							do {
								?>
								<div class="car-items">
									<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
									<p><?php echo $row['name']; ?></p>
									<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
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

			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h3>Минивэны</h3>
						<div class="carousel-cars">

						<?php
						$result = mysqli_query($link, "SELECT * FROM `cars` WHERE `type` = 'Минивэн'");

						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							do {
								?>
								<div class="car-items">
									<a href="/showroom.php?id=<?php echo $row['id']; ?>"><img src="/img/cars/<?php echo $row['img']; ?>" alt="Alt"></a>
									<p><?php echo $row['name']; ?></p>
									<span><?php echo number_format($row['price'], 0, '.', ' '); ?> </span>руб.
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



		</div>

	</div>

	<div style="clear:both;"></div>