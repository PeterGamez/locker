<?php
$sql = "SELECT * FROM locker WHERE status != '2'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<body>
	<?php include './template/navbar.php' ?>
	<div class="body container d-flex justify-content-center text-center">
		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-5">
			<?php
			for ($i = 0; $i < count($result); $i++) {
			?>
				<div class="col">
					<div class="card" style="width: 30rem;">
						<div class="card-body">
							<h5 class="card-title"><?= $result[$i]['name'] ?></h5>
							<p class="card-text"><?= $result[$i]['description'] ?></p>
							<a href="/locker/<?= $result[$i]['id'] ?>" class="btn btn-primary">Go to Locker</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
	<?php include './template/footer.php' ?>
</body>