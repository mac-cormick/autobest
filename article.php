<?php
require "include/header.php";
?>

<div id="content">

	<div class="container">
		<div class="row">

			<div class="col-md-9 col-sm-12">

				<?php
				$result = mysqli_query($link, "SELECT * FROM articles WHERE art_id = " . (int) $_GET['id']);

				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					do {
						?>
						<div class="articles">
							<h3><?php echo $row["art_title"] ?></h3>
							<p><?php echo $row["art_date"] ?></p>
							<div class="img-wrap">
								<a href="#"><img src="img/articles/<?php echo $row["art_img"] ?>" alt="<?php echo $row["art_title"] ?>"></a>
							</div>
							<p><?php echo $row["art_full_descr"] ?></p>
						</div>
						<?php
					}
					while ($row = mysqli_fetch_assoc($result));
				}
				?>

				<a class="link" href="/articles.php">Все статьи</a>

				<hr>

				<div class="comments">
					
					<h3>Добавить комментарий</h3>
					<?php
					if (empty($_SESSION['user_login']) or empty($_SESSION['user_password']))
					{
						echo '<span style="color: red;font-weight: bold;margin-bottom: 10px; display: block;"><a href="/enter.php">Выполните вход</a>, чтобы иметь возможность оставлять комментарии! </span>';
					} else {
					?>
					<div id="comment-add-form" class="comment-add">
						<div class="addblock">
							<form class="comment-form" method="POST" enctype="multipart/form-data" action="/article.php?id=<?php echo $_GET['id']; ?>#comment-add-form">

								<div class="add-block">
									<div class="row">
										<div class="col-md-4">
											<input type="text" name="name" placeholder="Имя" value="<?php echo $_POST['name']; ?>">
										</div>
										<div class="col-md-4">
											<input type="text" name="nickname" placeholder="Логин" value="<?php echo $_SESSION['user_login']; ?>">
										</div>
										<div class="col-md-4">
											<input type="text" name="email" placeholder="Email" value="<?php echo $_SESSION['user_email']; ?>">
										</div>
									</div>
									<textarea name="text" placeholder="Текст комментария..."><?php echo $_POST['text']; ?></textarea>
									
									<label for="file">Загрузить аватар</label>
									<input type="file" id="file" name="uploadfile">
									<input type="submit" class="dopost" name="do_post" value="Добавить комментарий">
								</div>

								<?php
								if( isset($_POST['do_post']) )
								{
									$errors = array();

									if ( $_POST['name'] == '' )
									{
										$errors[] = 'Введите имя!';
									}
									if ( $_POST['nickname'] == '' )
									{
										$errors[] = 'Введите логин!';
									}
									if ( $_POST['email'] == '' )
									{
										$errors[] = 'Введите Email!';
									}
									if ( $_POST['text'] == '' )
									{
										$errors[] = 'Введите текст коммкетария!';
									}
									if ( empty($_FILES['uploadfile']['name']) )
									{
										$_FILES['uploadfile']['name'] = "misterion.jpg";
									}
									if ( empty($_FILES['uploadfile']['tmp_name']) )
									{
										$_FILES['uploadfile']['tmp_name'] = "./img/misterion.jpg";
									}

									if( empty($errors) )
									{
										copy($_FILES['uploadfile']['tmp_name'],"uploads/".basename($_FILES['uploadfile']['name']));
										$uploaddir = './img/';
										$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

										mysqli_query($link, "INSERT INTO comments (img,name,nickname,email,text,pubdate,article_id) VALUES ('".$_FILES['uploadfile']['name']."','".$_POST['name']."', '".$_POST['nickname']."', '".$_POST['email']."', '".$_POST['text']."', NOW(), '".$_GET['id']."')");
										echo '<span style="color: green;font-weight: bold;margin-bottom: 10px; display: block;">Комментарий успешно добавлен!</span>';
									} else
									{
										echo '<span style="color: red;font-weight: bold;margin-bottom: 10px; display: block;">' . $errors['0'] . '</span>';
									}
								}
								?>
								
							</form>

						</div>
					</div>

					<?php
				}
				?>

					<hr>

					<div class="comments-view">
						<a href="#comment-form">Добавить комментарий</a>
						<h3>Комментарии</h3>

						<?php
						$comments = mysqli_query($link, "SELECT * FROM comments WHERE article_id = " . (int) $_GET['id'] . " ORDER BY id DESC");
						if( mysqli_num_rows($comments) <= 0 )
						{
							echo "Нет комментариев!";
						}
						while( $comment = mysqli_fetch_assoc($comments) )
						{
							?>
							<div class="comment-block">
								<img src="/uploads/<?php echo $comment['img']; ?>" alt="">
								<span class="nickname"><?php echo $comment['name']; ?></span>
								<p><?php echo $comment['text']; ?></p>
								<span class="date"><?php echo $comment['pubdate']; ?></span>
							</div>
							<?php
						}
						?>

					</div>

				</div>


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