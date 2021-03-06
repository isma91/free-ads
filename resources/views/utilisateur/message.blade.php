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
	$otherUsers = DB::table('utilisateurs')->where('id', '!=', Auth::user()->id)->get();
	?>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="../panel">Le Bon Campus</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="../panel">Home</a></li>
					<li><a href="../profil">Profil</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Annonces<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="../ajoutAnnonce">Ajouter</a></li>
							<li><a href="../displayAllAnnonce/">Tout les annonces</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Vos Annonces</li>
							<li><a href="../updateUserAnnonce/">Modifier ou Supprimer</a></li>
							<li><a href="../displayUserAnnonce/">Les voir</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../recherche/">Recherche</a></li>
					<li>
						{!! Form::open(['url' => 'deco']) !!}
						{!! Form::submit('Deconnexion', ['class' => 'btn btn-primary form-control']) !!}
						{!! Form::close() !!}
					</li>
					<li class="active"><a href="../message/">Message</a></li>
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
	if (Session::has('messagePasContent')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messagePasContent') !!}</div>
		<?php
	}
	if (Session::has('messagePasTitre')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messagePasTitre') !!}</div>
		<?php
	}
	if (Session::has('messageSend')) {
		?>
		<div class="alert alert-success" role="alert">{!! Session::get('messageSend') !!}</div>
		<?php
	}
	?>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
			{!! Form::open(['url' => 'ajouterMessage']) !!}
			<div class="form-group">
				<label>Envoyer à qui ?</label>
				<select name="send_to" class="form-control">
					<?php
					foreach ($otherUsers as $value) {
						?>
						<option value='{!! $value->id !!}'>{!! $value->username !!}</option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="form-group">
				{!! Form::label('titre', 'Titre de votre message :') !!}
				{!! Form::text('titre', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('content', 'Contenu de votre message :') !!}
				{!! Form::textarea('content', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Envoyer message', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
			<a class="btn btn-lg btn-primary" href="../voirMessage/" role="button">Boite de reception</a>
		</div>
	</div> 
</body>
</html>