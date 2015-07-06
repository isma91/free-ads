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
	$messages_sender = DB::table('messages')->join('utilisateurs', 'messages.sender_id', '=', 'utilisateurs.id')->where('messages.sender_id', Auth::user()->id)->select('messages.id', 'messages.recever_id', 'messages.titre', 'messages.content', 'messages.created_at')->get();
	$messages_recever = DB::table('messages')->join('utilisateurs', 'messages.recever_id', '=', 'utilisateurs.id')->where('messages.recever_id', Auth::user()->id)->select('messages.id', 'messages.sender_id', 'messages.titre', 'messages.content', 'messages.created_at')->get();
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
	if (Session::has('messageSend')) {
		?>
		<div class="alert alert-success" role="alert">{!! Session::get('messageSend') !!}</div>
		<?php
	}
	?>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
			<p>Voici vos messages envoyés !!</p>
			<?php
			foreach ($messages_sender as $value) {
				$recever = DB::table('utilisateurs')->where('id', '=', $value->recever_id)->first();
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">A qui : {!! $recever->username !!}</h3>
						<h3 class="panel-title">Titre : {!! $value->titre !!}</h3>
					</div>
					<div class="panel-body">
						<p>{!! $value->content !!}</p>
					</div>
					<div class="panel-body">
						<p>Envoyé le : {!! $value->created_at !!}</p>
					</div>
				</div>
				<?php
			}
			?>
			<p>Voici vos messages recus !!</p>
			<?php
			foreach ($messages_recever as $value) {
				$sender = DB::table('utilisateurs')->where('id', '=', $value->sender_id)->first();
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">De qui : {!! $sender->username !!}</h3>
						<h3 class="panel-title">Titre : {!! $value->titre !!}</h3>
					</div>
					<div class="panel-body">
						<p>{!! $value->content !!}</p>
					</div>
					<div class="panel-body">
						<p>Recus le : {!! $value->created_at !!}</p>
					</div>
					{!! Form::open(['url' => 'repondreMessage']) !!}
					<div class="form-group">
					<label>Reponder le :</label>
						{!! Form::hidden('title', $value->titre) !!}
						{!! Form::hidden('id', $sender->id) !!}
						{!! Form::textarea('content', null, ['class' => 'form-control']) !!}
						{!! Form::submit('Repondre a ce message !!', ['class' => 'btn btn-primary form-control']) !!}
					</div>
					{!! Form::close() !!}
				</div>
				<?php
			}
			?>
		</div>
	</div> 
</body>
</html>