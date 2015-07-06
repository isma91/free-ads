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
	{!! Html::script('js/recherche.js') !!}
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="../panel">Le Bon Campus</a>
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
	if (Session::has('messageRecherche')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messageRecherche') !!}</div>
		<?php
	}
	?>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
			<p>Vous pouvez rechercher n'importe quelle anonces via le formulaire de recherche !!</p>
			{!! Form::open(array( 'url' => 'rechercheAnnonce')) !!}
			<div class="form-group">
				{!! Form::label('titre', 'Titre de L"annonce :') !!}
				{!! Form::input('search', 'titre', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::button('Preciser le prix ??', ['class' => 'btn', 'id' => 'enablePrix']) !!}
			</div>
			<div class="form-group" id="prixmin">
				{!! Form::label('prixMin', 'Prix minimal :') !!}
				<p id="valeurPrixMin"></p>
				{!! Form::input('range', 'prixMin', null, ['class' => 'form-control',
				'min' => 0, 'max' => 9999, 'onchange' => 'rangeValue()']) !!}
			</div>
			<div class="form-group" id="prixmax">
				{!! Form::label('prixMax', 'Prix maximal :') !!}
				<p id="valeurPrixMax"></p>
				{!! Form::input('range', 'prixMax', null, ['class' => 'form-control',
				'min' => 0, 'max' => 9999, 'onchange' => 'rangeValue()']) !!}
			</div>
			<div class="from-group">
				{!! Form::submit('Recherche', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</body>
</html>