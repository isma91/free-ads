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
	{!! Html::style('css/fixed-top.css') !!}
	{!! Html::script('js/jquery-2.1.3.js') !!}
	{!! Html::script('js/bootstrap.min.js') !!}
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<?php
	if (Session::has('titre')) {
		$annonces = DB::table('annonces')->where('titre', 'LIKE', '%'.$titre.'%')->get();
	}
	if (Session::has('prixMin-prixMax')) {
		$annonces = DB::table('annonces')->where('titre', 'LIKE', '%'.$titre.'%')->whereBetween('prix', [$prixMin, $prixMax])->get();
	}
	if (Session::has('prixMax-prixMin')) {
		$annonces = DB::table('annonces')->where('titre', 'LIKE', '%'.$titre.'%')->whereBetween('prix', [$prixMax, $prixMin])->get();
	}
	if (Session::has('prixMax')) {
		$annonces = DB::table('annonces')->where('titre', 'LIKE', '%'.$titre.'%')->where('prix', $prixMax)->get();
	}
	?>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="panel">Le Bon Campus</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="panel">Home</a></li>
					<li><a href="profil">Profil</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Annonces<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="ajoutAnnonce">Ajouter</a></li>
							<li><a href="displayAllAnnonce">Tout les annonces</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Vos Annonces</li>
							<li><a href="updateUserAnnonce">Modifier ou Supprimer</a></li>
							<li><a href="displayUserAnnonce">Les voir</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="recherche">Recherche</a></li>
					<li>
						{!! Form::open(['url' => 'deco']) !!}
						{!! Form::submit('Deconnexion', ['class' => 'btn btn-primary form-control']) !!}
						{!! Form::close() !!}
					</li>
					<li><a href="message">Message</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
	if (Session::has('messageDejaCo')) {
		?>
		<div class="alert alert-warning" role="alert">{!! Session::get('messageDejaCo') !!}</div>
		<?php
	}
	?>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
			<p>Voici vos recherche !!</p>
		</div>
		<?php
		foreach ($annonces as $value) {
			$images = explode("|", $value->picture);
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{!! $value->titre !!}</h3>
				</div>
				<div class="panel-body">
					<p>Numero de téléphone : {!! $value->numero !!}</p>
					<p>Email du vendeur : {!! $value->email !!}</p>
					<p>Prix : {!! $value->prix !!} {!! $value->monnaie !!}</p>
				</div>
				<div class="panel-body">
					<p>{!! $value->description !!}</p>
					<?php
					foreach ($images as $valueImage) {
						?>
						<img class="img-thumbnail" src='{!! url() !!}/../../storage/user-{!! $value->user_id !!}/{!! $value->id !!}/{!! $valueImage !!}' alt='{!! $value->description !!}'>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		?>
	</div> 
</body>
</html>