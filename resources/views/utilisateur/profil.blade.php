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
	$user = Auth::user();
	if (Session::has('messagePass')) {
		?>
		<div class="alert alert-success">{!! Session::get('messagePass') !!}</div>
		<?php
	}
	if (Session::has('messageOldPass')) {
		?>
		<div class="alert alert-danger">{!! Session::get('messageOldPass') !!}</div>
		<?php
	}
	if (Session::has('messageNewPass')) {
		?>
		<div class="alert alert-danger">{!! Session::get('messageNewPass') !!}</div>
		<?php
	}
	if (Session::has('messageDejaCo')) {
		?>
		<div class="alert alert-warning" role="alert">{!! Session::get('messageDejaCo') !!}</div>
		<?php
	}
	if (Session::has('messageUpdateUserUsername')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messageUpdateUserUsername') !!}</div>
		<?php
	}
	if (Session::has('messageUpdateUser')) {
		?>
		<div class="alert alert-success" role="alert">{!! Session::get('messageUpdateUser') !!}</div>
		<?php
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
					<li class="active"><a href="profil">Profil</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Annonces<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="ajoutAnnonce">Ajouter</a></li>
							<li><a href="displayAllAnnonce/">Tout les annonces</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Vos Annonces</li>
							<li><a href="updateUserAnnonce/">Modifier ou Supprimer</a></li>
							<li><a href="displayUserAnnonce/">Les voir</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="recherche/">Recherche</a></li>
					<li>
						{!! Form::open(['url' => 'deco']) !!}
						{!! Form::submit('Deconnexion', ['class' => 'btn btn-primary form-control']) !!}
						{!! Form::close() !!}
					</li>
					<li><a href="message/">Message</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
			<p>Vous pouvez changer votre profil selon vos envies !!</p>
			{!! Form::open(['url' => 'updateUser']) !!}
			<div class="form-group">
				{!! Form::label('name', 'Votre Nom :') !!}
				{!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('lastname', 'Votre Prenom :') !!}
				{!! Form::text('lastname', $user->lastname, ['class' => 'form-control', 'placeholder' => 'Votre prenom']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('username', 'Votre Pseudo :') !!}
				{!! Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Votre pseudo']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('birthdate', 'Votre Date de naissance :') !!}
				{!! Form::input('date', 'birthdate', $user->birthdate, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('email', 'Votre Email :') !!}
				{!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Modifier votre profil', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}
			{!! Form::open(['url' => 'updateUserPass']) !!}
			<div class="form-group">
				{!! Form::label('oldPassword', 'Ancien Mot de passe :') !!}
				{!! Form::password('oldPassword', null, ['class' => 'form-control', 'placeholder' => 'MINIMUM 5 CHARACTERES']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('newPassword', 'Nouveau Mot de passe :') !!}
				{!! Form::password('newPassword', null, ['class' => 'form-control', 'placeholder' => 'MINIMUM 5 CHARACTERES']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Modifier votre mot de passe', ['class' => 'btn btn-primary form-control']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div> 
</body>
</html>