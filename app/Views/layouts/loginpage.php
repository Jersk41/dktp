<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/loginpage.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
</head>
<body>
	<img class="wave" src="<?= base_url() ?>/assets/img/wave.svg">
	<div class="container">
		<div class="img">
			<img src="<?= base_url() ?>/assets/img/bg.svg">
		</div>
		<div class="login-content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url() ?>/assets/js/loginpage.js"></script>
</body>
</html>
