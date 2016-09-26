<?PHP

function __autoload( $nameClass ) {
	require $nameClass . '.php';

}

$installer = new StarterKit\Classes\InitialClass();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php echo $installer->dle_config['charset'] ?>">
	<title><?php echo $installer->cfg['moduleTitle'] ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/StarterKit/assets/css/normalize.css">
	<link rel="stylesheet" href="/StarterKit/assets/css/legrid.min.css">
	<link rel="stylesheet" href="/StarterKit/assets/css/dle_starter.css">
</head>

<body>
<div class="body-wrapper clearfix">
	<header class="container top_nav-container container-blue">
		<div class="content">
			<div class="col col-mb-12 ta-center">
				<a href="/" class="logo" title="<?php echo $installer->cfg['moduleTitle'] ?>">
					<img src="/StarterKit/assets/images/logo.png"
					     alt="<?php echo $installer->cfg['moduleTitle'] ?>"/>
				</a>
			</div>
		</div>
	</header>
	<div class="container pb0">
		<div class="content">
			<div class="col col-mb-12 ta-center">
				<h1><?php echo $installer->cfg['moduleTitle'] ?> v.<?php echo $installer->cfg['moduleVersion'] ?>
					от <?php echo $installer->cfg['moduleDate'] ?></h1>
				<div class="text-muted">Установка модуля</div>
				<hr>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="content">
			<div class="col col-mb-12">
				<?php
					$installer->checkBeforeInstall();
					if ( $installer->error_text === FALSE ) {
						$installer->gtSteps();

						if ( is_array( $installer->actions ) ) {
							echo '<h3>' . $installer->actions['header'] . '</h3>';
							echo $installer->actions['text'] . '<hr class="mt0">';
							echo '<pre class="dle-pre">' . $installer->actions['queries'] . '</pre>';

							$step = $installer->step;
							$prev = $step - 1;
							$next = $step + 1;

							if ( $step == 2 ) {
								$prev = '<a href="' . $installer->dle_config['http_home_url'] . 'StarterKit.php" class="btn btn-square">Назад</a>';
							} else if ( $step > 2 ) {
								$prev = '<a href="' . $installer->dle_config['http_home_url'] . 'StarterKit.php?step=' . $prev . '" class="btn btn-square">Назад</a>';
							} else {
								$prev = '';
							}

							$next = ( $installer->next_btn === TRUE ) ? '<a href="' . $installer->dle_config['http_home_url'] . 'StarterKit.php?step=' . $next . '" class="btn btn-square">Вперед</a>' : '';

							echo <<<HTML
		<div class="content">
			<div class="col col-mb-6 ta-left">{$prev}</div>
			<div class="col col-mb-6 ta-right">{$next}</div>
		</div>
HTML;

						} else {
							echo '<pre class="dle-pre">';
							print_r( $installer->error_text );
							echo '</pre>';

						}

					} else {
						echo '<pre class="dle-pre">';
						print_r( $installer->error_text );
						echo '</pre>';

					}

				?>
			</div>
		</div>
	</div>

	<div class="container pt0">
		<div class="content">
			<div class="col col-mb-12">
				<hr class="mt0">
				Контакты для связи и техподдержки:<br>

			</div>
		</div>
	</div>
	<script src="/StarterKit/assets/js/jquery.min.js"></script>
	<script>
		$( document )
			.on('click', '.code', function () {
				$( this ).select();

			})
			.on('click', '#wtq', function () {
				$( '.queries' ).slideToggle( 400 );
				$( this ).toggleClass( 'active' );

			});
	</script>
</div><!-- .body-wrapper clearfix -->
</body>
</html>
