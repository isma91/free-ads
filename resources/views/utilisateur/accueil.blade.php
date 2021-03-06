<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Le Bon Campus</title>
	<meta charset="utf-8" />
	<meta name="description" content="Acheter ou vendez !!" />
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/bootstrap-theme.min.css') !!}
	{!! Html::style('css/bootstrap.css.map') !!}
	{!! Html::style('css/bootstrap-theme.css.map') !!}
	{!! Html::script('js/jquery-2.1.3.js') !!}
	{!! Html::script('js/bootstrap.min.js') !!}
	{!! Html::style('css/cover.css') !!}
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="cover-container">
				<div class="masthead clearfix">
					<div class="inner">
						<h3 class="masthead-brand">Le Bon Campus</h3>
						<nav>
							<ul class="nav masthead-nav">
								<li class="active"><a href="accueil">Accueil</a></li>
								<li><a href="inscription">Inscription</a></li>
								<li><a href="connexion">Connexion</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<?php
				if (Session::has('messagePasCo')) {
					?>
					<div class="alert alert-warning" role="alert">{!! Session::get('messagePasCo') !!}</div>
					<?php
				}
				?>
				<div class="inner cover">
					<h1 class="cover-heading">Bienvenue dans Le Bon Campus !!</h1>
					<p class="lead">Inscrivez-vous puis chercher des milliers d'annonce ou bien vendez vos affaires !!</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>