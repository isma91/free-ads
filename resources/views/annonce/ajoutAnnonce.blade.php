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
	{!! Html::style('css/dropzone.css') !!}
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
				<a class="navbar-brand" href="panel">Le Bon Campus</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="panel">Home</a></li>
					<li><a href="profil">Profil</a></li>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Annonces<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="active"><a href="ajoutAnnonce">Ajouter</a></li>
							<li><a href="displayAllAnnonce">Tout les annonces</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Vos Annonces</li>
							<li><a href="updateUserAnnonce">Modifier ou Supprimer</a></li>
							<li><a href="displayUserAnnonce">Les voir</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="recherche">Recherche</a></li>
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
	if (Session::has('messagePasImage')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messagePasImage') !!}</div>
		<?php
	}
	if (Session::has('messageNoImage')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messageNoImage') !!}</div>
		<?php
	}
	if (Session::has('messageAnnonce')) {
		?>
		<div class="alert alert-success" role="alert">{!! Session::get('messageAnnonce') !!}</div>
		<?php
	}
	if (Session::has('messageTooMuchImage')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messageTooMuchImage') !!}</div>
		<?php
	}
	?>
	<div class="container">
		<div class="jumbotron">
			{!! Form::open(array( 'url' => 'ajouterAnnonce' , 'files'=>true)) !!}
			<div class="form-group">
				{!! Form::label('titre', 'Titre de L"annonce :') !!}
				{!! Form::text('titre', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('prix', 'Prix :') !!}
				<p id="valeurPrix"></p>
				{!! Form::input('range', 'prix', null, ['class' => 'form-control',
				'min' => 0, 'max' => 9999, 'onchange' => 'rangeValueAjouter()']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('typePrix', 'Type de monnaie :')!!}
				{!! Form::select('typePrix', [
				'€' => 'Euro (€)',
				'$' => 'Dollar ($)',
				'¥ JPY' => 'Yen Japonais (¥)',
				'¥ CNY' => 'Yuan Chinois (¥)',
				'₩' => 'Won Sud-Coréen (₩)',
				'₺' => 'Livre Turque (₺)',
				'₽' => 'Rouble Russe (₽)'
				],
				['class' => 'form-control']
				) !!}
			</div>
			<div class="form-group">
				{!! Form::label('numero', 'Numero de Telephone :') !!}
				{!! Form::input('tel', 'numero', null, ['class' => 'form-control', 'pattern' => '[0-9]{10,}', 'title' => 'Un numéro de telephone à 10 chiffres !!', 'placeholder' => '0123456789']) !!}
			</div>
			<h2>Vous pouvez ajouter jusqu'à 4 images appuyer sur CTRL pour en selectionner plusieurs :</h2>
			<div class="form-group">
				{!! Form::label('file[]', 'Image  :') !!}
				{!! Form::input('file', 'file[]', null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
				{!! Form::label('description', 'Decriver votre annonce :') !!}
				{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
				{!! Form::submit('Ajouter Annonce', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div> 
</body>
</html>