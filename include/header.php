<?php
	session_start();
	require "/config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Заголовок</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.7/css/superfish.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.7/css/megafish.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/5.5.3/core/css/jquery.mmenu.all.css">
	<link rel="shortcut icon" href="/favicon.png" />
	<link rel="stylesheet" href="/libs/bootstrap/bootstrap-grid.min.css" />
	<link rel="stylesheet" href="/libs/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/libs/animate/animate.min.css" />
	<link rel="stylesheet" href="/libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="/libs/owl-carousel/owl.theme.css" />
	<link rel="stylesheet" href="/libs/owl-carousel/owl.transitions.css" />
	<link rel="stylesheet" href="/css/fonts.css" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="css/media.css" />
</head>
<body>


	<div id="page">

	
	<header>

	<!-- Mega Menu Start -->

	<div class="menu-wrapper">
		
		<div class="container">

			<a href="#mobile-menu" class="toggle-mnu"><span></span></a>

			<div class="header-wrap clearfix">
			
				<div class="logo-wrap">
					<a href="#"><img src="/img/menu-logo.png" alt="Alt"></a>
				</div>

				<div class="top-mnu">
					
					<ul class="sf-menu">

						<li><a href="/">Главная</a></li>

						<li>
							<a href="/">Контакты</a>
						</li>

						<li>
							<a href="/choosen.php">Модельный ряд</a>
							<ul>

								<?php
								$types = mysqli_query($link, "SELECT * FROM types ORDER BY type_id");
								if (mysqli_num_rows($types) > 0) {
									while ($type = mysqli_fetch_assoc($types))
									{ 
										$kuzov = $type["type_kuzov"];
										?>

								<li>
									<a href="#"><?php echo $type["type_kuzov"]; ?></a>
									<ul>
	
										<?php
								$models = mysqli_query($link, "SELECT * FROM cars WHERE type = '$kuzov'");
								if (mysqli_num_rows($models) > 0) {
									while ($type_model = mysqli_fetch_assoc($models))
									{ 
										?>

										<li><a href="/showroom.php?id=<?php echo $type_model['id']; ?>"><?php echo $type_model["name"]; ?></a></li>
								
										<?php
									}
								}
								?>

									</ul>
								</li>

								<?php
							}
						}
						?>

							</ul>
						</li>

						<li>
							<a href="/articles.php">Статьи</a>
							<div class="sf-mega">
								
								<div class="container-fluid">
									<div class="row">

										<div class="col-md-3">

											<ul class="mega-sub">
												<li><a href="#"><i class="fa fa-anchor"></i>Подпункт 1</a></li>
												<li><a href="#"><i class="fa fa-bell"></i>Подпункт 2</a></li>
												<li><a href="#"><i class="fa fa-facebook"></i>Подпункт 3</a></li>
												<li><a href="#"><i class="fa fa-female"></i>Подпункт 4</a></li>
												<li><a href="#"><i class="fa fa-twitter"></i>Подпункт 5</a></li>
											</ul>

										</div>

										<div class="col-md-9">
											
											<div class="row">

											<?php
											$articles = mysqli_query($link, "SELECT * FROM articles ORDER BY art_id LIMIT 3");
											if (mysqli_num_rows($articles) > 0) {
												while ($row = mysqli_fetch_assoc($articles))
												{ 
													?>

													<div class="col-md-4">
														<div class="menu-new-item">
															<a href="article.php?id=<?php echo $row["art_id"] ?>"><img class="responsive-img" src="/img/articles/<?php echo $row["art_img"] ?>" alt="Alt"></a>
															<h3><a href="article.php?id=<?php echo $row["art_id"] ?>"><?php echo $row["art_title"] ?></a></h3>
															<p><?php echo mb_substr(strip_tags($row["art_mini_descr"]), 0, 100, 'utf-8') . ' ...'; ?></p>
														</div>
													</div>

													<?php
												}
											}
											?>

											</div>

										</div>

									</div>
								</div>

							</div>
						</li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- Mega Menu End -->

	
	<div class="top-line">
		
		<div class="contacts">
			<i class="fa fa-phone"></i>
			<p>8 (800) 800-80-80</p>
			<span>||</span>
			<i class="fa fa-clock-o"></i>
			<p>пн-вс 9.00 - 21.00</p>
		</div>

		<div class="enter-login">
			<a href="/enter.php">Регистрация | Вход<i class="fa fa-user"></i></a>
			<form action="" method="post">
				<input name="do_exit" type="submit" value="Выход"><i class="fa fa-sign-out"></i>
			</form>
		</div>

		<?php
		if ( isset($_POST['do_exit']))
		{
			session_unset();
		}
		?>

	</div>

	<div class="big-banner">
		
		<img src="/img/bigban.jpg" alt="Alt">

	</div>

	<?php

		$result = mysqli_query($link, "SELECT * FROM cars WHERE id = " . (int) $_GET['id']);
				$row = mysqli_fetch_assoc($result);
				$name = $row["name"];

		$result2 = mysqli_query($link, "SELECT * FROM `articles` WHERE `art_id` = " . (int) $_GET['id']);
				$row2 = mysqli_fetch_assoc($result2);
				$name2 = $row2["art_title"];

		$cur_url = $_SERVER['REQUEST_URI'];
			$urls = explode('/', $cur_url);
			 
			$crumbs = array();
			 
			if (!empty($urls) && $cur_url != '/') {
			    foreach ($urls as $key => $value) {
			        $prev_urls = array();
			        for ($i = 0; $i <= $key; $i++) {
			            $prev_urls[] = $urls[$i];
			        }
			        if ($key == count($urls) - 1)
			            $crumbs[$key]['url'] = '';
			        elseif (!empty($prev_urls))
			            $crumbs[$key]['url'] = count($prev_urls) > 1 ? implode('/', $prev_urls) : '/';

			        $values = explode('?', $value);
			    		$val = $values[0];
			 
			        switch ($val) {
			            case 'articles.php' : $crumbs[$key]['text'] = 'Статьи';
			                break;
			            case 'article.php' : $crumbs[$key]['text'] = $name2;
			                break;
			            case 'reg.php' : $crumbs[$key]['text'] = 'Регистрация';
			                break;
			            case 'showroom.php' : $crumbs[$key]['text'] = $name;
			                break;
			            case 'choosen.php' : $crumbs[$key]['text'] = 'Модельный ряд';
			                break;
			            case 'enter.php' : $crumbs[$key]['text'] = 'Вход';
			                break;
			            case 'confirm.php' : $crumbs[$key]['text'] = 'Подтверждение';
			                break;
			            default : $crumbs[$key]['text'] = 'Главная страница';
			                break;
			        }
			    }
			}

	?>

	<?php if (!empty($crumbs)) { ?>
    <section id="inner-headline">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <?php foreach ($crumbs as $item) { ?>
                        <?php if (isset($item)) { ?>
                            <li>
                                <?php if (!empty($item['url'])) { ?>
                                    <a href="<?php echo $item['url'] ?>"><?php echo $item['text'] . '&nbsp;&nbsp;&nbsp;&raquo;' ?></a>
                                <?php } else { ?>
                                    <?php echo $item['text'] ?>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
<?php } ?>

	</header>
